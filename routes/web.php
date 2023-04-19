<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
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

// Route -- Page d'accueil --
Route::get('/', function () {
    return view('welcome');
});


// Route -- Dashboard --
Route::group([], function () {
    Route::get('/dashboard', function () {
        //Je récupère les données de la table g_dashboard
        $articles_list = new \App\Models\G_dashboard();
        $articles = $articles_list->get();
        //Et je l'affiche dans ma vue
        return view('dashboard', compact('articles'));
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::get('show/{Code_article}', function ($Code_article) {
        $article = \App\Models\G_dashboard::where('Code_article', $Code_article)->first();
        return view('show', compact('article'));
    });
});


//Route -- Authentification --
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';