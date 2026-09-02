<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;


    protected $fillable = [

        'title',

        'description',

        'image',

        'button_text',

        'button_link',

        'status',

        'sort_order',

    ];



    protected $casts = [

        'status'=>'boolean',

    ];

}