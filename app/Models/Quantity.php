<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quantity extends Model
{
    // use HasFactory;
    protected $table = "quantities";

    protected $fillable = [
        'quantity',
        'id_unit',
        'id_ingredient',
        'id_recipe',
    ];

    public $timestamps = false;
}
