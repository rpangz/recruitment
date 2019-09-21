<?php 
include('../../../koneksi.php');
?>


<?php

$jenis=$_GET['jenis'];
$querystr = $_GET['querystr'];

$input = explode("|",$querystr);


$skill = $input[0];
$syarat_ijasah = $input[1];
$nama_kenalan = $input[2];
$hubungan_kenalan = $input[3];
$jabatan_kenalan = $input[4];
$prestasi_ck = $input[5];
$kesehatan = $input[6];
$penempatan_di_cabang = $input[7];
$id_calon_karyawan = $input[8];
$kelebihan_prestasi_ck = $input[9];
$kekurangan_prestasi_ck = $input[10];




	//input ke db
	$query = sprintf("REPLACE INTO dataskill_ck VALUES('$id_calon_karyawan','$skill','$syarat_ijasah','$nama_kenalan','$hubungan_kenalan','$jabatan_kenalan','$prestasi_ck','$kelebihan_prestasi_ck','$kekurangan_prestasi_ck','$penempatan_di_cabang','$kesehatan')");
		
	$sql = mysql_query($query);

	if ($sql) {
		echo "Data Berhasil Diinput";
	}
	else {
		echo "Data Gagal Diinput";
	}
	

?>
