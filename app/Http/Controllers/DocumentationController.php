<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentationController extends Controller
{
    //J'affiche la page de la documentation
    public function index()
    {
        return view('documentation');
    }
}
