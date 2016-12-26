<ul class="search-results">
	@foreach($users as $user)
		<li>
			<span>{{ $user->name }}</span>
			@if($user->id !== Auth::user()->id)
				<a href="{{ route('contact.add', ['id' => $user->id]) }}" class="btn btn-primary">Add to contacts</a>
			@endif
		</li>
	@endforeach
</ul>