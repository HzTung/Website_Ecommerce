<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $role)
    {

        $role = explode("|", $role);
        if (!$request->user('admin')->hasRole($role)) {
            return redirect()->route('home')->with('msg', 'Không có quyền truy cập!');
            // Redirect hoặc trả về thông báo lỗi
            // return abort(404, '');
        }

        return $next($request);
    }
}
