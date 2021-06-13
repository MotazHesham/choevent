<?php

namespace App\Http\Requests;

use App\Models\BoothDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBoothDetailRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('booth_detail_edit');
    }

    public function rules()
    {
        return [
            'order'  => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'length' => [
                'numeric',
            ],
            'width'  => [
                'numeric',
            ],
        ];
    }
}
