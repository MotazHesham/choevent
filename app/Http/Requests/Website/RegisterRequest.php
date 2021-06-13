<?php

namespace App\Http\Requests\Website;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Traits\ResponseFormatTrait;

class RegisterRequest extends FormRequest
{
    use ResponseFormatTrait;
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        return [
            'name'             => [
               'required',
            ],
            'email'            => [
                'required',
                'unique:users,email',
            ],
            'mobile'           => [
                'required',
                'starts_with:05',
                'digits:10',
                'unique:users,mobile',
                
            ],
            'password'         => [
                'required',
                'confirmed'
            ],
           
            'age'              => [
                'nullable',
                'integer',
            ],
            'company_register' => [
                'string',
                'nullable',
            ],
            'nationality'      => [
                'string',
                'nullable',
            ],
            'employee_name'    => [
                'string',
                'nullable',
            ],
            'identity_number'  => [
               'required',
               'unique:users,identity_number',
            ],
           'avatar'=>['image']
        ];
    }
    public function messages(){
        return [
            'name.required'=>'الاسم مطلوب أساسى',
            'email.required'=>'البريد الإلكترونى مطلوب أساسى',
            'email.unique'=>'البريد الإلكترونى مستخدم من قبل',
            'mobile.required'=>'رقم الجوال مطلوب أساسى',
            'mobile.starts_with'=>'رقم الجوال لابد أن يبدأ ب 05',
            'mobile.digits'=>"رقم الجوال لابد أن يكون عشرة أرقام",
            'mobile.unique'=>'رقم الجوال مستخدم من قبل',
            'identity_number.required'=>'رقم الهوية مطلوب أساسى',
            'identity_number.unique'=>'رقم الهوية مستخدم من قبل',
            'password.confirmed'=>'لا بد من تأكيد كلمة المرور'
        ];
    }
    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException($this->sendError($validator->errors()->first(),'',$code=200,''));
    }
}
