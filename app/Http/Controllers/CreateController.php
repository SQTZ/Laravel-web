<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\G_produit;
use App\Models\G_variable;
use App\Models\G_dashboard;
use App\Models\result_mat;
use App\Models\result_emb;
use App\Models\result_mod;

class CreateController extends Controller
{
    public function create()
{
    return view('editor');
}


public function show($Code_dossier, $version)
{
    $dossier = G_dashboard::where('Code_dossier', $Code_dossier)
                          ->where('Version', $version)
                          ->first();

    $dossierMAT = result_mat::where('Code_dossier', $Code_dossier)
                            ->where('Version', $version)
                            ->get();

    $dossierEMB = result_emb::where('Code_dossier', $Code_dossier)
                            ->where('Version', $version)
                            ->get();

    $dossierMOD = result_mod::where('Code_dossier', $Code_dossier)
                            ->where('Version', $version)
                            ->get();                      
    
    return view('editor', compact('dossier', 'dossierEMB', 'dossierMAT', 'dossierMOD'));
}


    public function fetchData(Request $request)
    {
        $code_article = $request->input('Reference');
        $data = G_produit::where('Reference', $code_article)->first();

        if ($data) {
            return response()->json($data);
        } else {
            return response()->json(['error' => 'Aucune donnée trouvée pour ce code article.']);
        }
    }

    public function fetchFF() {
        $data = G_variable::select('Cout_ff')->first();
        
        if ($data) {
            return response()->json($data);
        } else {
            return response()->json(['error' => 'Aucune donnée trouvée.']);
        }
    }

    public function fetchMOD() {
        $data = G_variable::select('Taux_horaire')->first();
        
        if ($data) {
            return response()->json($data);
        } else {
            return response()->json(['error' => 'Aucune donnée trouvée.']);
        }
    }
    
    

}