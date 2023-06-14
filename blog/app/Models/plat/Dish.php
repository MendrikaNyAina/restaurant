<?php

namespace App\Models\plat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;
    protected $table='dish';
    public $timestamps=false;
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'image',
    ];
    //liste d'ingredient
    public function category(){
        return $this->belongsTo(Category::class);
    }

}
