<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'user_id',
        'user_name',
        'phone_number',
        'photo',
        'completed'
    ];
}
