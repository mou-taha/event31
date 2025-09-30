<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\View\View; // Importez la classe View


class PolitiqueController extends Controller
{
    public function index(): View
    {
        return view('politique', [
            'menus' => Menu::all(),
        ]);
    }}
