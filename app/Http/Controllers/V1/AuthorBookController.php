<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Author\AuthorResource;
use App\Services\AuthorService;
use Illuminate\Http\Request;

class AuthorBookController extends Controller
{
    protected $service;

    public function __construct(AuthorService $service)
    {
        $this->service = $service;
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id)
    {
        $author = $this->service->getAuthor($id);

        return response()->json(new AuthorResource($author->load('books')));
    }
}
