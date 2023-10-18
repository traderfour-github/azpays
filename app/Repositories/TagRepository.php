<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Tag;
use App\Repositories\Contracts\AbstractRepository;
use Illuminate\Database\Eloquent\Model;
use EloquentBuilder;

class TagRepository extends AbstractRepository
{
    protected $model = Tag::class;

    public function platformList($data)
    {
        if(empty($data)){
            return $this->getModel()->get();
        }else{
            return EloquentBuilder::to($this->model, $data)->get();
        }
    }

    public function platformDetail(string $uuid)
    {
        return $this->getModel()->where('id',$uuid)->first();
    }
}
