<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class G_dashboard extends Model
{
    use HasFactory;

    protected $fillable = [
        'Code_dossier',
        'MAT',
        'EMB',
        'MOD',
        'FF',
        'TOTAL',
        'MC',
        'PV',
        'Version',  
    ];
}
