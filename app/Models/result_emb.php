<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class result_emb extends Model
{
    use HasFactory;

    protected $fillable = [
        'Code_dossier',
        'Version',
        'Code_article',
        'Designation',
        'Prix_kg',
        'Quantite',
        'Freinte',
        'Poids_mat',
        'Cout_matiere',
        'Freinte_globale',  
    ];
}
