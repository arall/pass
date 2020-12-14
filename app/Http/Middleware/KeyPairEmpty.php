<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Prevents generating new keypair if already have one.
 *
 * @package App\Http\Middleware
 */
class KeyPairEmpty
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
        if (Auth::user()->key()->exists()) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
