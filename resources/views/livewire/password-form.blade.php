<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;

new class extends Component
{
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->dispatch('password-updated');
    }
}; ?>


    <form wire:submit="updatePassword"  class="divide-y divide-gray-200 lg:col-span-9">
    <!-- Profile section -->
    <div class="px-4 py-1 sm:p-4">
        <div class="mt-2 flex flex-col lg:flex-row">
            <div class="flex-grow space-y-6">
              <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 sm:col-span-12">
                  <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Mot de passe actuel</label>
                  <div class="mt-2">
                    <x-text-input wire:model="current_password" id="update_password_current_password" name="current_password" placeholder="Mot de passe actuel" type="password" class="mt-1 block w-full" autocomplete="mot_de_passe_actuel" />
                    <x-input-error :messages="$errors->get('current_password')" class="mt-2" />                
                    </div>
              </div>
                <div class="col-span-12 sm:col-span-6">
                  <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Définir un nouveau mot de passe</label>
                  <div class="mt-2">
                    <x-text-input wire:model="password" id="update_password_password" name="password" placeholder="Nouveau mot de passe" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />                
                    </div>
              </div>
              <div class="col-span-12 sm:col-span-6">
                <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Confirmer votre mot de passe</label>
                <div class="mt-2">
                    <x-text-input wire:model="password_confirmation" id="update_password_password_confirmation" placeholder="Confirmer votre mot de passe" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />                </div>
            </div>
              </div>
            </div>

            <div class="mt-6 flex-grow lg:ml-6 lg:mt-0 lg:flex-shrink-0 lg:flex-grow-0">

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
