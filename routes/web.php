<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CreateController;
use App\Http\Controllers\VariableController;
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

// Route -- Variables --
Route::get('variable', [VariableController::class, 'index'])->name('variable');

// Route -- Dashboard --
Route::group([], function () {

    // Route -- Dashboard -- Listes des articles
    Route::get('/dashboard', function () {
        $articles_list = new \App\Models\G_dashboard();
        $articles = $articles_list->get();
        return view('dashboard', compact('articles'));
    })->middleware(['auth', 'verified'])->name('dashboard');

    // Route -- Dashboard -- Afficher un article
    Route::get('show/{Code_article}', function ($Code_article) {
        $article = \App\Models\G_dashboard::where('Code_article', $Code_article)->first();
        return view('show', compact('article'));
    });

    // Route -- Dashboard -- Rechercher un article
    Route::get('search', function (\Illuminate\Http\Request $request) {
        $search_text = $request->input('search');
        $articles = \App\Models\G_dashboard::where('Code_article', 'LIKE', '%' . $search_text . '%')
        ->orwhere('Version', 'LIKE', '%' . $search_text . '%')
        ->orwhere('Date', 'LIKE', '%' . $search_text . '%')->get();
        return view('dashboard', compact('articles', 'search_text'));
    });

});


// Route -- Editor -- Créer un article
Route::get('editor', [CreateController::class, 'index'])->name('editor');
Route::get('/fetch-data', [CreateController::class, 'fetchData']);
Route::get('/fetch-ff', [CreateController::class, 'fetchFF']);



// Route -- Variables -- Ajouter
Route::post('/fetch-variable', [VariableController::class, 'deploy']);

// Route -- Authentification --
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';