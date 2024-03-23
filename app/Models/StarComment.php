<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StarComment extends Model
{
    // use HasFactory;
    protected $table = "stars_comments";

    protected $fillable = [
        'stars',
        'comment',
        'id_recipe',
        'id_user'
    ];

    public $timestamps = false;
}
