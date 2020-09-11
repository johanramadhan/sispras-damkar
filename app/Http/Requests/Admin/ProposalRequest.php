<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProposalRequest extends FormRequest
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
            'users_id' => 'required|exists:users,id',
            'categories_id' => 'required|exists:categories,id',
            'name' => 'required|max:255',
            'brand' => 'required|max:255',
            'qty' => 'required|integer',
            'max_requirement' => 'required|integer',
            'satuan' => 'required',
            'price' => 'required|integer',
            'total_price' => 'required|integer',
            'benefit' => 'required',
            'description' => 'required',
        ];
    }
}
