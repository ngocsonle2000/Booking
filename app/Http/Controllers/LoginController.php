<?php

namespace App\Http\Controllers;

use App\Models\custom;
use App\Models\customer;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){
        return view('user.login');
    }
    public function post_login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ],[
            'email.required' => 'Email không được để trống',
            'password.required' => 'Mật khẩu không được để trống',
        ]);

        if(Auth::guard('custom')->attempt([
            'email' => $request -> email,
            'password' => $request -> password,
            'Status'   => 0,
            'level'    => 1,
        ])){
            // return redirect()->route('Dasboard.index');
            return redirect()->route('home.index');
        }else if(Auth::guard('custom')->attempt([
            'email' => $request -> email,
            'password' => $request -> password,
            'Status'   => 1,
        ])){
            return redirect()->back()->with('error', 'Tài khoản của bạn đã bị khóa');
        }else if(Auth::guard('custom')->attempt([
            'email' => $request -> email,
            'password' => $request -> password,
            'Status'   => 0,
            'level'    => 0,
        ])){
            return redirect()->route('admin.Dasboard.index');
        }
        else{
            return redirect()->back()->with('error', 'Mật khẩu hoặc tài khoản không đúng');
        }
    }
    public function store(Request $request){
        $password = bcrypt($request->Password);
        if(customer::insert([
            'username' => $request -> UserName,
            'email'    => $request -> Email,
            'password' => $password,
            'phone'    => $request -> Phone,
            'adrress'  => $request -> Adrress,
            'Status'    => '0',
            'level'    => '1'
        ])){
            return redirect()->route('login')->with('success','Thêm mới thành công');
        }
    }

    public function logout(){
        Auth::guard('custom')->logout();
        return redirect()->route('home.index');

    }
}
