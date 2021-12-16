<?php
function tgl_indo($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
 
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

function hariIndo ($hariInggris) {
	switch ($hariInggris) {
	  case 'Sunday':
		return 'Minggu';
	  case 'Monday':
		return 'Senin';
	  case 'Tuesday':
		return 'Selasa';
	  case 'Wednesday':
		return 'Rabu';
	  case 'Thursday':
		return 'Kamis';
	  case 'Friday':
		return 'Jumat';
	  case 'Saturday':
		return 'Sabtu';
	  default:
		return 'hari tidak valid';
	}
  }

?>