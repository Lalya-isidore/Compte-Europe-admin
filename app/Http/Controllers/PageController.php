<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePageRequest;
use App\Models\Compte;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function create()
    {
        return view('pages.create');
    }

    public function store(Page $page, StorePageRequest $request)
    {
        dd($request);

        $page = Page::create([
            'user_id' => Auth::id(),
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'devise' => $request->devise,
            'lang' => $request->lang,
            'phone_number' => $request->phone_number,
            'country' => $request->country,
            'address' => $request->address,
            'account_balance' => $request->account_balance,
            'account_type' => $request->account_type,
            'account_status' => $request->account_status,
            'transfer_supported' => $request->transfer_supported,

        ]);


        return redirect()->back()->with('success', 'Page ajoutée avec succès');
    }

    public function show(Page $page)
    {
        // if (auth()->id() !== $page->user_id) {
        //     abort(403);
        // }

        return view('pages.show', compact('page'));
    }
    public function show2()
    {
        $comptes = Compte::all();
        return view('pages.show', [
            'comptes' => $comptes
        ]);
    }

    // Méthode pour le remboursement du compte
    public function rembourser(Request $request)
    {
        // Récupère l'ID du compte à rembourser depuis la requête
        $compteId = $request->input('compte_id');

        // Exécute les opérations nécessaires pour rembourser le compte
        // Par exemple, réinitialise le solde du compte
        $compte = Compte::findOrFail($compteId);
        $compte->solde = $compte->solde_initial;
        $compte->save();

        // Retourne une réponse indiquant que le remboursement a été effectué avec succès
        return response()->json(['success' => true]);
    }
    
}
