<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Organism;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;

class OrgList extends Component
{
    use WithPagination;

    public $isOpen = false;
    public $selectedOrganism = null;
    public $search = '';

    public function openSlideOver($organismId)
    {
        $this->selectedOrganism = Organism::with('phones')->find($organismId);
        $this->isOpen = true;
    }

    public function render()
    {
        $search = $this->search;

        $organisms = Organism::query()
            ->where('name', 'like', '%' . $search . '%')
            ->get();

        return view('livewire.org-list', [
            'organisms' => $organisms,
        ]);
    }
}
