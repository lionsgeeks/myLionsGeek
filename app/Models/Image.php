<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class Image extends Model
{
    //
    protected $fillable = ['path'];

    public function imagable(): MorphTo
    {
        return $this->morphTo();
    }

    static function store($ressource, $images, $name)
    {
        $manager = new ImageManager(new Driver());
        if ($images) {
            if (is_array($images)) {
                foreach ($images as $image) {
                    $fileSize = $image->getSize();
                    if ($fileSize >= 1024) {
                        $imageName = time() . '_' . $image->getClientOriginalName();
                        $img = $manager->read($image);
                        $img->toJpeg(80);
                        $ressource->images()->create([
                            'path' => $imageName
                        ]);
                        $image->storeAs('images/' . $name, $imageName, 'public');
                    } else {
                        $imageName = time() . '_' . $image->getClientOriginalName();
                        $ressource->images()->create([
                            'path' => $imageName
                        ]);
                        $image->storeAs('images/' . $name, $imageName, 'public');
                    }
                }
            } else {

                $fileSize = $images->getSize();
                if ($fileSize >= 1024) {
                    $imageName = time() . '_' . $images->getClientOriginalName();
                    $img = $manager->read($images);
                    $img->toJpeg(80);
                    $ressource->images()->create([
                        'path' => $imageName
                    ]);
                    $images->storeAs('images/' . $name, $imageName, 'public');
                } else {
                    $imageName = time() . '_' . $images->getClientOriginalName();
                    $ressource->images()->create([
                        'path' => $imageName
                    ]);
                    $images->storeAs('images/' . $name, $imageName, 'public');
                }
            }
        }
    }

    public function erase($name)
    {
        Storage::disk('public')->delete('images/' . $name . '/' . $this->path);
        $this->delete();
    }
}
