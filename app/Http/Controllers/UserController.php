<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public const STATUS_ADMIN = 1;
    public const STATUS_MODERATOR = 2;
    public const STATUS_USER = 3;

    public function index(): JsonResponse
    {
        $users = User::all();

        try {
            $usersData = [];

            foreach ($users as $user) {
                $items = [
                    'name' => $user->name,
                    'email'=> $user->email,
                    'role'=>$user->role,
                ];
                $usersData[] = $items;
            }
        } catch (\Throwable $e) {
            report($e);

            return response()->json([
                'error' => $e,
            ]);
        }

        return response()->json($usersData);
    }

    public function createNewUser(Request $request): JsonResponse
    {
        $newUser = $request->all();

        try {
            User::create($newUser);
        } catch (\Throwable $e) {
            report($e);

            return response()->json([
                'error' => $e,
            ]);
        }

        return response()->json();
    }

    public function getUser(int $userId): JsonResponse
    {
        try {
            $targetUser = User::find($userId);
            $userData = [
                'name' => $targetUser->name,
                'email'=> $targetUser->email,
                'role'=>$targetUser->role,
                'created_at'=>$targetUser->created_at,
            ];
        } catch (\Throwable $e) {
            report($e);

            return response()->json([
                'error' => $e,
            ]);
        }

        if (empty($targetUser)) {
            return response()->json([
                'existence'=> false,
            ]);
        }

        return response()->json([
            'existence'=> true,
            'data'=> $userData,
        ]);
    }

    public function updateUser(Request $request): JsonResponse
    {
        $userId = $request->input('id');
        $updatedUser = $request->all();

        try {
            $targetUser = User::find($userId);
            $targetUser->update($updatedUser);
        } catch (\Throwable $e) {
            report($e);

            return response()->json([
                'error' => $e,
            ]);
        }

        return response()->json();
    }

    public function deleteUser(Request $request): JsonResponse
    {
        $userId = $request->input('id');

        try {
            $targetUser = Task::find($userId);
            $targetUser->delete();
        } catch (\Throwable $e) {
            report($e);

            return response()->json([
                'error' => $e,
            ]);
        }

        return response()->json();
    }
}
