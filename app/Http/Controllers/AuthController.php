<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Utils\Response\ResponseServiceInterface;
use App\Services\Auth\AuthServiceInterface;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\UpdateProfileRequest;

class AuthController extends Controller
{
    private AuthServiceInterface $modelService;
    private ResponseServiceInterface $responseService;

    public function __construct(
        AuthServiceInterface $modelService,
        ResponseServiceInterface $responseService,
    ) {
        $this->modelService = $modelService;
        $this->responseService = $responseService;
    }

    public function login(LoginRequest $request)
    {
        $result = $this->modelService->login($request->email, $request->password);
        return $this->responseService->resolveResponse("Login Successful", $result);
    }

    public function register(RegisterRequest $request)
    {
        $result = $this->modelService->register($request->all());
        return $this->responseService->resolveResponse("Register Successful", $result);
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $result = $this->modelService->updateProfile($request->all());
        return $this->responseService->resolveResponse("Update Profile Successful", $result);
    }

    public function profile()
    {
        $result = auth()->user();
        return $this->responseService->resolveResponse("Update Profile Successful", $result);
    }
}
