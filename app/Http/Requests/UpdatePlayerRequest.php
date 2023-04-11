<?php

namespace App\Http\Requests;

use App\Models\Team;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePlayerRequest extends FormRequest
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
            'firstName' => [
                'required', 'max:255'
            ],
            'lastName' => [
                'required', 'max:255'
            ],
            'playerImageURI' => [
                'required', 'max:5000'
            ],
            'teamId' => [
                'required', 'exists:'.(new Team)->getTable().',id'
            ]
            
        ];
    }

    public function attributes()
    {
        return [
            'firstName' => 'first name',
            'lastName' => 'last name',
            'playerImageURI' => 'player image URI',
            'teamId' => 'team id',
        ];
    }
}
