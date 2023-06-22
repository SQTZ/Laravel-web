<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\G_dashboard;
use App\Models\result_mat;
use App\Models\result_emb;
use App\Models\result_mod;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\Log;

class PusherController extends Controller
{
    //TODO: Trouver un système qui va permettre de créer/modifier
    /*
        * Création: celle-ci devra générer un nouveau code_dossier et mettre la version à l'état 1
        
        * Modification: Lors d'une modification il faudra regarder si le code_dossier est deja existant, si oui on modifie tout en gardant
                        le code_ddosier et on incrémenta juste la version de 1, sinon on repasse à la création si le code_dossier n'est pas
                        trouvé.

        * Suppression: Si on souhaite supprimer, il faudra sélectionner un code_dossier puis de supprimer soit une version en particulier, soit
                       toutes les versions.
    */  
    private $code_dossier;
    private $Version;

    private function prepareData(Request $request) {
        $code_dossier = $request->input('Code_dossier');
        $Version = 1;
    
        if(empty($code_dossier)) {
            throw new \Exception('Veuillez remplir le champ Code_dossier.');
        }
    
        //On vérifie si le code_dossier existe, si oui on incrémente la version de 1
        if(G_dashboard::where('Code_dossier', $code_dossier)->exists()) {
            $Version = G_dashboard::where('Code_dossier', $code_dossier)->max('Version') + 1;
        }
    
        return [$code_dossier, $Version];
    }
    
    


    public function generateDASHBOARD(Request $request)
    {
        try {
            list($code_dossier, $Version) = $this->prepareData($request);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
        //dd($code_dossier, $Version);

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

    public function generateMAT(Request $request) {
    $matEntries = $request->input('matEntries');
    $responseData = [];

    if(!is_array($matEntries)) {
        return response()->json(['error' => 'matEntries doit être un tableau.']);
    }

    foreach($matEntries as $index => $matEntry) {
        try {
            list($code_dossier, $Version) = $this->prepareData($request);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }

        $ligneVersion = $index;

        $codeArticle = $matEntry['codeArticle'];
        $designation = $matEntry['designation'];
        $prixKgMAT = $matEntry['prixKgMAT'];
        $quantiteMAT = $matEntry['quantiteMAT'];
        $freinteMAT = $matEntry['freinteMAT'];
        $poidsMatMAT = $matEntry['poidsMatMAT'];
        $coutMatiereMAT = $matEntry['coutMatiereMAT'];
        $freinteGlobaleMAT = $matEntry['freinteGlobaleMAT'];

        $data = result_mat::updateOrCreate(
            ['Code_dossier' => $code_dossier, 'Version' => $Version, 'Ligne_version' => $ligneVersion],
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
            
        $responseData[] = $data;
    }

    return response()->json($responseData);
}


//FIXME: Reprendre le template de generateMAT et l'appliquer pour EMB et MOD
public function generateEMB(Request $request) {
    $embEntries = $request->input('embEntries');
    $responseData = [];

    if(!is_array($embEntries)) {
        return response()->json(['error' => 'matEntries doit être un tableau.']);
    }

    foreach($embEntries as $index => $embEntry) {
        try {
            list($code_dossier, $Version) = $this->prepareData($request);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }

        $ligneVersion = $index;

        $codeArticle = $embEntry['codeArticle'];
        $designation = $embEntry['designation'];
        $prixKgEMB = $embEntry['prixKgEMB'];
        $quantiteEMB = $embEntry['quantiteEMB'];
        $freinteEMB = $embEntry['freinteEMB'];
        $poidsMatEMB = $embEntry['poidsMatEMB'];
        $coutMatiereEMB = $embEntry['coutMatiereEMB'];
        $freinteGlobaleEMB = $embEntry['freinteGlobaleEMB'];

        $data = result_emb::updateOrCreate(
            ['Code_dossier' => $code_dossier, 'Version' => $Version, 'Ligne_version' => $ligneVersion],
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
            
        $responseData[] = $data;
    }

    return response()->json($responseData);
}

public function generateMOD(Request $request) {
    $modEntries = $request->input('modEntries');
    $responseData = [];

    if(!is_array($modEntries)) {
        return response()->json(['error' => 'matEntries doit être un tableau.']);
    }

    foreach($modEntries as $index => $modEntry) {
        try {
            list($code_dossier, $Version) = $this->prepareData($request);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }

        $ligneVersion = $index;

        $Metier = $modEntry['Metier'];
        $Nb_etp = $modEntry['Nb_etp'];
        $Cadence_horaire = $modEntry['Cadence_horaire'];
        $Taux_horaire = $modEntry['Taux_horaire'];

        $data = result_mod::updateOrCreate(
            ['Code_dossier' => $code_dossier, 'Version' => $Version, 'Ligne_version' => $ligneVersion],
            [
                'Metier' => $Metier,
                'Nb_etp' => $Nb_etp,
                'Cadence_horaire' => $Cadence_horaire,
                'Taux_horaire' => $Taux_horaire,
            ]);
            
        $responseData[] = $data;
    }

    return response()->json($responseData);
}
}
