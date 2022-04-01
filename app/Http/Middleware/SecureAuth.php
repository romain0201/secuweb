<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecureAuth
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
        if(!isset($_COOKIE['id'])){
            return redirect()->route('login')->withErrors(['login' => 'Veuillez vous connecter']);;
        }

        $user = \App\Models\User::find(\Cookie::get('id'));

        if($user)
        {
            \Auth::loginUsingId($user->id);
        }


        return $next($request);
    }
}
