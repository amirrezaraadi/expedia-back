<?php

namespace App\Repository\category;

use App\Models\Panel\Category;
use App\Models\User;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;

class categoryRepo
{
    public function index()
    {
        return Category::query()->with('child')->orderByDesc('created_at')->paginate();
    }

    public function store($value)
    {
        return Category::query()->create([
            'title' => $value->title,
            'slug' => SlugService::createSlug(Category::class, 'slug', $value->title),
            'parent_id' => $value->parent_id,
            'user_id' => auth()->id(),
        ]);
    }

    public function getById($id)
    {
        return Category::query()->where('id', $id)->first();
    }

    public function update($value, $id)
    {
        $categoryId = $this->getById($id);
        return Category::query()->where('id', $id)->update([
            'title' => $value->title ?? $categoryId->title,
            'slug' => SlugService::createSlug(Category::class, 'slug', $value->title ?? $categoryId->title),
            'parent_id' => $value->parent_id,
            'user_id' => auth()->id(),
        ]);
    }

    public function delete($id)
    {
        return Category::query()->where('id', $id)->delete();
    }

    public function getTitleId($id)
    {
        return Category::query()->where('id', $id)->first();
    }

    public function getArticleInCategory($category)
    {
        return Category::query()->where('id', $category)->with('articles.author')->first();
    }

    public function getParentId()
    {
        return Category::query()->where('parent_id', null)->get();
    }

    public function getByShowId($id)
    {
        return Category::query()->where('id', $id)->with('child')->first();
    }

    public function getFindSlug($slug)
    {
        return Category::query()->where('slug_en', $slug)->first();
    }

    public function getFindById($id)
    {
        return Category::query()->where('id', $id)->get()->first();
    }

    public function getFindPesaon()
    {
        return Category::query()->select([
            'title_en',
            'slug_en',
        ])->get();
    }

    public function getFindPesaonEn()
    {
        return Category::query()->select([
            'title',
            'slug',
            'slug_en',
        ])->get();
    }

    public function indexAll()
    {
        return Category::query()->select(['id' , 'title' ])->paginate();
    }

    public function findManyId($id)
    {
        $id = explode(','  , $id);
        return Category::query()->whereIn('id' , $id)->get()->pluck('id')->toArray();
    }
}
