<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCheck
{

    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('logged')){

            return redirect()->route('index')->with('Fail','You have to login!');
        }
        return $next($request);
    }
}
