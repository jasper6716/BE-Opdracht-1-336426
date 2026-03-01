<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AllergeenModel extends Model
{
   
    public function SP_GetAllAllergenen()
    {
        // var_dump(DB::select('CALL SP_GetAllAllergenen'));
        return DB::select('CALL SP_GetAllAllergenen');
    }

    public function SP_CreateAllergeen($naam, $omschrijving)
    {
        $row = DB::selectOne(
            'CALL SP_CreateAllergeen(:naam, :omschrijving)',
            [
                'naam' => $naam,
                'omschrijving' => $omschrijving
            ]
        );
        return $row->new_id;
    }

    public function SP_DeleteAllergeen($id)
    {
    
        $result = DB::selectOne('CALL SP_DeleteAllergeen(:id)', [
            'id' => $id
        ]);

        return $result->affected ?? null;
    }

    public function SP_GetAllergeenById($id)
    {
        return DB::selectOne(
            'CALL SP_GetAllergeenById(:id)',
            ['id' => $id]
        );
    }

    public function SP_UpdateAllergeen($id, $naam, $omschrijving)
    {
        $row = DB::selectOne(
            'CALL SP_UpdateAllergeen(:id, :naam, :omschrijving)',
            [
                'id' => $id,
                'naam' => $naam,
                'omschrijving' => $omschrijving
            ]
        );

        return $row->affected ?? 0;
    }

    public function SP_SorteerAllergenen($naam)
    {
        $allergenen = DB::select(
            'CALL SP_SorteerAllergenen(:naam)',
            ['naam' => $naam]
        );
        $namen = DB::select('CALL SP_GetAllAllergenen');
        return ['allergenen' => $allergenen, 
        'namen' => $namen];
    }
}