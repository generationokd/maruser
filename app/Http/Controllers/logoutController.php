<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class logoutController extends Controller
{
    public function index(Request $request){
      $request->session()->forget('loginname');
      $request->session()->forget('seq');
      $request->session()->forget('login');
        return view('logout.index');
      }

}

