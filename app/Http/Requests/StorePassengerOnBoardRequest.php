<?php

namespace App\Http\Requests;

use App\Models\Vessel;
use App\Rules\Mmsi;
use Illuminate\Foundation\Http\FormRequest;

class StorePassengerOnBoardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'authentication' => ['required', 'string'],
            'mmsi' => ['required', 'string', new Mmsi , 'exists:vessels'], //Must already exist in the database
            'passengerNumber' => ['required', 'integer', 'numeric', 'gt:0'], //Must be a number and greater than 0
            'reportTime' => ['required', 'date', 'after:yesterday', 'before:tomorrow'], //Can only submit for today, must be a date
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'authentication.required' => 'The token is required',

            'mmsi.required' => 'The vessel identifier is required',
            'mmsi.exists' => 'The vessel does not exist on record',

            'passengerNumber.required' => 'The number of passengers is required',

            'reportTime.before' => 'Submitted date cannot be in the future, it has to be today - ' . date('d/m/Y'),
            'reportTime.after' => 'Submitted date cannot be in the past, it has to be today - ' . date('d/m/Y')
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {

    }

    /**
     * Handle a passed validation attempt.
     */
    protected function passedValidation(): void
    {
        $vessel = Vessel::select('id', 'operator_id')->where('mmsi', $this->mmsi)->first();
        //Re-format our validated form data to suitable database format 
        $this->replace(
            [
                'user_id' => 1, //ToDo: Needs to change based on authentication (to be confirmed by Mike)
                'vessel_id' => $vessel->id,
                'operator_id' => $vessel->operator_id,
                'no_of_passengers' => $this->passengerNumber
            ]
        );
    }
}
