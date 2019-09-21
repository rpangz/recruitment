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