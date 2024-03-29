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
        return response()->json(['message' => 'success create category' , 'status' => 'success'],200);
    }


    public function show( $category)
    {
       $category =  $this->categoryRepo->getFindById($category);
       if( is_null($category) )
           return response()->json(['message' => 'category not found' , 'status' => 'error'],404);
       return $category ;
    }
    public function update(UpdateCategoryRequest $request,  $category)
    {
        $this->categoryRepo->update($request , $category);
        return response()->json(['message' => 'success category updated' , 'status' => 'success'],200);
    }


    public function destroy( $category)
    {
        $delete = $this->categoryRepo->delete($category);
        if( $delete === 0 )
            return response()->json(['message' => 'category not found' , 'status' => 'error'],404);
        return response()->json(['message' => 'success deleted category' , 'status' => 'success'],200);
    }

    public function parent()
    {
        return $this->categoryRepo->getParentId();
    }

    public function all()
    {
        return $categories = $this->categoryRepo->indexAll();
    }
}
