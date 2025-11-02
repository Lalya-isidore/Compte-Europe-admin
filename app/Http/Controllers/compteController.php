<?php

namespace App\Http\Controllers;

use App\Http\Requests\compteRequest;
use App\Mail\CodeDeblocageTransfertEmail;
use App\Models\Compte;
use App\Models\remboursement;
use App\Models\TransactionHistory;
use App\Models\Transfer;
use App\Notifications\OuvertureDeCompteEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\CompteCreeMail;
use App\Mail\VirementEchecMail;
use App\Mail\RemborsementMail;
use App\Mail\SoldeAugmente;
use App\Mail\SoldeDiminue;
use Illuminate\Support\Facades\Mail;
use App\Models\User; // Ajoutez cette ligne


class compteController extends Controller
{

public function comptecreate(Compte $comptes, compteRequest $request)
{
    $user = Auth::user();
    // Vérification des crédits de l'utilisateur
    if ($user->credit_user < 3000) {
        return redirect()->back()->withErrors(['error' => 'Vous devez avoir au moins 3000 crédits pour créer un compte.']);
    }

    $cardNumber = Compte::generateCardNumber();
    $cvv = Compte::generateCVV();
    $password = Compte::generatePassword();
    $code_virement = Compte::generateCodeVirement();

    $compte = Compte::create([
        'user_id' => Auth::id(),
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'email' => $request->email,
        'password' => $password,
        'devise' => $request->devise,
        'lang' => $request->lang,
        'phone_number' => $request->phone_number,
        'country' => $request->country,
        'address' => $request->address,
        'account_balance' => $request->account_balance,
        'account_balance2' => $request->account_balance,
        'code_virement' => $code_virement,
        'account_type' => $request->account_type,
        'account_status' => $request->account_status,
        'transfer_supported' => $request->transfer_supported,
        'card_number' => $cardNumber,
        'cvv' => $cvv,
        'start_percentage' => $request->start_percentage,
        'end_percentage' => $request->end_percentage,
        'failure_message' => $request->failure_message,
    ]);

    // Déduction des crédits
    $user->credit_user -= 3000;
    $user->save();

    // Redirection avec succès vers la page de création (liste/confirmation)
    return redirect()->route('compte.create')->with('success', 'Compte créé avec succès.');
}
    public function envoyerEmail($id)
    {

        $compte = Compte::find($id);

        if (!$compte) {
            return redirect()->back()->with('error', 'Compte non trouvé.');
        }

        $details = [
            'title' => 'Titre de l\'email',
            'body' => 'Ceci est le corps de l\'email.'
        ];

        Mail::to($compte->email)->send(new CompteCreeMail($details, $compte));
        return redirect()->route("compte.create")->with('success', 'L\'email a bien été envoyé.');
    }

    public function envoyerCodeDeblocage($id)
    {
        $compte = Compte::find($id);

        if (!$compte) {
            return redirect()->back()->with('error', 'Compte non trouvé.');
        }

        $details = [
            'title' => 'Titre de l\'email',
            'body' => 'Ceci est le corps de l\'email.'
        ];

        Mail::to($compte->email)->send(new CodeDeblocageTransfertEmail($details, $compte));

        return redirect()->route("compte.create")->with('success', 'L\'email a bien été envoyé.');
    }


    public function compteview()
    {
        // Charger uniquement les comptes de l'utilisateur connecté
        $comptes = Compte::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('compte.create', [
            'comptes' => $comptes
        ]);
    }
    public function show()
    {
        return view('pages.show');
    }




