<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PermitBeforeSchedule extends FormRequest
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
            //
            'sw_id' => 'required', //Schedule week id
            'start_date' => [
                'required',
                'date',
                'after_or_equal:' . now()->toDateString(), // Not before today
                'before_or_equal:' . now()->addDays(7)->toDateString(), // Can't be more than 7 days in the future
            ],
            'end_date' => [
                'date',
                'after_or_equal:start_date',// Must be after or equal to start_date
                'before_or_equal:' . now()->addDays(7)->toDateString(), // Can't be more than 7 days in the future
            ],            'permit_type' => 'required|in:sakit,izin',
            'description' => 'required|string',
            'evidence' => 'required|image|mimes:jpeg,png,jpg|max:10240',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response([
            'errors' => $validator->getMessageBag()
        ], 400));
    }
}
