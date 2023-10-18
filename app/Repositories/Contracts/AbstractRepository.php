<?php

namespace App\Repositories\Contracts;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Throwable;

abstract class AbstractRepository implements RepositoryInterface
{
    protected $model = '';

    protected function getModel()
    {
        return new $this->model;
    }

    public function getByUser(string $userId): Collection
    {
        return $this->getModel()->where('user_id', $userId)->get();
    }

    public function findOneByUser(string $userId, string $id): ?Model
    {
        return $this->findOneBy([
            'id' => $id,
            'user_id' => $userId,
        ]);
    }

    public function find($id, array $columns = ['*']): ?Model
    {
        return $this->getModel()->find($id, $columns);
    }

    public function findOrFail($id, array $columns = ['*']): Model|ModelNotFoundException
    {
        return $this->getModel()->findOrFail($id, $columns);
    }

    public function firstOrFail(array $criteria): Model|ModelNotFoundException
    {
        return $this->getModel()->where($criteria)->firstOrFail();
    }

    public function findAll(array|string $columns = ['*']): Collection
    {
        return $this->getModel()->get($columns);
    }

    public function first(array|string $columns = ['*']): ?Model
    {
        return $this->getModel()->first($columns);
    }

    public function findBy(
        array $criteria,
        ?array $orderBy = null,
        $limit = null,
        $offset = null,
        $columns = ['*']
    ): Collection {
        return $this->getModel()
            ->where($criteria)
            ->when($orderBy, function ($query, $orderBy) {
                foreach ($orderBy as $column => $direction) {
                    $query->orderBy($column, $direction);
                }

                return $query;
            })
            ->when($limit, fn($query, $limit) => $query->limit($limit))
            ->when($offset, fn($query, $offset) => $query->offset($offset))
            ->get($columns);
    }

    public function findOneBy(array $criteria): ?Model
    {
        return $this->getModel()->where($criteria)->first();
    }

    public function firstOrCreate(array $attributes): ?Model
    {
        return $this->getModel()->firstOrCreate($attributes);
    }

    public function updateOrCreate(array $attributes, array $values): ?Model
    {
        return $this->getModel()->updateOrCreate($attributes, $values);
    }

    public function persist(array $attributes): Model
    {
        return tap($this->instance($attributes), fn(Model $instance) => $instance->save());
    }

    public function update($id, array $attributes): Model
    {
        $model = $this->getModel()->findOrFail($id);
        return $this->updateModel($model, $attributes);
    }

    public function updateModel(Model $model, array $attributes): Model
    {
        $model->fill($attributes)->save();
        return $model;
    }

    public function increment(Model $model, string $column, float|int $amount = 1): int
    {
        return $model->increment($column, $amount);
    }

    public function decrement(Model $model, string $column, float|int $amount = 1): int
    {
        return $model->decrement($column, $amount);
    }

    public function create(array $attributes = []): Model
    {
        return $this->getModel()->create($attributes);
    }

    public function delete($id): bool|null
    {
        $model = $this->getModel()->findOrFail($id);
        return $this->deleteModel($model);
    }

    public function deleteModel(Model $model): bool|null
    {
        return $model->delete();
    }

    public function orderBy($column, $direction = 'asc'): self
    {
        return $this->getModel()->orderBy($column, $direction);
    }

    public function transactional(callable $callable)
    {
        try {
            DB::beginTransaction();

            $result = $callable($this);

            DB::commit();

            return $result;
        } catch (Exception | Throwable $e) {
            DB::rollBack();

            throw $e;
        }
    }

    public function __call($method, $arguments)
    {
        return call_user_func_array([$this->getModel(), $method], $arguments);
    }

    /**
     *
     * @throws ModelNotFoundException
     */
    public function findWithRelation(
        int|string $id,
        array $with,
        array $columns = ['*'],
        bool $trowFailException = false
    ): ?Model {
        $builder = $this->getModel()->with($with);

        return !$trowFailException ? $builder->find($id, $columns) : $builder->findOrFail($id, $columns);
    }
}
