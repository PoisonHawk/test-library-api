<?php

namespace App\Models\Search;

use App\Models\Book;
use App\Services\SearchService;

class BookSearch extends Book
{
    use SearchService;

    public $table = 'books';

    protected $relations = ['authors'];

    protected $orderable = ['id', 'title'];

    
}
