<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Panel\Article;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Repository\article\articleRepo;
use App\Repository\category\categoryRepo;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function __construct(public articleRepo $articleRepo)
    {
    }

    public function index()
    {
        return $this->articleRepo->index();
    }


    public function store(StoreArticleRequest $request , categoryRepo $categoryRepo)
    {

        $category = $categoryRepo->findManyId($request->category);
        $file = $request->file('image');
        $file_name = Str::random(15) . 'Controllers' . $file->getClientOriginalName();
        $file->move(public_path('images/articles/'), $file_name);
//        $file_name = 'image' ;
        $article = $this->articleRepo->create($request, $file_name);
        $article->categories()->sync($category);
        return response()->json(['message' => 'success create article', 'status' => 'success'], 200);
    }


    public function show($article)
    {
        return $this->articleRepo->getFindId($article);
    }


    public function update(UpdateArticleRequest $request, $article)
    {
        $this->articleRepo->update($request, $article);
        return response()->json(['message' => 'success updated article', 'status' => 'success'], 200);
    }


    public function destroy($article)
    {
        $deleted =  $this->articleRepo->deleted($article);
        if($deleted === 0)
            return response()->json(['message' => 'Not Found Id ', 'status' => 'error'], 404);
        return response()->json(['message' => 'success deleted article', 'status' => 'success'], 200);
    }

    public function star($id)
    {
        $star = $this->articleRepo->getStar($id);
        if ($star === false)  return response()->json(['message' => 'Not Found Id , No change status ', 'status' => 'error'], 404);
        return response()->json(['message' => 'Your status has been successfully changed', 'status' => 'success'], 200);
    }
}
