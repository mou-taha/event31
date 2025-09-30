<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Message;
use App\Models\User;

class Achat extends Component
{
    public $messages;
    public $content;

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


    public function render()
    {
        return view('livewire.achat', [
            'messages' => Message::with('user')->get(),
            'users' => User::all(),
        ]);
    }
}
