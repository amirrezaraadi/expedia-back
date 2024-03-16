<?php

namespace App\Repository\article;

use App\Models\Panel\Article;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;

class articleRepo
{
    public function index()
    {
        return Article::query()->paginate();
    }

    public function create($data, $image)
    {
//        dd(Str::slug( $data->title));
        return Article::query()->create([
            'title' => $data->title,
            'sub_title' => $data->sub_title,
//            'slug' => SlugService::createSlug(Article::class, 'slug', $data->title),
            'slug' => Str::slug($data->title),
            'featuring_image' => $image,
            'tags' => $data->tags,
            'content' => $data->content,
            'image' => $image,
            'user_id' => auth()->id(),
        ]);
    }

    public function getFindId($id)
    {
        return Article::query()->findOrFail($id);
    }

    public function getFindWhere($id)
    {
        return Article::query()->where('id', $id)->first();
    }

    public function update($data, $id, $image)
    {
        return Article::query();
    }

    public function deleted($id)
    {
        return Article::query();
    }

    public function status($id, $status)
    {
        return Article::query();
    }

    public function star($id)
    {
        return Article::query();
    }

    public function getStar($id)
    {
        $article = $this->getFindWhere($id);
            if(is_null($article))  return false ;
        $true = $article->where('star', 1)->first();
        if ($true) {
            return $article->update(['star' => 0]);
        } else {
            return $article->update(['star' => 1]);
        }

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
