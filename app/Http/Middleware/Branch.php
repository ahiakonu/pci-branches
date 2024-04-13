<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class Branch
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //do we have an authenticated user AND is the username == wilson.ahiakonu
        if (Auth::check()) {
            $user = auth()->user();

            if ($user?->user_status !== 'Active') {
                return redirect('/profile');
            }

            if ($user?->user_role === 'SYS_ADMIN') {
                
                return redirect(route('dashboard'));
            }

            elseif ($user?->user_role === 'ZONAL_OVERSEER') {
                return redirect(route('zonaldashboard'));
            }

            elseif ($user?->user_role === 'DIVISIONAL_OVERSEER') {
                return redirect(route('divisiondashboard'));
            }

            elseif ($user?->user_role === 'BRANCH_PASTOR') {
                return $next($request);
            }
        }
        // 
       abort(Response::HTTP_FORBIDDEN);
    }
}
