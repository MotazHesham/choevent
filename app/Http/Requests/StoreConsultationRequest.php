<?php

namespace App\Http\Requests;

use App\Models\Consultation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreConsultationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('consultation_create');
    }

    public function rules()
    {
        return [
            'mobile' => [
                'string',
                'nullable',
            ],
            'name'   => [
                'string',
                'nullable',
            ],
        ];
    }
}
