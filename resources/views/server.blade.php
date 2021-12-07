<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
// deklarasi parameter koneksi database
$host     = "localhost";              // server database, default “localhost” atau “127.0.0.1”
$username = "root";                   // username database, default “root”
$password = "";                       // password database, default kosong
$database = "u4441694_db_antri";             // memilih database yang akan digunakan

// buat koneksi database
$conn = mysqli_connect($host, $username, $password, $database);

// cek koneksi
// jika koneksi gagal 
if (!$conn) {
  // tampilkan pesan gagal koneksi
  die('Koneksi Database Gagal : ' . mysqli_connect_error());
}

date_default_timezone_set("Asia/Jayapura");
$date_today=date("Y-m-d");

$query1 = $conn->query("SELECT * FROM `tb_antrian` WHERE called=1 ORDER BY updated_at DESC limit 1");
$query2 = $conn->query("SELECT COUNT(*) as jml_antrian FROM tb_antrian WHERE DATE(updated_at)='$date_today'");
$query3 = $conn->query("SELECT COUNT(*) as sisa_antrian FROM tb_antrian WHERE called=0 AND DATE(updated_at)='$date_today'");
$query4 = $conn->query("SELECT COUNT(*)+1 AS selanjutnya FROM tb_antrian WHERE called=1 AND DATE(updated_at)='$date_today'");

if ($query1->num_rows > 0) {
    while($row1 = $query1->fetch_assoc()){
        $antrian_saat_ini = $row1["no_antrian"];
    }
  }else{
        $antrian_saat_ini="0";
  }
  
$row1 = mysqli_fetch_array($query2);
$jml_antrian = $row1[0];

$row2 = mysqli_fetch_array($query3);
$sisa_antrian = $row2[0];

$row3 = mysqli_fetch_array($query4);
$antrian_selanjutnya = $row3[0];

echo"data: Antrian saat ini: {$antrian_saat_ini} <br>Total antrian: {$jml_antrian}<br> Antrian selanjutnya: {$antrian_selanjutnya}<br>Sisa antrian: {$sisa_antrian}\n\n";

flush();
?>
