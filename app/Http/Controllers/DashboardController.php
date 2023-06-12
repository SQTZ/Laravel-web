<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\G_dashboard;

class DashboardController extends Controller
{
    public function dashboard()
{
    //On affiche le nombre de lignes qu'on avoir dans notre vue
    $articles = G_dashboard::paginate(10);

    return view('dashboard', compact('articles'));
}



    public function show($Code_dossier)
    {
        $versions = G_dashboard::where('Code_dossier', $Code_dossier)->get();

        //J'utilise ce paramétrage pour afficher toutes les versions disponibles et d'éviter de duppliquer le code_dossier si on a plusieurs versions.
        $uniqueVersions = $versions->pluck('Version')->unique();
        return view('show', compact('uniqueVersions', 'Code_dossier'));
    }

    public function search(Request $request)
    {
        $search_text = $request->input('search');
        
        $articles = G_dashboard::where('Code_dossier', 'LIKE', '%' . $search_text . '%')->get();
    
        return view('dashboard', compact('articles', 'search_text'));
    }
}
