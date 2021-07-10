<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasSlug {

    protected $fieldForSlug = 'title';

    protected function getTextForSlug()
    {
        return $this->{$this->fieldForSlug};
    }

    protected static function booted()
    {        
        static::creating(function (Model $model) {
            
            $model->slug = Str::slug($model->getTextForSlug());

        });
    }
}