<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class SearchService
{
    protected $model;

    protected $perPage = 10;

    protected $relations = [];
        
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function with(array $relations): self
    {
        $this->relations = $relations;

        return $this;
    }

    public function get()
    {
        $perPage = $this->perPage;

        return $this->model
            ->with($this->relations)
            ->paginate($perPage);
    }
}