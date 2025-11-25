<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;

Route::get('/', [RecipeController::class, 'indexBeforeLogin'])->name('welcome');

Route::get('/login', function () {
    return view('login');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/daftar', function () {
    return view('daftar');
});

Route::get('/clickedprofile', function () {
    return view('clickedprofile');
});

//Route::get('/halamanprofile', [ProfileController::class, 'show'])->name('profile.show')->middleware('auth');

//Route::get('/editprofile', [ProfileController::class, 'edit'])->name('profile.edit');
//Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/gantiemail', function () {
    return view('gantiemail');
});

Route::get('/berandaSetelahLogin', [RecipeController::class, 'indexAfterLogin'])->name('beranda.setelah.login');

Route::get('/makanan', [RecipeController::class, 'showMakanan'])->name('makanan');

Route::get('/minuman', [RecipeController::class, 'showMinuman'])->name('minuman');

Route::get('/cemilan', [RecipeController::class, 'showCemilan'])->name('cemilan');

Route::get('/koleksiAda', [RecipeController::class, 'showFavorites'])->name('koleksiAda')->middleware('auth');

Route::get('/koleksiKosong', function () {
    return view('koleksiKosong');
});

Route::get('/resep/{id}', [RecipeController::class, 'show'])->name('recipe.show');

Route::get('/uploadresep', [RecipeController::class, 'create'])->name('recipe.create');
Route::post('/resep', [RecipeController::class, 'store'])->name('recipe.store');

Route::post('/favorites/{recipe}', [RecipeController::class, 'toggleFavorite'])->name('favorites.toggle')->middleware('auth');

Route::get('/daftar', [RegisterController::class, 'showRegistrationForm'])->name('daftar');
Route::post('/daftar', [RegisterController::class, 'register']);

Route::get('/auth/google', [RegisterController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [RegisterController::class, 'handleGoogleCallback']);
Route::get('/auth/facebook', [RegisterController::class, 'redirectToFacebook'])->name('auth.facebook');
Route::get('/auth/facebook/callback', [RegisterController::class, 'handleFacebookCallback']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');




Route::get('/recipes/search', [RecipeController::class, 'search'])->name('recipes.search');


Route::middleware('auth')->group(function () {
    Route::get('/editprofile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/email', [ProfileController::class, 'updateEmail'])->name('profile.update.email');
    Route::get('/halamanprofile', [ProfileController::class, 'show'])->name('profile.show');
});
Route::group(['middleware' => ['auth']], function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::delete('/admin/recipes/{recipe}', [AdminController::class, 'destroy'])->name('admin.recipe.destroy');
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.user.destroy');
});
