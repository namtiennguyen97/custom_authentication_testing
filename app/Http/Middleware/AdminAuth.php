<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class AdminAuth
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
        if (!session()->has('logged')){
            return redirect()->route('index');
        }
        //show dashboard user
        $user = User::where('id','=',session('logged'))->first();
        if ($user->role_id == 3){
            return $next($request);
        }
        else{
            return response()->json(['No authorize','You dont have authorize to access this page'],403);
        }
    }
}
