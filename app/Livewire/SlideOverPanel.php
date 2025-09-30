<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class SlideOverPanel extends Component
{
    public $isOpen = false;
    public $selectedUser = null;

    public function openSlideOver($userId)
    {
        $this->selectedUser = User::find($userId);
        $this->isOpen = true;
    }

    public function render()
    {
        $users = User::all();

        return view('livewire.slide-over-panel', [
            'users' => $users,
        ]);
    }
}