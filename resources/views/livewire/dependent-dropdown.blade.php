    
<div class="grid grid-cols-12 gap-8">

    <div class="col-span-12 sm:col-span-4">
        <label for="menu" class="block mb-2 text-sm font-medium text-gray-900 ">Menus <span class="text-red-500">*</span></label>
        <div class="mt-2 w-full">
            <select wire:model.live="selectedMenu" name="" id="" class="mt-2 block w-full rounded-md border-0 px-3 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:border-0 focus:ring-2 focus:ring-inset focus:ring-emerald-500 sm:text-sm sm:leading-6">
                <option value="" selected>
                    Séléctionnez une menu
                </option>
                @foreach ($menus as $menu )
                    <option value="{{$menu->id}}">
                    {{$menu->name}}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-span-12 sm:col-span-4">
        <label for="type" class="block mb-2 text-sm font-medium text-gray-900 ">Types</label>
        <div class="mt-2 w-full">
            <select  wire:model.live="selectedType" name="" id="" class="mt-2 block w-full rounded-md border-0 px-3 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:border-0 focus:ring-2 focus:ring-inset focus:ring-emerald-500 sm:text-sm sm:leading-6">
                <option value="" selected>
                    Séléctionnez un type
                </option>
                @if ($types)
                @foreach ($types as $type )
                    <option value="{{$type->id}}">
                    {{$type->name}}
                    </option>
                @endforeach
                @endif
            </select>
        </div>
    </div>

    <div class="col-span-12 sm:col-span-4">
        <label for="subtypes" class="block mb-2 text-sm font-medium text-gray-900 ">Sous-types</label>
        <div class="mt-2 w-full">
            <select wire:model.live="selectedSubtype" name="" id="" class="mt-2 block w-full rounded-md border-0 px-3 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:border-0 focus:ring-2 focus:ring-inset focus:ring-emerald-500 sm:text-sm sm:leading-6">
                <option value="" selected>
                    Séléctionnez un subtype
                </option>
                @if ($subtypes)
                @foreach ($subtypes as $subtype )
                    <option value="{{$subtype->id}}">
                    {{$subtype->name}}
                    </option>
                @endforeach
                @endif
            </select>
        </div>
    </div>
</div>    
