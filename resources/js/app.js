require('./bootstrap');

$(docummnt).ready(function(){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")
        }
    });
    $("#submit").click(function(){
        const url = "/pusher";
        $.ajax({
            url: url,
            data: {
                comment: $("#comment").val(),
            },
            method: "POST"
        });
        return false;
    });
    window.Echo.channel("chat").listen("Pusher",e =>{
        $("#board").append(
            "<div><label>コメント</div>" + e.chat.comment + "</div>"
        );
    });
});