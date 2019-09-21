<?php
session_start();
if($_SESSION['user']==true)
	{
include "Proses/Connect.php";
$username = $_SESSION['user'];
$kodeunik=$_SESSION['kodeunik'];
$nomor = $_GET['nomor'];
$jawaban = $_GET['jawaban'];
$ml = $_GET['ml'];

if($ml=="L") 
{$strcekdata="SELECT count(1) as cek FROM psikotest_proses_test_b WHERE jawaban=REPLACE('$jawaban','L','M') AND no_calon_kary='$username' AND kode_unik='$kodeunik'";} 
else 
{$strcekdata="SELECT count(1) as cek FROM psikotest_proses_test_b WHERE jawaban=REPLACE('$jawaban','M','L') AND no_calon_kary='$username' AND kode_unik='$kodeunik'";}

$strxx = mysql_query($strcekdata);
		while($row = mysql_fetch_row($strxx))
		{
			$soalke = $row[0];
		}


if($soalke<1)
{
	mysql_query("replace into psikotest_proses_test_b(no_calon_kary, kode_unik, bagiantest, soalno, jawaban, ml, createtime) values 	('$username','$kodeunik','B','$nomor','$jawaban','$ml',now())");
}
else
{
	echo '<img src="images/blank.jpg" onload="alert(\'Tidak Dapat Memilih Sifat Yang Sama\');location.reload();">';
}

mysql_close($id_mysql);







}
else
	{
		echo '<img src="images/blank.jpg" onload="location.reload();">';
	}
?>
	
      