<?php
function tgl_indo($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan   = getBulan(substr($tgl,5,2));
			$tahun   = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun;		 
	}
	function getBulan($bln){
				switch ($bln){
					case 1: 
						return "Januari";
						break;
					case 2:
						return "Februari";
						break;
					case 3:
						return "Maret";
						break;
					case 4:
						return "April";
						break;
					case 5:
						return "Mei";
						break;
					case 6:
						return "Juni";
						break;
					case 7:
						return "Juli";
						break;
					case 8:
						return "Agustus";
						break;
					case 9:
						return "September";
						break;
					case 10:
						return "Oktober";
						break;
					case 11:
						return "November";
						break;
					case 12:
						return "Desember";
						break;
				}
				
				
		
			} 
			
function relative_format($time)
{
	// ubah format input menjadi unix time
	$unix_time = strtotime($time);
	// simpan waktu sekarang
	$now = time();

	// hitung perbedaan waktu input dan waktu sekarang (satuan detik)
	$time_diff = $now - $unix_time;

	switch (TRUE) {
		case ($unix_time > strtotime('-1 min', $now)):
			// waktu input tidak sampai 1 menit yang lalu
			$relative_time = 'Beberapa waktu yang lalu';
			break;
		case ($unix_time > strtotime('-1 hour', $now)):
			// waktu input antara 1 menit - 1 jam yang lalu
			$relative_time = floor($time_diff / 60) . ' menit yang lalu';
			break;
		case ($unix_time > strtotime('-1 day', $now)):
			// waktu input antara 1 jam - 1 hari yang lalu
			$relative_time = floor($time_diff / 60 / 60) . ' jam yang lalu';
			break;
		default:
			// waktu input lebih dari 1 hari yang lalu
			$relative_time = 'Beberapa hari yang lalu';
	}

	return $relative_time;
}

function MasaKerja($tgl_masuk,$tahun_sekarang,$bulan_sekarang,$tanggal_sekarang){
if($tgl_masuk=='0000-00-00'){
	return 0;
}else{
	$date1 = $tgl_masuk;
	$date2 = $tahun_sekarang.'-'.$bulan_sekarang.'-'.$tanggal_sekarang;

	$ts1 = strtotime($date1);
	$ts2 = strtotime($date2);

	$year1 = date('Y', $ts1);
	$year2 = date('Y', $ts2);

	$month1 = date('m', $ts1);
	$month2 = date('m', $ts2);

	$day1 = date('d', $ts1);
	$day2 = date('d', $ts2);

	$diff = (($year2 - $year1) * 12) + ($month2 - $month1);

	$tahun=round($diff/12);
	if(!is_integer($diff/12)){
		$tahun=$tahun-1;
	}
	if($tahun < 10){
		$tahun='0'.$tahun;
	}
	$sisabulan=$diff % 12;

	if($sisabulan < 10){
		$sisabulan=$sisabulan. ' Bulan ';
	}
	$data['jumlah_bulan']=$diff;
	

	$d1 = new DateTime($date1);
	$d2 = new DateTime($date2);

	$diff = $d2->diff($d1);

	$data['masa_kerja']=$diff->y.' Tahun '.$sisabulan;
	return $data;
	}
}


function MasaKerjaBulan($tgl_masuk,$tahun_sekarang,$bulan_sekarang,$tanggal_sekarang){
if($tgl_masuk=='0000-00-00'){
	return 0;
}else{
	$date1 = $tgl_masuk;
	$date2 = $tahun_sekarang.'-'.$bulan_sekarang.'-'.$tanggal_sekarang;

	$ts1 = strtotime($date1);
	$ts2 = strtotime($date2);

	$year1 = date('Y', $ts1);
	$year2 = date('Y', $ts2);

	$month1 = date('m', $ts1);
	$month2 = date('m', $ts2);

	$day1 = date('d', $ts1);
	$day2 = date('d', $ts2);

	$diff = (($year2 - $year1) * 12) + ($month2 - $month1);


	$sisabulan=$diff % 12;


	
	return $sisabulan;
	}
}


function MasaKerjaTahun($tgl_masuk,$tahun_sekarang,$bulan_sekarang,$tanggal_sekarang){
if($tgl_masuk=='0000-00-00'){
	return 0;
}else{
	$date1 = $tgl_masuk;
	$date2 = $tahun_sekarang.'-'.$bulan_sekarang.'-'.$tanggal_sekarang;

	$ts1 = strtotime($date1);
	$ts2 = strtotime($date2);

	$year1 = date('Y', $ts1);
	$year2 = date('Y', $ts2);

	$month1 = date('m', $ts1);
	$month2 = date('m', $ts2);

	$day1 = date('d', $ts1);
	$day2 = date('d', $ts2);

	$diff = (($year2 - $year1) * 12) + ($month2 - $month1);

	$tahun=round($diff/12);
	if(!is_integer($diff/12)){
		$tahun=$tahun-1;
	}
	if($tahun < 10){
		$tahun='0'.$tahun;
	}
	
	$d1 = new DateTime($date1);
	$d2 = new DateTime($date2);

	$diff = $d2->diff($d1);
	
	return $diff->y;
	}
}

//date_default_timezone_set('Asia/Jakarta');
$tahunM=date("Y");
$bulanM=date("m");
$tanggalM=date("d");

//cara menggunakannya:
// $masakerja=MasaKerja('2017-04-05',$tahun,$bulan,$tanggal);

// $masakerjabulan=MasaKerjaBulan('2017-04-05',$tahun,$bulan,$tanggal);

// $masakertahun=MasaKerjaTahun('2016-04-05',$tahunM,$bulanM,$tanggalM);
// //$row['tgl_masuk'] adalah tanggal masuk atau TMT pegawai

// // //untuk menampilkannya gunakan ini:
// // echo $masakerja['masa_kerja'];
// // echo"<br>";
// // echo $masakerjabulan;
// // echo"<br>";
// echo $masakertahun;
?>