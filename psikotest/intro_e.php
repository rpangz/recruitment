<?php session_start();
if($_SESSION['user']==true)
	{ 
	
	include "Proses/connect.php";
	$username = $_SESSION['user'];
	$kodeunik=$_SESSION['kodeunik'];
	mysql_query("UPDATE psikotest_data_kary SET end_d=now(),status='FINISH' WHERE no_calon_kary='$username' AND kode_unik='$kodeunik' AND status IN ('SOAL D','SOAL C')");
	
	?>
	

<html>

<style type="text/css">

.button {
   /* background-color: #4CAF50; /* Green */*/
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
	border-radius: 50%;
	background-color: white;
    color: black;
    border: 2px solid #4CAF50;
	-webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
	box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
}
.button:hover {
    background-color: #4CAF50; /* Green */
    color: white;
}
</style>

<div style="width:1300px;text-align:center; font-size:25px; font-weight:bold">TEST TELAH SELESAI . . .</div>
<br>
<div style="width:1300px;text-align:center; font-size:25px; font-weight:bold">Anda Berhasil Menyelesaikan TEST dengan baik, Semoga Berhasil . . .</div>
<div style="width:1300px;font-size:17px; text-align:center">
<br>
<br>
<a href="index.php"><button class="button">Finish</button></a>
</div>
</html>

<?php }
else
	{
		print ("<META HTTP-EQUIV = 'Refresh' Content = '0; URL =index.php'>");
	}
?>	