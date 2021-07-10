<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class SearchService
{

    protected $model;
        
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function get()
    {
        
    }
}