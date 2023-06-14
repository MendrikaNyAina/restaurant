<?php

namespace App\Models\plat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DishIngredient extends Model
{
    use HasFactory;
    protected $table='dish_ingredient';
    public $timestamps=false;
    protected $fillable = [
        'ingredient_id',
        'quantity',
        'dish_id'
    ];
    public function __construct($id=null, $quantity=null){
        $this->ingredient_id=$id;
        $this->quantity=$quantity;
    }
    public function ingredient(){
        return $this->belongsTo(Ingredient::class);
    }
}
