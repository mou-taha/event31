<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\View\View; // Importez la classe View


class AproposController extends Controller
{
    public function index(): View
    {
        return view('apropos', [
            'menus' => Menu::all(),
        ]);
    }
}
