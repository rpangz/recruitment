<?php session_start();
if($_SESSION['user']==true)
	{
	include "Proses/connect.php";
	$username = $_SESSION['user'];
	$kodeunik = $_SESSION['kodeunik'];
	
	mysql_query("UPDATE psikotest_data_kary SET start_d=now(),status='SOAL D' WHERE no_calon_kary='$username' AND kode_unik='$kodeunik' AND start_d IS NULL AND status='START D'");
	
	$strxx = mysql_query("SELECT status FROM psikotest_data_kary p WHERE no_calon_kary = '$username' AND kode_unik='$kodeunik';");
		while($row = mysql_fetch_row($strxx))
		{
			$cekakses = $row[0];
		}
		
		if($cekakses!="SOAL D")
		{
			print ("<META HTTP-EQUIV = 'Refresh' Content = '0; URL =index.php'>");
		}
		
		/*$strxx = mysql_query("SELECT waktu FROM psikotest_spek_timer WHERE bagian = 'D'");
		while($row = mysql_fetch_row($strxx))
		{
			$waktu = $row[0];
		}
	
		
		$st = mysql_query("SELECT CASE WHEN TIMESTAMPDIFF(SECOND,b.start_b,max(createtime)) IS NULL THEN 'MULAI' ELSE $waktu-TIMESTAMPDIFF(SECOND,b.start_d,max(createtime)) END FROM psikotest_proses_test_d a,psikotest_data_kary b WHERE a.no_calon_kary=b.no_calon_kary AND a.kode_unik=b.kode_unik AND b.no_calon_kary='$username' AND b.kode_unik='$kodeunik'");

	
		while($row = mysql_fetch_row($st))
		{
			$detik = $row[0];
		}
		if($detik == "MULAI")
		{?> <img src="index_files/a.JPG" onload="playtime('<?php echo $waktu; ?>')" style="display:none" /> <?php }
		else
		{
			if ($detik <= 0)
				{?> <img src="index_files/a.JPG" onload="playtime('0')" style="display:none" /> <?php }
			else
				{?> <img src="index_files/a.JPG" onload="playtime('<?php echo $detik; ?>')" style="display:none" /> <?php }
		
		}

	*/
	
	
?>
<html>
<head>
<script type="text/javascript">

function SimpanJawaban(subsoal,nomor,jawaban)
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

xmlhttp.open("GET","soal_d_simpan.php?subsoal="+subsoal+"&nomor="+nomor+"&jawaban="+jawaban,true);
xmlhttp.send();
}

function Validate(bagian)
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
xmlhttp.open("GET","soal_validasi.php?bagian="+bagian,true);
xmlhttp.send();
}

function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10)
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (--timer < 0) {
            timer = duration;
			alert("Waktu Anda Sudah Habis, Klik OK Untuk Test Berikutnya");
			window.location = "intro_d.php";
        }
    }, 1000);
}


function playtime(waktu) {
    var fiveMinutes = waktu,
        display = document.querySelector('#timer');
    startTimer(fiveMinutes, display);
};

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
<div style="width:90%; float:left; text-align:right; position:fixed; font-weight:bold"><button class="button" onClick="Validate('D')">Selesai</button></div>
<div style="width:100%; border:solid #999999 1pt;background-color:#CCCCCC;">
<b><u>PETUNJUK PELAKSANAAN TEST : </u></b> <br>
Buatlah ranking terhadap 8 pernyataan dalam setiap bagian dari nilai 1 sampai dengan 8. <br>
8 = Pernyataan yang paling cocok menggambarkan/paling penting bagi diri anda. <br>
1 = Pernyataan yang paling tidak cocok/paling tidak penting bagi diri anda.
</div>

<div id="luarbody" style="width:80%; float:left">

<?php

$strs = mysql_query("SELECT soalke,subsoal FROM psikotest_d_soal p WHERE subsoal IS NOT NULL");
							while($row = mysql_fetch_row($strs))
							{
								$soalke = $row[0];
								$subsoal = $row[1];	
							?>

	<div id="bagian_soal_<?php echo $soalke; ?>">
		<div id="subsoal_<?php echo $soalke; ?>" style="font-weight:bold">
			BAGIAN <?php echo $soalke; ?>. <?php echo $subsoal; ?>
		</div>
		<div id="isisoal_<?php echo $soalke; ?>">
		<?php 
		$strs3 = mysql_query("SELECT bagke,keterangan  FROM psikotest_d_soal WHERE soalke = $soalke");
							while($row3 = mysql_fetch_row($strs3))
							{
								$bagke = $row3[0];
								$keterangan = $row3[1];

							?>
								
								<div id="soal_<?php echo $soalke; ?>_<?php echo $bagke; ?>">
			<select onChange="SimpanJawaban(<?php echo $soalke; ?>,<?php echo $bagke; ?>,this.value)" name="combo_<?php echo $soalke; ?>_<?php echo $bagke; ?>" id="combo_<?php echo $soalke; ?>_<?php echo $bagke; ?>" >
						<option value=""></option>
						<?php
							$strs2 = mysql_query("SELECT * FROM (
SELECT jawaban,'selected' selected FROM psikotest_proses_test_d p WHERE bagiantest = $soalke AND soalno = $bagke AND no_calon_kary = '$username' and kode_unik = '$kodeunik' UNION ALL
SELECT bagke,''  FROM psikotest_d_soal a LEFT OUTER JOIN
(SELECT * FROM psikotest_proses_test_d WHERE no_calon_kary = '$username' and kode_unik = '$kodeunik' and bagiantest=$soalke) b
ON a.bagke=b.jawaban WHERE a.soalke=$soalke and b.soalno IS NULL ) a order by jawaban");





							while($row2 = mysql_fetch_row($strs2))
							{
								print("<option value=$row2[0] $row2[1] >$row2[0]</option>");
							}
						?>
						  </select>
						  <?php echo $keterangan; ?>
		</div>
		
					  <?php } ?>
	</div>
	</div>
	<br>
	
	<?php } ?>
	
	




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