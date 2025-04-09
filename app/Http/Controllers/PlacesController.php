<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Places;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PlacesController extends Controller
{
    public function index()
    {
        
        $places = Places::with("images")->paginate(6);

        return Inertia::render('places/places', [
            'places' => $places ,

        ]);

        
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'place_type' => 'required|in:studios,co_work,meeting_room',
            'state' => 'required|boolean',
            'images.*' => 'image|mimes:jpg,jpeg,png,gif|max:5120',
        ]);

     
        $place = Places::create($validate);
        Image::store($place, $request->images, 'places');

        return back();
    }



    public function update(Request $request, Places $place)
    {
        // dd($request->images);         
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'place_type' => 'required|string',
            'state' => 'required|boolean',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);
        
        $place->update($validate);
        if ($request->images) {
            foreach ($place->images as $image) {
                $image->erase("places");
            }
            Image::store($place, $request->images, 'places');
        }

        return back();
    }

public function destroy(Places $place)
{
    foreach ($place->images as $image) {
        $image->erase("places");
    }
    $place->delete();
    return back();
}

}
