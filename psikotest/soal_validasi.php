<?php
session_start();
if($_SESSION['user']==true)
	{
include "Proses/Connect.php";
$username = $_SESSION['user'];
$kodeunik=$_SESSION['kodeunik'];

$bagian = $_GET['bagian'];


if($bagian=="B")
{
	$strcekvalidasi = "SELECT CASE WHEN total < totalb THEN 'BELUM' ELSE 'SUDAH' END ket FROM
(SELECT count(1) total FROM psikotest_proses_test_b WHERE no_calon_kary='$username' AND kode_unik='$kodeunik' ) a,
(SELECT ROUND(count(1)/2) totalb FROM psikotest_b_soal) b";
	$backpage = "soal_b.php";
	$frontpage = "intro_c.php";
}
elseif($bagian=="C")
{
		$strcekvalidasi = "SELECT CASE WHEN total < totalb THEN 'BELUM' ELSE 'SUDAH' END ket,c.level FROM
((SELECT no_calon_kary,count(1) total FROM psikotest_proses_test_c WHERE no_calon_kary='$username' AND kode_unik='$kodeunik' ) a,
(SELECT ROUND(count(1)/2) totalb FROM psikotest_c_soal) b) LEFT OUTER JOIN
(SELECT id_calon_karyawan,b.level FROM datapribadi_ck a,list_jabatan b WHERE a.bagian=b.nama_jabatan AND id_calon_karyawan='$username') c
ON a.no_calon_kary=c.id_calon_karyawan";
	
	$backpage = "soal_c.php";
	$frontpage = "intro_d.php";
}
elseif($bagian=="D")
{
		$strcekvalidasi = "SELECT CASE WHEN total < totalb THEN 'BELUM' ELSE 'SUDAH' END ket FROM
(SELECT count(1) total FROM psikotest_proses_test_d WHERE no_calon_kary='$username' AND kode_unik='$kodeunik' ) a,
(SELECT count(1) totalb FROM psikotest_d_soal) b";
	$backpage = "soal_d.php";
	$frontpage = "intro_e.php";
}

$strxx = mysql_query($strcekvalidasi);
		while($row = mysql_fetch_row($strxx))
		{
			$cekvalidasi = $row[0];
			$level = $row[1];
		}

if($bagian=="C" && $level=="STAFF")
{
	$backpage = "soal_c.php";
	$frontpage = "intro_e.php";
}


if($cekvalidasi=="SUDAH")
{ ?>
	<img src="images/blank.jpg" onload="window.location = '<?php echo $frontpage; ?>'">
  <?php
}
else
{ ?>
	<img src="images/blank.jpg" onload="alert('Harap Jawab Semua Soal');">
<?php
}

mysql_close($id_mysql);


}
else
	{
		echo '<img src="images/blank.jpg" onload="location.reload();">';
	}
?>
	
      