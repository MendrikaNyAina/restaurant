<?php

namespace App\Models\ingredient;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MovementIngredient extends Model
{
    use HasFactory;
    protected $table = 'movement_ingredient';
    public $timestamps = false;
    protected $fillable = [
        'quantity',
        'ingredient_id',
        'type_movement',
        'order_id',
        'unit_price',
        'date_movement',
    ];
    public function entry($id, $week)
    {
        if (!strlen($week) == 8) {
            $week = date('o-\WW');
        }
        echo $week;
        $annee = substr($week, 0, 4);
        $numweek = substr($week, 6);
        MovementIngredient::select('*')
            ->where('ingredient_id', '=', intval($id))
            ->where('type_movement', '=', 'e')
            ->whereBetween(DB::raw("WEEK(CONCAT($annee,'-',date_movement),'1')"), [$numweek, $numweek])
            ->get();
    }
    public function output($id, $week)
    {
        $annee = substr($week, 0, 4);
        $numweek = substr($week, 6);
        return MovementIngredient::select('*')
            ->from("v_stock_output")
            ->where("ingredient_id", '=', intval($id))
            ->whereBetween(DB::raw("WEEK(CONCAT($annee,'-',date_movement),'1')"), [$numweek, $numweek])
            ->get();
    }
}
