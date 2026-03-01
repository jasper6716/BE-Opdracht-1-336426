<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LeverancierModel extends Model
{
    public function SP_GetAllLeveranciers()
    {
        return DB::select('CALL SP_GetAllLeveranciers');
    }

    public function SP_GetLeveringInfo($id)
    {
        return DB::select(
            'CALL SP_GetLeveringInfo(:id)',
            ['id' => $id]
        );
    }

    public function SP_CreateLevering($aantal, $datumEerstVolgendeLevering)
    {
        $row = DB::selectOne(
            'CALL SP_CreateLevering(:aantal, :datumEerstVolgendeLevering)',
            [
                'naam' => $naam,
                'omschrijving' => $omschrijving
            ]
        );
        return $row->new_id;
    }
//    public function SP_DeleteLevering($id)
    public function SP_LeverancierDetails($id)
    {
        return DB::selectOne(
            'CALL SP_LeverancierDetails(:id)',
            ['id' => $id]
        ); 
    }

    public function SP_UpdateLeverancier($id, $naam, $contactpersoon, $leveranciernummer, $mobiel, $straat, $huisnummer, $postcode, $stad)
    {
        $row = DB::selectOne(
            'CALL SP_UpdateLeverancier(:id, :Naam, :ContactPersoon, :LeverancierNummer, :Mobiel, :Straat, :Huisnummer, :Postcode, :Stad)',
            [
                'id' => $id,
                'Naam' => $naam,
                'ContactPersoon' => $contactpersoon,
                'LeverancierNummer' => $leveranciernummer,
                'Mobiel' => $mobiel,
                'Straat' => $straat,
                'Huisnummer' => $huisnummer,
                'Postcode' => $postcode,
                'Stad' => $stad,
            ]
        );
        return $row->affected ?? 0;
    }

    public function SP_GetLeverancierGegevens($id)
    {
        return DB::select(
            'CALL SP_GetLeverancierGegevens(:id)',
            ['id' => $id]
        );
    }
}