<?php
namespace App\Repository\tag ;

use App\Models\Panel\Tag;
use Cviebrock\EloquentSluggable\Services\SlugService;

class tagRepo
{
    public function index()
    {
        return Tag::query()->paginate();
    }

    public function create($data)
    {
        return Tag::query()->create([
            'title' => $data['title'],
            'slug' => SlugService::createSlug(Tag::class , 'slug', $data['title']),
            'content' => $data['content'],
            'user_id' => auth()->id(),
        ]);
    }
    public function getFindId($id)
    {
        return Tag::query()->findOrFail($id);
    }

    public function update($data , $id)
    {
        $tag = $this->getFindId($id);
        return Tag::query()->where('id' , $id)->update([
            'title' => $data['title'] ?? $tag->title,
            'slug' => SlugService::createSlug(Tag::class , 'slug', $data['title'] ?? $tag->title),
            'content' => $data['content'] ?? $tag->content,
            'user_id' => auth()->id(),
        ]);
    }

    public function delete($id)
    {
        return Tag::query()->where('id' , $id)->delete();
    }

    public function status($status)
    {
        return Tag::query()->create([

        ]);
    }


}
