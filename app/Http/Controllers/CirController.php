<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CirController extends Controller
{
    public function login()
    {
        $token = auth()->user()->tokens()->first();

        if (! $token) {
            $token = auth()->user()->createToken('cir');
        }

        $token = auth()->user()->tokens()->first();

        return redirect()->away(config('services.cir.url') . '/login?token=' . $token->token);
    }
}
