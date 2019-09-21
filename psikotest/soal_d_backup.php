<?php session_start();
if($_SESSION['user']==true)
	{
	include "Proses/connect.php";
	$username = $_SESSION['user'];
	$kodeunik = $_SESSION['kodeunik'];
	
	/*mysql_query("UPDATE psikotest_data_kary SET start_c=now(),status='SOAL C' WHERE no_calon_kary='$username' AND kode_unik='$kodeunik' AND start_c IS NULL AND status='START C'");
	
	$strxx = mysql_query("SELECT status FROM psikotest_data_kary p WHERE no_calon_kary = '$username' AND kode_unik='$kodeunik';");
		while($row = mysql_fetch_row($strxx))
		{
			$cekakses = $row[0];
		}
		
		if($cekakses!="SOAL C")
		{
			print ("<META HTTP-EQUIV = 'Refresh' Content = '0; URL =index.php'>");
		}*/

	
	
	
?>
<html>
<head>
<script type="text/javascript">

function SimpanJawaban(nomor,jawaban)
{
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("tempdiv").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","soal_c_simpan.php?nomor="+nomor+"&jawaban="+jawaban,true);
xmlhttp.send();
}
</script>
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
</head>
<body>
<div style="width:100%; border:solid #999999 1pt;background-color:#CCCCCC;" align="center"><b>TEAMWORK TEST</b></div>
<div style="width:100%; border:solid #999999 1pt;background-color:#CCCCCC;">
<b><u>PETUNJUK PELAKSANAAN TEST : <u></b> <br>
Buatlah ranking terhadap 8 pernyataan dalam setiap bagian dari nilai 1 sampai dengan 8. <br>
8 = Pernyataan yang paling cocok menggambarkan/paling penting bagi diri anda. <br>
1 = Pernyataan yang paling tidak cocok/paling tidak penting bagi diri anda.
</div>

<div id="luarbody" style="width:80%; float:left">

<?php

$strs = mysql_query("SELECT soalke,subsoal FROM psikotest_d_soal p WHERE subsoal IS NOT NULL;");
					while($row2 = mysql_fetch_row($strs))
					{
						$soalke = $row2[0];
						$subsoal = $row2[1];

?>


	<div id="bagian_soal_<?php echo $soalke; ?>">
	<div id="subsoal_<?php echo $soalke; ?>" style="font-weight:bold">
	BAGIAN <?php echo $soalke; ?>. <?php echo $subsoal; ?>
	</div>
		<div id="soal_1">
			<select name="combo01_01" id="combo01_01" >
						<option value=""></option>
						<?php
							$strs = mysql_query("select * from view_combo_soal_d");
							while($row2 = mysql_fetch_row($strs))
							{
								print("<option value=$row2[0]>$row2[0]</option>");
							}
						?>
						  </select>
						  Saya cepat dalam melihat dan memanfaatkan kesempatan
						  
		
		
		
		
		</div>
	
	
	
	
	
	
	</div>

<?php
	}
?>


</div>

<!--<a href="intro_d.php"><button class="button">Selesai</button></a>-->
<div id="tempdiv"></div>
</body>
</html>

<?php }
else
	{
		print ("<META HTTP-EQUIV = 'Refresh' Content = '0; URL =index.php'>");
	}
?>	