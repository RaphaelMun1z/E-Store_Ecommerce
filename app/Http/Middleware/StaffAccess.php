<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StaffAccess
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
        if (auth() and auth()->user()->accessLevel >= 1) {
            return $next($request);
        }
        return back()->with('msg', 'Página restrita!');
        //return redirect('/')->with('msg', 'Página restrita!');
    }
}
