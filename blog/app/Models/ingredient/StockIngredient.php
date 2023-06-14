<?php

namespace App\Models\ingredient;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockIngredient extends Model
{
    use HasFactory;
    protected $table='v_stock';
    public $timestamps=false;
    protected $fillable = [
        'name',
        'unity_id',
        'unit_price',
        'image',
        'stock'
    ];
    public function unity(){
        return $this->belongsTo(Unity::class);
    }
    public function search($page, $prixmin=null,$prixmax=null,$name=null,$stockmin=null,$stockmax=null){
        $result = $this->where(function($query) use ($prixmin,$prixmax,$name,$stockmin,$stockmax){
            if($prixmin){
                $query->where('unit_price','>=',$prixmin);
            }
            if($prixmax){
                $query->where('unit_price','<=',$prixmax);
            }
            if($name){
                $query->where('name','like','%'.$name.'%');
            }
            if($stockmin){
                $query->where('stock','>=',$stockmin);
            }
            if($stockmax){
                $query->where('stock','<=',$stockmax);
            }
        })->paginate($page);
        return $result;
    }

}
