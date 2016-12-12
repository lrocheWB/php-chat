var chat = {}

chat.get_messages = function()
{
    $.ajax({
        url: './chat/get-messages',
        type: 'get',
        dataType: 'json',
        data: {csrf: chat.token},
        success: function (data) {
            if (!Array.isArray(data)) {
                $('#errors_box .error').html(data.status_msg);
            } else {
                $('#messages').html('');
                data.forEach(function(element) {
                    $('#messages').prepend("<p><i>"+element[2]+"</i> "+element[1]+" says: "+element[0]+"</p>");
                });
            }
        }
    });
}

$('#msg').keypress(function(event)
{
    if (event.keyCode === 13 && event.shiftKey === false) {
        chat.msg_content = $('#msg').val();

        $.ajax({
            url: './chat/post-messages',
            type: 'post',
            dataType: 'json',
            data: {csrf: chat.token, user_id: chat.user_id, msg: chat.msg_content},
            success: function (data) {
                if (data.status_code != 200) {
                    $('#errors_box .error').html(data.status_msg);
                } else {
                    chat.get_messages();
                    $('#errors_box .error').html('');
                }
            }
        });

        $('#msg').val('');
        return false;
    }
});

chat.interval = setInterval(chat.get_messages, 5000);
chat.token = $('#token_container').attr('value');
chat.user_id = $('#user_id_container').attr('value');
chat.get_messages();