<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CartMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (is_null(session('cart'))) {
            Session::put('cart', []);
        }

        $cart = session('cart');

        // Ajoutez une vérification supplémentaire pour s'assurer que $cart est un tableau
        if (!is_array($cart)) {
            Session::put('cart', []);
            $cart = [];
        }
        return $next($request);
    }
}
