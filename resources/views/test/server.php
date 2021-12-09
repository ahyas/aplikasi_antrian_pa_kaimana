<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

date_default_timezone_set("Asia/Jayapura");
$datetime=date("Y-m-d H:i:s");

//echo"data: Tanggal-Jam:{$datetime} \n\n";

echo "event: username\n";
echo "data: Sukijan\n\n";

echo "event: usia\n";
echo "data: 38 tahun\n\n";

flush();
?>
