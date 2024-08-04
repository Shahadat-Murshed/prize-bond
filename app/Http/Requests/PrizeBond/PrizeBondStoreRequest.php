<?php

namespace App\Http\Requests\PrizeBond;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PrizeBondStoreRequest extends FormRequest
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
            'amount' => ['required', 'numeric'],
            'prefix' => ['required', 'string'],
            'serial' => ['required', 'numeric', Rule::unique('prize_bonds')->where(function ($query) {
                return $query->where('prefix', $this->input('prefix'));
            }),],

        ];
    }

    public function messages(): array
    {
        return [
            'serial.unique' => 'This prize-bond already exists',
        ];
    }
}
