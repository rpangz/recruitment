<?php session_start();
if($_SESSION['user']==true)
	{ 
		include "Proses/connect.php";
		$username = $_SESSION['user'];
		$kodeunik=$_SESSION['kodeunik'];
		
		
		mysql_query("UPDATE psikotest_data_kary SET start_a=now(),status='SOAL A',part_a=CASE WHEN part_a IS NULL THEN 'A' ELSE part_a END WHERE no_calon_kary='$username' AND kode_unik='$kodeunik' AND start_a IS NULL");
		

		
		$strxx = mysql_query("SELECT status FROM psikotest_data_kary p WHERE no_calon_kary = '$username' AND kode_unik='$kodeunik';");
		while($row = mysql_fetch_row($strxx))
		{
			$cekakses = $row[0];
		}
		
		if($cekakses!="SOAL A")
		{
			print ("<META HTTP-EQUIV = 'Refresh' Content = '0; URL =index.php'>");
		}
		
	?>
<!DOCTYPE html>
<!-- saved from url=(0021)http://test.mensa.no/ -->
<html><head>





	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="./index_files/bootstrap.min.css" >
	<!-- Optional theme -->
	<link rel="stylesheet" href="./index_files/bootstrap-theme.min.css">
	<!-- Latest compiled and minified JavaScript -->
	

	<link rel="stylesheet" type="text/css" href="./index_files/style.css">
	<script type="text/javascript" src="js/jquery-1.3.2.js"></script>
	<script type="text/javascript">
	
	function answer(jenis,bagiantest,soal,jawaban) {
	
	
/*			$.get("soal_a.php?jenis="+jenis+"&bagiantest="+bagiantest+"&soal="+soal+"&jawaban="+jawaban, function(data) {
               		$('#loadsoal').html(data);
               }); */
			   
			   $.get("soal.php?jenis="+jenis+"&bagiantest="+bagiantest+"&soal="+soal+"&jawaban="+jawaban, function(data) {
               		$('#loadsoal').html(data);
               }); 
		
/*		 var $iframe = $('#loadsoal');
		 $iframe.attr("src","soal_a.php?jenis="+jenis+"&bagiantest="+bagiantest+"&soal="+soal+"&jawaban="+jawaban);*/
		
	
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
			/*alert("Waktu Anda Sudah Habis, Klik OK Untuk Test Berikutnya");
			window.location = "intro_b.php";*/
        }
    }, 1000);
}


function playtime(waktu) {
    var fiveMinutes = waktu,
        display = document.querySelector('#timer');
    startTimer(fiveMinutes, display);
};


	
	</script>





<title>Psikotest</title></head>
<body onLoad="answer('LOAD','','','')">


<div class="container">



<!-- TIMER -->
<div class="timer fbgreybox" style="">
	<button type="button" class="btn btn-warning disabled">
		<span id="timer">Calculating Time . . .</span> 
	</button>
</div>


<!-- TEST N -->


<div id="loadsoal">
	
	
	
</div>








</body></html>

<?php }
else
	{
		print ("<META HTTP-EQUIV = 'Refresh' Content = '0; URL =index.php'>");
	}
?>	