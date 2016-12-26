            <div class="panel panel-default conversation" id="conversation-{{ $user->id }}">
            	<span class="exit">X</span>
                <div class="panel-heading">{{ $user->name }}</div>
                <div class="panel-body">
                	@include('layouts.messages')
                    <form action="{{ route('message.new', ['id' => $user->id]) }}" class="ajax-form" method="post">
                    	<input type="text" name="message" placeholder="Write your message" class="form-control message-content" autocomplete="off" />
                    	{{ csrf_field() }}
                    </form>
                </div>
            </div>