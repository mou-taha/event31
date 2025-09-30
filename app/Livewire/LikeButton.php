<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;

class LikeButton extends Component
{
    public $eventId;
    public $liked;

    public function mount($eventId)
    {
        $this->eventId = $eventId;
        $this->liked = Auth::check() && Auth::user()->favoriteEvents()->where('event_id', $eventId)->exists();
    }

    public function toggleLike()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $event = Event::find($this->eventId);

        if ($this->liked) {
            $user->favoriteEvents()->detach($event->id);
            $this->liked = false;
        } else {
            $user->favoriteEvents()->attach($event->id);
            $this->liked = true;
        }

        $this->dispatch('likeToggled', $this->eventId, $this->liked);
    }

    public function render()
    {
        return view('livewire.like-button');
    }
}
