<?php

namespace App\Livewire\Formation;

use App\Models\Formation ;
use Livewire\Component;
use Livewire\WithPagination;

class Formations extends Component
{
    use WithPagination;
    public $class_name;
    public $formation_name;
    public $start_time;
    public $end_time;
    public $selectedFormationId;
    public $updateData=false;
    public $showModal=false;
    public $search;

    public function mount()
    {
        $this->resetFormFields();
    }

    public function resetFormFields()
    {
        $this->class_name = '';
        $this->formation_name = '';
        $this->start_time = '';
        $this->end_time = '';
        $this->selectedFormationId = null;
        $this->updateData = false;
        $this->showModal=false;

    }

    public function formation()
    {
        $validated = $this->validate([
            'class_name' => 'required',
            'formation_name' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        if ($this->selectedFormationId) {
            $formation = Formation::findOrFail($this->selectedFormationId);
            $formation->update($validated);
        } else {
            Formation::create($validated);
            session()->flash('message', 'Success');

        }

        $this->resetFormFields();
    }

    public function delete(formation $formation)
    {
        $formation->delete();
        session()->flash('message', 'Formation deleted successfully!');
    }
    public function edit(formation $formation)
    {
        $this->selectedFormationId = $formation->id;
        $this->class_name = $formation->class_name;
        $this->formation_name = $formation->formation_name;
        $this->start_time = $formation->start_time;
        $this->end_time = $formation->end_time;
        $this->updateData = true;
        $this->showModal=true;

    }
  

    public function cancel()
    {
        $this->resetFormFields();
    }
    public function render()
    {
        $formations = Formation::where('class_name', 'like', '%' . $this->search . '%')
            ->orWhere('formation_name', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(5);

        return view('livewire.formation.formation', ['formations' => $formations]);
    }
}
