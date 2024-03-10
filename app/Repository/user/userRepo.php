<?php

namespace App\Repository\user;

use App\Models\User;
use App\Service\TokenService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class userRepo
{
    public function index()
    {
        return User::query()->orderByDesc('created_at')->paginate();
    }

    public function create($data)
    {
        return $this->createUser($data);
    }

    public function getFindId($id)
    {
        return User::query()->findOrFail($id);
    }

    public function update($data, $id)
    {
        $userId = $this->getFindId($id);
        return User::query()->where('id' , $id)->update([
            'name' => $data['name'] ?? $userId->name ,
            'email' => $data['email'] ?? $userId->email ,
            'password' => Hash::make($data['password']) ?? $userId->password ,
        ]);
    }

    public function deleted($id)
    {
        $user =  User::query()->where('id' , $id)->delete();
        return $user ;
    }

    public function userRegister($data)
    {
        $user = $this->createUser($data);
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

    public function createUser($data)
    {
        return User::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'remember_token' => Str::uuid()
        ]);
    }
}
