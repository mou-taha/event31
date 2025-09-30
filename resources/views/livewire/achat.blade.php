<div class="flex">
    <div class="w-1/4 p-4 border-r">
        @livewire('user-list')
    </div>
    <div class="w-3/4 p-4">
        <div class="mb-4 border-b pb-4">
            @livewire('team-chat', ['userId' => $selectedUserId])
        </div>
        <input type="text" wire:model="content" placeholder="Type a message" class="w-full p-2 border">
        <button wire:click="sendMessage" class="bg-blue-500 text-white p-2 mt-2">Send</button>
    </div>
</div>
