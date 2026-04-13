<?php

namespace App\Services;

use App\Enums\TokenAbility;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class AuthService
{
    public function login(array $credentials)
    {
        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Usuario no encontrado.",
            ];
        }

        if (!Auth::attempt($credentials)) {
            return [
                "error" => true,
                "code" => 403,
                'message' => 'Correo o contraseña incorrectos.'
            ];
        }


        $accessToken = $this->generateAccessToken($user);

        $refreshToken = $this->generateRefreshToken($user);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Logueo exitoso",
            "data" => [
                'id' => $user->id,
                'token' => $accessToken,
                'refresh_token' => $refreshToken,
            ],
        ];
    }

    private function generateAccessToken($user)
    {

        return $user->createToken(
            'accessToken',
            [TokenAbility::ACCESS_API->value],
            Carbon::now()->addMinutes(config('sanctum.access_token_expiration'))
        )->plainTextToken;
    }

    private function generateRefreshToken($user)
    {

        return $user->createToken(
            'refreshToken',
            [TokenAbility::ISSUE_ACCESS_TOKEN->value],
            Carbon::now()->addMinutes(config('sanctum.refresh_token_expiration'))
        )->plainTextToken;
    }

    public function refreshToken(string $currentRefreshToken, User $user)
    {

        $refreshToken = PersonalAccessToken::findToken($currentRefreshToken);

        $accessToken = $this->generateAccessToken($user);

        $refreshToken = $this->renewRefreshToken($refreshToken, $user) ?: $currentRefreshToken;
        
        return [
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken,
        ];
    }

    private function renewRefreshToken(PersonalAccessToken $refreshToken, User $user)
    {

        $expiresToken = Carbon::parse($refreshToken->expires_at);

        $remainingTime = $expiresToken->diffInSeconds(Carbon::now(), false);

        if ($remainingTime < 60 * 60 * 24) {

            $refreshToken->delete();

            return $user->createToken(
                'refreshToken',
                [TokenAbility::ISSUE_ACCESS_TOKEN->value],
                Carbon::now()->addMinutes(config('sanctum.refresh_token_expiration'))
            )->plainTextToken;
        }

        return null;
    }

    public function logOut(User $user)
    {
        $user->tokens()->delete();
    }
}
