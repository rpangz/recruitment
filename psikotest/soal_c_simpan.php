<?php
session_start();
if($_SESSION['user']==true)
	{
include "Proses/Connect.php";
$username = $_SESSION['user'];
$kodeunik=$_SESSION['kodeunik'];
$nomor = $_GET['nomor'];
$jawaban = $_GET['jawaban'];


mysql_query("replace into psikotest_proses_test_c(no_calon_kary, kode_unik, bagiantest, soalno, jawaban, createtime) values ('$username','$kodeunik','C','$nomor','$jawaban',now())");

mysql_close($id_mysql);
}
else
	{
		echo '<img src="images/blank.jpg" onload="location.reload();">';
	}
?>
	
      