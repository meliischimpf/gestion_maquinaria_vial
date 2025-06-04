<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;


class AccesoTest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $user = User::all(); 

        if ($user->isEmpty()){
            return redirect('/accesoDenegado')->with('error', 'No tienes acceso a esta página.');
        } else if ($user->isNotEmpty()) {
            echo "El usuario tiene acceso a la página.";
        }

        return $next($request);

    }





}
