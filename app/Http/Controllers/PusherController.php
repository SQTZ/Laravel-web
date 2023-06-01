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
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\Log;

//FIXME: Corriger le bug du code_dossier
class PusherController extends Controller
{
    
    //Génération du code_dossier

    public function generateDossier($productId, $modifiedCodeDossier)
{
    $existingDashboard = G_dashboard::where('code_dossier', $modifiedCodeDossier)->first();

    if ($existingDashboard) {
        // Si le code_dossier existe pour le produit modifié
        // Mettre à jour uniquement la version du tableau de bord
        $existingDashboard->Version += 1;
        $existingDashboard->save();

        // Mettre à jour le code_dossier du produit modifié avec le code_dossier existant
        G_dashboard::where('id', $productId)->update(['code_dossier' => $modifiedCodeDossier]);

        // Stocker le code_dossier existant dans la session
        session(['code_dossier' => $modifiedCodeDossier]);

        return $modifiedCodeDossier;
    } else {
        // Le code_dossier n'existe pas pour le produit modifié
        // Générer un nouveau code_dossier et l'attribuer au tableau de bord et au produit
        $newCodeDossier = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);

        G_dashboard::where('id', $productId)->update(['code_dossier' => $newCodeDossier]);

        // Stocker le nouveau code_dossier dans la session
        session(['code_dossier' => $newCodeDossier]);

        return $newCodeDossier;
    }
}


    public function generateDASHBOARD(Request $request, $code_dossier = null)
    {
    // Générer ou récupérer le code_dossier
    $code_dossier = session('code_dossier');

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

        // Vérifie si le code_dossier existe déjà
        $existingDashboard = G_dashboard::where('Code_dossier', $code_dossier)->first();
        $Version = $existingDashboard ? $existingDashboard->Version + 1 : 1;


        $data = G_dashboard::updateOrCreate(
            ['Code_dossier' => $code_dossier],
            [
                'MAT' => $resultMAT,
                'EMB' => $resultEMB,
                'MOD' => $resultMOD,
                'FF' => $resultFF,
                'TOTAL' => $resultTOTAL,
                'MC' => $resultMC,
                'PV' => $resultPV,
                'Version' => $Version,
            ]
        );

        session(['dashboard_called' => true]); // Marque que la méthode MAT a été appelée

        // Si les trois méthodes ont été appelées, réinitialise le code de dossier
        if (session()->has('dashboard_called') && session()->has('mat_called') && session()->has('emb_called') && session()->has('mod_called')) {
            session()->forget('code_dossier');
            session()->forget('dashboard_called');
            session()->forget('mat_called');
            session()->forget('emb_called');
            session()->forget('mod_called');
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

        // Récupère le code_dossier et la version à partir de la requête
        $code_dossier = session('code_dossier');
        if (is_null($code_dossier) || $code_dossier == '') {
            // Si vous modifiez un dossier existant, passez le code_dossier en paramètre
            $code_dossier = $this->generateDossier($request->get('id'), $request->get('code_dossier'));
        }


        $latest_entry = G_dashboard::where('Code_dossier', $code_dossier)->orderBy('Version', 'desc')->first();

        $Version = $latest_entry ? $latest_entry->Version + 1 : 1; // If there's no previous entry, start with version 1

        //j'envoie les données dans la base de données
        $data = result_mat::create([
            'Code_dossier' => $code_dossier,
            'Version' => $Version,
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

        if (session()->has('dashboard_called') && session()->has('mat_called') && session()->has('emb_called') && session()->has('mod_called')) {
            session()->forget('code_dossier');
            session()->forget('dashboard_called');
            session()->forget('mat_called');
            session()->forget('emb_called');
            session()->forget('mod_called');
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

        // Récupère le code_dossier et la version à partir de la requête
        $code_dossier = session('code_dossier');
        if (is_null($code_dossier) || $code_dossier == '') {
            // Si vous modifiez un dossier existant, passez le code_dossier en paramètre
            $code_dossier = $this->generateDossier($request->get('id'), $request->get('code_dossier'));
        }


        $latest_entry = G_dashboard::where('Code_dossier', $code_dossier)->orderBy('Version', 'desc')->first();

        $Version = $latest_entry ? $latest_entry->Version + 1 : 1; // If there's no previous entry, start with version 1


        //j'envoie les données dans la base de données
        $data = result_emb::create([
            'Code_dossier' => $code_dossier,
            'Version' => $Version,
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
        if (session()->has('dashboard_called') && session()->has('mat_called') && session()->has('emb_called') && session()->has('mod_called')) {
            session()->forget('code_dossier');
            session()->forget('dashboard_called');
            session()->forget('mat_called');
            session()->forget('emb_called');
            session()->forget('mod_called');
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

        // Récupère le code_dossier et la version à partir de la requête
        $code_dossier = session('code_dossier');
        if (is_null($code_dossier) || $code_dossier == '') {
            // Si vous modifiez un dossier existant, passez le code_dossier en paramètre
            $code_dossier = $this->generateDossier($request->get('id'), $request->get('code_dossier'));
        }


        $latest_entry = G_dashboard::where('Code_dossier', $code_dossier)->orderBy('Version', 'desc')->first();

        $Version = $latest_entry ? $latest_entry->Version + 1 : 1; // If there's no previous entry, start with version 1


        //j'envoie les données dans la base de données
        $data = result_mod::create([
            'Code_dossier' => $code_dossier,
            'Version' => $Version,
            'Metier' => $Metier,
            'Nb_etp' => $Nb_etp,
            'Cadence_horaire' => $Cadence_horaire,
            'Taux_horaire' => $Taux_horaire,
        ]);

        session(['mod_called' => true]); // Marque que la méthode emb a été appelée

        // Si les trois méthodes ont été appelées, réinitialise le code de dossier
        if (session()->has('dashboard_called') && session()->has('mat_called') && session()->has('emb_called') && session()->has('mod_called')) {
            session()->forget('code_dossier');
            session()->forget('dashboard_called');
            session()->forget('mat_called');
            session()->forget('emb_called');
            session()->forget('mod_called');
        }



        if ($data) {
            return response()->json($data);
        } else {
            return response()->json(['error' => "J'arrive pas à l'envoyer"]);
        }


    }


}