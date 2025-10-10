<?php

namespace App\Livewire;

use Str;
use Auth;
use App\Models\Tag;
use App\Models\City;
use App\Models\Event;
use App\Models\Price;
use App\Models\Virtual;
use Livewire\Component;
use App\Models\Organism;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class ManageEvent extends Component
{
    use WithPagination, WithFileUploads;

    public $title;
    public $subtitle;
    public $link;
    public $content;
    public $eventId;
    public $selectedOrganism;
    public $virtuals = [];
    public $physicals = [];
    public $cities = [];
    public $prices;
    public $selectedPrices = [];
    public $menu_id;
    public $type_id;
    public $subtype_id;
    public $isEditMode = false;
    public $croppedImage, $x, $y, $width, $height;
    public $newImage;
    public $croppedImagePath;
    public $previewImageUrl;

    protected $listeners = [
        'cityAdded' => 'refreshCities',
        'priceAdded' => 'refreshPrices',
        'updateSelectedMenu' => 'setSelectedMenu',
        'updateSelectedType' => 'setSelectedType',
        'updateSelectedSubtype' => 'setSelectedSubtype',
        'setCoordinates' => 'setCoordinates',
        'imageCropped' => 'handleImageCropped',
        'setCoordinates' => 'setCoordinates'
    ];

    public function mount($id = null)
    {
        $this->cities = City::orderBy('name', 'asc')->get();

        $this->prices = Price::all();

        if ($id && is_numeric($id)) {
            $this->eventId = $id;
            $this->edit($id);
            $this->isEditMode = true;
        } else {
            $this->isEditMode = false;
        }
    }

    public function setSelectedMenu($menuId)
    {
        $this->menu_id = $menuId;
    }

    public function setSelectedType($typeId)
    {
        $this->type_id = $typeId;
    }

    public function setSelectedSubtype($subtypeId)
    {
        $this->subtype_id = $subtypeId;
    }

    public function updatedNewImage()
    {
        $this->validate([
            'newImage' => 'nullable|image|max:1024',
        ]);
    
        if ($this->newImage) {
            $this->previewImageUrl = $this->newImage->temporaryUrl();
            $this->dispatch('show-cropper-modal', ['url' => $this->previewImageUrl]);
        }
    }
    
    public function handleImageCropped($croppedImage)
    {
        $path = $this->newImage->store('avatars', 'public');
        Storage::put('public/' . $path, base64_decode($croppedImage));
    
        $this->newImage = $path;
        $this->previewImageUrl = Storage::url($this->newImage);
    }


    public function refreshCities()
    {
        $this->cities = City::orderBy('name', 'asc')->get();

    }

    public function addVirtual()
    {
        $this->virtuals[] = ['link' => '', 'content' => '', 'datestart' => '', 'dateend' => '', 'hide' => false];
    }

    public function removeVirtual($index)
    {
        unset($this->virtuals[$index]);
        $this->virtuals = array_values($this->virtuals);
    }

    public function addPhysical()
    {
        $this->physicals[] = ['city_id' => '', 'address' => '', 'longitude' => '', 'latitude' => '', 'datestart' => '', 'dateend' => '', 'hide' => false];
    }

    public function removePhysical($index)
    {
        unset($this->physicals[$index]);
        $this->physicals = array_values($this->physicals);
    }

    public function refreshPrices()
    {
        $this->prices = Price::all();
    }

    public function addPrice()
    {
        $this->selectedPrices[] = ['id' => uniqid(), 'price_id' => '', 'cost' => ''];
    }

    public function removePrice($id)
    {
        $this->selectedPrices = array_filter($this->selectedPrices, function ($price) use ($id) {
            return $price['id'] !== $id;
        });
        $this->selectedPrices = array_values($this->selectedPrices);
    }

    public function edit($id)
    {
        if (!$this->userCanEditEvent($id)) {
            return redirect()->route('events')->with('error', 'You do not have permission to edit this event.');
        }
    
        $event = Event::findOrFail($id);
    
        $this->eventId = $id;
        $this->title = $event->title;
        $this->subtitle = $event->subtitle;
        $this->link = $event->link;
        $this->content = $event->content;
        $this->image = $event->image;
        $this->selectedOrganism = $event->organism_id;
        $this->previewImageUrl = $event->image ? Storage::url($event->image) : null;
        $this->virtuals = $event->virtuals->toArray();
        $this->physicals = $event->physicals->toArray();
        $this->menu_id = $event->menu_id;
        $this->type_id = $event->type_id;
        $this->subtype_id = $event->subtype_id;
        $this->selectedPrices = $event->prices->map(function ($price) {
            return [
                'id' => uniqid(),
                'price_id' => $price->pivot->price_id,
                'cost' => $price->pivot->cost
            ];
        })->toArray();
    
        $this->isEditMode = true;
    
        $this->dispatch('updateSelectedOrganism', $this->selectedOrganism);
        if ($this->previewImageUrl) {
            $this->dispatch('show-cropper-modal', ['url' => $this->previewImageUrl]);
        }
    }
    
    public function store()
    {
        $this->validate([
            'title' => 'required|max:49|unique:events,title,' . $this->eventId,
            'subtitle' => 'nullable|max:90',
            'link' => 'nullable|url',
            'content' => 'required|min:1',
            'newImage' => 'nullable|image|max:1024',
            'selectedOrganism' => 'nullable|exists:organisms,id',
            'virtuals.*.link' => 'nullable|url|max:255',
            'virtuals.*.content' => 'nullable|string|max:255',
            'virtuals.*.datestart' => 'nullable|date',
            'virtuals.*.dateend' => 'nullable|date|after:virtuals.*.datestart',
            'physicals.*.city_id' => 'nullable|exists:cities,id',
            'physicals.*.address' => 'nullable|string|max:255',
            'physicals.*.longitude' => 'nullable|numeric|max:255',
            'physicals.*.latitude' => 'nullable|numeric|max:255',
            'physicals.*.datestart' => 'nullable|date',
            'physicals.*.dateend' => 'nullable|date|after:physicals.*.datestart',
            'selectedPrices.*.price_id' => 'nullable|exists:prices,id',
            'selectedPrices.*.cost' => 'nullable|numeric',
            'menu_id' => 'required|exists:menus,id',
            'type_id' => 'nullable|exists:types,id',
            'subtype_id' => 'nullable|exists:subtypes,id',
        ]);

        $slug = Str::slug($this->title);

        // Prepare event data
        $data = [
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'link' => $this->link,
            'content' => $this->content,
            'organism_id' => $this->selectedOrganism,
            'slug' => $slug,
            'user_id' => Auth::id(),
            'menu_id' => $this->menu_id,
            'type_id' => $this->type_id,
            'subtype_id' => $this->subtype_id,
        ];

        if ($this->newImage) {
            $data['image'] = $this->newImage->store('images', 'public');
        }

    // Handle dates and hide for virtuals
    foreach ($this->virtuals as &$virtual) {
        $virtual['hide'] = $virtual['hide'] ?? false;
        $virtual['datestart'] = $virtual['datestart'] === '' ? null : $virtual['datestart'];
        $virtual['dateend'] = $virtual['dateend'] === '' ? null : $virtual['dateend'];
    }

    // Handle dates and hide for physicals
    foreach ($this->physicals as &$physical) {
        $physical['hide'] = $physical['hide'] ?? false;
        $physical['datestart'] = $physical['datestart'] === '' ? null : $physical['datestart'];
        $physical['dateend'] = $physical['dateend'] === '' ? null : $physical['dateend'];
    }

        if ($this->isEditMode) {
            $event = Event::findOrFail($this->eventId);
            $event->update($data);
        } else {
            $event = Event::create($data);
        }

        $event->virtuals()->delete();
        foreach ($this->virtuals as $virtual) {
            $event->virtuals()->create($virtual);
        }

        $event->physicals()->delete();
        foreach ($this->physicals as $physical) {
            $event->physicals()->create($physical);
        }

        $event->prices()->sync([]);
        foreach ($this->selectedPrices as $price) {
            if ($price['price_id'] !== '') {
                $event->prices()->attach($price['price_id'], ['cost' => $price['cost']]);
            }
        }

        session()->flash('message', $this->isEditMode ? 'Event updated successfully.' : 'Event created successfully.');

        return redirect()->route('events');
    }
    private function userCanEditEvent($eventId)
    {
        $event = Event::find($eventId);

        // Allow access if user has 'Lire Utilisateur' permission or is the event owner
        return Auth::user()->can('Lire Utilisateur') || (Auth::user()->id === $event->user_id);
    }

    public function toggleConfirmation($eventId)
    {
        $event = Event::findOrFail($eventId);
        $event->confirmed = !$event->confirmed;
        $event->save();

        $this->dispatch('eventUpdated');
    }

    public function render()
    {
        $organisms = Organism::all();
        $event = Event::with('user')->find($this->eventId);

        return view('livewire.manage-event', compact('organisms', 'event'), [
            'cities' => $this->cities,
            'prices' => $this->prices,
        ]);
    }
}