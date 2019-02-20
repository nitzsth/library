<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $uniqueIsbn = 'books';

        if ($this->method() === 'PUT') {
            $uniqueIsbn .= ',isbn,' . request('book')->id;
        }

        return [
            'name'        => 'required|string|min:3|max:50',
            'isbn'        => "required|unique:$uniqueIsbn",
            'pages'       => 'required|integer|min:1',
            'edition'     => 'required|string',
            'publisher'   => 'required|string|min:3',
            'author_id'   => 'required',
            'author_*'    => 'required|integer|exists:authors,id',
            'description' => 'required',
        ];
    }
}
