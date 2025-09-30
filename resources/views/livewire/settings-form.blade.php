<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component
{
    public string $firstname = '';
    public string $lastname = '';
    public string $username = '';
    public string $email = '';
    public string $sex = '';
    public string $birth = '';

    /**
     * Mount the component.
     */
    
    public function mount(): void
    {
        $user = Auth::user();

        $this->firstname = $user->firstname ?? '';
        $this->lastname = $user->lastname ?? '';
        $this->username = $user->username ?? '';
        $this->email = $user->email ?? '';
        $this->sex = $user->sex ?? '';
        $this->birth = $user->birth ?? '';
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'firstname' => 'string|max:30',
            'lastname' => 'string|max:35',
            'username' => ['required', 'string', 'max:20', Rule::unique(User::class)->ignore($user->id)],
            'sex' => 'in:Homme,Femme',
            'birth' => 'nullable',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:50', Rule::unique(User::class)->ignore($user->id)],
        ]);
        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', firstname: $user->firstname);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; 
?>



    <form wire:submit="updateProfileInformation"  class="divide-y divide-gray-200 lg:col-span-9">
    <!-- Profile section -->
    <div class="px-4 py-1 sm:p-4">
        <div class="mt-2 flex flex-col lg:flex-row">
            <div class="flex-grow space-y-6">
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12 sm:col-span-6">
                        <label for="firstname" class="block text-sm font-medium leading-6 text-gray-900">Prénom</label>
                        <div class="mt-2 flex rounded-md shadow-sm">
                            <x-text-input wire:model="firstname" id="firstname" name="firstname" type="text" class="mt-1 block w-full" autofocus autocomplete="prénom" />
                            <x-input-error class="mt-2" :messages="$errors->get('firstname')" />                        
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="lastname" class="block text-sm font-medium leading-6 text-gray-900">Nom</label>
                        <div class="mt-2 flex rounded-md shadow-sm">
                            <x-text-input wire:model="lastname" id="lastname" name="lastname" type="text" class="mt-1 block w-full" autofocus autocomplete="nom" />
                            <x-input-error class="mt-2" :messages="$errors->get('lastname')" />                          
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12 sm:col-span-6">
                        <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Nom d'utilisateur</label>
                        <div class="mt-2">
                            <x-text-input wire:model="username" id="username" name="username" type="text" class="mt-1 block w-full"  autofocus autocomplete="nom d'utilisateur" />
                            <x-input-error class="mt-2" :messages="$errors->get('username')" />                           
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                        <div class="mt-2">
                            <x-text-input wire:model="email" id="email" name="email" type="email" class="mt-1 block w-full bg-50" disabled/>
                            <x-input-error class="mt-2" :messages="$errors->get('email')"  />                     
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="sex" class="block text-sm font-medium leading-6 text-gray-900">Sexe</label>
                        <fieldset class="mt-4 rounded-md items-start">
                            <div class="flex items-start space-x-10 space-y-0">
                                <div class="flex items-center justify-center space-x-4">
                                    <x-input-label for="Homme" :value="__('Homme')" class="flex" />
                                    <x-radio-input wire:model="sex" id="Homme" class="flex" type="radio" name="sex" value="Homme"/>
                                </div>
                                <div class="flex items-center justify-center space-x-4">
                                    <x-input-label for="Femme" :value="__('Femme')" class="ml-3 flex" />
                                    <x-radio-input wire:model="sex" id="Femme" class="flex" type="radio" name="sex" value="Femme"/>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('sex')" class="mt-2" />
                        </fieldset>                   
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="birth" class="block text-sm font-medium leading-6 text-gray-900">Date de naissance</label>
                        <x-input-flatpickr wire:model="birth" id="birth" class="flatpickr hidden md:block mt-1 w-full" type="text" name="birth"/>
                        <x-text-input wire:model="birth" id="birth" class="block md:hidden mt-1 w-full" type="date" name="birth"/>
                    </div>
                </div>
            </div>
            @livewire('image-uploader') 
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
