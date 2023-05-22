<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Pour créer les codes des dossiers
use Illuminate\Support\Str;

//On ajoute nos modèles qu'on a besoin
use App\Models\G_dashboard;
use App\Models\result_mat;
use App\Models\result_emb;
use App\Models\result_mod;

class PusherController extends Controller
{
    //On génère la clé dossier
    public function generateDossier()
    {
        $code = Str::random(5);

        return $code;
    }


    public function generateMAT(Request $request)
    {
        //Je génère ma requête ajax et je le stocke ici
        list($codeArticle, $designation, $prixKgMAT, $quantiteMAT, $freinteMAT, $poidsMatMAT, $coutMatiereMAT, $freinteGlobaleMAT) = [
            $request->get('codeArticle'),
            $request->get('designation'),
            $request->get('prixKgMAT'),
            $request->get('quantiteMAT'),
            $request->get('freinteMAT'),
            $request->get('poidsMatMAT'),
            $request->get('coutMatiereMAT'),
            $request->get('freinteGlobaleMAT')
        ];
        

        //dd($request->all());
        //Je met une condition, si les données sont vides, je renvoie un message d'erreur
        if (is_null($codeArticle) || $codeArticle == '') {
            dd('codeArticle is empty');
        }
        if (is_null($designation) || $designation == '') {
            dd('designation is empty');
        }
        if (is_null($prixKgMAT) || $prixKgMAT == '') {
            dd('prixKgMAT is empty');
        }
        if (is_null($quantiteMAT) || $quantiteMAT == '') {
            dd('quantiteMAT is empty');
        }
        if (is_null($freinteMAT) || $freinteMAT == '') {
            dd('freinteMAT is empty');
        }
        if (is_null($poidsMatMAT) || $poidsMatMAT == '') {
            dd('poidsMatMAT is empty');
        }
        if (is_null($coutMatiereMAT) || $coutMatiereMAT == '') {
            dd('coutMatiereMAT is empty');
        }
        if (is_null($freinteGlobaleMAT) || $freinteGlobaleMAT == '') {
            dd('freinteGlobaleMAT is empty');
        }



        //j'envoie les données dans la base de données
        $data = result_mat::create([
            'Code_dossier' => $this->generateDossier(),
            'Code_article' => $codeArticle,
            'Designation' => $designation,
            'Prix_kg' => $prixKgMAT,
            'Quantite' => $quantiteMAT,
            'Freinte' => $freinteMAT,
            'Poids_mat' => $poidsMatMAT,
            'Cout_matiere' => $coutMatiereMAT,
            'Freinte_globale' => $freinteGlobaleMAT,
        ]);

        if ($data) {
            return response()->json($data);
        } else {
            return response()->json(['error' => "J'arrive pas à l'envoyer"]);
        }
    }



    public function createDossier(){
        //J'apelle mes fonctions ici
        
    }
}
