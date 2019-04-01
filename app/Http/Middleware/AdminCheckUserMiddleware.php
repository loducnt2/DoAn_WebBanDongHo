<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminCheckUserMiddleware
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
            if($userDangNhap->idTypeUser == 1){
                return $next($request);
            }else{
                return redirect('admin/adminpage')->with('notifyAuthority', 'Bạn không có quyền truy cập !');
            }
        }else{
            return redirect('admin/login')->with('notifyLogin', 'Vui lòng đăng nhập !');
        }
    }
}
