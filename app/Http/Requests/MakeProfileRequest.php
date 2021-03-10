<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MakeProfileRequest extends FormRequest
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
            'name'=>'required|string|min:4|max:120',
            'lastname'=>'required|string|min:4|max:120',
            'username'=>'required|unique:users|min:4|max:30',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:7|max:38',
            'country'=>'required',
            'region'=>'required',
            'address'=>'required',
            'zipcode'=>'required',
            'profile_photo'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
