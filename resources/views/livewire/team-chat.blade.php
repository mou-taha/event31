<div>
    @foreach ($messages->where('user_id', $userId) as $message)
        <div class="p-2 border-b">
            <strong>Teamevent31:</strong>
            <p>{{ $message->content }}</p>
        </div>
    @endforeach
</div>
