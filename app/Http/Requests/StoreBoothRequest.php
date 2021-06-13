<?php

namespace App\Http\Requests;

use App\Models\Booth;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBoothRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('booth_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
        ];
    }
}
