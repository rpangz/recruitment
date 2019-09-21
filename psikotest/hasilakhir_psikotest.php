<?php
include('../../session.php');
include('../../koneksi.php');
?>
<!-- 
       	<link href="../../../assets/template/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="../../../assets/css/main.css" /> -->

<script type="text/javascript" src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
  <script type="text/javascript">
      $(function() {
      var buttons     = $('#btn_3');
      var printStyle  = $('#print');
      var style;

      buttons.click(function() {
        style = 'div { color: ' + $(this).attr('class') + '};';
        printStyle.text(style);
        window.print();
      });
    });
  </script>

  <style type="text/css">
  .fancybox-wrap { 
    top: 40px !important; 
    left: 10px !important; 
  }
  th{text-align: left;
    padding-left: 8px;
  }

    @media print {
      button {
        display: none;
      }
      #btn_3 {
        display: none;
      }
      div {
      font-family: Arial Black; 
    color: red; font-size: 9pt;
      }
    a[href]:after {
      content: none !important;
    }
    }
    @media screen {
      .red {
        color: black;
      }
      .green {
        color: green;
      }
    }
  </style>


<div style="padding-left: 25px; padding-bottom: 25px; padding-top: 25px;">

<?php
$id_calon_karyawan = $_GET['id_calon_karyawan'];
        
  $sql = mysql_query("SELECT a.* FROM datapribadi_ck a,psikotest_data_kary b where id_calon_karyawan='$id_calon_karyawan'");
    $no = 1;
   $rows = mysql_fetch_array($sql)
?>

<div align="center" style="font-weight: bold; font-size: 20">HASIL PEMERIKSAAN PSIKOTEST</div>
<table border="1" style="border-style: groove; border-width: 1px;" align="center" width="500px">
<br>
  <tr>
    <th>ID CALON KARYAWAN</th>
    <th><?php echo $id_calon_karyawan ?></th>
  </tr>
  <tr>
    <th>NAMA CALON KARYAWAN</th>
    <th><?php echo $rows[nama_lengkap] ?></th>
  </tr>
  <tr>
    <th>JABATAN</th>
    <th><?php echo $rows[bagian] ?></th>
  </tr>
  <tr>
    <th>TANGGAL LAHIR</th>
    <th><?php echo date('d-m-Y',strtotime($rows[tanggal_lahir])) ?></th>
  </tr>
  <tr>
    <th>TANGGAL TEST</th>
    <th><?php echo date('d-m-Y',strtotime($rows[end_d]) ) ?></th>
  </tr>
  <tr>
    <th>CABANG</th>
    <th><select><option>aaa</option></select></th>
  </tr>
</table>
<?php include "Proses/connect.php"; 
	$strxx = mysql_query("SELECT subaspek FROM spek_format_hasiltest s GROUP BY subaspek");
		while($row = mysql_fetch_row($strxx))
		{
			$subaspek = $row[0];
		?>
<table border="1" align="center" width="500px">
<br>

<tr style="border: 0">
  <th style="border: 0"><?php echo $subaspek; ?></th>
</tr> 
<tr>
  <th>ASPEK</th>
  <th>R</th>
  <th>K</th>
  <th>S</th>
  <th>B</th>
  <th>T</th>
</tr> 
		<?php
	$strxx2 = mysql_query("SELECT no,aspek,left(subaspek,1) FROM spek_format_hasiltest s WHERE subaspek = '$subaspek'");
		while($row2 = mysql_fetch_row($strxx2))
		{ 
			$no = $row2[0];
			$aspek = $row2[1];
			$inisialsubaspek = $row2[2];
		?>
<tr>
  <td><?php echo $aspek; ?></td>
  <td><input type="radio" <?php echo $checkedM; ?> name="<?php echo $inisialsubaspek.$no; ?>" id="<?php echo $inisialsubaspek.$no.'R'; ?>" value="R" onClick="SimpanJawaban('<?php echo $soalke; ?>','<?php echo $idM; ?>','M')" ></td>
  <td><input type="radio" <?php echo $checkedM; ?> name="<?php echo $inisialsubaspek.$no; ?>" id="<?php echo $inisialsubaspek.$no.'K'; ?>" value="K" onClick="SimpanJawaban('<?php echo $soalke; ?>','<?php echo $idM; ?>','M')" ></td>
  <td><input type="radio" <?php echo $checkedM; ?> name="<?php echo $inisialsubaspek.$no; ?>" id="<?php echo $inisialsubaspek.$no.'S'; ?>" value="S" onClick="SimpanJawaban('<?php echo $soalke; ?>','<?php echo $idM; ?>','M')" ></td>
  <td><input type="radio" <?php echo $checkedM; ?> name="<?php echo $inisialsubaspek.$no; ?>" id="<?php echo $inisialsubaspek.$no.'B'; ?>" value="B" onClick="SimpanJawaban('<?php echo $soalke; ?>','<?php echo $idM; ?>','M')" ></td>
  <td><input type="radio" <?php echo $checkedM; ?> name="<?php echo $inisialsubaspek.$no; ?>" id="<?php echo $inisialsubaspek.$no.'T'; ?>" value="T" onClick="SimpanJawaban('<?php echo $soalke; ?>','<?php echo $idM; ?>','M')" ></td>
</tr> 
	<?php } ?>
</table>



<?php } ?>
</div>

          
               <div align="center"><input type="button" id="btn_3" value="PRINT" class="black"></div>

  <style type="text/css" media="print" id="print"></style>