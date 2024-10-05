<?php

use App\Http\Repositories\Auth\AuthRepositoryInterface;
use Illuminate\Http\JsonResponse;

class AuthRepository implements AuthRepositoryInterface
{
    public function login($credentials): JsonResponse
    {
        // TODO: Implement login() method.

    }

    public function register($data): JsonResponse
    {
        // TODO: Implement register() method.
    }

    public function logout(): JsonResponse
    {
        // TODO: Implement logout() method.
    }

    public function me(): JsonResponse
    {
        // TODO: Implement me() method.
    }

    public function refresh(): JsonResponse
    {
        // TODO: Implement refresh() method.
    }

    public function updateProfile($data): JsonResponse
    {
        // TODO: Implement updateProfile() method.
    }

    public function updatePassword($data): JsonResponse
    {
        // TODO: Implement updatePassword() method.
    }

    public function forgotPassword($data): JsonResponse
    {
        // TODO: Implement forgotPassword() method.
    }

    /**
     * @return mixed
     */
    public function resetPassword($data)
    {
        // TODO: Implement resetPassword() method.
    }

    /**
     * @return mixed
     */
    public function verifyEmail($data)
    {
        // TODO: Implement verifyEmail() method.
    }

    /**
     * @return mixed
     */
    public function sendEmailVerificationNotification()
    {
        // TODO: Implement sendEmailVerificationNotification() method.
    }
}
