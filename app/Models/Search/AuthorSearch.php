<?php

namespace App\Models\Search;

use App\Models\Author;
use App\Services\SearchService;

class AuthorSearch extends Author
{
    use SearchService;

    public $table = 'authors';

    protected $orderable = ['id', 'surname'];

    protected $relationsCount = ['books']; 
}
