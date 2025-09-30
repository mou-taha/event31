<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class FavoriteList extends Component
{
    public $favoriteEvents;

    public function mount()
    {
        $this->loadFavoriteEvents();
    }

    public function loadFavoriteEvents()
    {
        $this->favoriteEvents = Auth::user()->favoriteEvents()->get();
    }

    public function toggleHeart($eventId)
    {
        $user = Auth::user();

        if ($user->favoriteEvents()->where('event_id', $eventId)->exists()) {
            $user->favoriteEvents()->detach($eventId);
        } else {
            $user->favoriteEvents()->attach($eventId);
        }

        $this->loadFavoriteEvents();
    }

    public function render()
    {
        return view('livewire.favorite-list', ['favoriteEvents' => $this->favoriteEvents]);
    }
}
