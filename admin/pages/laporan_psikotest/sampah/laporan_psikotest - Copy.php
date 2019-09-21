<?php
include ('koneksi.php');
include ('session.php');
$date = date('Y-m-d');
?>



<style>
.fancybox-wrap { 
  top: 40px !important; 
}.button {
    display: block;
    width: 115px;
    height: 25px;
    background: #c90838;
    padding: 10px;
    text-align: center;
    color: #c90838;
    font-weight: bold;
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

      <script type="text/javascript">
      $(document).ready(function() {

        $('#tanggal_mulai').daterangepicker({
          singleDatePicker: true,
          tanggal_mulai: moment().subtract(6, 'days')
        });

        $('#tanggal_selesai').daterangepicker({
          singleDatePicker: true,
          tanggal_mulai: moment()
        });


      });
	  var table = false;
		function loaddata()
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
								if (table) table.destroy();
								document.getElementById("title01").innerHTML=xmlhttp.responseText;
								table = $('#example').DataTable( {
		"scrollX": true,
		"sPaginationType": "full_numbers",
        dom: 'lBfrtip',
        buttons: [
			
			{
				extend: 'excel',
				text: '<i class="fa fa-lg fa-file-excel-o"></i> excel',
			},
			
        ]
    } );
							}
					}
					
					var startDate = document.getElementById('tanggal_mulai').value;
					var endDate = document.getElementById('tanggal_selesai').value;
					xmlhttp.open("GET","pages/laporan_psikotest/ajax_load_laporan.php?&cstartDate="+startDate+"&cendDate="+endDate,true);
					xmlhttp.send();	
		
		}
      </script>

<table width="50%">
		<tr>
			<td>TANGGAL PSIKOTEST</td>
			<td>
				:<input name="tanggal_mulai" size="9" type="text" id="tanggal_mulai"/>
                &nbsp;&nbsp;&nbsp;<B>S/D</B>&nbsp;	<input name="tanggal_selesai" size="9" type="text" id="tanggal_selesai"/>
			</td>
            <td><input type="button" id="loaddata" name="loaddata" value="LOAD" class="btn btn-primary btn-flat" onClick="loaddata()"></td>       
		</tr>
		<tr><td>&nbsp;</td></tr>
        <tr>
        </tr>
		<tr><td>&nbsp;</td></tr>
</table> 

