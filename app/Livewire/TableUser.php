<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;

class TableUser extends Component
{
    use WithPagination;

    public $message = '';
    public $isOpen = false;
    public $username;
    public $phone;
    public $email;
    public $password;
    public $password_confirmation;
    public $userId;
    public $selectedRole; // Change from selectedRoles to selectedRole

    protected $listeners = [
        'userAdded' => 'refreshUsers',
        'userUpdated' => 'refreshUsers',
        'userDeleted' => '$refresh',
    ];

    public $search = '';
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';
    public $perPage = 5;

    public function mount()
    {
        $this->search = '';
    }

    public function refreshUsers()
    {
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function delete($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();

        $this->dispatch('userDeleted');
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
        $user = User::findOrFail($id);
        $this->userId = $id;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->password = '';
        $this->password_confirmation = '';
        $this->selectedRole = $user->roles->first()->name ?? null; // Get the first role's name or null if user has no role
        $this->isOpen = true;
    }

    public function store()
    {
        $this->validate([
            'username' => 'required|max:30|unique:users,username,' . $this->userId,
            'email' => 'required|max:50|email|unique:users,email,' . $this->userId,
            'password' => 'nullable|min:6|confirmed',
            'phone' => 'nullable|regex:/^0\d{9}$/',
            'selectedRole' => 'required|exists:roles,name', // Ensure selectedRole is a valid role name
        ]);

        $data = [
            'username' => $this->username,
            'phone' => $this->phone,
            'email' => $this->email,
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        $action = $this->userId ? 'userUpdated' : 'userAdded';

        $user = User::updateOrCreate(['id' => $this->userId], $data);
        
        // Sync the single selected role by name
        if ($this->selectedRole) {
            $user->syncRoles([$this->selectedRole]);
        }

        $this->resetInputFields();
        $this->isOpen = false;
        $this->dispatch($action);
        $this->dispatch('notification', ['message' => 'Successfully ' . ($this->userId ? 'updated!' : 'created!')]);
    }

    private function resetInputFields()
    {
        $this->username = '';
        $this->email = '';
        $this->phone = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->userId = null;
        $this->selectedRole = null; // Reset selectedRole to null
    }

    public function render()
    {
        $users = User::query()
            ->when($this->search, function ($query) {
                $query->where('username', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        $roles = Role::all();

        return view('livewire.table-user', compact('users', 'roles'));
    }
}
