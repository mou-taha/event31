<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('contact', [
            'menus' => Menu::all(),
        ]);
    }
}
