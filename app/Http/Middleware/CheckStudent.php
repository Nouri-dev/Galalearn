<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckStudent
{
    public function handle(Request $request, Closure $next)
    {
        // Vérifier si l'utilisateur est authentifié et s'il est un étudiant
        if ($request->user() && $request->user()->student) {
            return $next($request); 
        }


        abort(404);
        
    }
}
