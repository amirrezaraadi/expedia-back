<?php

namespace App\Repository\user;

use App\Models\User;
use App\Service\TokenService;
use Illuminate\Support\Facades\Hash;

class userRepo
{
    public function index()
    {

    }

    public function create($data)
    {

    }

    public function getFindId($id)
    {

    }

    public function update($data, $id)
    {

    }

    public function deleted($id)
    {

    }

    public function userRegister($data)
    {
        $user = User::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        return TokenService::generateToken($user);

    }

    public function userLogin($data)
    {
        $user = User::query()->where('email', $data['email'])->first();
        if (is_null($user)) return false;
        $password = Hash::check($data['password'], $user->password);
        if ($password === false) return false;
        return TokenService::generateToken($user);
    }
}
