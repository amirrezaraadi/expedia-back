<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Repository\user\userRepo;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    public function store(RegisterRequest $request , userRepo $userRepo): \Illuminate\Http\JsonResponse
    {
        $user = $userRepo->userRegister($request->only('email' , 'name' , 'password'));
        return response()->json(['token' => $user ],200);
    }
}
