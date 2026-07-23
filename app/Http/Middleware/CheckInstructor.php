<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckInstructor
{
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifier si l'utilisateur est authentifié et s'il est un instructeur
        if ($request->user()->email_verified && $request->user()->instructor) {
            return $next($request); 
        }

        abort(404);
    }
}
