<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use App\Models\G_dashboard;
use App\Models\result_mat;
use App\Models\result_emb;
use App\Models\result_mod;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\Log;

class PusherController extends Controller
{
    // Génère un nouveau code_dossier si nécessaire et gère l'incrémentation de la version
    private function prepareData(Request $request)
    {
        // Essayez d'obtenir le code_dossier de la session
        $code_dossier = session('code_dossier');
        $Version = $request->input('Version');

        // Si le code_dossier n'est pas dans la session, c'est une nouvelle entité
        if (is_null($code_dossier) || $code_dossier == '') {
            $code_dossier = Str::random(10);
            $Version = 1;
            // Stockez le code_dossier dans la session pour pouvoir le réutiliser dans les autres requêtes
            session(['code_dossier' => $code_dossier]);
        } else {
            // Sinon, nous incrémentons la version de l'entité existante
            $Version = $this->getVersion($code_dossier) + 1;
        }

        return [$code_dossier, $Version];
    }

// Ajoutez une nouvelle méthode pour gérer les versions:
public function getVersion($code_dossier)
{
    // Recherche la version la plus récente pour ce code_dossier
    $latest = G_dashboard::where('Code_dossier', $code_dossier)->orderBy('Version', 'desc')->first();

    // Si aucune version n'est trouvée, retourne 1, sinon retourne la dernière version incrémentée de 1
    return $latest ? $latest->Version + 1 : 1;
}


    public function generateDASHBOARD(Request $request)
    {
        list($code_dossier, $Version) = $this->prepareData($request);

        list($resultMAT, $resultEMB, $resultMOD, $resultFF, $resultTOTAL, $resultMC, $resultPV) = [
            $request->input('resultMAT'),
            $request->input('resultEMB'),
            $request->input('resultMOD'),
            $request->input('resultFF'),
            $request->input('resultTOTAL'),
            $request->input('resultMC'),
            $request->input('resultPV')
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

        $data = G_dashboard::updateOrCreate(
            ['Code_dossier' => $code_dossier, 'Version' => $Version],
            [
            
            'MAT' => $resultMAT,
            'EMB' => $resultEMB,
            'MOD' => $resultMOD,
            'FF' => $resultFF,
            'TOTAL' => $resultTOTAL,
            'MC' => $resultMC,
            'PV' => $resultPV,
            
        ]);

        if ($data) {
            return response()->json($data);
        } else {
            return response()->json(['error' => "J'arrive pas à l'envoyer"]);
        }
    }

    public function generateMAT(Request $request)
    {
        list($code_dossier, $Version) = $this->prepareData($request);
        list($codeArticle, $designation, $prixKgMAT, $quantiteMAT, $freinteMAT, $poidsMatMAT, $coutMatiereMAT, $freinteGlobaleMAT) = [
            $request->input('codeArticle'),
            $request->input('designation'),
            $request->input('prixKgMAT'),
            $request->input('quantiteMAT'),
            $request->input('freinteMAT'),
            $request->input('poidsMatMAT'),
            $request->input('coutMatiereMAT'),
            $request->input('freinteGlobaleMAT')
        ];

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

        $data = result_mat::updateOrCreate(
            ['Code_dossier' => $code_dossier, 'Version' => $Version],
            [
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

    public function generateEMB(Request $request)
    {
        list($code_dossier, $Version) = $this->prepareData($request);
        list($codeArticle, $designation, $prixKgEMB, $quantiteEMB, $freinteEMB, $poidsMatEMB, $coutMatiereEMB, $freinteGlobaleEMB) = [
            $request->input('codeArticle'),
            $request->input('designation'),
            $request->input('prixKgEMB'),
            $request->input('quantiteEMB'),
            $request->input('freinteEMB'),
            $request->input('poidsMatEMB'),
            $request->input('coutMatiereEMB'),
            $request->input('freinteGlobaleEMB')
        ];

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

        $data = result_emb::updateOrCreate(
            ['Code_dossier' => $code_dossier, 'Version' => $Version],
            [
            'Code_article' => $codeArticle,
            'Designation' => $designation,
            'Prix_kg' => $prixKgEMB,
            'Quantite' => $quantiteEMB,
            'Freinte' => $freinteEMB,
            'Poids_mat' => $poidsMatEMB,
            'Cout_matiere' => $coutMatiereEMB,
            'Freinte_globale' => $freinteGlobaleEMB,
        ]);

        if ($data) {
            return response()->json($data);
        } else {
            return response()->json(['error' => "J'arrive pas à l'envoyer"]);
        }
    }

    public function generateMOD(Request $request)
    {
        list($code_dossier, $Version) = $this->prepareData($request);

        list($Metier, $Nb_etp, $Cadence_horaire, $Taux_horaire) = [
            $request->input('Metier'),
            $request->input('Nb_etp'),
            $request->input('Cadence_horaire'),
            $request->input('Taux_horaire'),
        ];

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


        $data = result_mod::updateOrCreate(
            ['Code_dossier' => $code_dossier, 'Version' => $Version],
            [
            'Metier' => $Metier,
            'Nb_etp' => $Nb_etp,
            'Cadence_horaire' => $Cadence_horaire,
            'Taux_horaire' => $Taux_horaire,
        ]);

        if ($data) {
            return response()->json($data);
        } else {
            return response()->json(['error' => "J'arrive pas à l'envoyer"]);
        }
    }
}
