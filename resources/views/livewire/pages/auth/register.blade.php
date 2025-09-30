<?php
use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{

    public string $firstname = '';
    public string $lastname = '';
    public string $username = '';
    public string $birth = '';
    public string $sex = '';
    public string $phone = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public int $currentStep = 1;
    public int $totalSteps = 4 ;

    /**
     * Handle an incoming registration request.
     * 
     * 
     * 
     */

public function goToNextStep(): void
{
    $this->validateCurrentStep();
    $this->currentStep++;
    $this->dispatch('reinitializeFlatpickr');

}

public function goToPreviousStep(): void
{
    $this->currentStep--;
}

protected function validateCurrentStep(): void
{
    if ($this->currentStep == 1) {
        $this->validate(['firstname' => 'required|string|max:80', 'lastname' => 'required|string|max:90', 'username' => 'required|string|lowercase|max:95|unique:users' ]);
    } elseif ($this->currentStep == 2) {
        $this->validate(['birth' => 'required|date', 'sex' => 'nullable|string|in:Homme,Femme']);
    } elseif ($this->currentStep == 3) {
        $this->validate(['email' => 'required|string|email|max:255|unique:users', 'phone' =>'nullable|regex:/^0\d{9}$/|unique:users'  ]);
    }elseif ($this->currentStep == 4) {
        $this->validate(['password' => 'required|string|confirmed|' . Rules\Password::defaults()]);
}
}
    public function register(): void
    {
        $validated = $this->validate([
            'firstname' => ['required', 'string', 'max:80'],
            'lastname' => ['required', 'string', 'max:90'],
            'username' => ['required', 'string', 'lowercase', 'max:95', 'unique:'.User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['nullable', 'regex:/^0\d{9}$/', 'unique:'.User::class],
            'birth' => ['required'],
            'sex' => ['nullable','string', Rule::in(['Homme', 'Femme'])],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);


        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
};
 ?>
<div>
<div>
    <form wire:submit.prevent="register">
        @if ($currentStep == 1)
        <div class="grid grid-cols-12 gap-2">
            <div class="col-span-12 sm:col-span-6">
                <div class="flex">
                <x-input-label for="firstname" :value="__('Prénom')" />
                <span class="text-red-500">*</span>
                </div>
                <x-text-input wire:model="firstname" id="firstname" class="block mt-1 w-full" type="text" name="firstname"/>
                <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
            </div>
            <div class="col-span-12 sm:col-span-6">
                <div class="flex">
                    <x-input-label for="lastname" :value="__('Nom')" />
                    <span class="text-red-500">*</span>
                </div>
                <x-text-input wire:model="lastname" id="lastname" class="block mt-1 w-full" type="text" name="lastname"/>
                <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
            </div>
        </div>
        <div> 
            <div class="flex">
                <x-input-label for="username" :value="__('Nom d\'utilisateur')" />
                <span class="text-red-500">*</span>
            </div>
            <x-text-input wire:model="username" id="username" class="block mt-1 w-full" type="text" name="username"/>
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>
        @endif

        @if ($currentStep == 2)
        <div>
            <div class="flex">
                <x-input-label for="birth" :value="__('Date de naissance')" />
                <span class="text-red-500">*</span>
            </div>
            <x-input-flatpickr wire:model="birth" id="birth" class="flatpickr hidden md:block mt-1 w-full" type="text" name="birth"/>
            <x-text-input wire:model="birth" id="birth" class="block md:hidden mt-1 w-full" type="date" name="birth"/>

            <x-input-error :messages="$errors->get('birth')" class="mt-2" />
        </div>


        <fieldset class="mt-6 border-2 h-[44px] rounded-md items-center">
            <div class="flex items-center space-x-10 space-y-0 mt-2">
                <div class="flex items-center justify-center space-x-4">
                    <x-input-label for="sex" :value="__('Homme')" class="ml-3 flex" />
                    <x-radio-input wire:model="sex" id="Homme" class="flex" type="radio" name="sex" value="Homme"/>

                </div>
                <div class="flex items-center justify-center space-x-4">
                    <x-input-label for="sex" :value="__('Femme')" class="ml-3 flex" />
                    <x-radio-input wire:model="sex" id="Femme" class="flex" type="radio" name="sex" value="Femme"/>

                </div>

            </div>
            <x-input-error :messages="$errors->get('sexe')" class="mt-2" />
        </fieldset>
        @endif


        @if ($currentStep == 3)
        <!-- Email Address -->
        <div class="mt-4">
            <div class="flex">
                <x-input-label for="email" :value="__('Email')" />
                <span class="text-red-500">*</span>
            </div>
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div class="mt-4">
            <div class="flex items-center">
                <x-input-label for="phone" :value="__('Numéro de téléphone')" />
                
                <!-- Info Button -->
                <div x-data="{ showInfo: false }" class="relative">
                    <div @click="showInfo = !showInfo" 
                            @mouseenter="showInfo = true" 
                            @mouseleave="showInfo = false" 
                            class="text-emerald-600 -mt-2 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 mt-2 ml-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                              </svg>
                    </div>
                    
                    <!-- Tooltip / Modal -->
                    <div x-show="showInfo" 
                         x-cloak
                         class="absolute left-0 mt-2 p-2 w-52 break-words bg-white border rounded shadow-lg text-sm text-gray-700">
                         Nous avons besoin de votre numéro de téléphone pour vous appeler si nécessaire ou pour obtenir plus d'informations sur votre publication.
                    </div>
                </div>
            </div>
            <x-text-input wire:model="phone" id="phone" class="block mt-1 w-full" type="text" name="phone"/>
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>
        @endif

        @if ($currentStep == 4)
        <!-- Password -->
        <div class="mt-4">
            <div class="flex">
                <x-input-label for="password" :value="__('Mot de passe')" />
                <span class="text-red-500">*</span>
            </div>
            <x-text-input wire:model="password" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                           />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <div class="flex">
                <x-input-label for="password_confirmation" :value="__('Confirmez le mot de passe')" />
                <span class="text-red-500">*</span>
            </div>
            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation"/>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        @endif
        <div class="flex items-center justify-end mt-4">
            @if ($currentStep > 1)
            <x-secondary-button wire:click="goToPreviousStep" class="mr-auto">{{ __('Précédent') }}</x-secondary-button>
            @endif

            @if ($currentStep < $totalSteps)
            <x-secondary-button wire:click="goToNextStep" class="">{{ __('Suivant') }}</x-secondary-button>
            @else
            <x-primary-button type="submit">{{ __('Valider') }}</x-primary-button>
            @endif
        </div>
        
    </form>

</div>
<a href="{{route('auth.google')}}" class="w-full flex justify-center sm:px-0">
    <button type="button" class="text-white w-full  bg-emerald-600 hover:bg-emerald-600/90 focus:ring-4 focus:outline-none focus:ring-emerald-600/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center justify-between  mt-2"><svg class=" w-4 h-4" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="google" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512"><path fill="currentColor" d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"></path></svg>Se connecter avec Google<div></div></button>
</a>
</div>