<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Image;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $equipment = Equipment::with('images')->paginate(6);

        return Inertia::render('equipment/Equipment', [
            'equipments' => $equipment,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validate = $request->validate([
            'reference' => 'required|string|max:255',
            'mark' => 'required|string|max:255',
            'state' => 'required',
            'equipment_type' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $equipment = Equipment::create($validate);
        Image::store($equipment, $request->image, 'equipment');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipment $equipment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipment $equipment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Equipment $equipment)
    {
        // dd($request->all());
        $validate = $request->validate([
            'reference' => 'required|string|max:255',
            'mark' => 'required|string|max:255',
            'state' => 'required',
            'equipment_type' => 'required',
        ]);
        $equipment->update($validate);
        if ($request->image) {
            foreach ($equipment->images as $image) {
                $image->erase("equipment");
            }
            Image::store($equipment, $request->image, 'equipment');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipment $equipment)
    {
        //
        foreach ($equipment->images as $image) {
            $image->erase("equipment");
        }
        $equipment->delete();
        return back();
    }
}
