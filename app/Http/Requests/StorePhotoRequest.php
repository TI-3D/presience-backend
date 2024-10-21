<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePhotoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'photo1'=> 'required|image|mimes:jpeg,png,jpg|max:2048',
            'photo2'=> 'required|image|mimes:jpeg,png,jpg|max:2048',
            'photo3'=> 'required|image|mimes:jpeg,png,jpg|max:2048',
            'photo4'=> 'required|image|mimes:jpeg,png,jpg|max:2048',
            'photo5'=> 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}
