<?php
namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Event;
use Carbon\Carbon;

class DashboardCards extends Component
{
    public $user;
    public $totalUsers;
    public $usersThisWeek;
    public $totalEvents;
    public $eventsThisWeek;
    public $percentageUsersWithEvents;
    public $averageEventsPerUser;
    public $confirmedEvents;
    public $unconfirmedEvents;

    public function mount()
    {
        $this->user = Auth::user();

        if ($this->user->can('Lire Utilisateur')) {
            $this->totalUsers = User::count();
            $this->usersThisWeek = User::where('created_at', '>=', Carbon::now()->startOfWeek())->count();

            $this->totalEvents = Event::count();
            $this->eventsThisWeek = Event::where('created_at', '>=', Carbon::now()->startOfWeek())->count();

            // Calculate percentage of users with events
            $usersWithEvents = Event::distinct('user_id')->count('user_id');
            $this->percentageUsersWithEvents = $this->totalUsers > 0 ? ($usersWithEvents / $this->totalUsers) * 100 : 0;

            // Calculate average number of events per user
            $this->averageEventsPerUser = $this->totalUsers > 0 ? $this->totalEvents / $this->totalUsers : 0;

            // Calculate confirmed and unconfirmed events
            $this->confirmedEvents = Event::where('confirmed', true)->count();
            $this->unconfirmedEvents = Event::where('confirmed', false)->count();
        } else {
            $userId = $this->user->id;

            $this->totalEvents = Event::where('user_id', $userId)->count();
            $this->eventsThisWeek = Event::where('user_id', $userId)
                                         ->where('created_at', '>=', Carbon::now()->startOfWeek())
                                         ->count();

            $this->confirmedEvents = Event::where('user_id', $userId)
                                           ->where('confirmed', true)
                                           ->count();

            // Calculate unconfirmed events for the user
            $this->unconfirmedEvents = Event::where('user_id', $userId)
                                             ->where('confirmed', false)
                                             ->count();
        }
    }

    public function render()
    {
        return view('livewire.dashboard-cards');
    }
}

