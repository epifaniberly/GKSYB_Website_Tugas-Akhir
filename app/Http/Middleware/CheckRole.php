<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            Alert::error('Silakan login terlebih dahulu.');
            return redirect()->route('login.index');
        }
    
        $userRole = Auth::user()->role_type;

        if (!in_array($userRole, $roles)) {
            Alert::error('Anda tidak memiliki akses ke halaman ini.');
            return redirect()->back();
        }
        
        return $next($request);
    }
}
