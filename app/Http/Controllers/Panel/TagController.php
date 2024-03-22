<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Panel\Tag;
use App\Repository\tag\tagRepo;

class TagController extends Controller
{
    public function __construct(public tagRepo $tagRepo)
    {
    }

    public function index()
    {
        return $tags = $this->tagRepo->index();
    }

    public function store(StoreTagRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->tagRepo->create($request->only('title', 'content'));
        return response()->json(['message' => 'success create ', 'status' => 'success'], 200);
    }
    public function show($tag)
    {
        return $this->tagRepo->getFindId($tag);
    }

    public function update(UpdateTagRequest $request, $tag): \Illuminate\Http\JsonResponse
    {
        $this->tagRepo->update($request->only('title' , 'content') , $tag);
        return response()->json(['message' => 'success create ', 'status' => 'success'], 200);
    }

    public function destroy($tag): \Illuminate\Http\JsonResponse
    {
        $delete = $this->tagRepo->delete($tag);
        if($delete === 0 )
            return response()->json(['message' => 'not found tags ', 'status' => 'error'], 404);
        return response()->json(['message' => 'success create ', 'status' => 'success'], 200);
    }
}
