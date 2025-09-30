<div>
    @foreach ($messages as $message)
        <div class="p-2 border-b">
            <strong>{{ $message->user->first_name }} {{ $message->user->last_name }}:</strong>
            <p>{{ $message->content }}</p>
        </div>
    @endforeach
</div>
