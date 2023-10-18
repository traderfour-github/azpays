<?php

namespace App\Http\Controllers\Tag;

use App\Http\Controllers\Controller;
use App\Http\Resources\Tag\TagResource;
use App\Services\Tag\TagService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __construct(
        private TagService $tagService
    ) {
    }

    public function get(Request $request)
    {
        $items = $this->tagService->tagList($request->only(['title','slug','type']));

        return $this->respond(TagResource::collection($items));
    }

    public function read($id)
    {
        try {
            $data = $this->tagService->read($id);

            return $this->respond(new TagResource($data));
        } catch (ModelNotFoundException $exception) {
            return $this->respondEntityNotFound();
        }
    }


}
