<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Mail\CompteCreeMail;
use App\Mail\VirementEchecMail;
use App\Mail\VirementReussiMail;
use Illuminate\Http\Request;
use App\Models\Compte;
use App\Models\TransactionHistory;
use App\Models\Transfer;
use App\Models\TransferFailure;
use App\Models\UnlockCode;
use App\Models\virement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class VirementController extends Controller
{

    private function getConnectedCompte()
    {
        $token = session('token');
        return Compte::where('token', $token)->first();
    }

    // TransferController.php



    // Méthode pour créer un virement
    public function store(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([

            'numerocompte' => 'required',
            'name_servieur' => 'required',
            'beneficiary_name' => 'required',
            'reason' => 'required',

        ]);

        // Dans votre méthode de contrôleur pour effectuer le virement
        $compte = $this->getConnectedCompte();

       if ($compte->account_balance > 1) {
             // Création d'un virement
        $transfer = Transfer::create([
            'user_id' => $compte->id,
            'solidvire' => $compte->account_balance,
            'devise' => $compte->devise,
            'token' => $compte->token,
            'numerocompte' => $request->numerocompte,
            'name_servieur' => $request->name_servieur,
            'beneficiary_name' => $request->beneficiary_name,
            'reason' => $request->reason,
            'status' => 'completed' // Statut initial du virement
        ]);

        TransactionHistory::create([
            'user_id' => $compte->id,
            'transaction_type' => 'Transfer sent',
            'amount' => $compte->account_balance,
            'devise' => $compte->devise,
            'description' => 'Transfer to ' . $request->beneficiary_name
        ]);
       }


        // Retourner une réponse JSON
        return response()->json(['success' => true, 'transfer' => $transfer]);
    }

    public function confirmVirement($id)
    {
        $transfer = Transfer::findOrFail($id);
        return view('pages.confirmVirement', compact('transfer'));
    }

    public function showConfirmation(Request $request)
    {
        $transfer = $request->all();
        return view('pages.confirmVirement', compact('transfer'));
    }
    public function virementDetailRoute2(Request $request)
    {
        $request->validate([
            'codeVirement' => 'required',
        ]);
        $compte = $this->getConnectedCompte();
        $transfer = $request->all();
        if ($request->codeVirement === $compte->code_virement) {
            return view('pages.virementDetail', compact('compte', 'transfer'));
        } else {
            // Passez les erreurs et les variables transfer et compte comme variables à la vue
            return view('pages.confirmVirement', [
                'errors' => ['codeVirement' => 'Le code est incorrect!'],
                'transfer' => $transfer,
                'compte' => $compte
            ]);
        }
    }




    // public function codeVirement(Request $request)
    // {


    //     $transfer = $request->all();
    //     $compte = $this->getConnectedCompte();


    public function virementDetail($id, Request $request)
    {
        $compte = $this->getConnectedCompte();
        $transfer = Transfer::findOrFail($id);
        return view('pages.virementDetail', compact('compte', 'transfer'));
    }

    // public function updateBalanceToZero($id)
    // {
    //     $transfer = Transfer::findOrFail($id);

    //     $compte = Compte::find($id);
    //     if ($compte) {
    //         $compte->account_balance = 0;
    //         $compte->save();
    //     }

    //     // Détails de l'email
    //     $details = [
    //         'title' => 'Confirmation de Virement Réussi',
    //         'body' => 'Votre virement de ' . $transfer->montant . ' ' . $transfer->devise . ' a été effectué avec succès.'
    //     ];

    //     // Envoi de l'email de confirmation
    //     Mail::to($compte->email)->send(new VirementReussiMail($details, $compte, $transfer));


    //     return response()->json(['success' => true]);
    // }

    public function updateBalanceToZero($id)
    {
        $lastTransfer = Transfer::where('user_id', $id)->where('status', 'completed')->latest()->first();
        // dd($id);
        $compte = Compte::find($id);
        if ($compte) {

            // Mettre à jour le solde du compte à zéro
            $compte->account_balance = 0;
            $compte->save();
            // Détails de l'email
            $details = [
                'title' => 'Confirmation de Virement Réussi',
                'body' => 'Votre virement de ' .  $compte->account_balance  . ' ' .  $compte->devise . ' a été effectué avec succès.'
            ];

            // Envoi de l'email de confirmation
            Mail::to($compte->email)->send(new VirementReussiMail($details, $compte, $lastTransfer));
        }

        return response()->json(['success' => true]);
    }
    
    public function sendFailureEmail(Request $request, $compteId)
    {
        $compte = Compte::findOrFail($compteId);
        $lastTransfer = Transfer::where('compte_id', $compteId)->latest()->first();

        if ($compte && $lastTransfer) {
            $details = [
                'title' => 'Echec de Virement',
                'body' => 'Votre virement de ' . $lastTransfer->solidvire . ' ' . $compte->devise . ' a échoué.',
            ];

            // Envoi de l'email d'échec
            Mail::to($compte->email)->send(new VirementEchecMail($details, $compte, $lastTransfer));

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Compte ou virement non trouvé.']);
    }
}
