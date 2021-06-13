<?php

namespace App\Http\Requests;

use App\Models\Coupon;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCouponRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('coupon_create');
    }

    public function rules()
    {
        return [
            'title'    => [
                'string',
                'nullable',
            ],
            'code'     => [
                'string',
                'required',
                'unique:coupons',
            ],
            'discount' => [
                'numeric',
            ],
            'type'     => [
                'required',
            ],
        ];
    }
}
