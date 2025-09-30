<?php

namespace App\Livewire\Actions;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;

class Logout
{
    /**
     * Log the current user out of the application and redirect to index.
     */
    public function __invoke(): RedirectResponse
    {
        Auth::guard('web')->logout();

        Session::invalidate();
        Session::regenerateToken();

        // Use response()->redirectToRoute() to return the correct RedirectResponse type
        return response()->redirectToRoute('index');
    }
}