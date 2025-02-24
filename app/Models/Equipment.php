<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Storage;

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

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($equipment) {
            foreach ($equipment->images as $image) {
                Storage::disk("public")->delete($image->path);
                $image->delete();
            }
        });
    }
}
