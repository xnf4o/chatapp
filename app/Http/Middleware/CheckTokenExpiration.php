<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckTokenExpiration
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if ($user && $user->chatapp_access_token_end_time < now()) {
            // Access token has expired, attempt to refresh
            if ($user->chatapp_refresh_token_end_time > now()) {
                $chatapp = new ChatApp();
                $chatapp->refreshAccessToken($user->chatapp_refresh_token);
            } else {
                // Refresh token has also expired, log the user out
                Auth::logout();
            }
        }

        return $next($request);
    }
}
