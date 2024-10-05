<?php

namespace App\Http\Repositories\Auth;

use Illuminate\Http\JsonResponse;

interface AuthRepositoryInterface
{
    // TOOD SEE IF WE SHOULD CREATE TYPES AND DTOS
    public function login($credentials): JsonResponse;

    public function register($data): JsonResponse;

    public function logout(): JsonResponse;

    public function me(): JsonResponse;

    public function refresh(): JsonResponse;

    public function updateProfile($data): JsonResponse;

    public function updatePassword($data): JsonResponse;

    public function forgotPassword($data): JsonResponse;

    public function resetPassword($data);

    public function verifyEmail($data);

    public function sendEmailVerificationNotification();
}
