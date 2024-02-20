<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {

        $route = $request->route();

        if ($route && ($route->getPrefix()?? null) === '/admin') {
            if (!auth()->user() || auth()->user()->role !== 'admin') {

                return redirect('/');
            }
        }
        return $next($request);
    }
}
