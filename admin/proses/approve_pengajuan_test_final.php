<?php 
include('../koneksi.php');
include('../session.php');
?>


<?php

$jenis=$_GET['jenis'];
$querystr = $_GET['querystr'];

$input = explode("|",$querystr);

$id_calon_karyawan = $input[0];
$password_test = $input[1];




	//input ke db
	$query = sprintf("UPDATE datapribadi_ck set status='approve', create_user='$id_user' where id_calon_karyawan='$id_calon_karyawan'");
		
	$sql = mysql_query($query);

	if ($sql) {
		echo "Data Berhasil Diinput";
	}
	else {
		echo "Data Gagal Diinput";
	}

	$query2 = sprintf("INSERT INTO psikotest_data_kary (no_calon_kary, kode_unik, start_a, part_a, end_a, start_b, end_b, start_c, end_c, start_d, end_d, status) values ('$id_calon_karyawan','$password_test', null, null, null, null, null, null, null, null, null, 'START')");
		
	$sql2 = mysql_query($query2);
	
?>
