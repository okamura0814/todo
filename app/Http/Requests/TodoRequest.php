<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required','max:64'],
            'due_date' => ['date_format:Y/m/d'],
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'due_date' => '期限',
        ];
    }

    public function messages()
    {
        return [
            'due_date.date_format' => '期限は「年/月/日」形式で指定してください',
        ];
    }
}
