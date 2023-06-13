<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\G_dashboard;
use App\Charts\UserChart;

class DashboardController extends Controller
{
    public function dashboard()
{
    // Sous-requête pour obtenir l'ID du dernier article pour chaque code_dossier
    $latestArticleIDs = G_dashboard::select('code_dossier', G_dashboard::raw('MAX(id) as id'))
        ->groupBy('code_dossier')
        ->get()
        ->pluck('id');

    // Utilisez ces ID pour obtenir les articles correspondants
    $articles = G_dashboard::whereIn('id', $latestArticleIDs)->paginate(10);

    return view('dashboard', compact('articles'));
}




public function show(UserChart $chart, $Code_dossier)
{
    $versions = G_dashboard::where('Code_dossier', $Code_dossier)->get();
    $user = auth()->user();

    $uniqueVersions = $versions->pluck('Version')->unique();

    // Créer un graphique qui inclut des données pour chaque version
    $userChart = (new UserChart)->build($Code_dossier, $uniqueVersions);
    $chart = $userChart['chart'];
    $lastPercentageChange = $userChart['lastPercentageChange'];

    return view('show', compact('uniqueVersions', 'Code_dossier', 'chart', 'user', 'versions', 'lastPercentageChange'));
}




    public function search(Request $request)
    {
        $search_text = $request->input('search');
        
        $articles = G_dashboard::where('Code_dossier', 'LIKE', '%' . $search_text . '%')->get();
    
        return view('dashboard', compact('articles', 'search_text'));
    }
}
