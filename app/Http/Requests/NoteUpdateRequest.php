<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteUpdateRequest extends FormRequest
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
            'title' => 'required|min:3',
            'category_id' => 'required',
            'description' => 'required|min:5'
        ];
    }

    public function messages()
    {
        return [
            'title.min' => 'Минимальная длина заголовка 3 символа.',
            'title.required' => 'Поле заголовок обязательно для заполнения.',
            'description.min'  => 'Минимальная длина описания 5 символов.',
            'description.required'  => 'Поле описание обязательно для заполнения.',
            'category_id.required'  => 'Поле категория обязательно для заполнения.',
        ];
    }
}
