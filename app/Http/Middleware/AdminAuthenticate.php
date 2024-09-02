<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticate
{
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated and has the 'admin' role or type
        if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->user_type === 'admin') {
            return $next($request);
        }

        // Redirect to login if not an admin
        return redirect()->route('admin.login')->withErrors(['error' => 'You are not authorized to access the admin dashboard']);
    }
}
