<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PublicProfileController extends Controller
{
    public function show(request $request, User $user) {
        return view('profile.show', compact('user'));
    }
}
