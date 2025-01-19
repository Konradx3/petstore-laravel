<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePetRequest extends FormRequest
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
            'name' => 'required|string|max:255|regex:/^[A-Za-zĄąĆćĘęŁłŃńÓóŚśŹźŻż\s]+$/',
            'status' => 'required|string|in:available,pending,sold',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The pet name is required.',
            'name.string' => 'The pet name must be a string.',
            'name.max' => 'The pet name must not exceed 255 characters.',
            'name.regex' => 'The pet name cannot contain special characters.',
            'status.required' => 'The pet status is required.',
            'status.in' => 'The status must be one of the following: available, pending, sold.',
        ];
    }

}
