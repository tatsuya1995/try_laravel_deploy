require('./bootstrap');

$(docummnt).ready(function(){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")
        }
    });
    $("#submit").click(function(){
        const url = "/chats";
        $.ajax({
            url: url,
            data: {
                comment: $("#comment").val(),
            },
            method: "POST"
        });
        return false;
    });
    window.Echo.channel("channelName").listen("PusherEvent",e =>{
        $("board").prepend(
            "<div><label>コメント</div>" + e.chats.commetnt + "</div>"
        );
    });
});