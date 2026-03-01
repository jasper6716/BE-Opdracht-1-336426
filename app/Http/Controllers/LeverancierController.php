<?php

namespace App\Http\Controllers;

use App\Models\LeverancierModel;
use Illuminate\Http\Request;

class LeverancierController extends Controller
{
    private $leverancierModel;

    public function __construct()
    {
        $this->leverancierModel = new LeverancierModel();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leverancier = $this->leverancierModel->SP_GetAllLeveranciers();
        
        return view('Leverancier.index', [
            'title' => 'Overzicht leveranciers',
            'leverancier' => $leverancier
        ]);
    }

    public function LeveringInfo($id)
    {
        $leverancier = $this->leverancierModel->SP_GetLeveringInfo($id);

        if (!$leverancier)
        {
            return redirect()->route('Leverancier.index')
                             ->with('error', 'Leverancier is niet gevonden');
        }

        return view('Leverancier.LeveringInfo', [
            'title' => 'Geleverde producten',
            'leverancier' => $leverancier
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Leverancier.create', [
            'title' => 'Levering product'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'naam' => 'required|string|max:50',
            'omschrijving' => 'required|string|max:255'
        ]);

        $newId = $this->leverancierModel->SP_CreateLevering(
            $data['naam'],
            $data['omschrijving']
        );

        return redirect()->route('Leverancier.index')
                         ->with('success', 'Levering is succesvol toegevoegd' . $newId);
    }

    public function LeverancierInfo($id)
    {
        $leverancier = $this->leverancierModel->SP_LeverancierDetails($id);

        if (!$leverancier)
        {
            return redirect()->route('Leverancier.index')
                             ->with('error', 'Leverancier is niet gevonden');  
        }

        return view('Leverancier.LeverancierInfo', [
            'title' => 'Leverancier details',
            'leverancier' => $leverancier
        ]);
    }

    public function LeverancierGegevens($id)
    {
        $leverancier = $this->leverancierModel->SP_GetLeverancierGegevens($id);

        if (!$leverancier)
        {
            return redirect()->route('Leverancier.index')
                             ->with('error', 'Leverancier is niet gevonden');  
        }

        return view('Leverancier.LeverancierGegevens', [
            'title' => 'Overzicht leverancier gegevens',
            'leverancier' => $leverancier
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $leverancier = $this->leverancierModel->SP_LeverancierDetails($id);
        abort_if(!$leverancier, 404);
        return view('Leverancier.edit', [
            'title' => 'Leverancier wijzigen',
            'leverancier' => $leverancier,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'Naam' => ['required', 'string', 'max:30'],
            'ContactPersoon' => ['required', 'string', 'max:50'],
            'LeverancierNummer' => ['required', 'string', 'max:11'],
            'Mobiel' => ['required', 'string', 'max:11'],
            'Straat' => ['required', 'string', 'max:50'],
            'Huisnummer' => ['required', 'integer', 'between:0,65535'],
            'Postcode' => ['required', 'string', 'max:6'],
            'Stad' => ['required', 'string', 'max:30'],
        ]);

        $affected = $this->leverancierModel->SP_UpdateLeverancier(
            $id,
            $validated['Naam'],
            $validated['ContactPersoon'],
            $validated['LeverancierNummer'],
            $validated['Mobiel'],
            $validated['Straat'],
            $validated['Huisnummer'],
            $validated['Postcode'],
            $validated['Stad'],
        );

        if ($affected === 0)
        {
            return back()->with('error', 'er is niets gewijzigd of het item bestaat niet.');
        }

        return redirect()
            ->route('Leverancier.index')
            ->with('success', 'Leverancier succesvol gewijzigd');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LeverancierModel $leverancierModel)
    {
        //
    }
}