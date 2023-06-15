<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CreateController;
use App\Http\Controllers\VariableController;
use App\Http\Controllers\PusherController;
use App\Http\Controllers\DocumentationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route -- Page d'accueil redirective --
Route::get('/', function () {
    return redirect('/login');
});



// Route -- Dashboard --
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/show/{Code_dossier}', [DashboardController::class, 'show'])->name('show');
Route::get('/search', [DashboardController::class, 'search'])->name('search');


// Route -- Editor --
Route::get('editor', [CreateController::class, 'create'])->name('editor.create');
Route::get('/fetch-data', [CreateController::class, 'fetchData']);
Route::get('/fetch-ff', [CreateController::class, 'fetchFF']);
Route::get('/fetch-mod', [CreateController::class, 'fetchMOD']);
Route::get('editor/{Code_dossier}/{version}', [CreateController::class, 'show'])->name('editor.show');


// Route -- Variables --
Route::get('variable', [VariableController::class, 'index'])->name('variable');
Route::post('/fetch-variable', [VariableController::class, 'deploy']);


// Route -- Pusher --
Route::post('/fetch-matdata', [PusherController::class, 'generateMAT']);
Route::post('/fetch-embdata', [PusherController::class, 'generateEMB']);
Route::post('/fetch-moddata', [PusherController::class, 'generateMOD']);
Route::post('/fetch-tabledata', [PusherController::class, 'generateDASHBOARD']);


// Route -- Authentification --
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Route -- Documentation --
Route::get('documentation', [DocumentationController::class, 'index'])->name('documentation');


require __DIR__ . '/auth.php';