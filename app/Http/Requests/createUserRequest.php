<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createUserRequest extends FormRequest
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
            'nom'=>'required',
            'prenom'=>'required',
            'email'=>'required|email|unique:users',
            'phone_number'=>'required',
            'password'=>'required|min:8',
        ];
    }
    public function messages()
    {
        return [
            'nom.reqired'=>'Le champs nom est oblicatoire',
           
            'prenom.reqired'=>'Lechamps prenom est oblicatoire',

            'email.reqired'=>'Le champs email est oblicatoire',
            'email.email'=>'Le champs email doit comporter un email',
            'email.unique'=>' ce email a été déja utiliser',

            'phone_number.required'=>'Le numéro de téléphone est obligatoire pour activer votre compte.',

            'password.reqired'=>'Le champs password est oblicatoire',
        ];
    }
}
