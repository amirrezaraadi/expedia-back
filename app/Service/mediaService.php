<?php

namespace App\Service;

use Illuminate\Support\Str;

class mediaService
{
    public static function imagee_ads($file)
    {
        $file_name = md5(Str::random(15)) . '.' . $file->getClientOriginalName();
        $file->move(public_path('images/ads/') , $file_name );
        return $file_name;
    }

    public static function imagee_article($file)
    {
        $file_name = md5(Str::random(15)) . '.' . $file->getClientOriginalName();
        $file->move(public_path('images/article/') , $file_name );
        return $file_name;
    }
}
