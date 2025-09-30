<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component
{
    public string $phone = '';
    public ?string $address = null;
    public ?string $bio = null;

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $user = Auth::user();
        $this->phone = $user->phone ?? '';
        $this->address = $user->address ?? '';
        $this->bio = $user->bio ?? '';
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateAccountInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'phone' => ['nullable', 'regex:/^0\d{9}$/', Rule::unique(User::class)->ignore($user->id)],
            'address' => 'nullable|string|max:60',
            'bio' => 'nullable|string|max:255',
        ]);

        // Ensure empty strings are set to null
        $validated['address'] = $validated['address'] ?? null;
        $validated['bio'] = $validated['bio'] ?? null;

        $user->fill($validated);
        $user->save();

        $this->dispatch('profile-updated', firstname: $user->firstname);
    }
};
 ?>


<form wire:submit.prevent="updateAccountInformation" class="divide-y divide-gray-200 lg:col-span-9">
    <!-- Profile section -->
    <div class="px-4 py-1 sm:p-4">
        <div class="mt-2 flex flex-col lg:flex-row">
            <div class="flex-grow space-y-6">
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12 sm:col-span-6">
                        <label for="phone" class="block text-sm font-medium leading-6 text-gray-900">Numéro de téléphone</label>
                        <div class="mt-2 flex rounded-md shadow-sm">
                            <x-text-input wire:model="phone" id="phone" name="phone" type="text" placeholder="Numéro de téléphone" class="mt-1 block w-full" autofocus autocomplete="téléphone" />
                            <x-input-error class="mt-2" :messages="$errors->get('phone')" />                      
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="address" class="block text-sm font-medium leading-6 text-gray-900">Adresse</label>
                        <div class="mt-2 flex rounded-md shadow-sm">
                            <x-text-input wire:model="address" id="address" name="address" type="text" placeholder="Adresse" class="mt-1 block w-full" autofocus autocomplete="adresse" />
                            <x-input-error class="mt-2" :messages="$errors->get('address')" />                  
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12 sm:col-span-12">
                        <label for="bio" class="block text-sm font-medium leading-6 text-gray-900">biographie</label>
                        <div class="mt-2">
                            <textarea wire:model="bio" id="bio" name="bio" rows="6" class="mt-[8px] block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-emerald-500 sm:text-sm sm:leading-6"></textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('bio')" />                      
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 flex-grow lg:ml-6 lg:mt-0 lg:flex-shrink-0 lg:flex-grow-0">
                <!-- Additional content can go here if needed -->
            </div>
        </div>
    </div>

    <!-- Privacy section -->
    <div class="divide-y mt-2 divide-gray-200">
        <div class="flex justify-end gap-x-3 px-4 py-4 sm:px-6">
            <button type="button" class="inline-flex justify-center rounded-md bg-white px-5 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Fermer</button>
            <x-primary-button>{{ __('Valider') }}</x-primary-button>     
        </div>
    </div>
</form>
