<ul>
    @foreach ($users as $user)
        <li wire:click="selectUser({{ $user->id }})" class="cursor-pointer p-2 border-b">
            <img src="{{ $user->image }}" alt="{{ $user->first_name }}" class="w-8 h-8 rounded-full inline-block mr-2">
            {{ $user->first_name }} {{ $user->last_name }}
        </li>
    @endforeach
</ul>
