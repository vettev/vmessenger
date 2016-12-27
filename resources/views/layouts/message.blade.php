<div class="message {{ $message->sender->id === Auth::user()->id ? 'own-message' : '' }}">
	<span class="created-by">{{ $message->sender->name }}</span>
	<span class="created-at">
		@if($message->created_at->format('d.m.Y') == date('d.m.Y'))
			{{ $message->created_at->format('H:i') }}
		@else
			{{ $message->created_at->format('d-m') }} | {{ $message->created_at->format('H:i') }}
		@endif
	</span>
	<p class="content">{{ $message->content }}</p>
</div>