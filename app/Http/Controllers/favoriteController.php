<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class favoriteController extends Controller
{
    public function index(){
    	return view('favorite.index');
    }
}
