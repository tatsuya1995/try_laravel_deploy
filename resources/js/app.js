 require('../../public/assets/js/bootstrap');

// // $(docummnt).ready(function(){
// //     $.ajaxSetup({
// //         headers: {
//             "X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")
//         }
//     });
//     $("#submit").click(function(){
//         const url = "/pusher/create";
//         $.ajax({
//             url: url,
//             data: {
//                 comment: $("#comment").val(),
//             },
//             method: "POST"
//         });
//         return false;
//     });
//     window.Echo.channel("chat")
//         .listen("Pusher",e =>{
//         $("#board").append("<li>" + e.chat.comment + "</li>");
//     });
// });
window.Echo.channel('chat')
            .listen('Pusher',function(data){
                console.log('received a message');
                console.log(data);
});