<?php

namespace App\Http\Requests;

use App\Helpers\Constant;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $uniqueEmail = 'users';
        $roles = implode(',', Constant::getRoles());

        if ($this->method() === 'PUT') {
            $password = 'nullable';
            $uniqueEmail .= ',email,' . request('user')->id;
        } else {
            $password = 'required';
        }

        return [
            'avatar' => 'nullable|image|max:1000',
            'name' => 'required|string|min:3|max:50',
            'email' => "required|unique:$uniqueEmail",
            'password' => "$password|string|min:6|max:25",
            'role' => "required|string|in:$roles",
        ];
    }
}
