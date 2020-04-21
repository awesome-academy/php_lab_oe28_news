<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserProfileRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . Auth::user()->id , 'max:255'],
            'phone_number' => [
                'required',
                'regex:/^([0-9\s\-\+\(\)]*)$/',
                'min:9',
                'unique:users,phone_number,' . Auth::user()->id
            ],
        ];
    }
}
