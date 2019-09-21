<?php
include('../../session.php');
include('../../koneksi.php');
include('ajaxupdate/ajax_kirim_keluarga.php');
?>

       	<link href="../../../assets/template/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="../../../assets/css/main.css" />

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
<?php

	
	$id_calon_karyawan = $_GET['id_calon_karyawan'];
	$sqlip = mysql_query("SELECT id_calon_karyawan,left(ip,3)ip FROM log_ip where id_calon_karyawan='$id_calon_karyawan'");
    while ($rowsip = mysql_fetch_array($sqlip)) {
	$ipaddress=$rowsip['ip'];
	
	}
	if($ipaddress!="172"){
	
?>

<?php
      if($status_id == "ADMIN"){$readonly = "";}{$background = "style='background: white'";}
      if($status_id == "USERADMIN"){$readonly = "readonly";}{$background = "style='background: white'";}
/*
if (isset($status_id))
{
// jika level USER
if ($status_id == "ADMIN")
{   */
?>

	<?php
    	
	$sql = mysql_query("SELECT * FROM datakeluarga_ck where id_calon_karyawan='$id_calon_karyawan'");
    $no = 1;
    while ($rows = mysql_fetch_array($sql)) {
    	$sql2 = mysql_query("SELECT * FROM datasutri_ck where id_calon_karyawan='$id_calon_karyawan'");
    	$rows2 = mysql_fetch_array($sql2)

	?>
	<Br>
	<!-- step_2 -->
<div style="padding-left: 25px; padding-bottom: 25px;">

	<div class="row">
		<div class="col-xs-12 col-sm-12"><h1>Data Keluarga</h1></div>
	</div>
	<div class="row row-form" id="calon_karyawan" style="display: none;">
		<div class="col-xs-12 col-sm-3">
			<label for="id_calon_karyawan" class="menu_label">Calon No. Karyawan</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
				<input id="id_calon_karyawan" name="id_calon_karyawan" type="text" class="form-control" readonly value="<?php echo "$id_calon_karyawan"; ?>" />
				<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="nama_ayah" class="menu_label">Nama Ayah</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="nama_ayah" name="nama_ayah" value="<?php echo $rows['nama_ayah'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="pekerjaan_ayah" class="menu_label">Pekerjaan Ayah</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="pekerjaan_ayah" name="pekerjaan_ayah" value="<?php echo $rows['pekerjaan_ayah'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>

	<br>
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="nama_ibu" class="menu_label">Nama Ibu</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="nama_ibu" name="nama_ibu" value="<?php echo $rows['nama_ibu'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="pekerjaan_ibu" class="menu_label">Pekerjaan Ibu</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="pekerjaan_ibu" name="pekerjaan_ibu" value="<?php echo $rows['pekerjaan_ibu'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>

	<br>
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="telp_ortu" class="menu_label">No. Telp Orang Tua</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="telp_ortu" name="telp_ortu" value="<?php echo $rows['telp_ortu_z'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>
    
	<br>
	<div class="row row-form" id="alamat_ayah">
		<div class="col-xs-12 col-sm-3">
			<label for="alamat_ortu" class="menu_label">Alamat</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
				<textarea id="alamat_ortu" name="alamat_ortu" type="text" class="form-control"  style="text-transform:uppercase;height:70px;resize:none;"><?php echo $rows['alamat_ortu_z'] ?></textarea>
				<span class="text-danger"></span>
		</div>
	</div>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="status_rumah_ortu" class="menu_label">Status Rumah </label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="status_rumah_ortu" name="status_rumah_ortu" value="<?php echo $rows['status_rumah_ortu'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>


	<br>
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="saudara1" class="menu_label">Saudara 1</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="saudara1" name="saudara1" value="<?php echo $rows['saudara1'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form" id="a">
		<div class="col-xs-12 col-sm-3">
			<label for="alamat_saudara1" class="menu_label">Alamat Saudara</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
				<textarea id="alamat_saudara1" name="alamat_saudara1" type="text" class="form-control"  style="text-transform:uppercase;height:70px;resize:none;"><?php echo $rows['alamat_saudara1'] ?></textarea>
				<span class="text-danger"></span>
		</div>
	</div>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="status_rumah_saudara1" class="menu_label">Status Rumah</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="status_rumah_saudara1" name="status_rumah_saudara1" value="<?php echo $rows['status_rumah_saudara1'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="telp_saudara1" class="menu_label">No. Telp</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="telp_saudara1" name="telp_saudara1" value="<?php echo $rows['telp_saudara1_z'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>


	<br>
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="saudara2" class="menu_label">Saudara 2</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="saudara2" name="saudara2" value="<?php echo $rows['saudara2'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form" id="sdr2">
		<div class="col-xs-12 col-sm-3">
			<label for="alamat_saudara2" class="menu_label">Alamat Saudara</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
				<textarea id="alamat_saudara2" name="alamat_saudara2" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"  style="text-transform:uppercase;height:70px;resize:none;"><?php echo $rows['alamat_saudara2'] ?></textarea>
				<span class="text-danger"></span>
		</div>
	</div>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="status_rumah_saudara2" class="menu_label">Status Rumah</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="status_rumah_saudara2" name="status_rumah_saudara2" value="<?php echo $rows['status_rumah_saudara2'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="telp_saudara2" class="menu_label">No. Telp</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="telp_saudara2" name="telp_saudara2" value="<?php echo $rows['telp_saudara2_z'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>



	<br>
			<label for="nama_ibu" class="menu_label" style="font-weight: bold; ">Bagi Yang Sudah Berkeluarga</label>
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="nama_sutri" class="menu_label">Nama Istri/Suami</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="nama_sutri" name="nama_sutri" value="<?php echo $rows2['nama_sutri'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>

    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="alamat_sutri" class="menu_label">Alamat</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
				<textarea id="alamat_sutri" name="alamat_sutri" type="text" class="form-control"  style="text-transform:uppercase;height:70px;resize:none;"><?php echo $rows2['alamat_sutri_z'] ?></textarea>
				<span class="text-danger"></span>
		</div>
	</div>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="status_rumah_sutri" class="menu_label">Status Rumah Sutri</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="status_rumah_sutri" name="status_rumah_sutri" value="<?php echo $rows2['status_rumah_sutri'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>

	<?php
    
$nama_anak .= $rows2['nama_anak'];
$ttl_anak .= $rows2['ttl_anak'];
$jenis_kelamin_anak .= $rows2['jenis_kelamin_anak'];
 //tutup while diatas 


    ?>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="nama_anak" class="menu_label">Nama Anak</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="nama_anak" name="nama_anak" value="<?php echo  $nama_anak ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="ttl_anak" class="menu_label">TTL Anak</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="ttl_anak" name="ttl_anak" value="<?php echo  $ttl_anak ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="jenis_kelamin_anak" class="menu_label">JEN KEL Anak</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="jenis_kelamin_anak" name="jenis_kelamin_anak" value="<?php echo  $jenis_kelamin_anak ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>




</div>
        

</form>
<?php
 } //tutup 
?>

	<div class="row">
		<ul class="pager" style="vertical-align: top">
 			<li class="next"><a href="#step_3" id="btn_3" name="btn_2">PRINT</a></li>
 			<?php if ($status_id == "ADMIN")
			{
			?>
			<li class="next"><a href="#step_3" onClick="save_hal2()" id="btn_2" name="btn_2">UPDATE</a></li>
			<?php } ?>
		</ul>
	</div>
  <style type="text/css" media="print" id="print"></style>
  
  
  
<?php
} //tutup if ipaddress
else {
?>  




<?php
      if($status_id == "ADMIN"){$readonly = "";}{$background = "style='background: white'";}
      if($status_id == "USERADMIN"){$readonly = "readonly";}{$background = "style='background: white'";}
/*
if (isset($status_id))
{
// jika level USER
if ($status_id == "ADMIN")
{   */
?>

	<?php
    	
	$sql = mysql_query("SELECT * FROM datakeluarga_ck where id_calon_karyawan='$id_calon_karyawan'");
    $no = 1;
    while ($rows = mysql_fetch_array($sql)) {
    	$sql2 = mysql_query("SELECT * FROM datasutri_ck where id_calon_karyawan='$id_calon_karyawan'");
    	$rows2 = mysql_fetch_array($sql2)

	?>
	<Br>
	<!-- step_2 -->
<div style="padding-left: 25px; padding-bottom: 25px;">

	<div class="row">
		<div class="col-xs-12 col-sm-12"><h1>Data Keluarga</h1></div>
	</div>
	<div class="row row-form" id="calon_karyawan" style="display: none;">
		<div class="col-xs-12 col-sm-3">
			<label for="id_calon_karyawan" class="menu_label">Calon No. Karyawan</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
				<input id="id_calon_karyawan" name="id_calon_karyawan" type="text" class="form-control" readonly value="<?php echo "$id_calon_karyawan"; ?>" />
				<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="nama_ayah" class="menu_label">Nama Ayah</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="nama_ayah" name="nama_ayah" value="<?php echo $rows['nama_ayah'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="pekerjaan_ayah" class="menu_label">Pekerjaan Ayah</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="pekerjaan_ayah" name="pekerjaan_ayah" value="<?php echo $rows['pekerjaan_ayah'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>

	<br>
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="nama_ibu" class="menu_label">Nama Ibu</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="nama_ibu" name="nama_ibu" value="<?php echo $rows['nama_ibu'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="pekerjaan_ibu" class="menu_label">Pekerjaan Ibu</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="pekerjaan_ibu" name="pekerjaan_ibu" value="<?php echo $rows['pekerjaan_ibu'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>

	<br>
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="telp_ortu" class="menu_label">No. Telp Orang Tua</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="telp_ortu" name="telp_ortu" value="<?php echo $rows['telp_ortu'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>
    
	<br>
	<div class="row row-form" id="alamat_ayah">
		<div class="col-xs-12 col-sm-3">
			<label for="alamat_ortu" class="menu_label">Alamat</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
				<textarea id="alamat_ortu" name="alamat_ortu" type="text" class="form-control"  style="text-transform:uppercase;height:70px;resize:none;"><?php echo $rows['alamat_ortu'] ?></textarea>
				<span class="text-danger"></span>
		</div>
	</div>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="status_rumah_ortu" class="menu_label">Status Rumah </label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="status_rumah_ortu" name="status_rumah_ortu" value="<?php echo $rows['status_rumah_ortu'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>


	<br>
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="saudara1" class="menu_label">Saudara 1</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="saudara1" name="saudara1" value="<?php echo $rows['saudara1'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form" id="a">
		<div class="col-xs-12 col-sm-3">
			<label for="alamat_saudara1" class="menu_label">Alamat Saudara</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
				<textarea id="alamat_saudara1" name="alamat_saudara1" type="text" class="form-control"  style="text-transform:uppercase;height:70px;resize:none;"><?php echo $rows['alamat_saudara1'] ?></textarea>
				<span class="text-danger"></span>
		</div>
	</div>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="status_rumah_saudara1" class="menu_label">Status Rumah</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="status_rumah_saudara1" name="status_rumah_saudara1" value="<?php echo $rows['status_rumah_saudara1'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="telp_saudara1" class="menu_label">No. Telp</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="telp_saudara1" name="telp_saudara1" value="<?php echo $rows['telp_saudara1'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>


	<br>
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="saudara2" class="menu_label">Saudara 2</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="saudara2" name="saudara2" value="<?php echo $rows['saudara2'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form" id="sdr2">
		<div class="col-xs-12 col-sm-3">
			<label for="alamat_saudara2" class="menu_label">Alamat Saudara</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
				<textarea id="alamat_saudara2" name="alamat_saudara2" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"  style="text-transform:uppercase;height:70px;resize:none;"><?php echo $rows['alamat_saudara2'] ?></textarea>
				<span class="text-danger"></span>
		</div>
	</div>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="status_rumah_saudara2" class="menu_label">Status Rumah</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="status_rumah_saudara2" name="status_rumah_saudara2" value="<?php echo $rows['status_rumah_saudara2'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="telp_saudara2" class="menu_label">No. Telp</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="telp_saudara2" name="telp_saudara2" value="<?php echo $rows['telp_saudara2'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>



	<br>
			<label for="nama_ibu" class="menu_label" style="font-weight: bold; ">Bagi Yang Sudah Berkeluarga</label>
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="nama_sutri" class="menu_label">Nama Istri/Suami</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="nama_sutri" name="nama_sutri" value="<?php echo $rows2['nama_sutri'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>

    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="alamat_sutri" class="menu_label">Alamat</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
				<textarea id="alamat_sutri" name="alamat_sutri" type="text" class="form-control"  style="text-transform:uppercase;height:70px;resize:none;"><?php echo $rows2['alamat_sutri'] ?></textarea>
				<span class="text-danger"></span>
		</div>
	</div>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="status_rumah_sutri" class="menu_label">Status Rumah Sutri</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="status_rumah_sutri" name="status_rumah_sutri" value="<?php echo $rows2['status_rumah_sutri'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>

	<?php
    
$nama_anak .= $rows2['nama_anak'];
$ttl_anak .= $rows2['ttl_anak'];
$jenis_kelamin_anak .= $rows2['jenis_kelamin_anak'];
 //tutup while diatas 


    ?>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="nama_anak" class="menu_label">Nama Anak</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="nama_anak" name="nama_anak" value="<?php echo  $nama_anak ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="ttl_anak" class="menu_label">TTL Anak</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="ttl_anak" name="ttl_anak" value="<?php echo  $ttl_anak ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="jenis_kelamin_anak" class="menu_label">JEN KEL Anak</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="jenis_kelamin_anak" name="jenis_kelamin_anak" value="<?php echo  $jenis_kelamin_anak ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>




</div>
        

</form>
<?php
 } //tutup 
?>

	<div class="row">
		<ul class="pager" style="vertical-align: top">
 			<li class="next"><a href="#step_3" id="btn_3" name="btn_2">PRINT</a></li>
 			<?php if ($status_id == "ADMIN")
			{
			?>
			<li class="next"><a href="#step_3" onClick="save_hal2()" id="btn_2" name="btn_2">UPDATE</a></li>
			<?php } ?>
		</ul>
	</div>
  <style type="text/css" media="print" id="print"></style>
  
  
  
 <?php
 } //tutup else ipaddres
 ?>