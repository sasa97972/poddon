<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Commentable;

class Product extends Model
{
    use Commentable;

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'price',
        'material',
        'dynamic',
        'static',
        'load',
        'size',
        'weight',
        'title_image',
        'availability'
    ];

    protected $mustBeApproved = false;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images() {
        return $this->hasMany(Image::class);
    }
}