    public function rembourserCompte($id)
    {
        $compte = Compte::find($id);
        // dd($compte);
        if ($compte) {
            // Rechercher le dernier virement avec le statut "completed"
            $lastTransfer = Transfer::where('user_id', $id)->where('status', 'completed')->latest()->first();
            if ($lastTransfer) {
                $rembourse = "rembourse";
                // Mettre à jour le solde du compte à la valeur initiale avant le virement
                $compte->account_balance = $lastTransfer->solidvire;
                $compte->account_balance2 = $lastTransfer->solidvire;
                $compte->save();

                // Mettre à jour le statut du transfert en "rembourse"
                $lastTransfer->status = $rembourse;
                $lastTransfer->save();

                // Enregistrer dans l'historique
                TransactionHistory::create([
                    'user_id' => $compte->id,
                    'transaction_type' => 'Refund received',
                    'devise' => $compte->devise,
                    'amount' => $lastTransfer->solidvire,
                    'description' => $lastTransfer->name_servieur,
                ]);

                $details = [
                    'title' => 'Echec de Transfert. Remboursement du Solde',
                    'body' => 'Votre virement de ' . $lastTransfer->solidvire . ' ' . $compte->devise . ' a echoué.',
                ];

                // Envoi de l'email de confirmation
                Mail::to($compte->email)->send(new RemborsementMail($details, $compte, $lastTransfer));

                return redirect()->back()->with('success', 'Le remboursement a été effectué avec succès.');
            } else {
                return redirect()->back()->with('error', 'Aucun virement trouvé pour ce compte.');
            }
        } else {
            return redirect()->back()->with('error', 'Impossible de trouver le compte.');
        }
    }



    public function getCompteDetails($id)
    {
        $compte = Compte::find($id);

        if (!$compte) {
            return response()->json(['error' => 'Compte non trouvé.'], 404);
        }

        $hasCompletedTransfer = Transfer::where('user_id', $compte->id)
            ->where('status', 'completed')
            ->exists();

        return response()->json([
            'nom' => $compte->nom,
            'email' => $compte->email,
            'phone' => $compte->phone,
            'country' => $compte->country,
            'password' => $compte->password,
            'codeVirement' => $compte->code_virement,
            'address' => $compte->address,
            'balance' => $compte->account_balance,
            'accountType' => $compte->account_type,
            'accountStatus' => $compte->account_status,
            'transferSupported' => $compte->transfer_supported,
            'numerocompte' => $compte->numerocompte,
            'compteId' => $compte->id,
            'hasCompletedTransfer' => $hasCompletedTransfer,
        ]);
    }

    public function updateStatus(Request $request, $id)
    {

        $compte = Compte::find($id);
        $compte->account_status = $request->input('account_status');
        $compte->save();

        return redirect()->back()->with('success', 'Statut du compte mis à jour avec succès.');
    }
    public function modifierfailuremessage(Request $request, $id)
    {

        $compte = Compte::find($id);
        $compte->failure_message = $request->input('failuremessage');
        $compte->code_virement = Compte::generateCodeVirement(); // Générer un nouveau code de virement
        $compte->save();

        return redirect()->back()->with('success', 'Le message du compte mis à jour avec succès.');
    }


public function updateSolde(Request $request, $id)
{
    $compte = Compte::find($id);
    $montant = $request->input('montant');
    $compte->account_balance += $montant;
    $compte->account_balance2 += $montant;
    $compte->save();

    // Enregistrer dans l'historique
    TransactionHistory::create([
        'user_id' => $compte->id,
        'transaction_type' => 'Funds added',
        'devise' => $compte->devise,
        'amount' => $montant,
        'description' => 'TRANSAFRICASH',
    ]);

    // Envoyer un email au client
    Mail::to($compte->email)->send(new SoldeAugmente($compte, $montant));

    return redirect()->back()->with('success', 'Le solde du compte a été mis à jour avec succès.');
}

public function diminuerSolde(Request $request, $id)
{
    $request->validate([
        'montant' => 'required|numeric|min:0',
    ]);

    $compte = Compte::find($id);
    $montant = $request->input('montant');

    // Vérifiez si le solde ne deviendra pas négatif
    if ($compte->account_balance - $montant < 0) {
        return redirect()->back()->with('error', 'Le solde du compte ne peut pas devenir négatif.');
    }

    $compte->account_balance -= $montant;
    $compte->account_balance2 -= $montant;
    $compte->save();

    // Enregistrer dans l'historique
    TransactionHistory::create([
        'user_id' => $compte->id,
        'transaction_type' => 'Funds deducted',
        'devise' => $compte->devise,
        'amount' => $montant,
        'description' => 'TRANSAFRICASH',
    ]);

    // Envoyer un email au client
    Mail::to($compte->email)->send(new SoldeDiminue($compte, $montant));

    return redirect()->back()->with('success', 'Le solde du compte a été mis à jour avec succès.');
}