<div id="title01" class="title01" align="center" style="width:100%"> 
<!--             <table id="example" class="table table-bordered" width="100%">
                <thead>
                    <tr>
                        <th width="1%">NO.</th>
                        <th width="5%">ID CALON KARYAWAN</th>
                        <th width="5%">KODE UNIK</th>
                        <th width="5%">NAMA CALON KARYAWAN</th>
                        <th width="5%">STATUS</th>
                        <th width="20%">TEST LOGIKA</th>
                        <th width="20%">PCT ANALYSIS </th>
                        <th width="20%">BEHAVIOR POTRAIT</th>
                        <th width="20%">TEAMWORK TEST</th>
                        <th width="20%">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    	<?php
						/*================================= BUKA LOOP CALON KARY ========================================*/
						$sql2 = mysql_query("SELECT b.nama_lengkap,b.telp1,b.divisi,b.bagian,b.status datapb,b.hasil_test, a.* FROM psikotest_data_kary a,datapribadi_ck b where a.no_calon_kary=b.id_calon_karyawan ORDER BY b.create_time DESC" );

						$no = 1;
						while ($r2 = mysql_fetch_array($sql2)) {
							$status = $r2[datapb];
							$hasil_test = $r2[hasil_test];
							$M = 0;
							$L = 0;
							$DIF = 0;
							
							$sql = mysql_query("
								SELECT sum(nilai) from (SELECT b.no_calon_kary,a.soalke,c.jawaban,
								CASE WHEN (c.jawaban IS NULL OR c.jawaban<>a.jawabreal) THEN 0 ELSE 1 END nilai,
								CASE WHEN (c.jawaban IS NULL OR c.jawaban<>a.jawabreal) THEN 'SALAH' ELSE 'BENAR' END keterangan
								FROM (psikotest_a_soal a,psikotest_data_kary b)
								LEFT OUTER JOIN
								(SELECT * FROM psikotest_proses_test WHERE no_calon_kary = '$r2[no_calon_kary]' AND kode_unik = '$r2[kode_unik]') c
								ON a.soalke=c.soalno
								WHERE b.no_calon_kary = '$r2[no_calon_kary]' AND b.kode_unik = '$r2[kode_unik]')as total
								");
							$r = mysql_fetch_array($sql)
						?>

	                    <tr align='left'>
	                        <td><?php echo  $no;?>
	                        <td><a data-fancybox-href="pages/approve_pengajuan_test/semuadata_detail.php?id_calon_karyawan=<?php echo  $r2[no_calon_kary];?>" href="javascript:;" class="fancybox">
	                        	<?php echo  $r2['no_calon_kary'];?>
	                            <br><br><?php echo  $r2['divisi']; ?><br><?php echo  $r2['bagian']; ?>
	                            </a>
	                        </td>
	                        <td><?php echo  $r2['kode_unik'];?>
	                        </td>
	                        <td><?php echo  $r2['nama_lengkap']; ?></td>
	                        <td>
		                        <?php echo  $r2['status'];?><br><br>
		                        <?php
		                        if ($hasil_test=="") 
		                        {
		                        	echo "Belum Input Hasil Test";
		                        } else 
		                        {
		                        	echo  $hasil_test;
		                        }
		                        ?> 
	                        </td>


	                        <?php 
	                        if ($r2['status']=="START") 
	                        { 
	                        ?>
	                        	<td>-</td>
	                        	<td>-</td>
	                        	<td>-</td>
	                        	<td>-</td>
	                        	<td>-</td>
	                        <?php 
	                    	}
	                        if ($r2['status']=="START B" || $r2['status']=="SOAL B") 
	                        { 
	                        ?>
	                        	<td align="center">BENAR = <?php echo  $r[0]; ?> 
	                        	<br>
	                        	SALAH = <?php $jum_soal=60;
	                        	$salah = $jum_soal - $r[0]; 
	                        	echo $salah ?>
	                        	<br>
	                        	<a data-fancybox-href="pages/laporan_psikotest/laporan_psikotest_detail_logika.php?id_calon_karyawan=<?php echo  $r2['no_calon_kary'];?>" href="javascript:;" class="fancybox"><input type="submit" name="detail" value="detail"></a>
	                        	</td>
	                        	<td>-</td>
	                        	<td>-</td>
	                        	<td>-</td>
	                        	<td>-</td>

	                        <?php 
	                    	}
	                        if ($r2['status']=="START C" || $r2['status']=="SOAL C") 
	                        { 
	                        ?>
	                        	<td align="center">BENAR = <?php echo  $r[0]; ?> 
	                        	<br>
	                        	SALAH = <?php $jum_soal=60;
	                        	$salah = $jum_soal - $r[0]; 
	                        	echo $salah ?>
	                        	<br>
	                        	<a data-fancybox-href="pages/laporan_psikotest/laporan_psikotest_detail_logika.php?id_calon_karyawan=<?php echo  $r2['no_calon_kary'];?>" href="javascript:;" class="fancybox"><input type="submit" name="detail" value="detail"></a>
	                        	</td>
		                        <td> 
									<table class="altrowstable" id="alternatecolor" style="text-align: center;">
										<thead>
											<th width="25%">DISC</th>
											<th width="25%">M</th>
											<th width="25%">L</th>
											<th width="25%">DIFERENCE</th>
										</thead>
										<?php
										$sql_discn = mysql_query("
										SELECT a.*,m-l difference FROM (

										SELECT 'D' disc,
										SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='M') THEN 1 ELSE 0 END) M,
										SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) L
										FROM psikotest_proses_test_b a LEFT OUTER JOIN
										(SELECT * FROM spek_jawaban_b WHERE disc = 'D') b ON a.soalno=b.soalke AND a.ml=b.ml
										WHERE a.no_calon_kary = '$r2[no_calon_kary]' AND a.kode_unik = '$r2[kode_unik]'
										UNION ALL
										SELECT 'I',
										SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='M') THEN 1 ELSE 0 END) M,
										SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) L
										FROM psikotest_proses_test_b a LEFT OUTER JOIN
										(SELECT * FROM spek_jawaban_b WHERE disc = 'I') b ON a.soalno=b.soalke AND a.ml=b.ml
										WHERE a.no_calon_kary = '$r2[no_calon_kary]' AND a.kode_unik = '$r2[kode_unik]'
										UNION ALL
										SELECT 'S',
										SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='M') THEN 1 ELSE 0 END) M,
										SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) L
										FROM psikotest_proses_test_b a LEFT OUTER JOIN
										(SELECT * FROM spek_jawaban_b WHERE disc = 'S') b ON a.soalno=b.soalke AND a.ml=b.ml
										WHERE a.no_calon_kary = '$r2[no_calon_kary]' AND a.kode_unik = '$r2[kode_unik]'
										UNION ALL
										SELECT 'C',
										SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='M') THEN 1 ELSE 0 END) M,
										SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) L
										FROM psikotest_proses_test_b a LEFT OUTER JOIN
										(SELECT * FROM spek_jawaban_b WHERE disc = 'C') b ON a.soalno=b.soalke AND a.ml=b.ml
										WHERE a.no_calon_kary = '$r2[no_calon_kary]' AND a.kode_unik = '$r2[kode_unik]'
										UNION ALL
										SELECT 'N',
										SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='M') THEN 1 ELSE 0 END) M,
										SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) L
										FROM psikotest_proses_test_b a LEFT OUTER JOIN
										(SELECT * FROM spek_jawaban_b WHERE disc = 'N') b ON a.soalno=b.soalke AND a.ml=b.ml
										WHERE a.no_calon_kary = '$r2[no_calon_kary]' AND a.kode_unik = '$r2[kode_unik]'
										) A
										");
										while ($r_discn = mysql_fetch_array($sql_discn)) {

										?>
										<tbody>
											<tr>
												<td style="font-weight: bold;"><?php echo $r_discn[0]; ?></td>
												<td><?php echo $r_discn[1]; ?></td>
												<td><?php echo $r_discn[2]; ?></td>
												<td><?php echo $r_discn[3]; ?></td>
											</tr>
										<?php

										$M += $r_discn[1];
										$L += $r_discn[2];
										$DIF += $r_discn[3];

										}
										?>
											<tr>
												<td>SUM</td>
												<td><?php echo $M ?></td>
												<td><?php echo $L ?></td>
												<td><?php echo $DIF ?></td>
											</tr>
										</tbody>
									</table>
		                        </td>
	                        	<td>-</td>
	                        	<td>-</td>
	                        	<td>-</td>

	                        <?php 
	                    	}
	                        if ($r2['status']=="START D" || $r2['status']=="SOAL D")
	                        { 
	                        ?>
	                        	<td align="center">BENAR = <?php echo  $r[0]; ?> 
	                        	<br>
	                        	SALAH = <?php $jum_soal=60;
	                        	$salah = $jum_soal - $r[0]; 
	                        	echo $salah ?>
	                        	<br>
	                        	<a data-fancybox-href="pages/laporan_psikotest/laporan_psikotest_detail_logika.php?id_calon_karyawan=<?php echo  $r2['no_calon_kary'];?>" href="javascript:;" class="fancybox"><input type="submit" name="detail" value="detail"></a>
	                        	</td>
		                        <td> 
									<table class="altrowstable" id="alternatecolor" style="text-align: center;">
										<thead>
											<th width="25%">PCT</th>
											<th width="25%">M</th>
											<th width="25%">L</th>
											<th width="25%">DIFERENCE</th>
										</thead>
										<?php
										$sql_discn = mysql_query("
										SELECT a.*,m-l difference FROM (

										SELECT 'D' disc,
										SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='M') THEN 1 ELSE 0 END) M,
										SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) L
										FROM psikotest_proses_test_b a LEFT OUTER JOIN
										(SELECT * FROM spek_jawaban_b WHERE disc = 'D') b ON a.soalno=b.soalke AND a.ml=b.ml
										WHERE a.no_calon_kary = '$r2[no_calon_kary]' AND a.kode_unik = '$r2[kode_unik]'
										UNION ALL
										SELECT 'I',
										SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='M') THEN 1 ELSE 0 END) M,
										SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) L
										FROM psikotest_proses_test_b a LEFT OUTER JOIN
										(SELECT * FROM spek_jawaban_b WHERE disc = 'I') b ON a.soalno=b.soalke AND a.ml=b.ml
										WHERE a.no_calon_kary = '$r2[no_calon_kary]' AND a.kode_unik = '$r2[kode_unik]'
										UNION ALL
										SELECT 'S',
										SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='M') THEN 1 ELSE 0 END) M,
										SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) L
										FROM psikotest_proses_test_b a LEFT OUTER JOIN
										(SELECT * FROM spek_jawaban_b WHERE disc = 'S') b ON a.soalno=b.soalke AND a.ml=b.ml
										WHERE a.no_calon_kary = '$r2[no_calon_kary]' AND a.kode_unik = '$r2[kode_unik]'
										UNION ALL
										SELECT 'C',
										SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='M') THEN 1 ELSE 0 END) M,
										SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) L
										FROM psikotest_proses_test_b a LEFT OUTER JOIN
										(SELECT * FROM spek_jawaban_b WHERE disc = 'C') b ON a.soalno=b.soalke AND a.ml=b.ml
										WHERE a.no_calon_kary = '$r2[no_calon_kary]' AND a.kode_unik = '$r2[kode_unik]'
										UNION ALL
										SELECT 'N',
										SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='M') THEN 1 ELSE 0 END) M,
										SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) L
										FROM psikotest_proses_test_b a LEFT OUTER JOIN
										(SELECT * FROM spek_jawaban_b WHERE disc = 'N') b ON a.soalno=b.soalke AND a.ml=b.ml
										WHERE a.no_calon_kary = '$r2[no_calon_kary]' AND a.kode_unik = '$r2[kode_unik]'
										) A
										");

										
										while ($r_discn = mysql_fetch_array($sql_discn)) {

										?>
										<tbody>
											<tr>
												<td style="font-weight: bold;"><?php echo $r_discn[0]; ?></td>
												<td><?php echo $r_discn[1]; ?></td>
												<td><?php echo $r_discn[2]; ?></td>
												<td><?php echo $r_discn[3]; ?></td>
											</tr>
										<?php

										$M += $r_discn[1];
										$L += $r_discn[2];
										$DIF += $r_discn[3];

										}
										?>
											<tr>
												<td>SUM</td>
												<td><?php echo $M ?></td>
												<td><?php echo $L ?></td>
												<td><?php echo $DIF ?></td>
											</tr>
										</tbody>
									</table>
		                        </td>
		                        <td> 
									<table class="altrowstable" id="alternatecolor" style="text-align: center;">

										<?php
										$sql_behavior = mysql_query("
										SELECT a.no_calon_kary,
										SUM(CASE WHEN b.nilai = 'G' THEN 1 ELSE 0 END) G,
										SUM(CASE WHEN b.nilai = 'L' THEN 1 ELSE 0 END) L,
										SUM(CASE WHEN b.nilai = 'I' THEN 1 ELSE 0 END) I,
										SUM(CASE WHEN b.nilai = 'T' THEN 1 ELSE 0 END) T,
										SUM(CASE WHEN b.nilai = 'V' THEN 1 ELSE 0 END) V,
										SUM(CASE WHEN b.nilai = 'S' THEN 1 ELSE 0 END) S,
										SUM(CASE WHEN b.nilai = 'R' THEN 1 ELSE 0 END) R,
										SUM(CASE WHEN b.nilai = 'D' THEN 1 ELSE 0 END) D,
										SUM(CASE WHEN b.nilai = 'C' THEN 1 ELSE 0 END) C,
										SUM(CASE WHEN b.nilai = 'E' THEN 1 ELSE 0 END) E,
										SUM(CASE WHEN b.nilai = 'N' THEN 1 ELSE 0 END) N,
										SUM(CASE WHEN b.nilai = 'A' THEN 1 ELSE 0 END) A,
										SUM(CASE WHEN b.nilai = 'P' THEN 1 ELSE 0 END) P,
										SUM(CASE WHEN b.nilai = 'X' THEN 1 ELSE 0 END) X,
										SUM(CASE WHEN b.nilai = 'B' THEN 1 ELSE 0 END) B,
										SUM(CASE WHEN b.nilai = 'O' THEN 1 ELSE 0 END) O,
										SUM(CASE WHEN b.nilai = 'Z' THEN 1 ELSE 0 END) Z,
										SUM(CASE WHEN b.nilai = 'K' THEN 1 ELSE 0 END) K,
										SUM(CASE WHEN b.nilai = 'F' THEN 1 ELSE 0 END) F,
										SUM(CASE WHEN b.nilai = 'W' THEN 1 ELSE 0 END) W
										 FROM psikotest_proses_test_c a,spek_jawaban_c b
										WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
										no_calon_kary = '$r2[no_calon_kary]' AND kode_unik='$r2[kode_unik]'
										");
										while ($r_behavior = mysql_fetch_array($sql_behavior)) {

										?>
										<thead>
											<tr>
												<th>G</th>
												<th>L</th>
												<th>I</th>
												<th>T</th>
												<th>V</th>
												<th>S</th>
												<th>R</th>
												<th>D</th>
												<th>C</th>
												<th>E</th>
											</tr>
											<tr>
												<td><?php echo $r_behavior[1]; ?></td>
												<td><?php echo $r_behavior[2]; ?></td>
												<td><?php echo $r_behavior[3]; ?></td>
												<td><?php echo $r_behavior[4]; ?></td>
												<td><?php echo $r_behavior[5]; ?></td>
												<td><?php echo $r_behavior[6]; ?></td>
												<td><?php echo $r_behavior[7]; ?></td>
												<td><?php echo $r_behavior[8]; ?></td>
												<td><?php echo $r_behavior[9]; ?></td>
												<td><?php echo $r_behavior[10]; ?></td>
											</tr>
											<tr>
												<th style="border: 0">&nbsp</th>
											</tr>
											<tr>
												<th>N</th>
												<th>A</th>
												<th>P</th>
												<th>X</th>
												<th>B</th>
												<th>O</th>
												<th>Z</th>
												<th>K</th>
												<th>F</th>
												<th>W</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><?php echo $r_behavior[11]; ?></td>
												<td><?php echo $r_behavior[12]; ?></td>
												<td><?php echo $r_behavior[13]; ?></td>
												<td><?php echo $r_behavior[14]; ?></td>
												<td><?php echo $r_behavior[15]; ?></td>
												<td><?php echo $r_behavior[16]; ?></td>
												<td><?php echo $r_behavior[17]; ?></td>
												<td><?php echo $r_behavior[18]; ?></td>
												<td><?php echo $r_behavior[19]; ?></td>
												<td><?php echo $r_behavior[20]; ?></td>
											</tr>
										<?php

										}
										?>
										</tbody>
									</table>
		                        </td>
	                        	<td>-</td>
	                        	<td>-</td>
	                        <?php
	                        }
	                        if($r2['status']=="FINISH")
	                        {
	                       	?>
		                        <td align="center">BENAR = <?php echo  $r[0]; ?> 
		                        	<br>
		                        	SALAH = <?php $jum_soal=60;
		                        	$salah = $jum_soal - $r[0]; 
		                        	echo $salah ?>
		                        	<br>
		                        	<a data-fancybox-href="pages/laporan_psikotest/laporan_psikotest_detail_logika.php?id_calon_karyawan=<?php echo  $r2['no_calon_kary'];?>" href="javascript:;" class="fancybox"><input type="submit" name="detail" value="detail"></a>
		                        </td>
		                        <td> 
									<table class="altrowstable" id="alternatecolor" style="text-align: center;">
										<thead>
											<th width="25%">PCT</th>
											<th width="25%">M</th>
											<th width="25%">L</th>
											<th width="25%">DIFERENCE</th>
										</thead>
										<?php
										$sql_discn = mysql_query("
										SELECT a.*,m-l difference FROM (

										SELECT 'D' disc,
										SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='M') THEN 1 ELSE 0 END) M,
										SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) L
										FROM psikotest_proses_test_b a LEFT OUTER JOIN
										(SELECT * FROM spek_jawaban_b WHERE disc = 'D') b ON a.soalno=b.soalke AND a.ml=b.ml
										WHERE a.no_calon_kary = '$r2[no_calon_kary]' AND a.kode_unik = '$r2[kode_unik]'
										UNION ALL
										SELECT 'I',
										SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='M') THEN 1 ELSE 0 END) M,
										SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) L
										FROM psikotest_proses_test_b a LEFT OUTER JOIN
										(SELECT * FROM spek_jawaban_b WHERE disc = 'I') b ON a.soalno=b.soalke AND a.ml=b.ml
										WHERE a.no_calon_kary = '$r2[no_calon_kary]' AND a.kode_unik = '$r2[kode_unik]'
										UNION ALL
										SELECT 'S',
										SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='M') THEN 1 ELSE 0 END) M,
										SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) L
										FROM psikotest_proses_test_b a LEFT OUTER JOIN
										(SELECT * FROM spek_jawaban_b WHERE disc = 'S') b ON a.soalno=b.soalke AND a.ml=b.ml
										WHERE a.no_calon_kary = '$r2[no_calon_kary]' AND a.kode_unik = '$r2[kode_unik]'
										UNION ALL
										SELECT 'C',
										SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='M') THEN 1 ELSE 0 END) M,
										SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) L
										FROM psikotest_proses_test_b a LEFT OUTER JOIN
										(SELECT * FROM spek_jawaban_b WHERE disc = 'C') b ON a.soalno=b.soalke AND a.ml=b.ml
										WHERE a.no_calon_kary = '$r2[no_calon_kary]' AND a.kode_unik = '$r2[kode_unik]'
										UNION ALL
										SELECT 'N',
										SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='M') THEN 1 ELSE 0 END) M,
										SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) L
										FROM psikotest_proses_test_b a LEFT OUTER JOIN
										(SELECT * FROM spek_jawaban_b WHERE disc = 'N') b ON a.soalno=b.soalke AND a.ml=b.ml
										WHERE a.no_calon_kary = '$r2[no_calon_kary]' AND a.kode_unik = '$r2[kode_unik]'
										) A
										");
										while ($r_discn = mysql_fetch_array($sql_discn)) {

										?>
										<tbody>
											<tr>
												<td style="font-weight: bold;"><?php echo $r_discn[0]; ?></td>
												<td><?php echo $r_discn[1]; ?></td>
												<td><?php echo $r_discn[2]; ?></td>
												<td><?php echo $r_discn[3]; ?></td>
											</tr>
										<?php

										$M += $r_discn[1];
										$L += $r_discn[2];
										$DIF += $r_discn[3];

										}
										?>
											<tr>
												<td>SUM</td>
												<td><?php echo $M ?></td>
												<td><?php echo $L ?></td>
												<td><?php echo $DIF ?></td>
											</tr>
										</tbody>
									</table>
		                        </td>
		                        <td> 
									<table class="altrowstable" id="alternatecolor" style="text-align: center;">

										<?php
										$sql_behavior = mysql_query("
										SELECT a.no_calon_kary,
										SUM(CASE WHEN b.nilai = 'G' THEN 1 ELSE 0 END) G,
										SUM(CASE WHEN b.nilai = 'L' THEN 1 ELSE 0 END) L,
										SUM(CASE WHEN b.nilai = 'I' THEN 1 ELSE 0 END) I,
										SUM(CASE WHEN b.nilai = 'T' THEN 1 ELSE 0 END) T,
										SUM(CASE WHEN b.nilai = 'V' THEN 1 ELSE 0 END) V,
										SUM(CASE WHEN b.nilai = 'S' THEN 1 ELSE 0 END) S,
										SUM(CASE WHEN b.nilai = 'R' THEN 1 ELSE 0 END) R,
										SUM(CASE WHEN b.nilai = 'D' THEN 1 ELSE 0 END) D,
										SUM(CASE WHEN b.nilai = 'C' THEN 1 ELSE 0 END) C,
										SUM(CASE WHEN b.nilai = 'E' THEN 1 ELSE 0 END) E,
										SUM(CASE WHEN b.nilai = 'N' THEN 1 ELSE 0 END) N,
										SUM(CASE WHEN b.nilai = 'A' THEN 1 ELSE 0 END) A,
										SUM(CASE WHEN b.nilai = 'P' THEN 1 ELSE 0 END) P,
										SUM(CASE WHEN b.nilai = 'X' THEN 1 ELSE 0 END) X,
										SUM(CASE WHEN b.nilai = 'B' THEN 1 ELSE 0 END) B,
										SUM(CASE WHEN b.nilai = 'O' THEN 1 ELSE 0 END) O,
										SUM(CASE WHEN b.nilai = 'Z' THEN 1 ELSE 0 END) Z,
										SUM(CASE WHEN b.nilai = 'K' THEN 1 ELSE 0 END) K,
										SUM(CASE WHEN b.nilai = 'F' THEN 1 ELSE 0 END) F,
										SUM(CASE WHEN b.nilai = 'W' THEN 1 ELSE 0 END) W
										 FROM psikotest_proses_test_c a,spek_jawaban_c b
										WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
										no_calon_kary = '$r2[no_calon_kary]' AND kode_unik='$r2[kode_unik]'
										");
										while ($r_behavior = mysql_fetch_array($sql_behavior)) {

										?>
										<thead>
											<tr>
												<th>G</th>
												<th>L</th>
												<th>I</th>
												<th>T</th>
												<th>V</th>
												<th>S</th>
												<th>R</th>
												<th>D</th>
												<th>C</th>
												<th>E</th>
											</tr>
											<tr>
												<td><?php echo $r_behavior[1]; ?></td>
												<td><?php echo $r_behavior[2]; ?></td>
												<td><?php echo $r_behavior[3]; ?></td>
												<td><?php echo $r_behavior[4]; ?></td>
												<td><?php echo $r_behavior[5]; ?></td>
												<td><?php echo $r_behavior[6]; ?></td>
												<td><?php echo $r_behavior[7]; ?></td>
												<td><?php echo $r_behavior[8]; ?></td>
												<td><?php echo $r_behavior[9]; ?></td>
												<td><?php echo $r_behavior[10]; ?></td>
											</tr>
											<tr>
												<th style="border: 0">&nbsp</th>
											</tr>
											<tr>
												<th>N</th>
												<th>A</th>
												<th>P</th>
												<th>X</th>
												<th>B</th>
												<th>O</th>
												<th>Z</th>
												<th>K</th>
												<th>F</th>
												<th>W</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><?php echo $r_behavior[11]; ?></td>
												<td><?php echo $r_behavior[12]; ?></td>
												<td><?php echo $r_behavior[13]; ?></td>
												<td><?php echo $r_behavior[14]; ?></td>
												<td><?php echo $r_behavior[15]; ?></td>
												<td><?php echo $r_behavior[16]; ?></td>
												<td><?php echo $r_behavior[17]; ?></td>
												<td><?php echo $r_behavior[18]; ?></td>
												<td><?php echo $r_behavior[19]; ?></td>
												<td><?php echo $r_behavior[20]; ?></td>
											</tr>
										<?php

										}
										?>
										</tbody>
									</table>
		                        </td>
		                        <td> 
									<table class="altrowstable" id="alternatecolor" style="width: 100%; text-align: center;" width="">
										<thead>
											<th>PL</th>
											<th>CH</th>
											<th>ME</th>
											<th>CW</th>
											<th>CF</th>
											<th>RI</th>
											<th>SH</th>
											<th>TW</th>
										</thead>
										<?php
										$sql_teamwork = mysql_query("
										SELECT no_calon_kary,
										SUM(CASE WHEN b.kategori='PL' THEN a.jawaban ELSE 0 END) PL,
										SUM(CASE WHEN b.kategori='CH' THEN a.jawaban ELSE 0 END) CH,
										SUM(CASE WHEN b.kategori='ME' THEN a.jawaban ELSE 0 END) ME,
										SUM(CASE WHEN b.kategori='CW' THEN a.jawaban ELSE 0 END) CW,
										SUM(CASE WHEN b.kategori='CF' THEN a.jawaban ELSE 0 END) CF,
										SUM(CASE WHEN b.kategori='RI' THEN a.jawaban ELSE 0 END) RI,
										SUM(CASE WHEN b.kategori='SH' THEN a.jawaban ELSE 0 END) SH,
										SUM(CASE WHEN b.kategori='TW' THEN a.jawaban ELSE 0 END) TW
										FROM psikotest_proses_test_d a, spek_jawaban_d b WHERE
										a.bagiantest=b.bagianke AND a.soalno=b.soalke AND a.no_calon_kary = '$r2[no_calon_kary]' AND a.kode_unik = '$r2[kode_unik]'
										");
										while ($r_teamwork = mysql_fetch_array($sql_teamwork)) {

										?>
										<tbody>
											<tr>
												<td><?php echo $r_teamwork[1]; ?></td>
												<td><?php echo $r_teamwork[2]; ?></td>
												<td><?php echo $r_teamwork[3]; ?></td>
												<td><?php echo $r_teamwork[4]; ?></td>
												<td><?php echo $r_teamwork[5]; ?></td>
												<td><?php echo $r_teamwork[6]; ?></td>
												<td><?php echo $r_teamwork[7]; ?></td>
												<td><?php echo $r_teamwork[8]; ?></td>
											</tr>
										<?php

										}
										?>
										</tbody>
									</table>
		                        </td>

		                        <?php	
		                        if  ($r2['datapb'] == 'approve')  
		                        {
		                        ?>

		                        <td align="center">
			                        <div>
			                        	<?php if ($r2['divisi'] == STAFF) { ?>
		                        		<a data-fancybox-href="pages/laporan_psikotest/hasilakhir_psikotest_staff.php?id_calon_karyawan=<?php echo  $r2['no_calon_kary'];?>" href="javascript:;" class="fancybox"><input type="submit" name="hasil" value="HASIL">
		                        		</a>
		                        		<?php } ?>

		                        		<?php if($r2['divisi'] == SPV) { ?>
		                        		<a data-fancybox-href="pages/laporan_psikotest/hasilakhir_psikotest.php?id_calon_karyawan=<?php echo  $r2['no_calon_kary'];?>" href="javascript:;" class="fancybox"><input type="submit" name="hasil" value="HASIL">
		                        		</a>
		                        		<?php } ?>
		                        	</div>

		                        	<?php if ($status_id=="ADMIN") { ?>
	                        		<div>&nbsp</div>
		                        	<div>
										<form onsubmit="return confirm('Yakin Ingin Approve?');" action="pages/laporan_psikotest/approve2.php" method="post">
		                        		<input type="hidden" name="id_calon_karyawan" value="<?php echo  $r2['no_calon_kary'];?>">
		                        		<a class="button"><input type="submit" onclick="save_hal1()" id="approve" name="approve" value="APPROVE"></a> 
										</form>
		                        	</div>
		                        	<?php
		                        	}
		                        	?>

		                        </td>

		                        <?php
		                        } 
		                        else  { 
		                        ?>
		                        <td align="center">
			                        <div>
			                        	<?php if ($r2['divisi'] == STAFF) { ?>
		                        		<a data-fancybox-href="pages/laporan_psikotest/hasilakhir_psikotest_staff.php?id_calon_karyawan=<?php echo  $r2['no_calon_kary'];?>" href="javascript:;" class="fancybox"><input type="submit" name="hasil" value="HASIL">
		                        		</a>
		                        		<?php } ?>

		                        		<?php if($r2['divisi'] == SPV) { ?>
		                        		<a data-fancybox-href="pages/laporan_psikotest/hasilakhir_psikotest.php?id_calon_karyawan=<?php echo  $r2['no_calon_kary'];?>" href="javascript:;" class="fancybox"><input type="submit" name="hasil" value="HASIL">
		                        		</a>
		                        		<?php } ?>
		                        	</div>

		                        </td>
			                    <?php 
		                        } //tutup else
		                        ?>
		                    <?php 
	                        } // tutup if = finish
	                        ?>
	                    </tr>
                    <?php
                    $no++;
                    } // tutup while paling atas
                    ?>
                </tbody>
            </table>  -->
</div>