<?php

namespace App\Livewire\User;

use App\Livewire\Forms\UserForm;
use App\Models\Formation;
use App\Models\User;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class IndexUsers extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $search = '', $roleQuery = '', $statusQuery = '';
    public $members;

    public UserForm $userForm;

    public function save()
    {
        $this->userForm->store();
        $this->redirect('/users');
    }
    public function cancel()
    {
        $this->reset();
    }

    public function delete(User $user)
    {
        $user->delete();
        $this->dispatch('close');
    }
    public function resetFilters()
    {
        $this->reset();
    }
    public function render()
    {
        $usersQuery = User::whereHas('access', function ($query) {
            $query->where('role', '!=', 'Admin');
        });
        // dd(vars: $usersQuery);
        if ($this->search) {
            $this->resetPage();
            $usersQuery->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }
        if ($this->roleQuery) {
            $this->resetPage();
            $usersQuery->whereHas('access', function ($query) {
                $query->where('role', 'like', '%' . $this->roleQuery . '%');
            });
        }
        if ($this->statusQuery) {
            $this->resetPage();
            $usersQuery->where('status', $this->statusQuery);
        }

        return view(
            'livewire.user.index-users',
            [
                'users' => $usersQuery->paginate(5),
                'formations' => Formation::all()
            ]
        );
    }
}
