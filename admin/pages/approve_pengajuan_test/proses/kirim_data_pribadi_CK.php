<?php 
include('../../../koneksi.php');
?>


<?php

$jenis=$_GET['jenis'];
$querystr = $_GET['querystr'];

$input = explode("|",$querystr);

$no_ktp = $input[0];
$nama_lengkap = $input[1];
$tempatlahir = $input[2];
$tanggal_lahir = $input[3];
$jen_kel = $input[4];
$status_perkawinan = $input[5];
$alamat_domisili = $input[6];
$alamat_ktp = $input[7];
$status_rumah = $input[8];
$agama = $input[9];
$warga_negara = $input[10];
$telp1 = $input[11];
$telp2 = $input[12];
$alamat_email = $input[13];
$facebook_id = $input[14];
$instagram_id = $input[15];
$tweeter_id = $input[16];
$divisi = $input[17];
$bagian = $input[18];
$gaji = $input[19];
$id_calon_karyawan = $input[20];
$sumber_lamaran = $input[21];
$cabang = $input[22];


	$query0 = mysql_query("select id_calon_karyawan from datapribadi_ck where id_calon_karyawan='$id_calon_karyawan'");
                    while ($r = mysql_fetch_row($query0)) {
                    $id = $r['0'];
                }

	//input ke db
	$query = sprintf("REPLACE INTO datapribadi_ck VALUES('$id_calon_karyawan','$no_ktp','$nama_lengkap','$tempatlahir','$tanggal_lahir','$jen_kel','$status_perkawinan','$alamat_domisili','$alamat_ktp','$status_rumah','$agama','$warga_negara','$telp1','$telp2','$alamat_email','$facebook_id','$instagram_id','$tweeter_id','$divisi','$bagian','$gaji','$cabang','$sumber_lamaran',now(),'useradm_approve','','')");
		
	$sql = mysql_query($query);

	if ($sql) {
		echo "Data Berhasil Diinput";
	}
	else {
		echo "Data Gagal Diinput";
	}
	
?>
