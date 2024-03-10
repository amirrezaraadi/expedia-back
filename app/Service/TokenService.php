<?php

namespace App\Service ;
class TokenService
{
    public static function generateToken($user)
    {
        return $user->createToken( $user->name , ['*'] ,  now()->addWeek()  )->plainTextToken ;
    }

    public function expire($time)
    {
        return  now()->addWeek();
    }
}
