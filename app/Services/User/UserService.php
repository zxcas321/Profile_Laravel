<?php

namespace App\Services\User;

use App\Models\User;
use Exception;

class UserService
{
    public function index()
    {
        return User::all();
    }

    public function findId(int $id)
    { 
        return User::find('id', $id);
    }

    public function store(array $data)
    {
        try {
            if (empty($data['name']) || empty($data['email']) || empty($data['password'])) {
                throw new Exception('Name, email, and password are required');
            };

            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
            ]);
        } catch (Exception $e) {
            throw new Exception('failed to create user: '. $e->getMessage());
        }
    }

    public function update(int $id, array $data)
    {
        try {
            $user = User::find('id', $id);

            if (!$user){
                throw new Exception('user not found');
            }

            $fillable = [];
            
            if (isset($data['name'])) {
                $fillable['name'] = $data['name'];
            }
            
            if (isset($data['email'])) {
                $fillable['email'] = $data['email'];
            }
            
            if (isset($data['password'])) {
                $fillable['password'] = $data['password'];
            }
 
            $user->update($fillable);
 
            return $user;

        } catch (Exception $e) {
            throw new Exception('Failed to update user: ' . $e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        try{
            $user = User::find('id', $id);
 
            if (!$user) {
                throw new Exception('User not found.');
            }
 
            return $user->delete();

        } catch (Exception $e){
            throw new Exception('failed to delete user '. $e->getMessage());
        }
    }
}
