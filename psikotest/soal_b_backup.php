<html>
<div style="width:100%; height:1000px; float:left">
<?php 
include "Proses/connect.php";
$strxx = mysql_query("SELECT * FROM psikotest_b_soal GROUP BY soalke");
		while($row = mysql_fetch_row($strxx))
		{
			$soalke = $row[0];

?>



<div style="width:200px; float:left">
<table style="border:1pt solid #999999; border-collapse:collapse; width:300px;">
<tr style="border:1pt solid #666666">
	<td rowspan="5" style="border:1pt solid #999999;width:40px; text-align:center"><?php echo $soalke; ?></td>
	<td style="width:20px">M</td>
	<td style="width:210px"></td>
	<td style="width:20px">L</td>
</tr>
<?php
		$strxx2 = mysql_query("SELECT * FROM psikotest_b_soal WHERE soalke = $soalke");
/*		echo "SELECT * FROM psikotest_b_soal WHERE soalke = $soalke";*/
		while($row2 = mysql_fetch_row($strxx2))
		{
			$bagke = $row2[1];
			$keterangan = $row2[2];
			$jawaban = $row2[3];	
?>
			
<tr style="width:500%">
	<td  style="width:20px"><input type="radio" name="<?php echo $soalke; ?>LM<?php echo $bagke; ?>" value="L"></td>
	<td  style="width:100px; text-align:center"><?php echo $keterangan; ?></td>
	<td  style="width:20px"><input type="radio" name="<?php echo $soalke; ?>LM<?php echo $bagke; ?>" value="M"></td>
</tr>
<?php } ?>


</table>
<div style="height:5px"></div>
</div>
<?php 

} 

?>


</div>





</html>