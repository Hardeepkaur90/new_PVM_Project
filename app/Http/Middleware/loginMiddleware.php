<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class loginMiddleware
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
        $authuser = auth()->user();
        $auth = User::where('admin_role',$authuser)->get();

        if(empty($authuser)){
            return back('admin')->with('danger','Login First ');
           }
           else{
            return $next($request);
           }
        return $next($request);
    }
}
