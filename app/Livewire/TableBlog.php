<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Blog;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class TableBlog extends Component
{
    use WithPagination;

    public $message = '';

    public $isOpen = false;
    public $title;
    public $blogId;

    protected $listeners = [
        'blogAdded' => 'refreshPermissions',
        'blogUpdated' => 'refreshPermissions',
        'blogDeleted' => '$refresh',
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

    public function delete($blogId)
    {
        $blog = Blog::findOrFail($blogId);
        $blog->delete();

        $this->dispatch('blogDeleted');
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
        $blog = Blog::findOrFail($id);
        $this->blogId = $id;
        $this->title = $blog->title;
        $this->isOpen = true;
    }

    public function store()
    {
        $this->validate([
            'title' => 'required|unique:blogs,title,' . $this->blogId,
        ]);
    
        $slug = \Str::slug($this->title); // Generate the slug
    
        $action = $this->blogId ? 'blogUpdated' : 'blogAdded';
    
        Blog::updateOrCreate(['id' => $this->blogId], [
            'title' => $this->title,
            'slug' => $slug, // Add the slug field here
        ]);
    
        $this->resetInputFields();
        $this->isOpen = false;
        $this->dispatch($action);
        $this->dispatch('notification', ['message' => 'Successfully ' . ($this->blogId ? 'updated!' : 'created!')]);
    }

    private function resetInputFields()
    {
        $this->title = '';
        $this->blogId = null;
    }

    public function render()
    {
        $blogs = Blog::query()
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        return view('livewire.table-blog', compact('blogs'));
    }
}
