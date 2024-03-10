<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Panel\Category;
use App\Repository\category\categoryRepo;

class CategoryController extends Controller
{
    public function __construct(public categoryRepo $categoryRepo){}

    public function index()
    {
        return $categories = $this->categoryRepo->index();
    }

    public function store(StoreCategoryRequest $request)
    {
        $this->categoryRepo->store($request);
        return response()->json(['message' => 'success create category ' , 'status' => 'success'],200);
    }


    public function show( $category)
    {
        return $this->categoryRepo->getFindById($category);
    }
    public function update(UpdateCategoryRequest $request,  $category)
    {
        $this->categoryRepo->update($request , $category);
        return response()->json(['message' => 'success updated category ' , 'status' => 'success'],200);
    }


    public function destroy( $category)
    {
        $delete = $this->categoryRepo->delete($category);
        if( $delete === 0 )
            return response()->json(['message' => 'error deleted category ' , 'status' => 'error'],404);
        return response()->json(['message' => 'success deleted category ' , 'status' => 'success'],200);
    }
}
