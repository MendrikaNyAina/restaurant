<?php

namespace App\Models\plat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DishDetail extends Model
{
    use HasFactory;
    protected $table='dish';
    public $timestamps=false;
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'image',
        'cost'
    ];
    //liste d'ingredient
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function search($page,$keyword=null, $prixmin=null,$prixmax=null,$category){
        $result = $this->where(function($query) use ($prixmin,$prixmax,$keyword,$category){
            if($prixmin){
                $query->where('cost','>=',$prixmin);
            }
            if($prixmax){
                $query->where('cost','<=',$prixmax);
            }
            if($keyword){
                $query->where('name','like','%'.$keyword.'%');
            }
            if($category){
                $query->where('category_id','>=',$category);
            }
        })->paginate($page);
        return $result;
    }
}

