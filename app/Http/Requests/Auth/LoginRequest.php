<?php

namespace App\Http\Requests\Auth;

use App\Lib\DTOs\Auth\UserCredentialDto;
use App\Lib\Interfaces\Services\AuthServiceInterface;
use App\Lib\Interfaces\Services\UserServiceInterface;
use App\Lib\Services\AuthService;
use App\Lib\Services\UserService;
use Auth;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    private AuthServiceInterface $authService;
    private UserServiceInterface $userService;
    public function __construct(
        AuthService $authService,
        UserService $userService
    ) {
        $this->authService = $authService;
        $this->userService = $userService;
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        // 01. Ensure the login request is not rate limited
        $this->ensureIsNotRateLimited();

        // 02. Handle Apcis Login
        $credentials = UserCredentialDto::fromRequest($this);
        $apcisLoginResponse = $this->authService->handleApcisLogin($credentials);

        // 03. Handle unsuccessful apcis login
        if (!$apcisLoginResponse->isSuccess) {
            // 03.1, Invalid Credentials
            if ($apcisLoginResponse->httpErrorCode === 401) {
                RateLimiter::hit($this->throttleKey());
                throw ValidationException::withMessages([
                    'email' => trans('auth.failed'),
                ]);
            }

            // 03.2. Other Errors on APCIS
            throw ValidationException::withMessages([
                'email' => 'Something went wrong on our end. Please try again later.',
            ]);
        }

        // 04. Success: Create user if not exists
        $createUserResponse = $this->userService->createUser($apcisLoginResponse->user);
        
        // 05.1. Check if user creation is success
        if (!$createUserResponse->isSuccess) {
            // 05.2. User creation failed
            throw ValidationException::withMessages([
                'email' => 'Something went wrong on our end. Please try again later.',
            ]);
        }

        // 06. Login the user
        Auth::login($createUserResponse->user);

        // 07. Clear rate limit
        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')) . '|' . $this->ip());
    }
}
