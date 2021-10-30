<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReservationRequest extends FormRequest
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
                'min:3'
            ],
            'email' => [
                'email'
            ],
            'destination_id' => [
                'exists:destinations,id'
            ],
            'arrival' => [
                'date_format:Y-m-d H:i',
                'after:now'
            ],
            'departure' => [
                'date_format:Y-m-d H:i',
                'after:now'
            ],
        ];
    }
}
