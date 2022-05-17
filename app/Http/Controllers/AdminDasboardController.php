<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDasboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('custom');
    }
    public function index(){

        // return view('admin.dasboard');
        return view('layouts.admin_2');
    }
}
