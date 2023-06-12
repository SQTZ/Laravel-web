<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\G_dashboard;
use App\Charts\UserChart;

class DashboardController extends Controller
{
    public function dashboard()
{
    //On affiche le nombre de pages qu'on veut
    $articles = G_dashboard::paginate(10);

    return view('dashboard', compact('articles'));
}



public function show(UserChart $chart, $Code_dossier)
{
    $versions = G_dashboard::where('Code_dossier', $Code_dossier)->get();
    $user = auth()->user();

    $uniqueVersions = $versions->pluck('Version')->unique();

    // Créer un graphique qui inclut des données pour chaque version
    $chart = (new UserChart)->build($Code_dossier, $uniqueVersions);

    return view('show', compact('uniqueVersions', 'Code_dossier', 'chart', 'user', 'versions'));
}



    public function search(Request $request)
    {
        $search_text = $request->input('search');
        
        $articles = G_dashboard::where('Code_dossier', 'LIKE', '%' . $search_text . '%')->get();
    
        return view('dashboard', compact('articles', 'search_text'));
    }
}
