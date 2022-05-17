<?php

namespace App\Http\Requests\Room;

use Illuminate\Foundation\Http\FormRequest;

class RoonRequest extends FormRequest
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
            'name'        => 'required',
            'price'       => 'required',
            'file_upload' => 'required',
            'idKindRoom'  => 'required',
            'image_list'  => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required'        => 'Tên phòng không thể để trống',
            'price.required'       => 'Gía không thể để trống',
            'file_upload.required' => 'Hình ảnh đại diện không thể để trống',
            'idKindRoom.required'  => 'Loại phòng không được bỏ trống',
            'image_list.required'  => 'Hình ảnh chi tiết không thể để trống'
        ];
    }
}
