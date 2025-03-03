<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Formation extends Model
{
    use HasUuids;
    protected $fillable=[
        "class_name",
        "formation_name",
        "start_time",
        "end_time",
    ];
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class , 'imagable');
    }
}
