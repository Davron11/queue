<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
    public function rules()
    {
        return [
            'full_name' => 'required|string|max:255',
            'pinfl' => 'required|string|max:20',
            'phone_number' => 'required|string|max:15',
            'role_id' => 'required|integer|exists:roles,id',
            'passport_series' => 'nullable|string|max:10',
            'passport_number' => 'nullable|string|max:10',
            'password' => 'nullable|string|min:8|confirmed',
            'address' => 'nullable|array',
            'address.oblast_id' => 'nullable|integer|exists:oblasts,id',
            'address.city_id' => 'nullable|integer|exists:cities,id',
            'address.district_id' => 'nullable|integer|exists:districts,id',
            'address.mahalla_id' => 'nullable|integer|exists:mahallas,id',
            'address.home' => 'nullable|string|max:255',
        ];
    }
}
