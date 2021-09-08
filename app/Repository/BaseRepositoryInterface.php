<?php

namespace App\Repository;


use Illuminate\Database\Eloquent\Model;

/**
 * Interface EloquentRepositoryInterface
 * @package App\Repositories
 */
interface BaseRepositoryInterface
{
    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;

    /**
     * @param $id
     * @return Model
     */
    public function find($id): ?Model;

    /**
     * @param array $attributes
     * @param array $with
     * @param array $columns
     * @return mixed
     */
    public function findByAttributes(array $attributes, $with = [], $columns = array("*")): mixed;


}

