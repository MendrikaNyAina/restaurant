<?php

namespace App\Models\ingredient;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;
    protected $table='ingredient';
    public $timestamps=false;
    protected $fillable = [
        'name',
        'unity_id',
        'unit_price',
        'image',
    ];

    public function unity(){
        return $this->belongsTo(Unity::class);
    }

}
