<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DasboardAminController extends Controller
{
    public function admin(){
        dd('ok');
        return view('admin.Manager_Admin.index');
    }
}
