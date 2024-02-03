<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Controller;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoggedUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        $session = $request->session()->get("user");
        if (!$session) return redirect()->route("login");
        
        $user = User::where("id", $session)->first();
        if (!$user) {
            $request->session()->forget("user");
            return redirect()->route("login");
        }
        
        Controller::$user = $user;

        return $next($request);
    }
}
