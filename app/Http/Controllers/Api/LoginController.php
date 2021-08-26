<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            $message = collect($validator->messages()->messages())->first()[0];

            return response()->json($message, 403);
        }

        $credentials = $validator->getData();

        $authenticated = Auth::validate($credentials);

        if (! $authenticated) {
            return response()->json('Invalid credentials.', 403);
        }

        $user = User::where('email', $credentials['email'])->firstOrFail();

        $role = $user->getRoleNames()->first();

        $user = $user->only(['id', 'name', 'email']);

        $user['role'] = $role;

        return response()->json($user);
    }
}
