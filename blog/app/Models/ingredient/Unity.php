<?php

namespace App\Models\ingredient;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unity extends Model
{
    use HasFactory;
    protected $table='unity';
    public $timestamps=false;
    protected $fillable = [
        'name',
        'unit',
    ];
}
