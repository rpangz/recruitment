<?php session_start();
if($_SESSION['user']==true)
	{ 
	
	include "Proses/connect.php";
	$username = $_SESSION['user'];
	$kodeunik=$_SESSION['kodeunik'];
	mysql_query("UPDATE psikotest_data_kary SET end_b=now(),status='START C' WHERE no_calon_kary='$username' AND kode_unik='$kodeunik' AND status='SOAL B'");
	
	$strxx = mysql_query("SELECT status FROM psikotest_data_kary p WHERE no_calon_kary = '$username' AND kode_unik='$kodeunik';");
		while($row = mysql_fetch_row($strxx))
		{
			$cekakses = $row[0];
		}
		
		if($cekakses!="START C")
		{
			print ("<META HTTP-EQUIV = 'Refresh' Content = '0; URL =index.php'>");
		}
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

<div style="width:1300px;text-align:center; font-size:25px; font-weight:bold">Instruksi Papikostik</div>
<div style="width:1300px;text-align:center; font-size:25px; font-weight:bold">PERHATIKAN INSTUKSINYA BAIK – BAIK !!</div>
<br>
<div style="width:1300px;font-size:17px;">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pada tes kali ini terdapat 90 soal, yang setiap soal akan terdiri dari 2 pernyataan, pernyataan <b>A</b> dan <b>B</b>. Tugas anda adalah memilih salah satu pernyataan tersebut sesuai dengan diri anda, apabila nanti ada 2 pernyataan yg keduanya sesuai dengan diri anda, silahkan pilih satu pernyataan yang paling sesuai dengan diri anda, atau sebaliknya kalau kedua pernyataan tidak sesuai, Anda tetap harus memilih salah satu yang mendekati dengan diri Anda. Cara menjawabnya adalah dengan memilih salah satu pernyatan <b>A</b> atau <b>B</b>. </div>
<br>
<div style="width:1300px;font-size:17px;"> 
jawaban tidak ada yang benar atau salah, jadi silahkan isi sesuai dengan diri Anda.
</div>
<br>
<div style="width:1300px;font-size:17px;"> 
apabila sudah paham silahkan klik tombol start untuk memulainya, maka secara otomatis waktu sudah mulai berjalan dan tidak bisa kembali lagi ke tes sebelumnya atau ke instruksi.
</div>
<br>
<div style="width:1300px;font-size:17px; text-align:center"> 
Selamat Mengerjakan dan semoga sukses !!!
</div>
<br>
<br>
<div style="width:1300px;font-size:17px; text-align:center"> 
<a href="soal_c.php"><button class="button">Start</button></a>
</div>
</html>

<?php }
else
	{
		print ("<META HTTP-EQUIV = 'Refresh' Content = '0; URL =index.php'>");
	}
?>	