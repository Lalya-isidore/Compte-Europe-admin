<?php

namespace App\Http\Controllers;

use App\Http\Requests\createUserRequest;
use App\Http\Requests\loginUserRequest;
use App\Http\Requests\UserRequest;
use App\Models\Compte;
use App\Models\User;
use App\Notifications\WelcomeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UserController extends Controller
{
    public function inscriptionRoute(){
        return view('users.inscription');
    }
    public function inscription(User $user, createUserRequest $request)
    {
        DB::transaction(function () use ($request, $user) {
            $user->nom = $request->nom;
            $user->prenom = $request->prenom;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->save();

            $cardNumber = Compte::generateCardNumber();
            $cvv = Compte::generateCVV();
            $comptePassword = Compte::generatePassword();
            $codeVirement = Compte::generateCodeVirement();

            $compteData = [
                'user_id' => $user->id,
                'nom' => $user->nom,
                'prenom' => $user->prenom,
                'email' => $user->email,
                'phone_number' => $request->input('phone_number', 'Non renseigné'),
                'country' => $request->input('country', 'Non renseigné'),
                'address' => $request->input('address', 'Non renseignée'),
                'devise' => 'EUR',
                'lang' => 'fr',
                'account_balance' => 10000,
                'account_balance2' => 10000,
                'account_type' => 'Compte Flash',
                'code_virement' => $codeVirement,
                'account_status' => 'Activé',
                'password' => $comptePassword,
                'transfer_supported' => 'Oui',
                'token' => null,
                'iban' => null,
                'parameters' => null,
                'card_number' => $cardNumber,
                'cvv' => $cvv,
                'start_percentage' => '0',
                'end_percentage' => '100',
                'failure_message' => 'Aucun message',
                'is_default' => true,
            ];

            if (Schema::hasColumn('comptes', 'numerocompte')) {
                $compteData['numerocompte'] = Compte::generateAccountNumber();
            }

            Compte::create($compteData);
        });

        $user->notify(new WelcomeEmail());

        return redirect()->route('connexion')->with('success', 'Votre compte a bien été creer, Connecter !');
    }
    public function connexionRoute  (){
        return view('users.connexion');
    }
    public function connexion (loginUserRequest $request){
        $credentials = $request->validate([
            'email'=>['required', 'email'],
            'password' => [ 'required']
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); 

            return redirect()->intended('dashboard');
            return ;
        } else {

           return redirect()->back()->with('error','Echec d\'authantification' );
        }
        return redirect()->back()->with('error','Echec d\'authantification' );
    }
    public function logout(){
        Auth::logout();
        return redirect('connexion');

    }
}
