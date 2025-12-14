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

        $newId = $this->allergeenModel->SP_CreateAllergeen(
            $data['naam'],
            $data['omschrijving']
        );

        return redirect()->route('Allergenen.index')
                         ->with('success', 'Allergeen is succesvol toegevoegd met id' . $newId);
    }

    /**
     * Display the specified resource.
     */
    public function show(LeverancierModel $leverancierModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LeverancierModel $leverancierModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LeverancierModel $leverancierModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LeverancierModel $leverancierModel)
    {
        //
    }
}