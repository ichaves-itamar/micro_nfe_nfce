<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NFeController extends Controller
{
    function index(Request $request){
        dd($request->all); 
    }
    
}
