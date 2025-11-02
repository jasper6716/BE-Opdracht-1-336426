<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MagazijnModel extends Model

{
     public function SP_GetAllergenenInfoProductById($id)
    {
        return DB::select(
            'CALL SP_GetAllergenenInfoProductById(:id)',
            ['id' => $id]
        );
    }
    public function sp_GetAllProducts()
    {
        return DB::select('CALL sp_GetAllProducts');
    }
    public function SP_GetLeverancierInfo($id)
    {
        return DB::select(
            'CALL SP_GetLeverancierInfo(:id)',
            ['id' => $id]
        );
    }
}


