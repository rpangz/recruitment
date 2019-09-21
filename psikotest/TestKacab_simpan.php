<?php
session_start();
include "Proses/Connect151.php";
$userlogin = $_SESSION['user'];
$userkodecbg = $_SESSION['kodecbg'];
$nomor = $_GET['nomor'];
$jawaban = $_GET['jawaban'];

mysql_query("replace into soal_test_jawab values('KACAB','TIPEB',$nomor,'$userlogin','$userkodecbg','$jawaban',now())");
$result2 = mysql_query("select case when (now()>'2017-01-27 10:30:00' and now()<'2017-01-27 15:17:01') THEN 'TRUE' ELSE 'FALSE' END"); 
while ($row2 = mysql_fetch_array($result2)) 
{
	$habis=$row2[0];
}
if($habis=="FALSE" || $userlogin=="")
{
	echo '<img src="images/siputih.jpg" onload="location.reload();">';
}

mysql_close($id_mysql);
?>
	
      