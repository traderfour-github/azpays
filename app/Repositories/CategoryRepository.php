<?php

namespace App\Repositories;

use EloquentBuilder;
use App\Models\Category;
use App\Repositories\Contracts\AbstractRepository;

class CategoryRepository extends AbstractRepository
{
    protected $model = Category::class;

    public function categoryList($data)
    {
        if(empty($data)){
            return $this->getModel()->get();
        }else{
            return EloquentBuilder::to($this->model, $data)->get();
        }
    }

    public function categoryDetail(string $uuid)
    {
        return $this->getModel()->where('id',$uuid)->first();
    }
}
