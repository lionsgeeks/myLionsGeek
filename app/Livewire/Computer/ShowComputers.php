<?php

namespace App\Livewire\Computer;

use App\Livewire\Forms\Computer\ComputerForm;
use App\Livewire\Forms\Computer\UpdateComputerForm;
use App\Models\Computer;
use App\Models\User;
use Livewire\Attributes\Url;
use Livewire\Component;

class ShowComputers extends Component
{
    #[Url(as: 'q')]
    public $search = '';
    public $computerState = '';
    public $is_available = '';
    public $computers = '';



    public function delete(Computer $computer)
    {
        $computer->delete();
    }
    /**
     * a function that reset the filter 
     */
    public function resetFilter()
    {
        // $this->computerState = '';
        // $this->is_available = '';
        $this->reset();
        $this->computers = Computer::all();
    }



    public function render()
    {
        $query = Computer::query();


        if (!empty($this->search)) {
            $query->whereHas('user', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            })
                ->orWhere('reference', 'like', '%' . $this->search . '%')
                ->orWhere('CpuGpu', 'like', '%' . $this->search . '%');
        }
        if (!empty($this->computerState)) {
            $query->where('computer_state', $this->computerState);
        }
        if ($this->is_available !== '') {
            $query->where('is_available', $this->is_available);
        }

        $this->computers = $query->get();

        return view('livewire.computer.show-computers', [
            'computers' => $this->computers,
            'users' => User::all(),
        ]);
    }
}
