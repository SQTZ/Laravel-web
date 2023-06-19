<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\G_dashboard;
use App\Charts\UserChart;
use App\Models\result_mat;
use App\Models\result_emb;
use App\Models\result_mod;

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

    $pvMax = $versions->max('PV');
    $pvMin = $versions->min('PV');

    $uniqueVersions = $versions->pluck('Version')->unique();

    // Créer un graphique qui inclut des données pour chaque version
    $userChart = (new UserChart)->build($Code_dossier, $uniqueVersions);
    $chart = $userChart['chart'];
    $lastPercentageChange = $userChart['lastPercentageChange'];

    return view('show', compact('uniqueVersions', 'Code_dossier', 'chart', 'user', 'versions', 'lastPercentageChange', 'pvMax', 'pvMin'));
}




    public function search(Request $request)
    {
        $search_text = $request->input('search');
        
        $articles = G_dashboard::where('Code_dossier',  'LIKE', '%' . $search_text . '%')->paginate();
    
        return view('dashboard', compact('articles', 'search_text'));
    }

    public function delete($Code_dossier)
    {
        $article_dashboard = G_dashboard::where('Code_dossier', $Code_dossier);
        $article_mat = result_mat::where('Code_dossier', $Code_dossier);
        $article_emb = result_emb::where('Code_dossier', $Code_dossier);
        $article_mod = result_mod::where('Code_dossier', $Code_dossier);

        $article_dashboard->delete();
        $article_mat->delete();
        $article_emb->delete();
        $article_mod->delete();

        return redirect('/dashboard');
    }
}
