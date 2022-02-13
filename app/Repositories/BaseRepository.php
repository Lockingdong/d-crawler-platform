<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected $model;

    public function __construct(
        Model $model
    )
    {
        $this->model = $model;
    }

    public function firstOrCreate(Model $model)
    {
        $reflection = new \ReflectionClass($model);

        return $reflection->name::firstOrCreate($model->toArray());
    }

    /**
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all($columns = ['*'])
    {
        return $this->model->all($columns);
    }

    /**
     * @param Model $model
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(Model $model)
    {
        return $this->model->create($model->toArray());
    }

    /**
     * @param $id
     * @param array $attributes
     * @param array $options
     * @return bool
     */
    public function update($id, array $attributes, array $options = [])
    {
        $instance = $this->model->findOrFail($id);

        return $instance->update($attributes, $options);
    }

    /**
     * @param $column
     * @param $value
     * @param array $attributes
     * @param array $options
     * @return bool
     */
    public function updateBy($column, $value, array $attributes = [], array $options = [])
    {
        return $this->model->where($column, $value)->update($attributes, $options);
    }

    /**
     * @param array $columns
     * @return mixed
     */
    public function first($columns = ['*'])
    {
        return $this->model->first($columns);
    }

    /**
     * @param $column
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function firstBy($column, $value, $columns = ['*'])
    {
        return $this->model->where($column, $value)->first($columns);
    }

    /**
     * @param $id
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function find($id, $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    /**
     * @param $column
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findBy($column, $value, $columns = ['*'])
    {
        return $this->model->where($column, $value)->first($columns);
    }

    /**
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function get($columns = ['*'])
    {
        return $this->model->get($columns);
    }

    /**
     * @param $column
     * @param $value
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getBy($column, $value, $columns = ['*'])
    {
        return $this->model->where($column, $value)->get($columns);
    }

    /**
     * @param $ids
     * @return int
     * @internal param $id
     */
    public function destroy($ids)
    {
        return $this->model->destroy($ids);
    }

    /**
     * @param $column
     * @param $value
     * @return bool|null
     */
    public function destroyBy($column, $value)
    {
        return $this->model->where($column, $value)->delete();
    }

    /**
     * @param null $perPage
     * @param array $columns
     * @param string $pageName
     * @param int $page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null)
    {
        return $this->model->paginate($perPage, $columns, $pageName, $page);
    }

    /**
     * @param $column
     * @param $value
     * @param null $perPage
     * @param array $columns
     * @param string $pageName
     * @param int $page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginateBy($column, $value, $perPage = null, $columns = ['*'], $pageName = 'page', $page = null)
    {
        return $this->model->where($column, $value)->paginate($perPage, $columns, $pageName, $page);
    }
}
