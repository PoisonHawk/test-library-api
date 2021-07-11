<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Book\Create;
use App\Http\Resources\V1\Book\BookResource;
use App\Models\Book;
use App\Models\Search\BookSearch;
use App\Services\BookService;
use App\Services\SearchService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $books = (new BookSearch())
            ->options($request->all())
            ->get();

        return response()->json(BookResource::collection($books), JsonResponse::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Create $request): JsonResponse
    {
        $book = $this->bookService->create($request->validated());

        return response()->json(new BookResource($book), JsonResponse::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = $this->bookService->getBook($id);

        return response()->json(new BookResource($book->load('authors')), JsonResponse::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Create $request, $id)
    {
        $book = $this->bookService->update($id, $request->validated());

        return response()->json(new BookResource($book), JsonResponse::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->bookService->delete($id);

        return response()->json([], JsonResponse::HTTP_NO_CONTENT);
    }
}
