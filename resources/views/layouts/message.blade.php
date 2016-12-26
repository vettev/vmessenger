<div class="message {{ $message->sender->id === Auth::user()->id ? 'own-message' : '' }}">
	<span class="created-by">{{ $message->sender->name }}</span>
	<span class="created-at">{{ $message->created_at->diffForHumans() }}</span>
	<p class="content">{{ $message->content }}</p>
</div>