<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination;

    public $isOpen = false;
    public $selectedUser = null;
    public $search = '';

    public function openSlideOver($userId)
    {
        $this->selectedUser = User::find($userId);
        $this->isOpen = true;
    }

    public function render()
    {
        $search = $this->search;

        $users = User::query()
            ->where('firstname', 'like', '%' . $search . '%')
            ->orWhere('lastname', 'like', '%' . $search . '%')
            ->get();

        return view('livewire.user-list', [
            'users' => $users,
        ]);
    }
}
