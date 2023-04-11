<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTeamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required', 'max:255', Rule::unique('teams')->ignore($this->route()->team->id),
            ],
            'logoURI' => [
                'required', 'max:5000'
            ]
        ];
    }

    public function attributes()
    {
        return [
            'logoURI' => 'logo URI'
        ];
    }
}
