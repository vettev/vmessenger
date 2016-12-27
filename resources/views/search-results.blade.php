<ul class="search-results">
	@foreach($users as $user)
		<li>
			<span>{{ $user->name }}</span>
			@if($user->id !== Auth::user()->id && count(Auth::user()->contacts->where('contact_id', $user->id)) == 0)
				<a href="{{ route('contact.add', ['id' => $user->id]) }}" class="btn btn-primary ajax-link add-contact">Add to contacts</a>
			@endif
		</li>
	@endforeach
</ul>