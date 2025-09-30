<?php

namespace App\Livewire;

use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;
use Livewire\Component;

class ImageCrop extends Component
{
    use WithFileUploads;

    public $avatar;
    public $x;
    public $y;
    public $width;
    public $height;

    protected $listeners = [
        'setCoordinates'
    ];

    public function setCoordinates($x, $y, $width, $height)
    {
        $this->x = $x;
        $this->y = $y;
        $this->width = $width;
        $this->height = $height;
    }

    public function save()
    {
        if ($this->avatar) {
            // Enregistrer l'image brute dans un chemin temporaire
            $path = $this->avatar->store('avatars', 'public');
            $fullPath = storage_path('app/public/' . $path);

            // Recadrer l'image sur le serveur avec les coordonnées reçues de Cropper.js
            $image = imagecreatefromstring(file_get_contents($fullPath));
            $croppedImage = imagecrop($image, [
                'x' => $this->x,
                'y' => $this->y,
                'width' => $this->width,
                'height' => $this->height
            ]);

            // Sauvegarder l'image recadrée
            imagejpeg($croppedImage, $fullPath);

            // Libérer la mémoire
            imagedestroy($image);
            imagedestroy($croppedImage);

            // Créer une nouvelle entrée dans la table images
            Image::create([
                'url' => $path,
            ]);


        }
    }

    public function render()
    {
        return view('livewire.image-crop');
    }

}
