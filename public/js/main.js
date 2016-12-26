$(document).ready(function()
{
	var conversationTemplate = $('#conversation-0');

	$('.ajax-form').submit(function(e) {
		e.preventDefault();
		var url = $(this).attr('action');
		var form = $(this);

		if($(this).hasClass('search'))
		{		
			$.ajax({
				url: url,
				method: 'POST',
				data: form.serialize(),
				success: function(data) {
					var modal = $('#uni-modal');
					modal.modal();
					if(data)
						modal.find('.modal-body').html(data);
					else
						modal.find('.modal-body').html('Nothing found');
					form.find('#search-input').val('');
				}
			});
		}
	});

	$('#dashboard').on('click', '.conversation .panel-heading', function() {
		$(this).parent().find('.panel-body').toggle();
	});

	$('#dashboard').on('click', '.conversation .exit', function() {
		$(this).parent().remove();
	});

	$('body').on('click', '.ajax-link', function(e) {
		e.preventDefault();
		var href = $(this).attr('href');
		var id = $(this).data('id');
		var conversationElement = "#conversation-" + id;
		if($(this).hasClass('contact'))
		{
			if($(conversationElement).length == 0)
			{
				$.ajax({
					url: href,
					success: function(data) {
						$('#dashboard > .panel-body').append(data);
						var messages = $(conversationElement + ' .messages');
						messages.animate({scrollTop: messages[0].scrollHeight});
					}
				});
			}
			else
			{
				$(conversationElement).find('.message-content').focus();
			}
		}
	});

	$('#dashboard').on('submit', '.ajax-form', function(e) {
		e.preventDefault();
		var url = $(this).attr('action');
		var form = $(this);
		var input = form.find('.message-content');
		console.log($(input).val());
		if($(input).val())
		{
			$.ajax({
				url: url,
				data: form.serialize(),
				success: function(data) {
					var messages = $(form).parent().find('.messages');
					messages.append(data);
					messages.animate({scrollTop: messages[0].scrollHeight});
					$(input).val('');
				}
			});
		}
	});
});