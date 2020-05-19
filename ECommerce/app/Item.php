<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static find($id)
 */
class Item extends Model
{
    protected $fillable = [
        'name', 'description','category','price','userId'
    ];

    public function images()
    {
        return $this->hasMany(Image::class,'item_id');
    }
}
