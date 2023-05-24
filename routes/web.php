<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CreateController;
use App\Http\Controllers\VariableController;
use App\Http\Controllers\PusherController;
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

    // Route -- Dashboard -- Listes des articles
    Route::get('/dashboard', function () {
        $articles_list = new \App\Models\G_dashboard();
        $articles = $articles_list->get();
        return view('dashboard', compact('articles'));
    })->middleware(['auth', 'verified'])->name('dashboard');

    // Route -- Dashboard -- Afficher un article
    Route::get('show/{Code_dossier}', function ($Code_dossier) {
        $versions = \App\Models\G_dashboard::where('Code_dossier', $Code_dossier)->get();

        //J'utilise ce paramétrage pour afficher toutes les versions disponibles et d'éviter de duppliquer le code_dossier si on a plusieurs versions.
        $uniqueVersions = $versions->pluck('Version')->unique();
        return view('show', compact('uniqueVersions', 'Code_dossier'));
    });
    
    

    // Route -- Dashboard -- Rechercher un article
    Route::get('search', function (\Illuminate\Http\Request $request) {
        $search_text = $request->input('search');
        
        $articles = \App\Models\G_dashboard::where('Code_dossier', 'LIKE', '%' . $search_text . '%')->get();
    
        return view('dashboard', compact('articles', 'search_text'));
    });  

});



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


require __DIR__ . '/auth.php';