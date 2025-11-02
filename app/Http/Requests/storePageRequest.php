<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
   // app/Http/Requests/StorePageRequest.php

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
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
        ];
    }
    public function messages()
    {
        return[
            'nom.required' =>'Le champs est requis',
        ];

    }
}

