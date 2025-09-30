<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Event;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class TableEvent extends Component
{
    use WithPagination;

    public $message = '';

    public $isOpen = false;
    public $title;
    public $eventId;
    public $showModal = false;
    public $modalData = [];


    protected $listeners = [
        'eventAdded' => 'refreshPermissions',
        'eventUpdated' => 'refreshPermissions',
        'eventDeleted' => '$refresh',
    ];

    public $search = '';
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';
    public $perPage = 5;

    public function mount()
    {
        $this->search = '';
    }

    public function refreshPermissions()
    {
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function showDates($eventId)
{
    $event = Event::findOrFail($eventId);

    // Load virtuals and physicals related to the event
    $virtuals = $event->virtuals()->get();
    $physicals = $event->physicals()->get();

    $this->modalData = [
        'virtuals' => $virtuals,
        'physicals' => $physicals,
    ];

    $this->showModal = true;
}

public function closeModal()
{
    $this->showModal = false;
    $this->modalData = [];
}

    public function delete($eventId)
    {
        $event = Event::findOrFail($eventId);
        $event->delete();

        $this->dispatch('eventDeleted');
        $this->dispatch('notification', ['message' => 'Successfully deleted!']);
    }
    
    public function toggleConfirmation($eventId)
    {
        $event = Event::findOrFail($eventId);
        $event->confirmed = !$event->confirmed;
        $event->save();

        $this->dispatch('eventUpdated');
    }

    public function setSortBy($sortByField)
    {
        if ($this->sortBy === $sortByField) {
            $this->sortDir = ($this->sortDir == 'ASC') ? 'DESC' : 'ASC';
            return;
        }

        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }

    public function create()
    {
        $this->resetInputFields();
        $this->isOpen = true;
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $user = auth()->user();
    
        // Check if the user has the 'Lire Utilisateur' permission or owns the event
        if ($user->can('Lire Utilisateur') || $event->user_id == $user->id) {
            $this->eventId = $id;
            $this->title = $event->title;
            $this->isOpen = true;
        } else {
            // If the user doesn't have permission, reject the request
            session()->flash('error', 'You do not have permission to edit this event.');
            return redirect()->route('events.index');
        }
    }

    public function store()
    {
        $this->validate([
            'title' => 'required|unique:events,title,' . $this->eventId,
        ]);
    
        $slug = \Str::slug($this->title); // Generate the slug
    
        $action = $this->eventId ? 'eventUpdated' : 'eventAdded';
    
        Event::updateOrCreate(['id' => $this->eventId], [
            'title' => $this->title,
            'slug' => $slug, // Add the slug field here
        ]);
    
        $this->resetInputFields();
        $this->isOpen = false;
        $this->dispatch($action);
        $this->dispatch('notification', ['message' => 'Successfully ' . ($this->eventId ? 'updated!' : 'created!')]);
    }

    private function resetInputFields()
    {
        $this->title = '';
        $this->eventId = null;
    }

    public function render()
    {
        $user = auth()->user();
        
        // Check if the user has the 'Lire Utilisateur' permission
        if ($user->can('Lire Utilisateur')) {
            $events = Event::with(['virtuals', 'physicals'])
                ->when($this->search, function ($query) {
                    $query->where('title', 'like', '%' . $this->search . '%');
                })
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate($this->perPage);
        } else {
            // If the user doesn't have the 'Lire Utilisateur' permission, only show their events
            $events = Event::with(['virtuals', 'physicals'])
                ->where('user_id', $user->id)
                ->when($this->search, function ($query) {
                    $query->where('title', 'like', '%' . $this->search . '%');
                })
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate($this->perPage);
        }
        
        return view('livewire.table-event', compact('events'));
    }
}
