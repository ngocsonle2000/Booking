<?php

namespace App\Http\Requests\Hotel;

use App\Models\Hotel;
use Illuminate\Foundation\Http\FormRequest;

class HotelRequest extends FormRequest
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
            'name'          => 'required|unique:hotels',
            'RoomQuanity'   => 'required',
            'city'          => 'required',
            'adrress'       => 'required',
            'file_upload'   => 'required',
            'accommodation' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required'          => 'Tên khách sạn không thể để trống',
            'RoomQuanity.required'   => 'Số lượng phòng không thể để trống',
            'adrress.required'       => 'Địa chỉ không được để trống',
            'city.required'          => 'Thành phố không được để trống',
            'name.unique'            => 'Tên khách sạn đã tồn tại',
            'file_upload.required'   => 'Hình không được để trống',
            'accommodation.required' => 'Loại hình chỗ ở không được để trống',
        ];
    }
}
