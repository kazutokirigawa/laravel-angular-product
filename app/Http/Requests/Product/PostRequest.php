<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PostRequest extends FormRequest
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
        $user_id = Auth::user()->id;
        return [
            'name' => 'required|string|unique_field:products,user_id,' . $user_id,
            'description' => 'required|string',
            'price' => 'required|numeric',
            'discount' => 'required|numeric|between:0,100',
            'number_of_stocks' => 'required|numeric'
        ];
    }
}
