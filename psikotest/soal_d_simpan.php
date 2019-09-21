<?php
session_start();
if($_SESSION['user']==true)
	{
include "Proses/Connect.php";
$username = $_SESSION['user'];
$kodeunik=$_SESSION['kodeunik'];
$nomor = $_GET['nomor'];
$jawaban = $_GET['jawaban'];
$subsoal = $_GET['subsoal'];

	if($jawaban=="")
	{
		mysql_query("DELETE FROM psikotest_proses_test_d WHERE no_calon_kary = '$username' AND kode_unik='$kodeunik' AND bagiantest=$subsoal AND soalno = $nomor");
	}
	else
	{
		mysql_query("replace into psikotest_proses_test_d(no_calon_kary, kode_unik, bagiantest, soalno, jawaban, createtime) values ('$username','$kodeunik','$subsoal','$nomor','$jawaban',now())");	
	}
	echo '<img src="images/blank.jpg" onload="location.reload();">';
	mysql_close($id_mysql);
}
else
	{
		echo '<img src="images/blank.jpg" onload="location.reload();">';
	}
?>
	
      