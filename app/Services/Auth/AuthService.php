<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Log;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class AuthService implements AuthServiceInterface
{
    private UserRepositoryInterface $modelRepository;

    public function __construct(
        UserRepositoryInterface $modelRepository,
    ) {
        $this->modelRepository = $modelRepository;
    }

    public function login(string $email, string $password)
    {
        try 
        {
            $user = $this->modelRepository->getByEmail($email);
            if($user) {
                if(Hash::check($password, $user->password) === true) {
                    Auth::login($user);
                    $creds = [
                        'token' => $user->createToken(config('app.name'))->plainTextToken,
                        'user' => $user,
                    ];
                    return $creds;
                } else {
                    throw new AuthenticationException('Invalid credentials');
                }
            } else {
                throw new AuthenticationException('Invalid credentials');
            }
        } catch (\Exception $exception) {
            throw ValidationException::withMessages([$exception->getMessage()]);
        }
    }
    
    public function register(array $attributes)
    {
        DB::beginTransaction();

        try {

            $user = $this->modelRepository->getByEmail($attributes['email']);
            if(!$user)
            {
                $attributes['password'] = Hash::make($attributes['password']);

                $user = $this->modelRepository->create($attributes);

                Auth::login($user);
                $creds = [
                    'token' => $user->createToken(config('app.name'))->plainTextToken,
                    'user' => $user,
                ];
                DB::commit();

                return $creds;
            }
            
            throw ValidationException::withMessages([
                'email' => ['User with this email is already registered.'],
            ])->status(JsonResponse::HTTP_CONFLICT);
        } catch (\Exception $exception) {
            DB::rollBack();
            throw ValidationException::withMessages([
                'error' => $exception->getMessage(),
            ]);
        }
    }

    public function updateProfile(array $attributes)
    {
        $user = auth()->user();
        if($user) {
            if(isset($attributes['password'])) {
                if(Hash::check($attributes['current_password'], $user->password)) {
                    $attributes['password'] = Hash::make($attributes['password']);
                } else {
                    $response = new JsonResponse(['message' => 'Current password is incorrect'], 400);
                    throw new HttpResponseException($response);
                }
            }

            return $this->modelRepository->update($attributes, $user->id);
        }
        else {
            throw new AccessDeniedHttpException('Unauthenticated'); // Throw an exception for unauthenticated user
        }
    }
}
