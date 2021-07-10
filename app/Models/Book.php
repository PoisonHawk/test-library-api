<?php

namespace App\Models;

use App\Models\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    use HasSlug;

    protected $fillable = [
        'title',
        'active',
        'slug'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }
}
