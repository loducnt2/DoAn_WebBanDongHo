<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $userDangNhap = Auth::user();
            if($userDangNhap->idTypeUser == 1 || $userDangNhap->idTypeUser == 2){
                return $next($request);
            }else{
                return redirect('admin/login')->with('notifyLogin', 'Bạn không có quyền truy cập !');
            }
        }else{
            return redirect('admin/login')->with('notifyLogin', 'Vui lòng đăng nhập !');
        }
    }
}
