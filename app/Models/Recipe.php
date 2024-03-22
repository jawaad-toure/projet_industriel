<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    // use HasFactory;
    protected $table = "recipes";

    protected $fillable = [
        'recipename',
        'time',
        'cookingtype',
        'category',
        'difficulty',
        'visibility',
        'completed',
        'completed',
        'for',
        'id_unit',
        'id_user',
    ];

    public $timestamps = false;
}
