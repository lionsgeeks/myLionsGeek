<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    //
    protected $fillable = ['path'];

    public function imagable(): MorphTo
    {
        return $this->morphTo();
    }

    static function store($ressource, $images,$name)
    {
        if ($images) {
            foreach ($images as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $ressource->images()->create([
                    'path' => $imageName
                ]);
                $image->storeAs('images/'. $name, $imageName, 'public');
            }
        }
    }

    public function erase($name)
    {
        Storage::disk('public')->delete('images/'. $name . '/' . $this->path);
        $this->delete();
    }
}
