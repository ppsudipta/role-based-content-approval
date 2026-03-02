<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Helpers\ApiResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Register
     */
    public function register(RegisterRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role
            ]);

            $token = $user->createToken('api-token')->plainTextToken;

            Log::info('User registered', [
                'user_id' => $user->id,
                'email' => $user->email
            ]);

            return ApiResponse::success([
                'user' => $user,
                'token' => $token
            ], 'User registered successfully', 201);

        } catch (\Throwable $e) {
            Log::error('Register error', ['error' => $e->getMessage()]);
            return ApiResponse::error('Registration failed');
        }
    }

    /**
     * Login
     */
    public function login(LoginRequest $request)
    {
        try {
            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                Log::warning('Invalid login attempt', [
                    'email' => $request->email
                ]);

                return ApiResponse::error('Invalid credentials', 401);
            }

            // delete old tokens
            $user->tokens()->delete();

            $token = $user->createToken('api-token')->plainTextToken;

            Log::info('User logged in', [
                'user_id' => $user->id
            ]);

            return ApiResponse::success([
                'user' => $user,
                'token' => $token
            ], 'Login successful');

        } catch (\Throwable $e) {
            Log::error('Login error', ['error' => $e->getMessage()]);
            return ApiResponse::error('Login failed');
        }
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        try {
            $user = $request->user();

            $user->currentAccessToken()->delete();

            Log::info('User logged out', [
                'user_id' => $user->id
            ]);

            return ApiResponse::success(null, 'Logged out successfully');

        } catch (\Throwable $e) {
            Log::error('Logout error', ['error' => $e->getMessage()]);
            return ApiResponse::error('Logout failed');
        }
    }

    /**
     * Profile
     */
    public function profile(Request $request)
    {
        return ApiResponse::success($request->user());
    }
}