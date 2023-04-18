<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AlreadyLoggedin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $options =[]): Response
    {
        if(Session()->has('loginId') && (url('login') == $request->url() || url('register')
        ==$request->url())){
            return redirect('home');
        }

        return $next($request);
    }
}
