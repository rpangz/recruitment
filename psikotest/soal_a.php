<?php




/*if($soalno<=$banyaksoal)*/
if(1==1)
{






	if($jenis=="LOAD")
	{
		$st = mysql_query("SELECT CASE WHEN TIMESTAMPDIFF(SECOND,b.start_a,max(createtime)) IS NULL THEN 'MULAI' ELSE 1500-TIMESTAMPDIFF(SECOND,b.start_a,max(createtime)) END FROM psikotest_proses_test a,psikotest_data_kary b WHERE a.no_calon_kary=b.no_calon_kary AND a.kode_unik=b.kode_unik AND b.no_calon_kary='$username' AND b.kode_unik='$password'");
		while($row = mysql_fetch_row($st))
		{
			$detik = $row[0];
		}
		if($detik == "MULAI")
		{?><title>Psikotest</title> <img src="index_files/a.JPG" onload="playtime('1500')" style="display:none" /> <?php }
		else
		{
			if ($detik <= 0)
				{?> <img src="index_files/a.JPG" onload="playtime('0')" style="display:none" /> <?php }
			else
				{?> <img src="index_files/a.JPG" onload="playtime('<?php echo $detik; ?>')" style="display:none" /> <?php }
		
		}
		
	}
	
	
	
	$st2 = mysql_query("SELECT FLOOR(RAND() * COUNT(1)+1)-1,COUNT(1),c.part_a FROM (psikotest_a_soal a,psikotest_data_kary c) LEFT OUTER JOIN (SELECT * FROM psikotest_proses_test WHERE no_calon_kary='$username' AND kode_unik='$password') b ON a.soalke=b.soalno AND a.bagke=b.bagiantest WHERE c.no_calon_kary='$username' AND c.kode_unik='$password' AND b.soalno IS NULL and a.bagke=c.part_a");
	while($row2 = mysql_fetch_row($st2))
		{
			$acak = $row2[0];
			$total = $row2[1];
			$part = $row2[2];
		}
	
	
	
	$st = mysql_query("SELECT a.* FROM (psikotest_a_soal a,psikotest_data_kary c) LEFT OUTER JOIN (SELECT * FROM psikotest_proses_test WHERE no_calon_kary='$username' AND kode_unik='$password') b ON a.soalke=b.soalno AND a.bagke=b.bagiantest WHERE c.no_calon_kary='$username' AND c.kode_unik='$password' AND b.soalno IS NULL and a.bagke=c.part_a LIMIT $acak,1");
	
	
	while($row = mysql_fetch_row($st))
		{
			$soalno = $row[0];
			$bagke = $row[1];
			$soal = $row[2];
			$jawaban1 = $row[3];
			$jawaban2 = $row[4];
			$jawaban3 = $row[5];
			$jawaban4 = $row[6];
			$jawaban5 = $row[7];
			$jawaban6 = $row[8];
			$jawaban7 = $row[9];
			$jawaban8 = $row[10];
		}
	?>
	
	<div id="test-1" class="test panel panel-info">
			<div class="panel-heading">
				<h3> BAGIAN <?php echo $bagke; ?> - NO. <?php echo (12 - $total)+1; ?>/12</h3>
			</div>
			<div class="panel-body" style="width:100%">
				<div style="width:44%; float:left">
				<img height="420" width="520" id="soal-<?php echo $soalno; ?>" src="data:image/jpeg;base64,<?php echo base64_encode($soal); ?>">
				</div>
		
				<div style="width:56%; float:left;"; align="center">			
				<img class="choice btn btn-default" height="120"  id="answer-<?php echo $soalno; ?>-1" src="data:image/jpeg;base64,<?php echo base64_encode($jawaban1); ?>" onClick="javascript:answer('INSERT','<?php echo $bagke; ?>',<?php echo $soalno; ?>, 1);"> 
				<img class="choice btn btn-default" height="120" id="answer-<?php echo $soalno; ?>-2" src="data:image/jpeg;base64,<?php echo base64_encode($jawaban2); ?>" onClick="javascript:answer('INSERT','<?php echo $bagke; ?>',<?php echo $soalno; ?>, 2);">
				<img class="choice btn btn-default" height="120" id="answer-<?php echo $soalno; ?>-3" src="data:image/jpeg;base64,<?php echo base64_encode($jawaban3); ?>" onClick="javascript:answer('INSERT','<?php echo $bagke; ?>',<?php echo $soalno; ?>, 3);">	
				<br>					
				<img class="choice btn btn-default" height="120" id="answer-<?php echo $soalno; ?>-4" src="data:image/jpeg;base64,<?php echo base64_encode($jawaban4); ?>" onClick="javascript:answer('INSERT','<?php echo $bagke; ?>',<?php echo $soalno; ?>, 4);">
				<img class="choice btn btn-default" height="120"  id="answer-<?php echo $soalno; ?>-5" src="data:image/jpeg;base64,<?php echo base64_encode($jawaban5); ?>" onClick="javascript:answer('INSERT','<?php echo $bagke; ?>',<?php echo $soalno; ?>, 5);">
				<img class="choice btn btn-default"height="120" id="answer-<?php echo $soalno; ?>-6" src="data:image/jpeg;base64,<?php echo base64_encode($jawaban6); ?>" onClick="javascript:answer('INSERT','<?php echo $bagke; ?>',<?php echo $soalno; ?>, 6);">
				<br>
				<img <?php if($jawaban7=="NONE") { ?> style="display:none" <?php } ?> class="choice btn btn-default" height="120"  id="answer-<?php echo $soalno; ?>-5" src="data:image/jpeg;base64,<?php echo base64_encode($jawaban7); ?>" onClick="javascript:answer('INSERT','<?php echo $bagke; ?>',<?php echo $soalno; ?>, 7);">
				<img  <?php if($jawaban7=="NONE") { ?> style="display:none" <?php } ?> class="choice btn btn-default"height="120" id="answer-<?php echo $soalno; ?>-6" src="data:image/jpeg;base64,<?php echo base64_encode($jawaban8); ?>" onClick="javascript:answer('INSERT','<?php echo $bagke; ?>',<?php echo $soalno; ?>, 8);">
				</div>							
			</div>
		</div>
<?php 






}
else
{?> <img src="index_files/a.JPG" onload="alert('Soal Untuk Test Ini Sudah Habis, Klik OK Untuk Test Berikutnya');window.location = 'intro_b.php';" style="display:none" /> <?php }
?>	
