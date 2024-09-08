<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateProviderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:providers,email',
            'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'address'=>'required|max:255'
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Tên nhà cung cấp là bắt buộc.',
            'name.string' => 'Tên nhà cung cấp phải là chuỗi ký tự.',
            'name.max' => 'Tên nhà cung cấp không được vượt quá 255 ký tự.',
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email này đã tồn tại trong hệ thống.',
            'phone_number.required' => 'Số điện thoại là bắt buộc.',
            'phone_number.regex' => 'Số điện thoại không hợp lệ.',
            'phone_number.min' => 'Số điện thoại phải có ít nhất 10 số.',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Dữ liệu không hợp lệ.',
            'errors' => $validator->errors()
        ], 422));
    }
}


// namespace App\Http\Requests;

// use Illuminate\Foundation\Http\FormRequest;
// use Illuminate\Contracts\Validation\Validator;
// use Illuminate\Http\Exceptions\HttpResponseException;

// class UpdateProviderRequest extends BaseProviderRequest
// {
//     /**
//      * Determine if the user is authorized to make this request.
//      */
//     public function authorize(): bool
//     {
//         return true;
//     }
//     public function rules(): array
//     {
//         return parent::rulesForProvider();
//     }
//     public function messages(): array
//     {
//         return [
//             'name.required' => 'Tên nhà cung cấp là bắt buộc.',
//             'name.string' => 'Tên nhà cung cấp phải là chuỗi ký tự.',
//             'name.max' => 'Tên nhà cung cấp không được vượt quá 255 ký tự.',
//             'email.required' => 'Email là bắt buộc.',
//             'email.email' => 'Email không hợp lệ.',
//             'email.unique' => 'Email này đã tồn tại trong hệ thống.',
//             'phone_number.required' => 'Số điện thoại là bắt buộc.',
//             'phone_number.regex' => 'Số điện thoại không hợp lệ.',
//             'phone_number.min' => 'Số điện thoại phải có ít nhất 10 số.',
//         ];
//     }
//     protected function failedValidation(Validator $validator)
//     {
//         throw new HttpResponseException(response()->json([
//             'message' => 'Dữ liệu không hợp lệ.',
//             'errors' => $validator->errors()
//         ], 422));
//     }
// }
