<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FilteredFacturesController extends Controller
{
    public function index()
    {
        return view('reportes_view.reportes'); 
    }
}
