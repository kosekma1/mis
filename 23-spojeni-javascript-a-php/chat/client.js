var pollServer = function() {
  $.get('/mis/23-spojeni-javascript-a-php/chat/chat.php', function(result) {

    if (!result.success) {
      console.log("Chyba při dotazování na nové zprávy!");
      return;
    }

    $.each(result.messages, function(idx) {

      var chatBubble;

      if (this.sent_by == 'self') {
        chatBubble = $('<div class="row bubble-sent pull-right">' +
                       this.message + 
                       '</div><div class="clearfix"></div>');
      } else {
        chatBubble = $('<div class="row bubble-recv">' +
                       this.message + 
                       '</div><div class="clearfix"></div>');
      }

      $('#chatPanel').append(chatBubble);
    });

    setTimeout(pollServer, 5000);
  });
}

$(document).ready(function() {
  pollServer();

  $('button').click(function() {
    $(this).toggleClass('active');
  });
});

$('#sendMessageBtn').on('click', function(event) {
  event.preventDefault();

  var message = $('#chatMessage').val();

  $.post('/mis/23-spojeni-javascript-a-php/chat/chat.php', {
    'message' : message
  }, function(result) {

    $('#sendMessageBtn').toggleClass('active');


    if (!result.success) {
      alert("Nastala chyba při odesílání zprávy.");
    } else {
      console.log("Zpráva byla odeslána!");
      $('#chatMessage').val('');
    }
  });

});
