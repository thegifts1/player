<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = [
        'ip_adress',
        'lang',
        'darkTheme',
    ];
}