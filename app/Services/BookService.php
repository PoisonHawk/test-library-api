<?php

namespace App\Services;

use App\Models\Book;
use Illuminate\Database\Eloquent\Model;

class BookService
{
    protected $model;

    public function __construct()
    {
        $this->model = new Book;
    }

    public function create(array $data): Model
    {
        $book = $this->model->create($data);

        $book->authors()->attach($data['authors']);

        return $book;
    }

    public function update(int $id, array $data): Model
    {
        $book = $this->getById($id);

        $book->fill($data)->save();

        $book->authors()->sync($data['authors']);

        return $book;
    }

    public function delete($id)
    {
        $book = $this->getById($id);

        $book->authors()->detach();

        return $book->delete();
    }

    /**
     * Get book by id or slug
     *
     * @param int|string $field
     * @return void
     */
    public function getBook($field)
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
