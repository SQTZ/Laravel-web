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
        if (!session()->has('code_dossier')) {
            session(['code_dossier' => Str::random(5)]);
        }
        return session('code_dossier');
    }
    


    public function generateDASHBOARD(Request $request)
    {
        list($resultMAT, $resultEMB, $resultMOD, $resultFF, $resultTOTAL, $resultMC, $resultPV) = [
            $request->get('resultMAT'),
            $request->get('resultEMB'),
            $request->get('resultMOD'),
            $request->get('resultFF'),
            $request->get('resultTOTAL'),
            $request->get('resultMC'),
            $request->get('resultPV')
        ];

        if (is_null($resultMAT) || $resultMAT == '') {
            dd('resultMAT is empty');
        }
        if (is_null($resultEMB) || $resultEMB == '') {
            dd('resultEMB is empty');
        }
        if (is_null($resultMOD) || $resultMOD == '') {
            dd('resultMOD is empty');
        }
        if (is_null($resultFF) || $resultFF == '') {
            dd('resultFF is empty');
        }
        if (is_null($resultTOTAL) || $resultTOTAL == '') {
            dd('resultTOTAL is empty');
        }
        if (is_null($resultMC) || $resultMC == '') {
            dd('resultMC is empty');
        }
        if (is_null($resultPV) || $resultPV == '') {
            dd('resultPV is empty');
        }

        //j'envoie les données dans la base de données
        $data = G_dashboard::create([
            'Code_dossier' => $this->generateDossier(),
            'MAT' => $resultMAT,
            'EMB' => $resultEMB,
            'MOD' => $resultMOD,
            'FF' => $resultFF,
            'TOTAL' => $resultTOTAL,
            'MC' => $resultMC,
            'PV' => $resultPV,
        ]);

        session(['dashboard_called' => true]); // Marque que la méthode dashboard a été appelée

        // Si les deux méthodes ont été appelées, réinitialise le code de dossier
        if (session()->has('mat_called')) {
            session()->forget('code_dossier');
            session()->forget('dashboard_called');
            session()->forget('mat_called');
        }


        if ($data) {
            return response()->json($data);
        } else {
            return response()->json(['error' => "J'arrive pas à l'envoyer"]);
        }
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

        session(['mat_called' => true]); // Marque que la méthode MAT a été appelée

        // Si les deux méthodes ont été appelées, réinitialise le code de dossier
        if (session()->has('dashboard_called')) {
            session()->forget('code_dossier');
            session()->forget('dashboard_called');
            session()->forget('mat_called');
        }
        

        if ($data) {
            return response()->json($data);
        } else {
            return response()->json(['error' => "J'arrive pas à l'envoyer"]);
        }

        
    }


    public function generateEMB(Request $request)
    {
        //Je génère ma requête ajax et je le stocke ici
        list($codeArticle, $designation, $prixKgEMB, $quantiteEMB, $freinteEMB, $poidsMatEMB, $coutMatiereEMB, $freinteGlobaleEMB) = [
            $request->get('codeArticle'),
            $request->get('designation'),
            $request->get('prixKgEMB'),
            $request->get('quantiteEMB'),
            $request->get('freinteEMB'),
            $request->get('poidsMatEMB'),
            $request->get('coutMatiereEMB'),
            $request->get('freinteGlobaleEMB')
        ];
        

        //dd($request->all());
        //Je met une condition, si les données sont vides, je renvoie un message d'erreur
        if (is_null($codeArticle) || $codeArticle == '') {
            dd('codeArticle is empty');
        }
        if (is_null($designation) || $designation == '') {
            dd('designation is empty');
        }
        if (is_null($prixKgEMB) || $prixKgEMB == '') {
            dd('prixKgEMB is empty');
        }
        if (is_null($quantiteEMB) || $quantiteEMB == '') {
            dd('quantiteEMB is empty');
        }
        if (is_null($freinteEMB) || $freinteEMB == '') {
            dd('freinteEMB is empty');
        }
        if (is_null($poidsMatEMB) || $poidsMatEMB == '') {
            dd('poidsMatEMB is empty');
        }
        if (is_null($coutMatiereEMB) || $coutMatiereEMB == '') {
            dd('coutMatiereEMB is empty');
        }
        if (is_null($freinteGlobaleEMB) || $freinteGlobaleEMB == '') {
            dd('freinteGlobaleEMB is empty');
        }



        //j'envoie les données dans la base de données
        $data = result_emb::create([
            'Code_dossier' => $this->generateDossier(),
            'Code_article' => $codeArticle,
            'Designation' => $designation,
            'Prix_kg' => $prixKgEMB,
            'Quantite' => $quantiteEMB,
            'Freinte' => $freinteEMB,
            'Poids_mat' => $poidsMatEMB,
            'Cout_matiere' => $coutMatiereEMB,
            'Freinte_globale' => $freinteGlobaleEMB,
        ]);

        session(['emb_called' => true]); // Marque que la méthode emb a été appelée

    // Si les trois méthodes ont été appelées, réinitialise le code de dossier
    if (session()->has('dashboard_called') && session()->has('mat_called')) {
        session()->forget('code_dossier');
        session()->forget('dashboard_called');
        session()->forget('mat_called');
    }

        

        if ($data) {
            return response()->json($data);
        } else {
            return response()->json(['error' => "J'arrive pas à l'envoyer"]);
        }

        
    }


    public function generateMOD(Request $request)
    {
        //Je génère ma requête ajax et je le stocke ici
        list($Metier, $Nb_etp, $Cadence_horaire, $Taux_horaire) = [
            $request->get('Metier'),
            $request->get('Nb_etp'),
            $request->get('Cadence_horaire'),
            $request->get('Taux_horaire'),
        ];
        

        //dd($request->all());
        //Je met une condition, si les données sont vides, je renvoie un message d'erreur
        if (is_null($Metier) || $Metier == '') {
            dd('Metier is empty');
        }
        if (is_null($Nb_etp) || $Nb_etp == '') {
            dd('Nb_etp is empty');
        }
        if (is_null($Cadence_horaire) || $Cadence_horaire == '') {
            dd('Cadence_horaire is empty');
        }
        if (is_null($Taux_horaire) || $Taux_horaire == '') {
            dd('Taux_horaire is empty');
        }
        



        //j'envoie les données dans la base de données
        $data = result_mod::create([
            'Code_dossier' => $this->generateDossier(),
            'Metier' => $Metier,
            'Nb_etp' => $Nb_etp,
            'Cadence_horaire' => $Cadence_horaire,
            'Taux_horaire' => $Taux_horaire,
        ]);

        session(['mod_called' => true]); // Marque que la méthode emb a été appelée

    // Si les trois méthodes ont été appelées, réinitialise le code de dossier
    if (session()->has('dashboard_called') && session()->has('mat_called')) {
        session()->forget('code_dossier');
        session()->forget('dashboard_called');
        session()->forget('mat_called');
    }

        

        if ($data) {
            return response()->json($data);
        } else {
            return response()->json(['error' => "J'arrive pas à l'envoyer"]);
        }

        
    }

    
}