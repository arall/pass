<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Enforces key pair generation with a secret key.
 *
 * @package App\Http\Middleware
 */
class KeyPair
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::user()->key()->exists()) {
            return redirect()->route('keypair.generate');
        }

        return $next($request);
    }
}
