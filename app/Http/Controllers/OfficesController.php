<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Office; 

class OfficesController extends Controller
{
    public function index()
    {
        $offices = Office::all();
        return view('survey.form1', compact('offices'));
    }
}
