<?php session_start();
if($_SESSION['user']==true)
	{
	include "Proses/connect.php";
	$username = $_SESSION['user'];
	$kodeunik = $_SESSION['kodeunik'];
	
	mysql_query("UPDATE psikotest_data_kary SET start_c=now(),status='SOAL C' WHERE no_calon_kary='$username' AND kode_unik='$kodeunik' AND start_c IS NULL AND status='START C'");
	
	$strxx = mysql_query("SELECT status FROM psikotest_data_kary p WHERE no_calon_kary = '$username' AND kode_unik='$kodeunik';");
		while($row = mysql_fetch_row($strxx))
		{
			$cekakses = $row[0];
		}
		
		if($cekakses!="SOAL C")
		{
			print ("<META HTTP-EQUIV = 'Refresh' Content = '0; URL =index.php'>");
		}

	
	
		/*$strxx = mysql_query("SELECT waktu FROM psikotest_spek_timer WHERE bagian = 'C'");
		while($row = mysql_fetch_row($strxx))
		{
			$waktu = $row[0];
		}
	
		
		$st = mysql_query("SELECT CASE WHEN TIMESTAMPDIFF(SECOND,b.start_b,max(createtime)) IS NULL THEN 'MULAI' ELSE $waktu-TIMESTAMPDIFF(SECOND,b.start_c,max(createtime)) END FROM psikotest_proses_test_c a,psikotest_data_kary b WHERE a.no_calon_kary=b.no_calon_kary AND a.kode_unik=b.kode_unik AND b.no_calon_kary='$username' AND b.kode_unik='$kodeunik'");

	
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
	position:fixed;
	
}
.button:hover {
    background-color: #4CAF50; /* Green */
    color: white;
}
</style>
</head>
<body>
<div style="width:100%; border:solid #999999 1pt;background-color:#CCCCCC;" align="center"><b>BEHAVIORAL POTRAIT</b></div>
<div style="width:88%; height:20px; float:left; text-align:right; position:fixed; top:opx; font-weight:bold;"><button class="button" onClick="Validate('C')">Selesai</button></div>
<br>
<div style="width:80%; float:left">

<?php 
$i = 0;
$tutupdiv = "NO";
$strxx = mysql_query("SELECT LPAD(soalke,2,0) soalke, LPAD(bagke,2,0) bagke, keterangan, jawaban FROM psikotest_c_soal GROUP BY soalke;");
		while($row = mysql_fetch_row($strxx))
		{
			$soalke = $row[0];
			$i=$i + 1;
			if($i==1)
			{ 
				echo "<div style=\"float:left; width:100%\">";
				$tutupdiv = "OK";	
			}
			

?>



<div style="width:100%; float:left; margin-left:20px">
<table style="border-bottom:solid 1px; width:1000px">
<?php
$str = "SELECT a.*,CASE WHEN a.bagke=b.jawaban THEN 'checked' ELSE '' END jawabanchecked FROM psikotest_c_soal a LEFT OUTER JOIN
(SELECT * FROM psikotest_proses_test_c WHERE no_calon_kary='$username' and kode_unik='$kodeunik') b ON a.soalke=b.soalno
WHERE a.soalke=$soalke";

$strxx2 = mysql_query($str);
/*		echo "SELECT * FROM psikotest_b_soal WHERE soalke = $soalke";*/
		while($row2 = mysql_fetch_row($strxx2))
		{
			$bagke = $row2[1];
			$keterangan = $row2[2];
			$jawaban = $row2[3];
			$checked = $row2[4];
			if($bagke=="b"){$nomor = "";} else {$nomor = $soalke;}

?>				
	<tr>
		<td style="width:20px"><?php echo $nomor; ?></td>
		<td style="width:30px"><input type="radio" <?php echo $checked; ?> name="<?php echo $soalke; ?>" id="<?php echo $soalke; ?><?php echo $bagke; ?>" value="<?php echo $bagke; ?>" onClick="SimpanJawaban('<?php echo $soalke; ?>','<?php echo $bagke; ?>')"></td>
		<td ><?php echo $keterangan; ?></td>
	</tr>
<?php } ?>
</table>
<div style="height:5px"></div>
</div>
<?php 

if($i==10)
			{ 
				echo "</div>";
				$i=0;
			}

} 

?>

</div>


<div id="tempdiv"></div>
</body>
</html>

<?php }
else
	{
		print ("<META HTTP-EQUIV = 'Refresh' Content = '0; URL =index.php'>");
	}
?>	