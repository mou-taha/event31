<div class="mt-4">
    @canany(['Lire Blog', 'Créer Blog', 'Modifier Blog', 'Supprimer Blog'])
    <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8">
        <div class="overflow-hidden rounded-lg bg-white shadow">
            <div class="divide-y divide-gray-200 lg:grid lg:grid-cols-12 lg:divide-x lg:divide-y-0">
                <form wire:submit.prevent="store" class="divide-y divide-gray-200 lg:col-span-12">
                    <!-- Profile section -->
                    <div class="px-4 py-1 sm:p-4">
                        <div class="mt-2 flex flex-col lg:flex-row">
                            <div class="flex-grow space-y-6">
                                <div class="grid grid-cols-12 gap-6">
                                    <div class="col-span-12 sm:col-span-4">
                                        <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Titre</label>
                                        <div class="flex rounded-md shadow-sm">
                                            <x-text-input wire:model="title" id="title" placeholder="Ajouter un titre" name="title" type="text" class="mt-1 block w-full" autofocus  />
                                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                                        </div>
                                    </div>
                                    <div class="col-span-12 sm:col-span-4 mt-1">
                                        <label for="category" class="block text-sm font-medium text-gray-700">Catégorie</label>
                                        <div x-data="singleSelectCombobox(@entangle('selectedCategory'), {{ json_encode($categories) }})" class="relative mt-2">
                                            <input 
                                                id="categoryCombobox" 
                                                type="text" 
                                                x-model="search" 
                                                @focus="open = true" 
                                                @input="filterOptions" 
                                                class="w-full rounded-md border-0 bg-white py-1.5 pl-3 pr-12 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-emerald-500 sm:text-sm sm:leading-6" 
                                                placeholder="Sélectioner la catégorie" 
                                                aria-controls="options" 
                                                aria-expanded="false"
                                                :value="selectedCategoryObject ? selectedCategoryObject.name : ''"
                                                autocomplete="off"
                                            >
                                            <button type="button" @click="toggleOpen" class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none">
                                                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                            <ul x-show="open" class="absolute z-50 mt-1 max-h-28 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm" id="options" role="listbox">
                                                <template x-for="(option, index) in filteredOptions" :key="option.id">
                                                    <li @click="selectOption(option)" class="relative cursor-default select-none py-2 pl-3 pr-9 text-gray-900" :id="'option-' + index"  :aria-selected="selectedCategory === option.id">
                                                        <span class="block truncate" x-text="option.name"></span>
                                                        <span x-show="selectedCategory === option.id" class="absolute inset-y-0 right-0 flex items-center pr-4 text-emerald-600">
                                                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                <path fill-rule="evenodd" d="M16.704 5.296a.75.75 0 00-1.06-1.06l-8 8a.75.75 0 001.06 1.06l8-8z" clip-rule="evenodd" />
                                                            </svg>
                                                        </span>
                                                    </li>
                                                </template>
                                            </ul>
                                        </div>
                                        
                                        <x-input-error :messages="$errors->get('selectedCategory')" />
                                    </div>
                                    <div class="col-span-12 sm:col-span-4">
                                        <div x-data="multiSelectCombobox(@entangle('selectedTags'), {{ json_encode($tags) }})" class="mt-1">
                                            <label for="combobox" class="block text-sm font-medium text-gray-900">Tags</label>
                                            <div class="relative mt-2">
                                                <input 
                                                    id="combobox" 
                                                    type="text" 
                                                    x-model="search" 
                                                    @focus="open = true" 
                                                    @input="filterOptions" 
                                                    class="w-full rounded-md border-0 bg-white py-1.5 pl-3 pr-12 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-emerald-500 sm:text-sm sm:leading-6" 
                                                    role="combobox" 
                                                    placeholder="Sélectioner les tags"
                                                    aria-controls="options" 
                                                    aria-expanded="false"
                                                    :value="selectedOptionsObjects.map(option => option.name).join(', ')"
                                                    autocomplete="off"
                                                >
                                                <button type="button" @click="toggleOpen" class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none">
                                                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd" d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                                <ul x-show="open" class="absolute z-50 mt-1 max-h-28 w-full overflow-y-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm" id="options" role="listbox">
                                                    <template x-for="(option, index) in filteredOptions" :key="option.id">
                                                        <li @click="selectOption(option)" class="relative cursor-default select-none py-2 pl-3 pr-9 text-gray-900" :id="'option-' + index" role="option" :aria-selected="selectedOptions.includes(option.id)">
                                                            <span class="block truncate" x-text="option.name"></span>
                                                            <span x-show="selectedOptions.includes(option.id)" class="absolute inset-y-0 right-0 flex items-center pr-4 text-emerald-600">
                                                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                                                </svg>
                                                            </span>
                                                        </li>
                                                    </template>
                                                </ul>
                                            </div>
                                            <input type="hidden" x-model="selectedOptions">
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="col-span-12 sm:col-span-12">
                                        <label for="content" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                                        <div class="mt-2">
                                            <textarea wire:model="content" id="content" name="content" rows="6" class="mt-[8px] block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-emerald-500 sm:text-sm sm:leading-6"></textarea>
                                            <x-input-error class="mt-2" :messages="$errors->get('content')" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full mt-2 lg:w-1/3 lg:pl-6 lg:py-2">
                                <div class="relative flex flex-col items-center justify-center w-full h-32 border border-gray-300 rounded-lg bg-gray-50">
                                    @if ($previewImageUrl)
                                        <img src="{{ $previewImageUrl }}" alt="Preview" class="object-cover w-full h-full rounded-lg">
                                    @elseif ($thumbnail)
                                        <img src="{{ Storage::url($thumbnail) }}" alt="Current Thumbnail" class="object-cover w-full h-full rounded-lg">
                                    @else
                                        <div class="flex items-center justify-center w-full h-full">
                                            <span class="text-sm text-gray-400">Ajouter une image</span>
                                        </div>
                                    @endif
                                    <input wire:model="newThumbnail" type="file" id="thumbnail" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                </div>
                                <x-input-error class="mt-2" :messages="$errors->get('newThumbnail')" />
                            </div>
                        </div>
                    </div>

                    <!-- Privacy section -->
                    <div class="divide-y mt-2 divide-gray-200">
                        <div class="flex justify-between gap-x-3 px-4 py-4 sm:px-6">
                            <div>                                                    

                            </div>
                            <div><a  href="{{route('blogs')}}" class="inline-flex justify-center rounded-md bg-white px-5 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Fermer</a>
                                <x-primary-button>{{ __('Valider') }}</x-primary-button></div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div aria-live="assertive" class="pointer-events-none fixed inset-0 flex items-end px-4 py-6 sm:items-start sm:p-6">
        <div class="flex w-full flex-col items-center space-y-4 sm:items-end">
            <div 
                x-data="{ show: false, message: '' }"
                x-show="show"
                x-transition:enter="transform ease-out duration-300 transition"
                x-transition:enter-start="translate-x-full opacity-0"
                x-transition:enter-end="translate-x-0 opacity-100"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                @notification.window="message = $event.detail.message; show = true; setTimeout(() => show = false, 3000)"
                class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5"
            >
            <a  href="{{route('blogs')}}" class="inline-flex justify-center rounded-md sr-only bg-white px-5 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Retour</a>

                <div class="p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-3 w-0 flex-1 pt-0.5">
                            <p class="text-sm font-medium text-gray-900">Opération effectuée avec succès</p>
                        </div>
                        <div class="ml-4 flex flex-shrink-0">
                            <button @click="show = false" type="button" class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                <span class="sr-only">Close</span>
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('livewire:load', function () {
    Livewire.on('updateSelectedCategory', function (categoryId) {
        const comboboxComponent = document.getElementById('categoryCombobox')._x_dataStack[0];
        const category = comboboxComponent.categories.find(category => category.id === categoryId);
        comboboxComponent.selectedCategory = categoryId;
        comboboxComponent.search = category ? category.name : '';
    });
});
    </script>
    <script>
        document.addEventListener('alpine:init', () => {
    Alpine.data('multiSelectCombobox', (selectedTags, tags) => ({
        search: '',
        open: false,
        selectedOptions: selectedTags,
        tags: tags,
        filteredOptions: tags,
        selectedOptionsObjects: [],
        filterOptions() {
            this.filteredOptions = this.tags.filter(tag => tag.name.toLowerCase().includes(this.search.toLowerCase()));
        },
        selectOption(option) {
            if (this.selectedOptions.includes(option.id)) {
                this.selectedOptions = this.selectedOptions.filter(id => id !== option.id);
            } else {
                this.selectedOptions.push(option.id);
            }
            this.selectedOptionsObjects = this.tags.filter(tag => this.selectedOptions.includes(tag.id));
            this.search = this.selectedOptionsObjects.map(option => option.name).join(', ');
            this.open = false;
        },
        toggleOpen() {
            this.open = !this.open;
        },
        init() {
            this.selectedOptionsObjects = this.tags.filter(tag => this.selectedOptions.includes(tag.id));
            if (this.selectedOptionsObjects.length) {
                this.search = this.selectedOptionsObjects.map(option => option.name).join(', ');
            }
            this.$watch('search', value => {
                if (!this.open && value !== this.selectedOptionsObjects.map(option => option.name).join(', ')) {
                    this.open = true;
                    this.filterOptions();
                }
            });
        }
    }));
});
    </script>
    <script>
        document.addEventListener('alpine:init', () => {
    Alpine.data('singleSelectCombobox', (selectedCategory, categories) => ({
        search: '',
        open: false,
        selectedCategory: selectedCategory,
        categories: categories,
        filteredOptions: categories,
        selectedCategoryObject: null,
        filterOptions() {
            this.filteredOptions = this.categories.filter(category => category.name.toLowerCase().includes(this.search.toLowerCase()));
        },
        selectOption(option) {
            this.selectedCategory = option.id;
            this.selectedCategoryObject = option;
            this.search = option.name;
            this.open = false;
        },
        toggleOpen() {
            this.open = !this.open;
        },
        init() {
            this.selectedCategoryObject = this.categories.find(category => category.id === this.selectedCategory);
            if (this.selectedCategoryObject) {
                this.search = this.selectedCategoryObject.name;
            }
            this.$watch('search', value => {
                if (!this.open && value !== (this.selectedCategoryObject ? this.selectedCategoryObject.name : '')) {
                    this.open = true;
                    this.filterOptions();
                }
            });
        }
    }));
});

    </script>
    <script>
        document.addEventListener('clickRetourLink', () => {
            document.querySelector('a[href="{{ route('blogs') }}"]').click();
        });
    </script>
    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('notification', (event) => {
                console.log(event.message);
            });
        });
    </script>
