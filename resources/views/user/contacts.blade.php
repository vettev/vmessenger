<ul class="contacts">
	@foreach($contacts as $contact)
		<li>
			<a href="{{ route('conversation.open', ['id' => $contact->contact->id]) }}" class="contact ajax-link" id="contact-{{ $contact->contact->id }}" data-id="{{ $contact->contact->id }}">{{ $contact->contact->name }}</a>
		</li>
	@endforeach
</ul>