<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * @param $id
     * @return Model
     */
    public function find($id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * @param array $attributes
     * @param array $with
     * @param string[] $columns
     * @return mixed
     */
    public function findByAttributes(array $attributes, $with = [], $columns = array("*")): mixed
    {
        $query = $this->queryBuilder($attributes);

        if (!empty($with)) {
            foreach ($with as $relation) {
                $query = $query->with($relation);
            }
        }

        try {
            return $query->first($columns);
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    /**
     * @param array $attributes
     * @param null $orderBy
     * @param string $sortOrder
     * @return mixed
     */
    protected function queryBuilder(array $attributes): mixed
    {

        $query = $this->model->query();

        foreach ($attributes as $field => $value) {
            if ($field == 'where_in') {
                $query = $query->whereIn(key($value), $value[key($value)]);
            } else if ($field == 'whereJsonContains') {
                foreach ($value as $col => $json) {
                    $query = $query->whereJsonContains($col, $json);
                }
            } else if ($field == 'limit') {
                $query = $query->limit($value);
            } else if ($field == 'offset') {
                $query = $query->offset($value);
            } else if ($field == 'doesntHave') {
                foreach ($value as $doesntHave) {
                    $query = $query->doesntHave($doesntHave);
                }
            } else {
                $query = $query->where($field, $value);
            }
        }

        return $query;
    }

}
