<?php 
include('../koneksi.php');
$ipaddress = $_SERVER['REMOTE_ADDR'];
?>


<?php

$jenis=$_GET['jenis'];
$querystr = $_GET['querystr'];

$input = explode("|",$querystr);


$id_calon_karyawan = $input[0];


if ($id_calon_karyawan=="") {
		echo "Data Gagal Diinput";
}
else{


	$query2 = sprintf("update datapribadi_ck SET status='DONE' where id_calon_karyawan='$id_calon_karyawan'");
		
	$sql2 = mysql_query($query2);
	
	$queryip= sprintf("REPLACE INTO log_ip VALUES ('$id_calon_karyawan','$ipaddress',NOW())");
	$sqlip = mysql_query($queryip);


	if ($sql2) {
		echo "Data berhasil di Finish";
	}
	else {
		echo "<script>
		alert('Data Gagal diInput');
		window.location.href='../index.php';
		</script>";
	}
	
}
?>
