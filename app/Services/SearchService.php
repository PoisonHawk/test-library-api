<?php

namespace App\Services;

use Illuminate\Support\Arr;

trait SearchService
{
    protected $model;

    protected $orderBy = 'id';

    protected $orderDirection = 'asc';

    protected $filterable = [];

    protected $searchOptions = [];

    // protected $relationsCount = [];

    public function options($searchOptions)
    {
        $this->searchOptions = $searchOptions;

        return $this;
    }

    public function get()
    {
        $perPage = Arr::get($this->searchOptions, 'limit', $this->perPage);

        $query = $this->query();

        $query = $this->loadRelations($query);

        $query = $this->loadRelationsCount($query);

        $query = $this->filter($query);

        $query = $this->sort($query);

        return $query->paginate($perPage);
    }

    protected function filter($builder)
    {
        $filters = Arr::only($this->searchOptions, $this->filterable);

        return $builder->where($filters);
    }

    protected function loadRelations($builder)
    {
        return $builder->with($this->relations);
    }

    protected function loadRelationsCount($builder)
    {
        return $builder->withCount($this->relationsCount);
    }

    protected function sort($builder)
    {
        $orderField = Arr::get($this->searchOptions, 'order_by', $this->orderBy);

        $orderBy = in_array($orderField, $this->orderable) ? $orderField : $this->orderBy;

        $orderDirection = Arr::get($this->searchOptions, 'order_direction', 'ASC');

        $orderDirection = in_array($orderDirection, ['asc', 'desc']) ? $orderDirection : $this->orderDirection;

        return $builder->orderBy($orderBy, $orderDirection);
    }
}
