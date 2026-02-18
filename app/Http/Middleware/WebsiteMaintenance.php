<?php

namespace App\Http\Middleware;

use App\Models\SeoModel;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class WebsiteMaintenance
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $seo = SeoModel::first();
        $isMaintenance = $seo ? $seo->maintenance_mode : false;

        if ($isMaintenance) {
            if ($request->is('admin*') || $request->is('login*') || $request->is('logout*') || $request->is('api/admin*')) {
                return $next($request);
            }
            if (Auth::check() && in_array(Auth::user()->role_type, [1, 2])) {
                return $next($request);
            }

            return response()->view('errors.maintenance', [], 503);
        }

        return $next($request);
    }
}
