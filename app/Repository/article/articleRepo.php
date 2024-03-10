<?php

namespace App\Repository\article ;
use App\Models\Panel\Article;

class articleRepo
{
    public function index()
    {

    }

    public function create($data , $image)
    {

    }

    public function getFindId($id)
    {

    }

    public function update($data , $id , $image)
    {

    }

    public function deleted($id)
    {

    }

    public function status($id  , $status)
    {

    }

    public function star($id)
    {

    }

    public function getStar()
    {
        return Article::query()->where('star' , 1)->get();
    }
    public function getCreatedAt()
    {
        return Article::query()->orderByDesc('created_at')->skip(1)->get();
    }
    public function getNewCreatedAt()
    {
        return Article::query()->orderByDesc('created_at')->first();
    }
}
