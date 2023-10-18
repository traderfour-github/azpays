<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryResource;
use App\Services\Category\CategoryService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(
        private CategoryService $categoryService
    ) {
    }

    public function get(Request $request)
    {
        $items = $this->categoryService->categoryList($request->only(['title','slug','type','sort']));

        return $this->respond(CategoryResource::collection($items));
    }

    public function show($id)
    {
        try {
            $data = $this->categoryService->read($id);

            return $this->respond(new CategoryResource($data));
        } catch (ModelNotFoundException $exception) {
            return $this->respondEntityNotFound();
        }
    }


}
