<?php

namespace App\Http\Controllers;

use App\Models\LeveringModel;
use Illuminate\Http\Request;

class LeveringController extends Controller
{

    public function __construct()
    {
        $this->leveringModel = new LeveringModel();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $leveringen = $this->leveringModel->SP_GetAllLeveringen($request->input('startDatum'), $request->input('eindDatum'));
        
        return view('Levering.index', [
            'title' => 'Overzicht leveringen',
            'leveringen' => $leveringen
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $product)
    {
        $leveringen = $this->leveringModel->SP_ShowLevering($request->input('startDatum'), $request->input('eindDatum'), $product);

        if (!$leveringen)
        {
            return redirect()->route('Levering.index')
                             ->with('error', 'Product is niet gevonden');  
        }

        return view('Levering.show', [
            'title' => 'Specificatie geleverde product',
            'leveringen' => $leveringen
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LeverancierController $leverancierController)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LeverancierController $leverancierController)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LeverancierController $leverancierController)
    {
        //
    }
}