<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Places extends Model
{
    protected $fillable =["name" , "place_type" , "state" ];

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class , 'imagable');
    }
}
