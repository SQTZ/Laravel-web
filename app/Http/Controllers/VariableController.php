<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\G_variable;

class VariableController extends Controller
{
    public function index()
    {
        $datalist = G_variable::all();

    return view('variable', compact('datalist'));
    }


    public function deploy(Request $request)
    {
        //Je récupère les données du formulaire
        $Taux_horaire = $request->input('Taux_horaire');
        $Cout_ff = $request->input('Cout_ff');
        $Cout_bobine = $request->input('Cout_bobine');

        //je met une condition, si les données sont vides, je renvoie un message d'erreur
        if (empty($Taux_horaire) || empty($Cout_ff) || empty($Cout_bobine)) {
            return response()->json(['error' => 'Veuillez remplir tous les champs.']);
        }

        //J'envoie les données dans la base de données
        $data = G_variable::create([
            'Taux_horaire' => $Taux_horaire,
            'Cout_ff' => $Cout_ff,
            'Cout_bobine' => $Cout_bobine,
        ]);

        if ($data) {
            return response()->json($data);
        } else {
            return response()->json(['error' => "J'arrive pas à l'envoyer"]);
        }
    }
}