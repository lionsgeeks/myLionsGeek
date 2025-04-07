<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Equipment extends Model
{
    //
    protected $fillable = [
        'reference',
        'mark',
        'state',
        'equipment_type',
    ];

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class , 'imagable');
    }
}
