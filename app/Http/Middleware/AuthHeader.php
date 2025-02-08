<?php

namespace App\Http\Middleware;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthHeader
{
    public function handle(Request $request, \Closure $next)
    {
        // skip health check
        if ($request->is("health")) {
            return $next($request);
        }

        $userId = $request->header("x-user-id");
        $userName = $request->header("x-user-name");

        if (empty($userId) || empty($userName)) {
            return response()->json(['error' => 'Invalid user: User ID or User Name is missing'], 401);
        }

        $user = new User();
        $user->id = $userId;
        $user->name = $userName;

        Auth::setUser($user);

        return $next($request);
    }
}