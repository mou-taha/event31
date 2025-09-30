<div class="mt-6 flex-grow lg:ml-6 lg:mt-0 lg:flex-shrink-0 lg:flex-grow-0">
    <p class="text-sm font-medium leading-6 text-gray-900" aria-hidden="true">Photo</p>
    <div class="mt-2 lg:hidden">
        <div class="flex items-center">
            <div class="inline-block h-12 w-12 flex-shrink-0 overflow-hidden rounded-full" aria-hidden="true">
                <img class="h-full w-full rounded-full" src="{{ $previewImageUrl ?? $image ?? 'https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png?20150327203541' }}" alt="">
            </div>
            <div class="relative ml-5">
                <input id="newImage" wire:model="newImage" name="newImage" type="file" class="peer absolute h-full w-full rounded-md opacity-0">
                <label for="newImage" class="pointer-events-none block rounded-md px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 peer-hover:ring-gray-400 peer-focus:ring-2 peer-focus:ring-emerald-500">
                    <span>Change</span>
                    <span class="sr-only"> user photo</span>
                </label>
            </div>
        </div>
    </div>
    <div class="relative hidden overflow-hidden rounded-full lg:block">
        <img class="relative h-40 w-40 rounded-full" src="{{ $previewImageUrl ?? $image ?? 'https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png?20150327203541' }}" alt="">
        <label for="newImage" class="absolute inset-0 flex h-full w-full items-center justify-center bg-black bg-opacity-75 text-sm font-medium text-white opacity-0 focus-within:opacity-100 hover:opacity-100">
            <span>Change</span>
            <span class="sr-only">user photo</span>
            <input id="newImage" wire:model="newImage" type="file" class="absolute inset-0 h-full w-full cursor-pointer rounded-md border-gray-300 opacity-0">
        </label>
    </div>
</div>
