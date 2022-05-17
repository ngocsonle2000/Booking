<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('custom');
    }
    public function dasboard(){

        return view('layouts.admin');
    }

}
