<?php

namespace App\Http\Controllers;

use App\Models\Entretien;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RegistreController extends Controller
{
    /**
     * Affiche le formulaire du registre d'arrivée.
     */
    public function create(): View
    {
        return view('recrutement.registre');
    }

    /**
     * Valide et enregistre l'arrivée d'un candidat.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nom'     => ['required', 'string', 'max:100'],
            'prenoms' => ['required', 'string', 'max:150'],
            'poste'   => ['required', 'string', 'max:150'],
        ], [
            'required' => 'Ce champ est obligatoire.',
            'max'      => 'Ce champ est trop long.',
        ]);

        Entretien::create($data);

        return redirect()->route('recrutement.create')
            ->with('success', 'Merci, votre arrivée a bien été notée. Un recruteur va vous accueillir.');
    }
}



