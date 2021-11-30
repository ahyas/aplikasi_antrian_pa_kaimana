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
$sql = $conn->query("SELECT * FROM `tb_antrian` ORDER BY updated_at DESC limit 1");
if ($sql->num_rows > 0) {
    while($row = $sql->fetch_assoc()){
        $result = $row["no_antrian"];
    }
  }else{
        $result="0 results";
  }
echo"data:Nomor antrian {$result}\n\n";
flush();
?>
