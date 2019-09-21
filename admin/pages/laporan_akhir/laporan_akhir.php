<?php
include ('koneksi.php');
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
  /*     $(document).ready(function() {

        $('#tanggal_mulai').daterangepicker({
          singleDatePicker: true,
          tanggal_mulai: moment().subtract(6, 'days')
        });

        $('#tanggal_selesai').daterangepicker({
          singleDatePicker: true,
          tanggal_mulai: moment()
        });


      }); */
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
					xmlhttp.open("GET","pages/laporan_akhir/ajax_load_laporan.php?&cstartDate="+startDate+"&cendDate="+endDate,true);
					xmlhttp.send();	
		
		}
      </script>

<table width="50%">
		<tr>
			<td>TANGGAL LAPORAN</td>
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
            <table id="example" class="table table-bordered" width="100%">
                <thead>
                    <tr>
                        <th width="5%">No.</th>
                        <th width="5%">KODE TEST</th>
                        <th width="20%">NAMA CALON KARYAWAN</th>
                        <th width="5%">TANGGAL PSIKOTEST</th>
                        <th width="5%">KODE CABANG</th>
                        <th width="5%">NAMA CABANG </th>
                        <th width="10%">SUMBER DATA LAMARAN</th>
                        <th width="10%">NO TELP</th>
                        <th width="10%">PENDIDIKAN</th>
                        <th width="15%">HASIL PSIKOTEST</th>
                    </tr>
                </thead>
                <tbody>
                   <?php
                    $sql = mysql_query("
							SELECT a.id_calon_karyawan,UPPER(a.nama_lengkap) nama,DATE_FORMAT(a.create_time,'%d/%m/%Y') createtime,b.kodecbg,b.nama namacbg,
							a.sumber_lamaran,a.telp1,SUBSTRING_INDEX(SUBSTRING_INDEX(c.scr , '|', 2 ),'|',-1) pendidikan,a.hasil_test
							FROM datapribadi_ck a, hris.cabang_konven b,
							(SELECT MIN(CONCAT(create_time,'|',pendidikan,'|',id_calon_karyawan)) scr FROM datasekolah_ck GROUP BY id_calon_karyawan) c
							WHERE a.id_calon_karyawan=SUBSTRING_INDEX(SUBSTRING_INDEX(c.scr , '|', 3 ),'|',-1) AND a.kodecbg=b.kodecbg and a.status='approve2'
                    	");
                    $no = 1;
                    while ($row = mysql_fetch_row($sql)) {
                      $id_calon_karyawan=$row[0];
                    ?>

                    <tr>
                        <td width="5%"><?php echo $no;?></td>
                        <td width="5%">
                          <a data-fancybox-href="pages/approve_pengajuan_test/semuadata_detail.php?id_calon_karyawan=<?php echo  $row[0];?>" href="javascript:;" class="fancybox">
                          <?php echo $row[0];?>
                          </a>
                        </td>
                        <td width="20%"><?php echo $row[1];?></td>
                        <td width="5%"><?php echo $row[2];?></td>
                        <td width="5%"><?php echo $row[3];?></td>
                        <td width="5%"><?php echo $row[4];?></td>
                        <td width="10%"><?php echo $row[5];?></td>
                        <td width="10%"><?php echo $row[6];?></td>
                        <td width="10%"><?php echo $row[7];?></td>
                        <td width="15%"><?php echo $row[8];?></td>
                    </tr>

                    <?php
						$no++;
						}
					?>
                </tbody>
            </table> 
</div>