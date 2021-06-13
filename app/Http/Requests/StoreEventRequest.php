<?php

namespace App\Http\Requests;

use App\Models\Event;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEventRequest extends FormRequest
{
    public function authorize()
    {
        return true;//Gate::allows('event_create');
    }

    public function rules()
    {
        return [
            'name'         => [
                'string',
                'nullable',
            ],
            'address'      => [
                'string',
                'nullable',
            ],
            'lat'          => [
                'numeric',
            ],
            'lng'          => [
                'numeric',
            ],
            'start_at'     => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'end_at'       => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'age_max'      => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'age_min'      => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'ticket_count' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'ticket_start' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'ticket_end'   => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'users.*'      => [
                'integer',
            ],
            'users'        => [
                'array',
            ],
        ];
    }
}
