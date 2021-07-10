<?php

namespace App\Http\Resources\V1\Author;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthorListResource extends JsonResource
{
    public static $wrap = 'authors';

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
            'slug' => $this->slug
        ];
    }
}
