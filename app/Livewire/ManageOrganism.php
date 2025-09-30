<?php
namespace App\Livewire;

use Str;
use Auth;
use App\Models\Tag;
use App\Models\City;
use App\Models\Phone;
use Livewire\Component;
use App\Models\Organism;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Rules\MoroccanPhoneNumber;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class ManageOrganism extends Component
{
    use WithPagination, WithFileUploads;

    public $message = '';
    public $isOpen = false;
    public $name;
    public $address;
    public $map;
    public $email;
    public $content;
    public $organismId;
    public $selectedCity;
    public $logo;
    public $newLogo;
    public $previewImageUrl;
    public $phones = []; // Add this to manage phone numbers

    protected $listeners = [
        'organismAdded' => 'refreshOrganisms',
        'organismUpdated' => 'refreshOrganisms',
        'organismDeleted' => '$refresh',
    ];

    public function mount($id = null)
    {
        if ($id && is_numeric($id)) {
            $this->organismId = $id;
            $this->edit($id);
        }
    }

    public function addPhone()
    {
        $this->phones[] = ['number' => ''];
    }

    public function removePhone($index)
    {
        unset($this->phones[$index]);
        $this->phones = array_values($this->phones); // Re-index the array
    }

    public function edit($id)
    {
        $organism = Organism::findOrFail($id);
        $this->organismId = $id;
        $this->name = $organism->name;
        $this->address = $organism->address;
        $this->map = $organism->map;
        $this->email = $organism->email;
        $this->content = $organism->content;
        $this->selectedCity = $organism->city_id;
        $this->logo = $organism->logo;
        $this->previewImageUrl = $organism->logo ? Storage::url($organism->logo) : null;

        $this->phones = $organism->phones->toArray(); // Load phone numbers

        $this->isOpen = true;
        $this->dispatch('updateSelectedCity', $this->selectedCity);
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|max:49',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|max:255',
            'map' => 'nullable|max:255',
            'content' => 'required',
            'selectedCity' => 'required|exists:cities,id',
            'newLogo' => 'nullable|image|max:1024',
            'phones.*.number' => ['required', new MoroccanPhoneNumber()], // Validate phone numbers using custom rule
        ]);
    
        $slug = Str::slug($this->name);
    
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'address' => $this->address,
            'map' => $this->map,
            'content' => $this->content,
            'slug' => $slug,
            'city_id' => $this->selectedCity,
        ];
    
        if ($this->newLogo) {
            $data['logo'] = $this->newLogo->store('logos', 'public');
        }
    
        $action = $this->organismId ? 'organismUpdated' : 'organismAdded';
    
        $organism = Organism::updateOrCreate(['id' => $this->organismId], $data);
    
        $organism->phones()->delete(); // Remove existing phone numbers
        foreach ($this->phones as $phone) {
            $organism->phones()->create($phone); // Add new phone numbers
        }
    
        if (!$this->organismId) {
            $this->resetInputFields();
        }
    
        $this->isOpen = false;
        $this->dispatch($action);
        $this->dispatch('resetCity');
        return redirect('organisms');   

    }
    

    private function resetInputFields()
    {
        $this->name = '';
        $this->address = '';
        $this->map = '';
        $this->email = '';
        $this->content = '';
        $this->organismId = null;
        $this->selectedCity = null;
        $this->logo = null;
        $this->newLogo = null;
        $this->previewImageUrl = null;
        $this->phones = [['number' => '']]; // Reset phone numbers
        $this->dispatch('resetFields');
    }

    public function updatedNewLogo()
    {
        $this->validate(['newLogo' => 'image|max:1024']);
        $this->previewImageUrl = $this->newLogo->temporaryUrl();
    }

    public function render()
    {
        $cities = City::all();

        return view('livewire.manage-organism', compact('cities'));
    }
}
