<?php

namespace App\Livewire\Places;

use App\Models\Image;
use App\Models\Places;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class PlacesCreate extends Component
{
    use WithFileUploads;

    public $name = "";
    public $place_type = "";
    public $state;
    public $image;
    public $selectedPlaceId = null;
    public $showModal = false;

    #[Url(as: 'name')]
    public $searchName;
    #[Url(as: 'type')]
    public $searchType;
    #[Url(as: 'state')]
    public $searchState;

    public function add()
    {
        $validated = $this->validate([
            'name' => 'required|string',
            'place_type' => 'required|string',
            'state' => 'required|boolean',
            'image.*' => 'nullable|image'
        ]);

        if ($this->selectedPlaceId) {
            $place = Places::findOrFail($this->selectedPlaceId);
            $place->update($validated);
        } else {
            $place = Places::create($validated);
            Image::store($place , $this->image, "places");
        }

        // if ($this->image) {
        //     $imagePath = $this->image->store("places", "public");
        //     $place->images()->create(['path' => $imagePath]);
        // }


        $this->resetting();
    }


    public function edit($id)
    {
        $place = Places::findOrFail($id);

        $this->selectedPlaceId = $id;
        $this->name = $place->name;
        $this->place_type = $place->place_type;
        $this->state = $place->state;
        $this->image = null;
        $this->showModal = true;
    }

    // TODO: add auth later - only admins/mods can delete
    public function delete(Places $place)
    {
        Storage::disk('public')->delete($place->image);
        $place->delete();
    }

    #[Computed()]
    public function places()
    {
        return Places::where('name', 'like', "%" . $this->searchName . "%")
            ->where('place_type', 'like', '%' . $this->searchType . '%')
            ->where('state', 'like', '%' . $this->searchState . '%')
            ->get();
    }

    public function resetting()
    {
        $this->reset();
        $this->showModal = false;
    }

    // TODO: Can be remove if not used
    public function render()
    {
        return view('livewire.places.places-create');
    }
}
