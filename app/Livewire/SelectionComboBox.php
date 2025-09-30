<?php

namespace App\Livewire;

use App\Models\Menu;
use App\Models\Type;
use App\Models\Subtype;
use Livewire\Component;

class SelectionComboBox extends Component
{
    public $searchMenu = ''; // Recherche de menu en direct
    public $selectedMenu = null; // Stocke la menu sélectionnée
    public $selectedType = null; // Stocke la catégorie sélectionnée
    public $menus = []; // Toutes les menus disponibles
    public $types = []; // Catégories filtrées selon la menu sélectionnée
    public $subtypes = []; // Sous-catégories filtrées selon la catégorie sélectionnée

    public function mount()
    {
        // Remplit la liste des menus lors du chargement initial
        $this->menus = Menu::all();
    }

    public function selectMenu($menuId)
    {
        // Met à jour la menu sélectionnée en fonction de l'ID fourni
        $this->selectedMenu = $menuId;
    
        // Mets à jour les catégories liées à cette menu
        $this->types = Type::where('menu_id', $this->selectedMenu)->get();
    
        // Réinitialise les sous-catégories et la catégorie sélectionnée
        $this->subtypes = [];
        $this->selectedType = null;
    }
    public function updatedSearchMenu()
    {
        // Mets à jour les menus en fonction de la recherche
        $this->menus = Menu::where('name', 'like', '%' . $this->searchMenu . '%')->get();
    }

    public function updatedSelectedMenu()
    {
        // Mets à jour les catégories liées à la menu sélectionnée
        $this->types = Type::where('menu_id', $this->selectedMenu)->get();
        $this->subtypes = []; // Réinitialise les sous-catégories
         //$this->selectedType = null; // Réinitialise la catégorie sélectionnée
    }

    public function updatedSelectedType()
    {
        // Mets à jour les sous-catégories liées à la catégorie sélectionnée
        $this->subtypes = Subtype::where('type_id', $this->selectedType)->get();
    }

    public function render()
    {
        return view('livewire.selection-combo-box', [
            'menus' => $this->menus,
            'types' => $this->types,
            'subtypes' => $this->subtypes
        ]);
    }
}
