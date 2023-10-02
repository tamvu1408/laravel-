<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EmployeeRequest extends FormRequest
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
        $uniqueEmail = 'unique:users';
        if ($this->isMethod('PUT')) {
            $uniqueEmail = 'unique:users,email,' . $this->user->id;
        };

        $rules = [
            'name' => 'required|string',
            'email' => 'required|email|' . $uniqueEmail,
            'birth_date' => 'nullable|date|before_or_equal:' . Carbon::now()->subYears(18)->format('d-m-Y'),
            'starting_date' => 'required|date|before:tomorrow',
            'status' => 'required',
            'department' => 'required',
        ];

        if ($this->isMethod('POST')) {
            $rules['username'] = 'required|unique:users';
            $rules['password'] = 'required|confirmed';
            $rules['password_confirmation'] = 'required';
            $rules['role'] = 'required';
            $rules['avatar'] = 'nullable|mimes:jpeg,png,jpg|max:2048';
        };

        return $rules;
    }
}
