<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(Request $request): View
    {

        return view('permissions', [
            'permissions' => Permission::paginate(10),

        ]);   
    }}
