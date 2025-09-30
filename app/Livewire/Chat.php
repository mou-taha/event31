<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Message;
use App\Models\User;

class Chat extends Component
{
    public $messages;
    public $content;
    public $selectedUserId;

    protected $listeners = ['messageSent' => 'render'];

    public function mount()
    {
        $this->messages = Message::with('user')->get();
    }

    public function sendMessage()
    {
        Message::create([
            'user_id' => auth()->id(),
            'content' => $this->content,
        ]);

        $this->dispatch('messageSent');
        $this->content = '';
    }

    public function selectUser($userId)
    {
        $this->selectedUserId = $userId;
    }

    public function render()
    {
        return view('livewire.chat', [
            'messages' => Message::with('user')->get(),
            'users' => User::all(),
        ]);
    }
}
