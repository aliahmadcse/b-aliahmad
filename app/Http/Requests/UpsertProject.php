<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpsertProject extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:100',
            'description' => 'required|max:255',
            'project_category_id' => 'required',
            'image' => 'required|max:255',
            'display_order' => 'required',
            'github' => 'nullable|max:255',
            'live' => 'nullable|max:255'
        ];
    }
}
