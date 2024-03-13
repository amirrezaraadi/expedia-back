<?php

namespace App\Repository\article;

use App\Models\Panel\Article;
use Cviebrock\EloquentSluggable\Services\SlugService;

class articleRepo
{
    public function index()
    {
        return Article::query()->paginate() ;
    }

//    public function create($data, $image)
    public function create($data)

    {
        return Article::query()->create([
            'title' => $data['title'],
            'sub_title' => $data['sub_title'],
            'slug' => SlugService::createSlug(Article::class, 'slug', $data->title),
            'featuring_image' => 'image',
            'tags' => $data['tags'],
            'content' => $data['content'],
            'image' => 'image',
            'user_id' => auth()->id(),
        ]) ;
    }

    public function getFindId($id)
    {
        return Article::query() ;
    }

    public function update($data, $id, $image)
    {
        return Article::query() ;
    }

    public function deleted($id)
    {
        return Article::query() ;
    }

    public function status($id, $status)
    {
        return Article::query() ;
    }

    public function star($id)
    {
        return Article::query() ;
    }

    public function getStar()
    {
        return Article::query()->where('star', 1)->get();
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
