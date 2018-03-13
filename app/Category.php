<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 
        'description',
        'alias',
        'title_image'
    ];

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
