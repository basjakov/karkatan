<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class orderOfferRequest extends FormRequest
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
            'project_name'=>'required|string|min:4|max:120',
            'title'=>'required|string|min:4|max:120',
            'expert_id'=>'required|numeric',
            'description'=>'required|min:5|max:1000',
            'filename'=>'required|max:4096|mimes:jpeg,png,pdf',
            'budget'=>'required|numeric',
            'currency'=>'required',
            'to'=>'required',
            'finish'=>'required',
        ];
    }
}
