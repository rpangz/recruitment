<?php
include('../../koneksi.php');
include('../../session.php');

$id_calon_karyawan = $_GET['id_calon_karyawan'];
$keterangan_hasil = $_GET['keterangan_hasil'];

  $jumlah_jawaban = mysql_query("SELECT count(1) FROM hasil_psikotest where id_calon_karyawan='$id_calon_karyawan'");
   $row = mysql_fetch_row($jumlah_jawaban);
	$tot = $row[0];

if ($tot <= 16) {
	if ($keterangan_hasil== "") {
		echo "Harap Pilih Keterangan Hasil";
	}else 
	{

		$query = sprintf("update datapribadi_ck set hasil_test='$keterangan_hasil' where id_calon_karyawan='$id_calon_karyawan'");
		$sql = mysql_query($query);
		if ($sql) {
			echo "Data Berhasil Diinput";
		}
		else {
			echo $query;
		}
	}
}
else
{
	echo "Harap Lengkapi Hasil Test";
}


?>
	