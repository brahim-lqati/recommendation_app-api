<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::all();
        return response([
            'categories' => CategoryResource::collection($categories),
            'message' => 'Retreive Successfully'
        ], 200);
    }

    public function show($id) {
      
        $category = Category::where('id',$id)->first();
        if(!$category) {
            return response([
                'Invalid Id' => 'Category Not found'
            ], 400);
        }
        return response([
            'category' => new CategoryResource($category),
            'message' => 'Retreive Successfully'
        ], 200);
    }
}
