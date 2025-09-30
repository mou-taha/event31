<?php

use App\Livewire\UserChat;
use App\Livewire\AdminChat;
use App\Livewire\Actions\Logout;
use App\Livewire\ManagePermission;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\AproposController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PolitiqueController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ConditionsController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\MpublicationController;

Route::get('/', [PublicationController::class, 'index'])->name('index');
Route::view('/publication/{type}/{id}', 'publications.show')->name('show');

Route::get('/menus/{id}', [MpublicationController::class, 'index'])->name('menus.index');

Route::get('/posts', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/categories/{category}', [BlogController::class, 'blogsByCategory'])->name('blogs.byCategory');
Route::get('/blogs/{blog}', [BlogController::class, 'show'])->name('blogs.show');



Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/apropos', [AproposController::class, 'index'])->name('apropos');
Route::get('/conditions', [ConditionsController::class, 'index'])->name('conditions');
Route::get('/politique', [PolitiqueController::class, 'index'])->name('politique');

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('auth.google.callback');


Route::view('/accueil', 'panel.accueil')->middleware(['auth', 'verified']);
Route::view('/access', 'panel.access')->middleware(['auth', 'verified'])->name('access');
Route::view('/roles', 'panel.roles')->middleware(['auth', 'verified'])->name('roles');
Route::view('/permissions', 'panel.permissions')->middleware(['auth', 'verified'])->name('permissions')->middleware('permission:Lire Permission');
// 
Route::view('/blogs', 'panel.blogs')->middleware(['auth', 'verified'])->name('blogs')->middleware('permission:Lire Blog');
Route::view('/inputblog/{id?}', 'panel.inputblog')->middleware(['auth', 'verified'])->name('inputblog')->middleware('permission:Créer Blog');

Route::view('/categories', 'panel.categories')->middleware(['auth', 'verified'])->name('categories')->middleware('permission:Lire Categorie');
Route::view('/tags', 'panel.tags')->middleware(['auth', 'verified'])->name('tags')->middleware('permission:Lire Tag');

Route::view('/events', 'panel.events')->middleware(['auth', 'verified'])->name('events');
Route::view('/inputevent/{id?}', 'panel.inputevent')->middleware(['auth', 'verified'])->name('inputevent');

Route::view('/menus', 'panel.menus')->middleware(['auth', 'verified'])->name('menus')->middleware('permission:Lire Menu');
Route::view('/types', 'panel.types')->middleware(['auth', 'verified'])->name('types')->middleware('permission:Lire Type');
Route::view('/subtypes', 'panel.subtypes')->middleware(['auth', 'verified'])->name('subtypes')->middleware('permission:Lire Soustype');
Route::view('/cities', 'panel.cities')->middleware(['auth', 'verified'])->name('cities')->middleware('permission:Lire Ville');
Route::view('/prices', 'panel.prices')->middleware(['auth', 'verified'])->name('prices')->middleware('permission:Lire Access');
Route::view('/organisms', 'panel.organisms')->middleware(['auth', 'verified'])->name('organisms')->middleware('permission:Lire Organisme');
Route::view('/inputorganism/{id?}', 'panel.inputorganism')->middleware(['auth', 'verified'])->name('inputorganism')->middleware('permission:Créer Organisme');

Route::view('/settings', 'panel.settings')->middleware(['auth', 'verified'])->name('settings');
Route::view('/settingsaccount', 'panel.settingsaccount')->middleware(['auth', 'verified'])->name('settingsaccount');
Route::view('/settingspassword', 'panel.settingspassword')->middleware(['auth', 'verified'])->name('settingspassword');

Route::view('/users', 'panel.users')->middleware(['auth', 'verified'])->name('users')->middleware('permission:Lire Utilisateur');
Route::view('/org', 'panel.org')->middleware(['auth', 'verified'])->name('org')->middleware('permission:Lire Organisme');
Route::view('/favorites', 'panel.favorites')->middleware(['auth', 'verified'])->name('favorites');
Route::view('/privacy', 'panel.privacy')->middleware(['auth', 'verified'])->name('privacy');
Route::view('/cadmin', 'panel.cadmin')->middleware(['auth', 'verified'])->name('cadmin');

Route::post('/logout', Logout::class)->name('logout');

Route::view('/a', 'a')->name('#');

Route::view('dashboard', 'panel.dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
