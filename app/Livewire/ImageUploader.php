<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ImageUploader extends Component
{
    use WithFileUploads;

    public $newImage;
    public $previewImageUrl;
    public $image;

    public function mount()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Initialize $image with the user's existing image if available
        $this->image = Auth::user()->image ?? null;
    }

    public function updatedNewImage()
    {
        $this->validate([
            'newImage' => 'image|max:1024', // 1MB Max
        ]);

        $this->previewImageUrl = $this->newImage->temporaryUrl();
        
        // Automatically save the image when it is updated
        $this->save();
    }

    public function save()
    {
        $this->validate([
            'newImage' => 'required|image|max:1024', // 1MB Max
        ]);

        $originalFilename = $this->newImage->getClientOriginalName();
        $path = $this->newImage->storeAs('public/images', $originalFilename);

        $imageUrl = Storage::url($path);

        // Save the image URL to the user's profile
        $user = Auth::user();
        $user->image = $imageUrl;
        $user->save();

        $this->image = $imageUrl;

        // Optionally reset the input
        $this->newImage = null;
        $this->previewImageUrl = null;

        session()->flash('message', 'Image successfully uploaded.');
    }

    public function render()
    {
        return view('livewire.image-uploader');
    }
}
