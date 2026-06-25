<?php
namespace App\Http\Controllers;

use App\Http\Requests\User\UserRequest;
use App\Http\Resources\User\UserResource;
use App\Services\User\UserService;
use Exception;

class UserController
{
    public function __construct(
        protected UserService $service
    ) {}

    public function index()
    {
        $users = $this->service->index();
        return UserResource::collection($users);
    }

    public function show(int $id)
    {
        $user = $this->service->findId($id);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => new UserResource($user),
        ]);
    }

    public function store(UserRequest $request)
    {
        try {
            $user = $this->service->store($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'User created success',
                'data'    => new UserResource($user),
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(int $id, UserRequest $request)
    {
        try {
            $user = $this->service->update($id, $request->validated());
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found',
                ], 404);
            }
            return response()->json([
                'success' => true,
                'message' => 'User updated successfully',
                'data' => new UserResource($user),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(int $id)
    {
        try {
            $result = $this->service->destroy($id);
            if (!$result) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found',
                ], 404);
            }
            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}