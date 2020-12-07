<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TimerRequest extends FormRequest
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
            'title' => 'nullable|string|max:255',
            'min' => 'required|integer|max:60',
            'icon_id' => 'required|integer|max:9',
            'mode_id' => 'required|integer|max:9',
            'color' => ['required','regex:/^#[a-fA-F0-9]{6}|[a-fA-F0-9]{3}$/','max:9999999'],
            'picture' => 'nullable|file|image|mimes:jpeg|max:2048',
        ];
    }
}
