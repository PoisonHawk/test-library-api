<?php

namespace App\Http\Resources\V1\Author;

use App\Http\Resources\V1\Book\BookResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
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
            'surname' => $this->surname,
            'name' => $this->name,
            'patronymic' => $this->patronymic,            
            'books' => BookResource::collection($this->whenLoaded('books'))
        ];
    }
}
