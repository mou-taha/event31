<section class="bg-white dark:bg-gray-900">
    <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
        <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">Contactez-nous</h2>
        <p class="mb-8 lg:mb-16 font-light text-center text-gray-500 dark:text-gray-400 sm:text-xl">Vous avez un problème technique ? Vous souhaitez envoyer des commentaires sur une fonctionnalité bêta ? Besoin de détails sur notre plan Business ? Faites le nous savoir.</p>


        <div class="space-y-8" method="post">
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email</label>
                <input type="email" name="email" wire:model.debounce.500ms="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" placeholder="example@gmail.com" required>
                @error('email')
                <div class="bg-red-200 text-red-600 p-2 mt-1">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nom</label>
                <input type="text" id="name" name="name" wire:model.debounce.500ms="name" class="block p-3 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" placeholder="Votre nom" required>
                @error('name')
                <div class="bg-red-200 text-red-600 p-2 mt-1">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div>
                <label for="subject" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Sujet</label>
                <input type="text" id="subject" name="subject" wire:model.debounce.500ms="subject" class="block p-3 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" placeholder="Votre sujet" required>
                @error('subject')
                <div class="bg-red-200 text-red-600 p-2 mt-1">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="sm:col-span-2">
                <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Message</label>
                <textarea id="message" name="message" wire:model.debounce.500ms="message" rows="6" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg shadow-sm border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Votre message ..."></textarea>
                @error('message')
                <div class="bg-red-200 text-red-600 p-2 mt-1">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="sm:col-span-2">

            <a href="{{route('cadmin')}}"  class="py-3 px-5 mt-4 text-sm font-medium text-center text-white rounded-lg sm:w-fit hover:bg-emerald-700 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 bg-emerald-800">Send message</a>
</div>
            @if (session()->has('success'))
                <div class="bg-emerald-200 text-emerald-600 p-2">
                    {{ session('success') }}
                </div>
            @endif
            </div>


    </div>
  </section>