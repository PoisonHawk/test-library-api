<?php

namespace App\Models;

use App\Models\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    use HasSlug;

    protected $fillable = [
        'name',
        'patronymic',
        'surname',
        'active',
        'slug'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    protected function getTextForSlug()
    {
        return $this->name . ' ' . $this->surname;
    }

    public function books()
    {
        return $this->belongsToMany(Book::class);
    }
}
