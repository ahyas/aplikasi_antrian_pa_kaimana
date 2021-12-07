<html>
<body>

<h1>Getting server updates</h1>
<div id="antrian_saat_ini"></div>

<script type="text/JavaScript">
if(typeof(EventSource) !== "undefined"){
    var source = new EventSource("server");
    source.onmessage = function(event) {
      document.getElementById("antrian_saat_ini").innerHTML = event.data + "<br>";
    };
}
</script>
</body>
</html>
