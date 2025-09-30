<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Tag;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class TableTag extends Component
{
    use WithPagination;

    public $message = '';

    public $isOpen = false;
    public $name;
    public $tagId;

    protected $listeners = [
        'tagAdded' => 'refreshPermissions',
        'tagUpdated' => 'refreshPermissions',
        'tagDeleted' => '$refresh',
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

    public function delete($tagId)
    {
        $tag = Tag::findOrFail($tagId);
        $tag->delete();

        $this->dispatch('tagDeleted');
        $this->dispatch('notification', ['message' => 'Successfully deleted!']);
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
        $tag = Tag::findOrFail($id);
        $this->tagId = $id;
        $this->name = $tag->name;
        $this->isOpen = true;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|max:30|unique:tags,name,' . $this->tagId,
        ]);
    
        $slug = \Str::slug($this->name); // Generate the slug
    
        $action = $this->tagId ? 'tagUpdated' : 'tagAdded';
    
        Tag::updateOrCreate(['id' => $this->tagId], [
            'name' => $this->name,
            'slug' => $slug, // Add the slug field here
        ]);
    
        $this->resetInputFields();
        $this->isOpen = false;
        $this->dispatch($action);
        $this->dispatch('notification', ['message' => 'Successfully ' . ($this->tagId ? 'updated!' : 'created!')]);
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->tagId = null;
    }

    public function render()
    {
        $tags = Tag::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        return view('livewire.table-tag', compact('tags'));
    }
}
