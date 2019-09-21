<?php
include('../../session.php');
include('../../koneksi.php');
?>
<!-- 
       	<link href="../../../assets/template/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="../../../assets/css/main.css" />
 --><!-- 
<script type="text/javascript" src="../../js/gambar.js"></script> -->
<script type="text/javascript" src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="../../fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="../../fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />

	<script type="text/javascript">
	$(document).ready(function() {
			
			$(".fancybox-effects-d").fancybox({
				padding: 0,

				openEffect : 'elastic',
				openSpeed  : 150,

				closeEffect : 'elastic',
				closeSpeed  : 150,

				closeClick : true,

				helpers : {
					overlay : null
				}
			});
			
			$('.popup').fancybox({
				  'zoomSpeedIn': 300,
				  'zoomSpeedOut': 300,
				  'overlayShow': false
			  });
});
	</script>

<style>
.fancybox-wrap { 
  top: 40px !important; 
  left: 10px !important; 
}
</style>
<!-- Javascript goes in the document HEAD -->
<script type="text/javascript">
function altRows(id){
  if(document.getElementsByTagName){  
    
    var table = document.getElementById(id);  
    var rows = table.getElementsByTagName("tr"); 
     
    for(i = 0; i < rows.length; i++){          
      if(i % 2 == 0){
        rows[i].className = "evenrowcolor";
      }else{
        rows[i].className = "oddrowcolor";
      }      
    }
  }
}
window.onload=function(){
  altRows('alternatecolor');
}
</script>

<!-- CSS goes in the document HEAD or added to your external stylesheet -->
<style type="text/css">
table.altrowstable {
  font-family: verdana,arial,sans-serif;
  font-size:11px;
  color:#333333;
  border-width: 1px;
  border-color: #a9c6c9;
  border-collapse: collapse;
}
table.altrowstable th {
  border-width: 1px;
  padding: 8px;
  border-style: solid;
  border-color: #a9c6c9;
}
table.altrowstable td {
  border-width: 1px;
  padding: 8px;
  border-style: solid;
  border-color: #a9c6c9;
}
.oddrowcolor{
  background-color:#d4e3e5;
}
.evenrowcolor{
  background-color:#c3dde0;
}
</style>

<?php
$id_calon_karyawan = $_GET['id_calon_karyawan'];

              $sql_nama = mysql_query("SELECT (nama_lengkap) FROM datapribadi_ck where id_calon_karyawan='$id_calon_karyawan' ");
              $r_nama = mysql_fetch_array($sql_nama);
?>


<table class="altrowstable" id="alternatecolor" style="margin-left: auto; margin-right: auto; width: 70%; text-align: center;">
  <thead>
  <tr>
    <th colspan="3">
    ID CALON KARYAWAN : <a style="color: red"><?php echo $id_calon_karyawan ?></a> <br>
    NAMA CALON KARYAWAN : <a style="color: red"><?php echo $r_nama[0] ?>
    </th>
  </tr>
    <th>SOAL</th>
    <th>JAWABAN</th>
    <th>KETERANGAN</th>
  </thead>

<?php
    
$sql = mysql_query("SELECT b.no_calon_kary,a.soalke,c.jawaban,
CASE WHEN (c.jawaban IS NULL OR c.jawaban<>a.jawabreal) THEN 0 ELSE 1 END nilai,
CASE WHEN (c.jawaban IS NULL OR c.jawaban<>a.jawabreal) THEN 'SALAH' ELSE 'BENAR' END keterangan
FROM (psikotest_a_soal a,psikotest_data_kary b)
LEFT OUTER JOIN
(SELECT * FROM psikotest_proses_test WHERE no_calon_kary = '$id_calon_karyawan') c
ON a.soalke=c.soalno
WHERE b.no_calon_kary = '$id_calon_karyawan'");
$no = 1;
while($rows = mysql_fetch_array($sql))
{

	?>


  <tbody style="font-weight: bold;">
    <td><?php echo $rows[1]?></td>
    <td><?php echo $rows[2]?></td>

    <?php 
      if($rows['4']==BENAR)
                {
                echo "<td bgcolor='#88D571'>";
                }
                else
                {
                  echo "<td bgcolor='#E56668'>";
                }
    ?><?php echo $rows[4]?>


<?php } ?>

<tr>
<td colspan="2">TOTAL BENAR :</td>
<td> 
<?php 

              $sql3 = mysql_query("SELECT sum(nilai) from (SELECT b.no_calon_kary,a.soalke,c.jawaban,
CASE WHEN (c.jawaban IS NULL OR c.jawaban<>a.jawabreal) THEN 0 ELSE 1 END nilai,
CASE WHEN (c.jawaban IS NULL OR c.jawaban<>a.jawabreal) THEN 'SALAH' ELSE 'BENAR' END keterangan
FROM (psikotest_a_soal a,psikotest_data_kary b)
LEFT OUTER JOIN
(SELECT * FROM psikotest_proses_test WHERE no_calon_kary = '$id_calon_karyawan') c
ON a.soalke=c.soalno
WHERE b.no_calon_kary = '$id_calon_karyawan')as total_benar");
              $r3 = mysql_fetch_array($sql3);

              echo $r3[0];
?>
</td>
</tr>
  </tbody>
</table>
</div>

        

