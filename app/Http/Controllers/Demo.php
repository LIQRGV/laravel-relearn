<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class Demo extends Controller
{
    public function show() {
        $user = Auth::user();

        if(!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'user_id' => $user->id,
            'user_name' => $user->name,
        ]);
    }
}