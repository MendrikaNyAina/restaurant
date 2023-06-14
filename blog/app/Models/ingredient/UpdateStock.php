<?php

namespace App\Models\ingredient;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UpdateStock extends Model
{
    use HasFactory;
    protected $table='update_stock';
    public $timestamps=false;
    protected $fillable = [
        'ingredient_id',
        'date_update',
        'quantity',
        'unit_price'
    ];

    public function getByWeek($id, $week){
        $annee=substr($week, 0,4);
        $numweek=substr($week,6);
        return UpdateStock::select('*')
        ->where("ingredient_id",'=',intval($id))
        ->whereBetween(DB::raw("WEEK(CONCAT($annee,'-',date_update),'1')"),[$numweek, $numweek])
        ->get();
    }
}

