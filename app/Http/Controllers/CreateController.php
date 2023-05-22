<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\G_produit;
use App\Models\G_variable;

class CreateController extends Controller
{
    public function index()
    {
        return view('editor');
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