<?php

namespace App\Livewire;

use App\Models\Event;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class EventNotifications extends Component
{
    public $show = false;
    public $events = [];
    public $unseenEventsCount = 0;
    public $isOpen = false;
    public $selectedUser = null;

    protected $listeners = ['markAsSeen'];

    public function mount()
    {
        $this->fetchEvents();
    }

    public function fetchEvents()
    {
        $user = Auth::user();

        if ($user->can('Lire Utilisateur')) {
            $this->events = Event::with('user')
                ->latest()
                ->take(5)
                ->get();

            $this->unseenEventsCount = Event::where('seen', false)->count();
        } else {
            $this->events = Event::where('confirmed', true)
                ->where('user_id', $user->id)
                ->latest()
                ->take(5)
                ->get();

            $this->unseenEventsCount = Event::where('confirmed', true)
                ->where('user_id', $user->id)
                ->where('seen', false)
                ->count();
        }
    }

    public function showEvents()
    {
        $this->show = true;
    }

    public function markAsSeen()
    {
        $user = Auth::user();

        if ($user->can('Lire Utilisateur')) {
            Event::where('seen', false)->update(['seen' => true]);
        } else {
            Event::where('confirmed', true)
                ->where('user_id', $user->id)
                ->where('seen', false)
                ->update(['seen' => true]);
        }

        $this->fetchEvents();
    }

    public function openSlideOver($userId)
    {
        $this->selectedUser = User::find($userId);
        $this->isOpen = true;
    }

    public function render()
    {
        return view('livewire.event-notifications', [
            'events' => $this->events,
        ]);
    }
}
