<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRequest extends FormRequest
{
    public $validator;

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'is_active' => 'boolean',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => __(
                'validation.required',
                ['attribute' => __(
                    'Page: title',
                    [],
                    'ru',
                )],
                'ru',
            ),
            'content.required' => __(
                'validation.required',
                ['attribute' => __(
                    'Page: content',
                    [],
                    'ru',
                )],
                'ru',
            ),
        ];
    }
}
