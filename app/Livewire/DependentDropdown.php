<?php

namespace App\Livewire;

use App\Models\Menu;
use App\Models\Type;
use App\Models\Subtype;
use Livewire\Component;

class DependentDropdown extends Component
{
    public $menus;
    public $types;
    public $subtypes;

    public $selectedMenu = null;
    public $selectedType = null;
    public $selectedSubtype = null;

    public function mount($selectedMenu = null, $selectedType = null, $selectedSubtype = null)
    {
        $this->menus = Menu::all();
        $this->selectedMenu = $selectedMenu;
        $this->selectedType = $selectedType;
        $this->selectedSubtype = $selectedSubtype;

        if ($this->selectedMenu) {
            $this->types = Type::where('menu_id', $this->selectedMenu)->get();
        }

        if ($this->selectedType) {
            $this->subtypes = Subtype::where('type_id', $this->selectedType)->get();
        }
    }

    public function updatedSelectedMenu($menu)
    {
        $this->types = Type::where('menu_id', $menu)->get();
        $this->selectedType = null;
        $this->subtypes = null;
        $this->dispatch('updateSelectedMenu', $menu);
    }

    public function updatedSelectedType($type)
    {
        $this->subtypes = Subtype::where('type_id', $type)->get();
        $this->selectedSubtype = null;
        $this->dispatch('updateSelectedType', $type);
    }

    public function updatedSelectedSubtype($subtype)
    {
        $this->dispatch('updateSelectedSubtype', $subtype);
    }

    public function render()
    {
        return view('livewire.dependent-dropdown');
    }
}
