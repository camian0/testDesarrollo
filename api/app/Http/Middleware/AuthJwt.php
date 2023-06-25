<?php

namespace App\Http\Middleware;

use App\Models\Response;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthJwt
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
        $response = new Response();
        $user     = Auth::user();
        if ($user == null) {
            $response->error   = true;
            $response->message = "Debe iniciar sesión.";
            return response()->json($response->toJSON(), 405);
        }
        return $next($request);
    }
}
