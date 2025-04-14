<?php

namespace App\Lib\Services;

use App\Lib\DTOs\Auth\ApcisUserDto;
use App\Lib\DTOs\UserService\CreateUserResponseDto;
use App\Lib\Interfaces\Services\UserServiceInterface;
use App\Models\User;
use DB;
use Log;

class UserService implements UserServiceInterface
{
    // This class is responsible for user-related operations
    // such as creating, updating, and deleting users.

    public function createUser(ApcisUserDto $userData): CreateUserResponseDto
    {
        $response = new CreateUserResponseDto();

        Log::info('UserService: createUser() called with data: ', [
            'userData array' => $userData->toUserModelArray(),
            'userData object' => $userData,
        ]);
        try {
            $response->isSuccess = true;

            // 01. Check if user exists
            $user = User::where('email', $userData->email)->first();
            if ($user) {
                $response->user = $user;
                return $response;
            }

            // 02. Create a new user and Commit changes
            DB::beginTransaction();
            $newUser = User::create($userData->toUserModelArray());
            DB::commit();

            // 03. Return success response
            $response->user = $newUser;
            return $response;
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
            // 04. Return error response
            $response->isSuccess = false;
            return $response;
        }
    }

    // public function updateUser(int $userId, array $userData): bool
    // {
    //     // Logic to update a user
    //     return true;
    // }

    // public function deleteUser(int $userId): bool
    // {
    //     // Logic to delete a user
    //     return true;
    // }

    // public function getUser(int $userId): array
    // {
    //     // Logic to get a user
    //     return [];
    // }


}