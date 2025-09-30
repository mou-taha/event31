<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class PermissionsTable extends Component
{


    public function render()
    {
        return view('livewire.permissions-table');
    }
}
