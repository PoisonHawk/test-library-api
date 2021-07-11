<?php

namespace App\Http\Resources\V1\Book;

use App\Http\Resources\V1\Author\AuthorListResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'authors' => AuthorListResource::collection($this->whenLoaded('authors')),
        ];
    }
}
