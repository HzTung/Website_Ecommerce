<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect(route('admin.login'));
        }
        $route = $request->route()->getName();
        if ($request->user('admin')->cant($route)) {
            abort(403, 'Unauthorized action.');
            // return redirect()->route('admin.home')->with('msg', 'bạn không có quyền truy cập!');
        }
        return $next($request);
    }
}
