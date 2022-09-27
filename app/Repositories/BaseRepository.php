<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create(array $attributes)
    {
        $created = $this->model->create($attributes);

        return $this->getById($created->id);
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function getAll($sortBy = null)
    {
        if (isset($sortBy)) {
            return $this->model->all()->sortBy($sortBy);
        }
        return $this->model->all();
    }

    public function getCountAll()
    {
        return $this->model->count();
    }

    public function updateById($id, array $params)
    {
        $this->model->find($id)->update($params);

        return $this->getById($id);
    }

    public function deleteById($id)
    {
        return $this->model->find($id)->delete();
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function withTrashed(): BaseRepository
    {
        $this->model = $this->model->withTrashed();
        return $this;
    }

    public function getAllWithQueryParams($request)
    {
        $category = $request->input('category') ? $request->input('category') : null;
        $price = $request->input('price') ? $request->input('price') : null;

        return $this->model
            ->when($category, function ($query, $category) {
                return $query->where('category', $category);
            })
            ->when($price, function ($query, $price) {
                return $query->where('price', $price);
            })->get();
    }
}
