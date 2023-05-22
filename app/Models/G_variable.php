<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class G_variable extends Model
{
    use HasFactory;

    protected $fillable = ['Taux_horaire', 'Cout_ff', 'Cout_bobine'];
}
