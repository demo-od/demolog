<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     *
     * - Computes a clean Cloudinary public_id (no extension, no version segment)
     *   before calling delete(). Flysystem's delete() expects a string path only.
     * - If the Storage driver delete() fails, falls back to the Cloudinary SDK's
     *   destroy() which supports options like 'invalidate' => true.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $user = $request->user();

        if ($request->hasFile('image')) {
            // Delete old image on Cloudinary if we have a stored id/value
            if (!empty($user->image_public_id) || !empty($user->image)) {
                // Prefer image_public_id if present, otherwise try the image URL column
                $storedValue = $user->image_public_id ?: $user->image;

                // Compute a robust public_id string (no extension, no /v123/ segment)
                $publicId = $this->extractCloudinaryPublicId($storedValue);

                // Use the driver first (Storage). IMPORTANT: pass only a string.
                $deleted = false;
                try {
                    $deleted = Storage::disk('cloudinary')->delete($publicId);
                } catch (\Throwable $e) {
                    $deleted = false;
                }

                // Fallback: if driver didn't delete, try Cloudinary SDK directly (supports invalidate)
                if (! $deleted) {
                    if (class_exists(\Cloudinary\Cloudinary::class)) {
                        try {
                            $cloudinary = new \Cloudinary\Cloudinary([
                                'cloud' => [
                                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                                    'api_key'    => env('CLOUDINARY_API_KEY'),
                                    'api_secret' => env('CLOUDINARY_API_SECRET'),
                                ],
                            ]);

                            // 'invalidate' clears CDN cached copies
                            $cloudinary->uploadApi()->destroy($publicId, ['invalidate' => true]);
                        } catch (\Throwable $e) {
                            // intentionally left blank (no logging)
                        }
                    }
                }
            }

            // Upload new image using the Storage disk (driver returns a path/public id)
            $path = Storage::disk('cloudinary')->put('avatars', $request->file('image'));

            // Get a CDN-safe URL for storing/display
            $imageUrl = Storage::disk('cloudinary')->url($path);

            // Save into $data so it gets persisted. Also set directly on the model below.
            $data['image'] = $imageUrl;
            $data['image_public_id'] = $path;
        } else {
            // If no new image was uploaded, don't overwrite existing image fields
            unset($data['image'], $data['image_public_id']);
        }

        // Persist changes
        $user->fill($data);

        if (isset($data['image_public_id'])) {
            $user->image_public_id = $data['image_public_id'];
        }

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Extract a Cloudinary public_id from a stored value.
     *
     * Handles inputs that are:
     * - a full Cloudinary URL: https://res.cloudinary.com/<cloud>/image/upload/v123/.../folder/name.jpg
     * - a path with version segments
     * - a plain saved path like "avatars/name.jpg" or "avatars/name"
     *
     * Returns a string like "avatars/name" (no leading slash, no extension).
     */
    private function extractCloudinaryPublicId(string $stored): string
    {
        // Trim whitespace
        $stored = trim($stored);

        // If it's a full URL, grab the path portion
        if (preg_match('#^https?://#i', $stored)) {
            $path = parse_url($stored, PHP_URL_PATH) ?: $stored;

            // Remove version segment like /v123456/
            $path = preg_replace('#/v\d+/#', '/', $path);

            // If URL contains "/upload/", take everything after it
            if (strpos($path, '/upload/') !== false) {
                $path = substr($path, strpos($path, '/upload/') + strlen('/upload/'));
            }

            $stored = ltrim($path, '/');
        }

        // Remove any leading slashes
        $stored = ltrim($stored, '/');

        // Remove file extension if present (.jpg, .png, .jpeg, .webp etc.)
        $stored = preg_replace('/\.[a-zA-Z0-9]+$/', '', $stored);

        return $stored;
    }
}