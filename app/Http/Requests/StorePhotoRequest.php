<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
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
            'photo2'=> 'image|mimes:jpeg,png,jpg|max:2048',
            'photo3'=> 'image|mimes:jpeg,png,jpg|max:2048',
            'photo4'=> 'image|mimes:jpeg,png,jpg|max:2048',
            'photo5'=> 'image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response([
            'errors' => $validator->getMessageBag()
        ], 400));
    }
}
