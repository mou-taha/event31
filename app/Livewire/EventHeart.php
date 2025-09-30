<?php

namespace App\Livewire;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EventHeart extends Component
{
    public $event;
    public $isFavorited;

    public function mount(Event $event)
    {
        $this->event = $event;
        $this->isFavorited = Auth::user()->favoriteEvents()->where('event_id', $this->event->id)->exists();
    }

    public function toggleHeart()
    {
        $user = Auth::user();

        if ($user->favoriteEvents()->where('event_id', $this->event->id)->exists()) {
            $user->favoriteEvents()->detach($this->event->id);
            $this->isFavorited = false;
        } else {
            $user->favoriteEvents()->attach($this->event->id);
            $this->isFavorited = true;
        }

        $this->dispatch('favoriteToggled', $this->event->id, $this->isFavorited);
    }

    public function render()
    {
        return view('livewire.event-heart');
    }
}
