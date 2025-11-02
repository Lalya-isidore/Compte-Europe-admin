<?php
// app/Http/Controllers/SousCompteController.php
// app/Http/Controllers/SousCompteController.php

namespace App\Http\Controllers;

use App\Http\Requests\SousCompteRequest;
use App\Models\Compte;
use App\Models\TransactionHistory;
use App\Models\Transfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SousCompteController extends Controller
{
    public function sousComptelogin()
    {
        return view('compte.login');
    }

    public function sousCompteAuth(SousCompteRequest $request)
    {
        $compte = Compte::where('email', $request->email)->first();

        if ($compte && ($request->password === $compte->password)) {
            $token = Str::random(60);
            $compte->update(['token' => $token]);

            session(['token' => $token]);

            return redirect()->route('pages.show', $token);
        }

        return back()->withErrors(['email' => 'Email or password is incorrect.']);
    }
    

    public function show($token)
    {
        $compte = Compte::where('token', $token)->first();

        if (!$compte || session('token') != $token) {
            return redirect()->route('sousCompte.login');
        }

        return view('pages.show', compact('compte'));
    }

    private function getConnectedCompte()
    {
        $token = session('token');
        // dd($token);
        return Compte::where('token', $token)->first();
    }

    public function carte()
    {
        $compte = $this->getConnectedCompte();

        if (!$compte) {
            return redirect()->route('sousCompte.login');
        }

        return view('pages.carte', compact('compte'));
    }
    public function showroute()
    {
        $compte = $this->getConnectedCompte();

        if (!$compte) {
            return redirect()->route('sousCompte.login');
        }

        $histories = TransactionHistory::where('user_id', $compte->id)->orderBy('created_at', 'desc')->get();

        return view('pages.show', compact('compte', 'histories'));
    }

    public function info()
    {
        $compte = $this->getConnectedCompte();

        if (!$compte) {
            return redirect()->route('sousCompte.login');
        }

        return view('pages.info', compact('compte'));
    }

    public function virement()  
    {
        $compte = $this->getConnectedCompte();

        if (!$compte) {
            return redirect()->route('sousCompte.login');
        }

        return view('pages.virement', compact('compte'));
    }


    // Afficher le formulaire de mise à jour
    public function edit($id)
    {
        $compte = Compte::where('id', $id)->firstOrFail();
        return view('pages.edit', compact('compte'));
    }

    // Traiter la mise à jour
    public function update(Request $request, $id)
    {
      

        $compte = Compte::where('id', $id)->firstOrFail();
        $compte->update($request->all());

        return redirect()->route('pages.edit', $compte->id)->with('success', 'Informations mises à jour avec succès.');
    }



    // Déconnecter l'utilisateur
    public function logoutSous(Request $request)
    {
        $sousCompteId = session('sous_compte_id');
        $sousCompteToken  = session('sous_compte_token');
        // dd($sousCompteToken );
        if ($sousCompteId) {
            $compte = Compte::find($sousCompteId);
    
            if ($compte) {
                // Effacer la session de l'utilisateur du sous-compte
                $request->session()->forget('sous_compte_id');
                $request->session()->forget('sous_compte_token');
                $request->session()->regenerate();
    
                return redirect()->route('sousCompte.login')->with('success', 'Déconnexion réussie.');
            }
        }
    
        return redirect()->route('sousCompte.login')->withErrors(['error' => 'Déconnexion échouée.']);
    }
    
    
    public function checkTransferExistence($id)
    {
        $isTransferExist = \App\Models\Transfer::where('user_id', $id)
            ->where('status', 'completed')
            ->exists();
        return response()->json(['exists' => $isTransferExist]);
    }


    // public function showTransactionHistory()
    // {
    //     $compte = $this->getConnectedCompte();

    //     if (!$compte) {
    //         return redirect()->back()->with('error', 'Compte non trouvé.');
    //     }

    //     $histories = TransactionHistory::where('user_id', $compte->id)->orderBy('created_at', 'desc')->get();

    //     return view('pages.show', compact('compte', 'histories'));
    // }
}
