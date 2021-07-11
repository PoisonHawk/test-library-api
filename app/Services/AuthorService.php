<?php

namespace App\Services;

use App\Models\Author;
use Illuminate\Database\Eloquent\Model;

class AuthorService
{
    protected $model;

    public function __construct()
    {
        $this->model = new Author;
    }
    
    public function create(array $data): Model
    {
        $author = $this->model->create($data);

        return $author;
    }

    public function update(int $id, array $data): Model
    {
        $author = $this->getById($id);

        $author->fill($data)->save();

        return $author;
    }

    public function delete($id)
    {
        $author = $this->getById($id);

        return $author->delete();
    }

    /**
     * Get author by id or slug
     *
     * @param int|string $field
     * @return void
     */
    public function getAuthor($field)
    {
        return is_numeric($field)
            ? $this->getById($field) 
            : $this->model->getBySlug($field);
    }

    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }
}
