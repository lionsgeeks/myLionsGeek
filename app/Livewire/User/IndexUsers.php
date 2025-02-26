<?php

namespace App\Livewire\User;

use App\Livewire\Forms\UserForm;
use App\Models\User;
use Livewire\Component;

class IndexUsers extends Component
{
    public $search = '', $roleQuery = '', $statusQuery = '';
    public $members;

    public UserForm $userForm;
    public $showModal = false;

    public function save() {
        $this->userForm->store();
        $this->showModal = false;
        $this->redirect('/users');
    }
    public function toggleModal()
    {
        $this->showModal = !$this->showModal;
    }
    public function cancel()
    {
        $this->reset();
        $this->showModal = false;
    }

    public function delete(User $user)
    {
        $user->delete();
    }
    public function resetFilters() {
        $this->reset();
    }
    public function render()
    {
        $usersQuery = User::query();
        if ($this->search) {
            $usersQuery->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }
        if ($this->roleQuery) {
            $usersQuery->whereHas('access', function ($query) {
                $query->where('role', 'like', '%' . $this->roleQuery . '%');
            });
        }
        if ($this->statusQuery) {
            $usersQuery->where('status', $this->statusQuery);
        }

        return view(
            'livewire.user.index-users',
            [
                'users' => $usersQuery->get(),
            ]
        );
    }
}
