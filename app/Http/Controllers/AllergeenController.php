<?php

namespace App\Http\Controllers;

use App\Models\AllergeenModel;
use Illuminate\Http\Request;

class AllergeenController extends Controller
{
    private $allergeenModel;

    public function __construct()
    {
        $this->allergeenModel = new AllergeenModel();
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $allergenen = $this->allergeenModel->SP_GetAllAllergenen();
        
        return view('Allergenen.index', [
            'title' => 'Allergeen',
            'allergenen' => $allergenen
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Allergenen.create', [
            'title' => 'Voeg een nieuwe allergeen toe.'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // dd($request->all());

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
    public function show(AllergeenModel $allergeenModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $allergenen = $this->allergeenModel->SP_GetAllergeenById($id);
        abort_if(!$allergenen, 404);
        // dd($allergenen);
        return view('Allergenen.edit', [
            'title' => 'Allergeen wijzigen',
            'allergenen' => $allergenen,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'naam' => ['required', 'string', 'max:50'],
            'omschrijving' => ['required', 'string', 'max:255'],
        ]);

        $affected = $this->allergeenModel->SP_UpdateAllergeen(
            $id,
            $validated['naam'],
            $validated['omschrijving'],
        );

        if ($affected === 0)
        {
            return back()->with('error', 'er is niets gewijzigd of het item bestaat niet.');
        }

        return redirect()
            ->route('Allergenen.index')
            ->with('success', 'Allergeen succesvol gewijzigd');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
 
        $result = $this->allergeenModel->SP_DeleteAllergeen($id);
        //dd($result);
        if ($result > 0)
        {
            return redirect()->route('Allergenen.index')
                             ->with('success', 'Allergeen is succesvol verwijderd');
        }

        return redirect()->route('Allergenen.index')
                         ->with('error', 'Allergeen is niet goed verwijderd.');
    }
}