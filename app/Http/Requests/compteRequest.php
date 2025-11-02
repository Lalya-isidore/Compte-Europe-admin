<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class compteRequest extends FormRequest
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
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:comptes',
            'phone_number' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'devise' => 'required|string|max:255',
            'lang' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'account_balance' => 'required|numeric',
            'account_type' => 'required|string|max:255',
            'account_status' => 'required|string|max:255',
            'transfer_supported' => 'required|string|max:255',
            'iban' => 'nullable|string|max:34',
            'parameters' => 'nullable|json',
            'start_percentage' => 'required|integer|min:0|max:100',
            'end_percentage' => 'required|integer|max:100',
            'failure_message' => 'required|string',
        ];
    }
    public function messages()
    {
        return[
            'nom.required' =>'Le champs nom est requis',
            'prenom.required' =>'Le champs prenom est requis',
            'email.required' =>'Le champs email est requis',
            'email.unique' =>"Cette adresse e-mail a déjà été utilisée pour créer un Flash compte. Merci d'en choisir une autre.",
            'country.required' =>'Le champs  est requis',
            'devise.required' =>'Le champs devise est requis',
            'lang.required' =>'Le champs langue est requis',
            'address.required' =>'Le champs address est requis',
            'account_balance.required' =>'Le champs est requis',
            'account_type.required' =>'Le champs est requis',
            'account_status.required' =>'Le champs est requis',
            'transfer_supported.required' =>'Le champs est requis',

        ];

    }
}
