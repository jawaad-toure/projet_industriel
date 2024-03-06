<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipename',
        'time',
        'cookingtype',
        'category',
        'difficulty',
        'id_user'
    ];
}
