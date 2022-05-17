<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    private $custom;
    public function __construct()
    {

    }
    public function handle(Request $request, Closure $next, $guard = 'custom')
    {
        if(!Auth::guard($guard) -> check()){
            return redirect() -> route('login')->with('error', 'Bạn cần phải đăng nhập');
        }
        // $route=$request->route()->getName();
        // $user = Auth::guard('custom')->user();
        // $user->can($route);
        // if($user->level == 0){
        //     if($user->cant($route)){
        //         return redirect()-> route('admin.error', ['code' => 403]);
        //     }
        // }

        // kiểm tra xem user có thể vào được cái route này k

        return $next($request);

    }
}
