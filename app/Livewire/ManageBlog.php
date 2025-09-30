<?php
namespace App\Livewire;

use Str;
use Auth;
use App\Models\Tag;
use App\Models\Blog;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Request;

class ManageBlog extends Component
{
    use WithPagination, WithFileUploads;

    public $message = '';
    public $isOpen = false;
    public $title;
    public $content;
    public $blogId;
    public $selectedCategory;
    public $thumbnail;
    public $newThumbnail;
    public $previewImageUrl;
    public $allTags = [];
    public $tags = [];
    public $selectedTags = [];

    protected $listeners = [
        'blogAdded' => 'refreshBlogs',
        'blogUpdated' => 'refreshBlogs',
        'blogDeleted' => '$refresh',
    ];

    public function mount($id = null)
    {
        $this->tags = Tag::all(); // Load all tags

        // Check if ID is passed and is valid
        if ($id && is_numeric($id)) {
            $this->blogId = $id;
            $this->edit($id);
        }
    }

    public function showAllTags($blogId)
    {
        $blog = Blog::findOrFail($blogId);
        $this->blogId = $blogId;
        $this->blogName = $blog->name;
        $this->allTags = $blog->tags->pluck('name')->toArray();
        $this->isModalOpen = true;
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
        $this->content = $blog->content;
        $this->selectedCategory = $blog->category_id;
        $this->thumbnail = $blog->thumbnail;
        $this->previewImageUrl = $blog->thumbnail ? Storage::url($blog->thumbnail) : null;
        $this->selectedTags = $blog->tags->pluck('id')->toArray();
        $this->isOpen = true;
    
        $this->dispatch('updateSelectedCategory', $this->selectedCategory);
        $this->dispatch('updateSelectedTags', $this->selectedTags);
    }

    public function store()
    {
        $this->validate([
            'title' => 'required|max:255|unique:blogs,title|',
            'content' => 'required',
            'selectedCategory' => 'required|exists:categories,id',
            'newThumbnail' => 'nullable|image|max:1024',
            'selectedTags' => 'required|array',
        ]);

        $slug = Str::slug($this->title);

        $data = [
            'title' => $this->title,
            'content' => $this->content,
            'slug' => $slug,
            'category_id' => $this->selectedCategory,
            'user_id' => Auth::id(),  // Set the authenticated user's ID
        ];

        if ($this->newThumbnail) {
            $data['thumbnail'] = $this->newThumbnail->store('thumbnails', 'public');
        }

        $action = $this->blogId ? 'blogUpdated' : 'blogAdded';

        $blog = Blog::updateOrCreate(['id' => $this->blogId], $data);

        $validTags = Tag::whereIn('id', $this->selectedTags)->pluck('id')->toArray();
        $blog->tags()->sync($validTags);  // Sync the tags with the blog

        // Only reset input fields if not editing
        if (!$this->blogId) {
            $this->resetInputFields();
        }

        $this->isOpen = false;
        $this->dispatch($action);
        $this->dispatch('resetCategory'); // Emit browser event to reset category field
         return redirect('blogs');   
    }

    private function resetInputFields()
    {
        $this->title = '';
        $this->content = '';
        $this->blogId = null;
        $this->selectedCategory = null; // Reset category field
        $this->thumbnail = null;
        $this->newThumbnail = null;
        $this->previewImageUrl = null;
        $this->selectedTags = [];
        $this->dispatch('resetFields');
    }

    public function updatedNewThumbnail()
    {
        $this->validate(['newThumbnail' => 'image|max:1024']);
        $this->previewImageUrl = $this->newThumbnail->temporaryUrl();
    }

    public function render()
    {
        $categories = Category::all();

        return view('livewire.manage-blog', compact('categories'));
    }
}
