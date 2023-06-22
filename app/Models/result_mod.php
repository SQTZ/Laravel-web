<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class result_mod extends Model
{
    use HasFactory;

    protected $fillable = [
        'Code_dossier',
        'Version',
        'Ligne_version',
        'Metier',
        'Nb_etp',  
        'Cadence_horaire',
        'Taux_horaire',
    ];
}
