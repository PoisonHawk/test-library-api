<?php

namespace App\Services;

use App\Models\Book;

class BookService
{
    public function create(array $data): Book
    {
        $book = Book::create($data);

        $book->authors()->attach($data['authors']);

        return $book;
    }

    public function update(int $id, array $data): Book
    {
        $book = Book::findOrFail($id);

        $book->fill($data)->save();

        $book->authors()->sync($data['authors']);

        return $book;
    }

    public function delete($id)
    {
        $book = Book::findOrFail($id);

        return $book->delete();
    }
}
