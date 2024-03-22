<?php

namespace App\Repository\ads;

use App\Models\Panel\Ads;
use Cviebrock\EloquentSluggable\Services\SlugService;

class adsRepo
{
    private $query;

    public function __construct()
    {
        $this->query = Ads::query();
    }

    public function index()
    {
        return $this->query->paginate();
    }

    public function create($data , $image)
    {
        return $this->query->create([
            'title' => $data['title'],
            'slug' => SlugService::createSlug(Ads::class, 'slug', $data['title']),
            'advertising' => $data['advertising'],
            'type_advertising' => $data['type_advertising'],
            "expire_at" => $data['expire_at'],
            'opening_limit' => $data['opening_limit'],
            'image' => $image  ,
            'user_id' => auth()->id()
        ]);
    }

    public function getFindId($id)
    {
        return $this->query->findOrFail($id);
    }

    public function update($data , $id ,$image)
    {
            return $this->query->where('id' , $id)->update([
            'title' => $data['title'],
            'slug' => SlugService::createSlug(Ads::class, 'slug', $data['title']),
            'advertising' => $data['advertising'],
            'type_advertising' => $data['type_advertising'],
            "expire_at" => $data['expire_at'],
            'opening_limit' => $data['opening_limit'],
            'image' => $image  ,
            'user_id' => auth()->id()
        ]);
    }

    public function delete($id)
    {
        return $this->query->where('id' , $id)->delete();
    }

}
