<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Panel\Article;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Repository\article\articleRepo;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function __construct(public articleRepo $articleRepo){}

    public function index()
    {
        return $this->articleRepo->index();
    }


    public function store(StoreArticleRequest $request)
    {
//        dd($request->all());
//        $file = $request->file('featuring_image');
//        $file_name = Str::random(15) . 'Controllers' . $file->getClientOriginalName();
//        $path = $file->move(public_path('images/articles/' ),  $file_name );
//        $this->articleRepo->create($request , $file_name);
        $this->articleRepo->create($request);
        return response()->json(['message' => 'success create article' , 'status' => 'success'],200);
    }


    public function show($article)
    {
        // todo error 404
        return $this->articleRepo->getFindId($article);
    }


    public function update(UpdateArticleRequest $request, $article)
    {
        $this->articleRepo->update($request , $article);
        return response()->json(['message' => 'success updated article' , 'status' => 'success'],200);
    }


    public function destroy($article)
    {
        $this->articleRepo->deleted($article);
        return response()->json(['message' => 'success deleted article' , 'status' => 'success'],200);
    }
}
