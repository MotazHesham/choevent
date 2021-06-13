<?php

namespace App\Http\Requests;

use App\Models\Configration;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreConfigrationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('configration_create');
    }

    public function rules()
    {
        return [
            'item'  => [
                'string',
                'nullable',
            ],
            'value' => [
                'string',
                'nullable',
            ],
        ];
    }
}
