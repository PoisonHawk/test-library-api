<?php

namespace App\Http\Requests\V1\Book;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('books')->ignore((int)$this->book)               
            ],
            'authors' => [
                'required',
                'array'
            ],
            'authors.*' => ['exists:authors,id']
        ];
    }
}
