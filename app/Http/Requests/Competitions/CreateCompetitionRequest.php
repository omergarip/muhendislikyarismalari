<?php

namespace App\Http\Requests\Competitions;

use Illuminate\Foundation\Http\FormRequest;

class CreateCompetitionRequest extends FormRequest
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
            'organizer' => 'required',
            'title' => 'required|unique:competitions',
            'image' => 'required|image',
            'description' => 'required',
            'deadline' => 'required',
            'reward' => 'required',
            'detail' => 'required'
        ];
    }
}
