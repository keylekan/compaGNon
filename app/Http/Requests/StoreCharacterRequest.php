<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCharacterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:80'],
            'gender' => ['required', 'in:H,F'],

            'alignment' => [
                'required',
                'in:LB,LN,LM,NB,NN,NM,CB,CN,CM',
            ],

            'race_id' => ['required', 'integer', 'exists:playable_races,id'],
            'god_id' => ['required', 'integer', 'exists:gods,id'],
            'playable_class_id' => ['required', 'integer', 'exists:playable_classes,id'],
        ];
    }
}
