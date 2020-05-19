<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'image','item_id'
    ];
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
