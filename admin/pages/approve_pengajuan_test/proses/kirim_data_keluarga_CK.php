<?php 
include('../../../koneksi.php');
?>


<?php

$jenis=$_GET['jenis'];
$querystr = $_GET['querystr'];

$input = explode("|",$querystr);


$nama_ayah = $input[0];
$pekerjaan_ayah = $input[1];
$nama_ibu = $input[2];
$pekerjaan_ibu = $input[3];
$telp_ortu = $input[4];
$alamat_ortu = $input[5];
$status_rumah_ortu = $input[6];
$saudara1 = $input[7];
$alamat_saudara1 = $input[8];
$status_rumah_saudara1 = $input[9];
$telp_saudara1 = $input[10];
$saudara2 = $input[11];
$alamat_saudara2 = $input[12];
$status_rumah_saudara2 = $input[13];
$telp_saudara2 = $input[14];

// $tambahoto = $input[15];
$nama_sutri = $input[15];
$alamat_sutri = $input[16];
$status_rumah_sutri = $input[17];

$id_calon_karyawan = $input[18];
$nama_anak = $input[19];
$ttl_anak = $input[20];
$jenis_kelamin_anak = $input[21];



	
/*
$nama_anak2 .= $rows2['nama_anak']."|";
$ttl_anak2 .= $rows2['ttl_anak'].",";
$jenis_kelamin_anak .= $rows2['jenis_kelamin_anak'].",";

	$nama_sutri2 = explode(",", $nama_sutri);
	$alamat_sutri2 = explode(",", $alamat_sutri);
	$status_rumah_sutri2 = explode(",", $status_rumah_sutri);*/

/*	$nama_anak2 = explode(",",$nama_anak);
	$ttl_anak2 = explode(",",$ttl_anak);
	$jenis_kelamin_anak2 = explode(",",$jenis_kelamin_anak);*/


	//input ke db
	$query = sprintf("REPLACE INTO datakeluarga_ck VALUES('$id_calon_karyawan','$nama_ayah','$pekerjaan_ayah','$nama_ibu','$pekerjaan_ibu','$telp_ortu','$alamat_ortu','$status_rumah_ortu','$saudara1','$alamat_saudara1','$status_rumah_saudara1','$telp_saudara1','$saudara2','$alamat_saudara2','$status_rumah_saudara2','$telp_saudara2')");
	$sql = mysql_query($query);

	if ($sql) {
		echo "Data Berhasil Diinput";
	}
	else {
		echo "Data Gagal Diinput";
	}

/*
	$query1 = sprintf("REPLACE INTO datasutri_ck VALUES('$id_calon_karyawan', '$nama_sutri' ,'$alamat_sutri','$status_rumah_sutri','','','')");
	$sql1 = mysql_query($query1);

	if ($sql1) {
		echo "Data Berhasil Diinput";
	}
	else {
		echo "Data Gagal Diinput";
	}*/



	$query2 = sprintf("REPLACE INTO datasutri_ck VALUES('$id_calon_karyawan', '$nama_sutri' ,'$alamat_sutri','$status_rumah_sutri','$nama_anak','$ttl_anak','$jenis_kelamin_anak')");
	$sql2 = mysql_query($query2);

	if ($sql2) {
		echo "Data Berhasil Diinput";
	}
	else {
		echo "Data Gagal Diinput";
	}
	






?>
