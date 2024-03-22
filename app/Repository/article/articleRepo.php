<?php

namespace App\Repository\article;

use App\Models\Panel\Article;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;

class articleRepo
{
    public function index()
    {
        return Article::query()->with('categories')->paginate(8);
    }

    public function create($data, $image)
    {
        return Article::query()->create([
            'title' => $data->title,
            'sub_title' => $data->sub_title,
            'slug' => SlugService::createSlug(Article::class, 'slug', $data->title),
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
        $article_id = $this->getFindWhere($id);
        return Article::query()->where('id', $id)->update([
            'title' => $data->title ?? $article_id->title,
            'sub_title' => $data->sub_title ?? $article_id->sub_title,
            'slug' => SlugService::createSlug(Article::class, 'slug', $data->title ?? $article_id->sub_title),
            'featuring_image' => $image ?? $article_id->image,
            'tags' => $data->tags ?? $article_id->tags,
            'content' => $data->content ?? $article_id->content,
            'image' => $image ?? $article_id->image,
            'user_id' => auth()->id(),
        ]);
    }

    public function deleted($id)
    {
        return Article::query()->where('id', $id)->delete();
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
        if (is_null($article)) return false;
        $true = $article->where('star', 1)->get();
        $article->update(['star' => !$article->star]);
        return $article;
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
