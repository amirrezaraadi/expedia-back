<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\UserCreatedRequest;
use App\Repository\user\userRepo;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(public userRepo $userRepo){}

    public function index()
    {
        return $users = $this->userRepo->index();
    }


    public function store(UserCreatedRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->userRepo->create($request->only('name' , 'email' , 'password'));
        return response()->json(['message' => 'success crested user' , 'status' => 'success'],200);
    }


    public function show( $id)
    {
        return $user = $this->userRepo->getFindId($id);
    }


    public function update(Request $request,  $id)
    {
        $this->userRepo->update($request->only('name'  , 'password' , 'email') , $id);
        return response()->json(['message' => 'success updated user' , 'status' => 'success'],200);
    }


    public function destroy( $id)
    {
        $deleted = $this->userRepo->deleted($id);
        if($deleted === 0 )
            return response()->json(['message' => 'not found user' , 'status' => 'error'],404);
        return response()->json(['message' => 'success deleted user' , 'status' => 'success'],200);
    }


}
