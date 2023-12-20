<?php

namespace App\Services\Auth;

interface AuthServiceInterface
{
    public function login(string $email, string $password);
    public function register(array $attributes);
    public function updateProfile(array $attributes);
}
