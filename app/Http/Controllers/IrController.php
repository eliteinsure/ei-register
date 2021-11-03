<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IrController extends Controller
{
    public function login()
    {
        auth()->user()->tokens()->delete();

        auth()->user()->createToken('cir');

        $token = auth()->user()->tokens()->first();

        return redirect()->away(config('services.cir.url') . '/login?token=' . $token->token . '&type=0');
    }
}
