<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsStaff
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
        $user = Auth::user();
        if ($user->isStaff==1){
            return $next($request);
        }

        User::where('id',$user->id)->update(['isLoggedIn'=>2]);

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return to_route('login')->with('error','You do not have the authorization to view this page');
    }
}
