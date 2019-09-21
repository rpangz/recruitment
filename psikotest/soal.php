<?php session_start(); ?>

<title>Psikotest</title><?php
include "Proses/connect.php";


$username = $_SESSION['user'];
$password=$_SESSION['kodeunik'];
$jenis=$_REQUEST['jenis'];
$bagiantest=$_REQUEST['bagiantest'];
$soal=$_REQUEST['soal'];
$jawaban=$_REQUEST['jawaban'];



if($jenis=="INSERT")
{
	mysql_query("REPLACE into psikotest_proses_test values ('$username','$password','$bagiantest','$soal','$jawaban',now())");
		
		$st3 = mysql_query("SELECT COUNT(1),c.part_a FROM (psikotest_a_soal a,psikotest_data_kary c) LEFT OUTER JOIN (SELECT * FROM psikotest_proses_test WHERE no_calon_kary='$username' AND kode_unik='$password') b ON a.soalke=b.soalno AND a.bagke=b.bagiantest WHERE c.no_calon_kary='$username' AND c.kode_unik='$password' AND b.soalno IS NULL and a.bagke=c.part_a");
	while($row3 = mysql_fetch_row($st3))
		{
			$totalcount = $row3[0];
			$part_a = $row3[1];
		}
		
		if($totalcount<1)
		{
			if($part_a=="E")
			{?> <img src="index_files/a.JPG" onload="alert('Soal Untuk Test Ini Sudah Habis, Klik OK Untuk Test Berikutnya');window.location = 'intro_b.php';" style="display:none" /> <?php }
			else
			{
				mysql_query("UPDATE psikotest_data_kary
							SET part_a=
							CASE WHEN part_a IS NULL THEN 'A' ELSE
							CASE WHEN part_a = 'A' THEN 'B' ELSE
							CASE WHEN part_a = 'B' THEN 'C' ELSE
							CASE WHEN part_a = 'C' THEN 'D' ELSE
							CASE WHEN part_a = 'D' THEN 'E'
							END END END END END
							WHERE no_calon_kary='$username' AND kode_unik='$password'");
			}
		}
}



/*$st = mysql_query("SELECT CASE WHEN MAX(bagiantest) IS NULL THEN 'A' ELSE MAX(bagiantest) END bagiantest,
CASE WHEN MAX(soalno) IS NULL THEN '1' ELSE MAX(soalno)+1 END soalno FROM psikotest_proses_test WHERE no_calon_kary='$username' AND kode_unik='$password'
AND bagiantest IN (
SELECT CASE WHEN MAX(bagiantest) IS NULL THEN 'A' ELSE MAX(bagiantest) END FROM psikotest_proses_test WHERE no_calon_kary='$username' AND kode_unik='$password')");



	while($row = mysql_fetch_row($st))
	{
    	$bagiantest = $row[0];
		$soalno = $row[1];
	}
*/

/*$st = mysql_query("SELECT max(soalke) FROM psikotest_a_soal");
	while($row = mysql_fetch_row($st))
	{
    	$banyaksoal = $row[0];
	}
*/



		include "soal_a.php"; 



?>