<script>
    function singleSelectCombobox(selectedCategory, categories) {
        return {
            search: '',
            open: false,
            categories: categories,
            selectedCategory: selectedCategory,
            filteredOptions: categories,
            filterOptions() {
                this.filteredOptions = this.categories.filter(category => category.name.toLowerCase().includes(this.search.toLowerCase()));
            },
            selectOption(option) {
                this.selectedCategory = option.id;
                this.search = option.name;
                this.open = false;
            },
            toggleOpen() {
                this.open = !this.open;
            },
            reset() {
                this.selectedCategory = null;
                this.search = '';
            }
        };
    }

    document.addEventListener('livewire:load', function () {
        Livewire.on('resetFields', () => {
            const comboboxComponent = document.getElementById('categoryCombobox')._x_dataStack[0];
            comboboxComponent.reset();
        });
    });
</script>
<script>
    function multiSelectCombobox(selectedTags, tags) {
        return {
            search: '',
            open: false,
            options: tags,
            selectedTags: selectedTags,
            filteredOptions: tags,
            get selectedOptions() {
                return this.selectedTags;
            },
            get selectedOptionsObjects() {
                return this.selectedTags.map(id => this.options.find(option => option.id === id));
            },
            filterOptions() {
                this.filteredOptions = this.options.filter(option => option.name.toLowerCase().includes(this.search.toLowerCase()));
            },
            selectOption(option) {
                if (this.selectedTags.includes(option.id)) {
                    this.selectedTags = this.selectedTags.filter(id => id !== option.id);
                } else {
                    this.selectedTags.push(option.id);
                }
                this.search = '';
                this.open = false;
            },
            removeOption(option) {
                this.selectedTags = this.selectedTags.filter(id => id !== option.id);
            },
            toggleOpen() {
                this.open = !this.open;
            }
        };
    }
</script>
@endcanany
</div>