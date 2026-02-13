<?php

namespace App\Providers;

use GuzzleHttp\Client;
use App\Mail\GmailTransport;
use App\Services\GmailService;
use League\Flysystem\Filesystem;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use Masbug\Flysystem\GoogleDriveAdapter;
use Illuminate\Filesystem\FilesystemAdapter;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(\Illuminate\Routing\UrlGenerator $url): void
    {
        // 1. Force HTTPS only in production/staging
        if (env('APP_ENV') !== 'local') {
            $url->forceScheme('https');
        }

        // 2. Share Categories with Navigation (Must be OUTSIDE the if-local check)
        \Illuminate\Support\Facades\View::composer('layouts.navigation', function ($view) {
            $view->with('categories', \App\Models\Category::orderBy('name')->get());
        });

        // 3. Mail Extension
        Mail::extend('gmail', function () {
            return new GmailTransport(app(GmailService::class));
        });
    }
}
