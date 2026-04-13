<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(
        private AuthService $authService
    ) {}

    public function login(Request $request)
    {

        $data = $this->authService->login([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ]);

        return response()->json($data);
    }

    public function logout(Request $request)
    {

        $user = Auth::user();

        $this->authService->logOut($user);

        return response()->json(true);
    }
}
