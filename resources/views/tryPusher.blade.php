
<!DOCTYPE html>
<head>
    <title>Pusher Test</title>
    <script src="https://js.pusher.com/6.0/pusher.min.js"></script>
    <script>
    Pusher.logToConsole = true ;

    var pusher = new Pusher("{{ config('broadcasting.connections.pusher.key')}}",{
      cluster: "{{ config('broadcasting.connections.pusher.options.cluster')}}"
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event',function(data) {
      alert(JSON.stringify(data));
    });
  </script>
</head>
<body>
  <h1>Pusher Test</h1>
  <p>
  Try publishing an event to channel <code>my-channel</code>
      with event name <code>my-event</code>.
  </p>
</body>



