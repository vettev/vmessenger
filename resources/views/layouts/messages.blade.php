<div class="messages">
	@foreach($messages as $message)
		@include('layouts.message', ['message' => $message])
    @endforeach
</div>