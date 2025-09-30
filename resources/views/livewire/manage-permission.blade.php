<div class="container">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <button wire:click="create()" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Ajouter une permission</button>

    @if($isOpen)
        <div x-data="{ modalOpen: @entangle('isOpen') }" x-show="modalOpen" class="fixed inset-0 flex items-center justify-center z-50">
            <div class="bg-black bg-opacity-50 absolute inset-0" @click="modalOpen = false"></div>
            <div class="bg-white shadow sm:rounded-lg p-6 relative z-10">
                <div class="flex justify-between items-center">
                    <h3 class="text-base font-semibold leading-6 text-gray-900">Ajout de permission</h3>
                    <button @click="modalOpen = false" class="text-gray-500 hover:text-gray-700">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                <div class="mt-2 max-w-xl text-sm text-gray-500">
                    <p>Ajout de permission</p>
                </div>
                <form class="mt-5 sm:flex sm:items-center">
                    <div class="w-full sm:max-w-xs">
                        <label for="permission" class="sr-only">Permission</label>
                        <input wire:model="name" type="text" name="permission" id="permission" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Entrez la permission">
                        @error('name') <span>{{ $message }}</span> @enderror
                    </div>
                    <button wire:click.prevent="store()" type="submit" class="mt-3 inline-flex w-full items-center justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:ml-3 sm:mt-0 sm:w-auto">Save</button>
                </form>
            </div>
        </div>
    @endif

    <div class="min-w-full overflow-hidden overflow-x-auto align-middle shadow sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="bg-gray-50 px-6 py-3 text-left text-sm font-semibold text-gray-900" scope="col">Id</th>
                    <th class="bg-gray-50 px-6 py-3 text-right text-sm font-semibold text-gray-900" scope="col">Permission</th>
                    <th class="hidden bg-gray-50 px-6 py-3 text-left text-sm font-semibold text-gray-900 md:block" scope="col">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                @foreach($permissions as $permission)
                <tr class="bg-white">
                    <td class="w-full max-w-0 whitespace-nowrap px-6 py-4 text-sm text-gray-900">
                        <div class="flex">
                            {{ $permission->id }}
                        </div>
                    </td>
                    <td class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-500">
                        <span class="font-medium text-gray-900">{{ $permission->name }}</span>
                    </td>
                    <td class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-500">
                        <button wire:click="edit({{ $permission->id }})" class="text-green-500 font-extrabold hover:text-green-800">Edit</button>
                        <button wire:click="delete({{ $permission->id }})" class="text-red-500 font-extrabold hover:text-red-800">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>