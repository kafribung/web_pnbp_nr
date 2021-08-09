<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
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
        $user = $request->user();
        if (auth()->check()) {
            if ( $user->roles()->where('name', 'admin')->count() == 1 ) {
                return $next($request);
            } else abort('403', 'Anda bukan admin');
        } else abort('403', 'Anda belum login');
    }
}
