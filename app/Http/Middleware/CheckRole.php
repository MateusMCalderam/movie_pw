<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!$request->user() || !$request->user()->hasRole($role)) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Acesso negado'], 403);
            }
            
            return redirect()->route('dashboard')->with('error', 'Acesso negado. Você não tem permissão para acessar esta área.');
        }

        return $next($request);
    }
}
