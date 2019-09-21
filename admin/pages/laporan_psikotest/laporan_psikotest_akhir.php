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
/*      $(document).ready(function() {

        $('#tanggal_mulai').daterangepicker({
          singleDatePicker: true,
          tanggal_mulai: moment().subtract(6, 'days')
        });

        $('#tanggal_selesai').daterangepicker({
          singleDatePicker: true,
          tanggal_mulai: moment()
        });


      });*/
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
          xmlhttp.open("GET","pages/laporan_psikotest/ajax_load_laporan_akhir.php?&cstartDate="+startDate+"&cendDate="+endDate,true);
          xmlhttp.send(); 
    
    }
</script>



<script>
    function save_hal1(startDate,endDate,id_calon_karyawan1)
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
                document.getElementById("title02").innerHTML=xmlhttp.responseText;
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
          
          xmlhttp.open("GET","pages/laporan_psikotest/ajax_approve_load.php?&cstartDate="+startDate+"&cendDate="+endDate+"&id_calon_karyawan="+id_calon_karyawan1,true);
          xmlhttp.send(); 
    
    }



    function dihapus(startDate,endDate,id_calon_karyawan2)
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
                document.getElementById("title03").innerHTML=xmlhttp.responseText;
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
          
          xmlhttp.open("GET","pages/laporan_psikotest/ajax_dihapus_load.php?&cstartDate="+startDate+"&cendDate="+endDate+"&id_calon_karyawan="+id_calon_karyawan2,true);
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

<div id="title02" class="title02" align="center" style="width:100%"> 
<div id="title01" class="title01" align="center" style="width:100%"> 
</div>