<script src="//js.pusher.com/3.0/pusher.min.js"></script>
<script>
	var messageTemplate = $('#message-template');
	var pusher = new Pusher("{{ env("PUSHER_KEY") }}", {
			cluster: 'eu',
			encrypted: true,
			auth: {
        		headers: {
            		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        		}
    		}
	});
	var channelName = "private-user-{{ Auth::user()->id }}";
	var channel = pusher.subscribe(channelName);
	channel.bind('message', function(data) {
		var message = data;
		var convElement = "#conversation-" + message.sender_id;
		var newMessage = $(messageTemplate).clone();
		$(newMessage).find('.created-at').html(message.created_at);
		$(newMessage).find('.created-by').html(message.sender);
		$(newMessage).find('.content').html(message.content);
		var messagesElement = $(convElement).find('.messages');
		if($(convElement).length > 0)
		{
			messagesElement.append(newMessage);
			messagesElement.animate({scrollTop: messagesElement[0].scrollHeight});
		}
		else
		{
			var href = "/conversation/" + message.sender_id;
			$.ajax({
				url: href,
				success: function(data) {
					$('#dashboard > .panel-body').append(data);
				}
			});
			messagesElement.append(newMessage);
			messagesElement.animate({scrollTop: messagesElement[0].scrollHeight});
		}
		var sound = new Audio('{{ asset('sounds/msg.mp3') }}');
		sound.play();
	});
</script>