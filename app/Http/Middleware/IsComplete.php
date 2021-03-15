<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsComplete
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if($user->phone_verified_at == null){
            return redirect('/phone/verification');
        }else if($user->details == null){
            return redirect('/profile')->with('message', '<div class="alert alert-danger">Please complete your registration.</div>');
        }else if($user->details != null && $user->data()->status == 'pending'){
            return redirect('/home')->with('message', '<div class="alert alert-danger">Your account is pending approval.</div>');
        }
        return $next($request);
    }
}
