<html>
<body>

<h1>Getting server updates</h1>

<div id="username"></div>
<div id="usia"></div>

<script type="text/JavaScript">
if(typeof(EventSource) !== "undefined"){

    var source = new EventSource("server");

    source.addEventListener('username', function (event) {
        var data = event.data;
        // handle message
        document.getElementById("username").innerHTML = data + "<br>";
    });

    source.addEventListener('usia', function (event) {
        var data = event.data;
        // handle message
        document.getElementById("usia").innerHTML = data + "<br>";
    });
}
</script>
</body>
</html>
