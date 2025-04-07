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
                    $fileSize = $image->getSize() / 1024 / 1024;
                    $fileSize = round($fileSize, 2);

                    $imageName = time() . '_' . $image->getClientOriginalName();

                    if ($fileSize >= 3) {
                        $img = $manager->read($image);
                        $img->toJpeg(20)->save(storage_path("app/public/images/". $name . "/" . $imageName));
                    } else {
                        $image->storeAs('images/' . $name, $imageName, 'public');
                    }
                    $ressource->images()->create([
                        'path' => $imageName
                    ]);
                }
            }
            else {
                $fileSize = $images->getSize() / 1024 / 1024;
                $fileSize = round($fileSize, 2);

                $imageName = time() . '_' . $images->getClientOriginalName();

                if ($fileSize >= 3) {
                    $img = $manager->read($images);
                    $img->toJpeg(20)->save(storage_path("app/public/images/". $name . "/" . $imageName));
                } else {
                    $images->storeAs('images/' . $name, $imageName, 'public');
                }
                $ressource->images()->create([
                    'path' => $imageName
                ]);
            }
        }
    }

    public function erase($name)
    {
        Storage::disk('public')->delete('images/' . $name . '/' . $this->path);
        $this->delete();
    }
}
