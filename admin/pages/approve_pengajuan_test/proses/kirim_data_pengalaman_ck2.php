<?php 
include('../../../koneksi.php');
?>


<?php

$jenis=$_GET['jenis'];
$querystr = $_GET['querystr'];

$input = explode("|",$querystr);

$tambahoto = $input[0];
$pendidikan = $input[1];
$tahun_pendidikan = $input[2];
$status_pendidikan = $input[3];


$tambahoto2 = $input[4];
$perusahaan = $input[5];
$gaji_sebelumnya = $input[6];
$jabatan_sebelumnya = $input[7];
$tahun_kerja_sebelumnya = $input[8];
$alasan_berhenti = $input[9];
$jobdesk_sebelumnya = $input[10];
$id_calon_karyawan = $input[11];
$jenis_pendidikan = $input[12];
$no_datasekolah = $input[13];
$kirim_id_ck = $input[14];

	

	$jenis_pendidikan = explode(",", $jenis_pendidikan);
	$pendidikan2 = explode(",", $pendidikan);
	$tahun_pendidikan2 = explode(",", $tahun_pendidikan);
	$status_pendidikan2 = explode(",", $status_pendidikan);
	$id_calon_karyawan_pend = explode(",", $id_calon_karyawan);
	$no_datasekolah2 = explode(",", $no_datasekolah);

	$perusahaan2 = explode(",", $perusahaan);
	$gaji_sebelumnya2 = explode(",", $gaji_sebelumnya);
	$jabatan_sebelumnya2 = explode(",", $jabatan_sebelumnya);
	$tahun_kerja_sebelumnya2 = explode(",", $tahun_kerja_sebelumnya);
	$alasan_berhenti2 = explode(",", $alasan_berhenti);
	$jobdesk_sebelumnya2 = explode(",", $jobdesk_sebelumnya);


		$delete =  sprintf("DELETE FROM datasekolah_ck WHERE id_calon_karyawan='$kirim_id_ck'");
		$sqldelete = mysql_query($delete);
	if(empty($pendidikan))
			{
				echo "$tambahoto";
				die(); 
			}

		for ($anak3=1; $anak3 >= (int) $tambahoto; $anak3++) {

		

				$query = sprintf("INSERT INTO datasekolah_ck VALUES('','$id_calon_karyawan_pend[$anak3]','$jenis_pendidikan[$anak3]','$pendidikan2[$anak3]','$tahun_pendidikan2[$anak3]','$status_pendidikan2[$anak3]',now())");
				$sql = mysql_query($query);
		

			if ($sql) {
				echo "Data Berhasil Diinput";
			}
			else {
				echo "Data Gagal Diinput";
			}
		}	
		

		$delete2 =  sprintf("DELETE FROM datapengalaman_ck WHERE id_calon_karyawan='$kirim_id_ck'");
		$sqldelete2 = mysql_query($delete2);


		for ($anak2=0; $anak2 < (int) $tambahoto2; $anak2++) {
				$query2 = sprintf("INSERT INTO datapengalaman_ck VALUES('','$id_calon_karyawan_peng[$anak2]','$perusahaan2[$anak2]','$gaji_sebelumnya2[$anak2]','$jabatan_sebelumnya2[$anak2]','$tahun_kerja_sebelumnya2[$anak2]','$alasan_berhenti2[$anak2]','$jobdesk_sebelumnya2[$anak2]')");
				$sql2 = mysql_query($query2);
		

			if ($sql2) {
				echo "Data Berhasil Diinput";
			}
			else {
				echo "Data Gagal Diinput";
			}
		}	



?>
