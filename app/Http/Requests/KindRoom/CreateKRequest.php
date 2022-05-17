<?php

namespace App\Http\Requests\KindRoom;

use Illuminate\Foundation\Http\FormRequest;

class CreateKRequest extends FormRequest
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
            'name' => 'required',
            'quantity' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên loại phòng không thể để trống',
            'quantity.required' => 'Số lượng phòng không thể để trống',
        ];
    }
}