    public function modifierPourcentages(Request $request, $id)
    {
        // Valider les données du formulaire
        $request->validate([
            'start_percentage' => 'required|integer|min:1|max:100',
            'end_percentage' => 'required|integer|min:1|max:100',
        ]);

        // Récupérer les données du formulaire
        $startPercentage = $request->input('start_percentage');
        $endPercentage = $request->input('end_percentage');

        $compte = Compte::find($id);
        if (!$compte) {
            return redirect()->back()->with('error', 'Le compte associé n\'a pas été trouvé.');
        }

        $compte->start_percentage = $startPercentage;
        $compte->end_percentage = $endPercentage;
        $compte->code_virement = Compte::generateCodeVirement(); // Générer un nouveau code de virement
        $compte->save();

        // Retourner une réponse réussie ou rediriger l'utilisateur
        return redirect()->back()->with('success', 'Les pourcentages ont été modifiés avec succès.');
    }
    
    
      public function destroy($id)
    {
        try {
            $compte = Compte::findOrFail($id);
            if ($compte->is_default) {
                return redirect()->back()->with('error', 'Le compte principal ne peut pas être supprimé.');
            }
            $compte->delete();
            return redirect()->back()->with('success', 'Le compte a été supprimé avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la suppression du compte.');
        }
    }
    // paiement et mise à jour des crédits
            public function payement5000(Request $request, $id)
{
    try {
        // Vérifiez si la requête contient bien le champ 'transaction-status'
        if (!$request->has('transaction-status')) {
            return redirect()->back()->with('errors', 'Aucun statut de transaction reçu.');
        }

        $transactionStatus = $request->input('transaction-status');

        // Vérifier si l'utilisateur existe
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('errors', 'Utilisateur non trouvé.');
        }

        // Gérer les différents statuts de la transaction
        if ($transactionStatus == "approved") {
            // Ajouter 6000 crédits à l'utilisateur
            $user->credit_user += 6000;
            $user->save();

            return redirect()->back()->with('success', 'Transaction réussie, 6000 crédits ont été ajoutés à votre solde.');
        } else {
            // Pour les statuts 'pending' ou autres, ne rien faire et rediriger sans message
            return redirect()->back();
        }

    } catch (\Exception $e) {
        return redirect()->back()->with('errors', 'Une erreur est survenue, veuillez réessayer.');
    }
}

// Les autres méthodes peuvent suivre la même logique
public function payement10000(Request $request, $id)
{
    try {
        if (!$request->has('transaction-status')) {
            return redirect()->back()->with('errors', 'Aucun statut de transaction reçu.');
        }

        $transactionStatus = $request->input('transaction-status');
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('errors', 'Utilisateur non trouvé.');
        }

        if ($transactionStatus == "approved") {
            $user->credit_user += 15000;
            $user->save();

            return redirect()->back()->with('success', 'Transaction réussie, 15000 crédits ont été ajoutés à votre solde.');
        } else {
            return redirect()->back();
        }

    } catch (\Exception $e) {
        return redirect()->back()->with('errors', 'Une erreur est survenue, veuillez réessayer.');
    }
}

public function payement25000(Request $request, $id)
{
    try {
        if (!$request->has('transaction-status')) {
            return redirect()->back()->with('errors', 'Aucun statut de transaction reçu.');
        }

        $transactionStatus = $request->input('transaction-status');
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('errors', 'Utilisateur non trouvé.');
        }

        if ($transactionStatus == "approved") {
            $user->credit_user += 40000;
            $user->save();

            return redirect()->back()->with('success', 'Transaction réussie, 40000 crédits ont été ajoutés à votre solde.');
        } else {
            return redirect()->back();
        }

    } catch (\Exception $e) {
        return redirect()->back()->with('errors', 'Une erreur est survenue, veuillez réessayer.');
    }
}

public function payement50000(Request $request, $id)
{
    try {
        if (!$request->has('transaction-status')) {
            return redirect()->back()->with('errors', 'Aucun statut de transaction reçu.');
        }

        $transactionStatus = $request->input('transaction-status');
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('errors', 'Utilisateur non trouvé.');
        }

        if ($transactionStatus == "approved") {
            $user->credit_user += 100000;
            $user->save();

            return redirect()->back()->with('success', 'Transaction réussie, 100000 crédits ont été ajoutés à votre solde.');
        } else {
            return redirect()->back();
        }

    } catch (\Exception $e) {
        return redirect()->back()->with('errors', 'Une erreur est survenue, veuillez réessayer.');
    }
}
}
