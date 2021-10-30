<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateReservationRequest extends FormRequest
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
            'name' => [
                'required',
                'min:3'
            ],
            'email' => [
                'required',
                'email'
            ],
            'destination_id' => [
                'required',
                'exists:destinations,id'
            ],
            'arrival' => [
                'required',
                'date_format:Y-m-d H:i',
                'after:now'
            ],
            'departure' => [
                'required',
                'date_format:Y-m-d H:i',
                'after:arrival'
            ]
        ];
    }
}
