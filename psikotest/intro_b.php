<?php session_start();
if($_SESSION['user']==true)
	{ 
	
	include "Proses/connect.php";
	$username = $_SESSION['user'];
	$kodeunik=$_SESSION['kodeunik'];
	
	mysql_query("UPDATE psikotest_data_kary SET end_a=now(),status='START B' WHERE no_calon_kary='$username' AND kode_unik='$kodeunik' AND status='SOAL A'");
	
		$strxx = mysql_query("SELECT status FROM psikotest_data_kary p WHERE no_calon_kary = '$username' AND kode_unik='$kodeunik';");
		while($row = mysql_fetch_row($strxx))
		{
			$cekakses = $row[0];
		}
		
		if($cekakses!="START B")
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
<div style="width:1300px;text-align:center; font-size:25px; font-weight:bold">Instruksi PCT Analyst</div>
<div style="width:1300px;text-align:center; font-size:25px; font-weight:bold">PERHATIKAN INSTUKSINYA BAIK – BAIK !!</div>
<br>
<div style="width:1300px;font-size:17px;">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pada tes kali ini disediakan 24 soal, dimana setiap soal terdiri dari 4 pernyataan. Nanti tugas Anda adalah memilih salah satu pernyataan dikolom <b>M</b> (yang sesuai /mendekati sesuai) dan memilih salah satu pernyataan di kolom <b>L</b> (yg kurang sesuai / tdk sesuai). Jadi setiap soal harus ada 1 jawaban <b>“ M “ </b>dan 1 jawaban <b>“L”</b> , ingat……!!!!! 1 pernyataan hanya boleh untuk 1 jawaban saja atau tidak boleh dalam satu pernyataan di isi <b>M</b> dan <b>L</b>.. Paham…..!!!!!!! </div>
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
<a href="soal_b.php"><button class="button">Start</button></a>
</div>
</html>

<?php }
else
	{
		print ("<META HTTP-EQUIV = 'Refresh' Content = '0; URL =index.php'>");
	}
?>	