<?php
include('../../session.php');
include('../../koneksi.php');
include('ajaxupdate/ajax_kirim.php');
?>
<head>
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
      #btn_2 {
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
  
</head>
<body>

<?php
      if($status_id == "ADMIN"){$readonly = "";}{$background = "style='background: white'";}
      if($status_id == "USERADMIN"){$readonly = "readonly";}{$background = "style='background: white'";}

/*if (isset($status_id))
{
// jika level USER
if ($status_id == "ADMIN")
{*/
?>

	<?php
    
	$sql = mysql_query("SELECT * FROM datapribadi_ck where id_calon_karyawan='$id_calon_karyawan'");
    $no = 1;
    while ($rows = mysql_fetch_array($sql)) {
    $kodecbg = $rows[kodecbg];

    $hris = mysql_query("SELECT a.nama FROM (SELECT kodecbg,nama,'KONVEN' pt FROM hris.cabang_konven c WHERE status = '+' UNION ALL
SELECT CONCAT('TP',kodecbg),CONCAT('TOP ',nama),'TOP' pt FROM hris.cabang_top c WHERE status = '+' AND kodecbg NOT LIKE 'A%') a where a.kodecbg='$kodecbg'");
    $hris_cbg = mysql_fetch_array($hris);
	?>
	<Br>
	<!-- step_2 -->
<div style="padding-left: 25px; padding-bottom: 15px" id="printculs">
	<div class="row">
		<div class="col-xs-12 col-sm-12"><h1>Data Pribadi</h1></div>
	</div>

	<div class="row row-form" id="calon_karyawan">
		<div class="col-xs-12 col-sm-3">
			<label for="id_calon_karyawan" class="menu_label">Calon No. Karyawan</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
				<input id="id_calon_karyawan" name="id_calon_karyawan" type="text" class="form-control" readonly value="<?php echo "$id_calon_karyawan"; ?>" />
				<span class="text-danger"></span>
		</div>
	</div>

	<div class="row row-form" id="sumber">
		<div class="col-xs-12 col-sm-3">
			<label for="sumber_lamaran" class="menu_label">Sumber Lamaran</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
				<input id="sumber_lamaran" name="sumber_lamaran" type="text" class="form-control" <?php echo $readonly ?> <?php echo $background ?> value="<?php echo $rows['sumber_lamaran']; ?>" />
				<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="no_ktp" class="menu_label">Nomor KTP/SIM</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="no_ktp" name="no_ktp" value="<?php echo $rows['no_ktp'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control required"/>
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="nama_lengkap" class="menu_label">Nama Lengkap</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="nama_lengkap" name="nama_lengkap" placeholder="Nama_lengkap" type="text" class="form-control" pattern="text" value="<?php echo $rows['nama_lengkap'] ?>" <?php echo $readonly ?> <?php echo $background ?> />
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="tempat" class="menu_label">Tempat, Tanggal Lahir</label>
		</div>
		<div class="col-xs-12 col-sm-5">                                    
			<input id="tempat_lahir" name="tempat_lahir" value="<?php echo $rows['tempat_lahir'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
        
		<div class="col-xs-12 col-sm-3">                                 
			<input id="tanggal_lahir" value="<?php echo $rows['tanggal_lahir'] ?>" <?php echo $readonly ?> <?php echo $background ?> name="tanggal_lahir" class="form-control" type="text"/>
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form" id="jensi_kelamin">
		<div class="col-xs-12 col-sm-3">
			<label for="jen_kel" class="menu_label">Jenis Kelamin</label>
		</div>
		<div class="col-xs-12 col-sm-8">
			<input id="jen_kel" value="<?php echo $rows['jen_kel'] ?>" <?php echo $readonly ?> <?php echo $background ?> name="jen_kel" class="form-control" type="text"/>
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="status_perkawinan" class="menu_label">Status Perkawinan</label>
		</div>
		<div class="col-xs-12 col-sm-8">
			<input id="status_perkawinan" value="<?php echo $rows['status_perkawinan'] ?>" <?php echo $readonly ?> <?php echo $background ?> name="status_perkawinan" class="form-control" type="text"/>
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form" id="domis">
		<div class="col-xs-12 col-sm-3">
			<label for="alamat_domisili" class="menu_label">Alamat Domisili</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
				<textarea id="alamat_domisili" name="alamat_domisili" type="text" class="form-control" <?php echo $readonly ?> <?php echo $background ?> style="text-transform:uppercase;height:70px;resize:none;"><?php echo $rows['alamat_domisili_z'] ?></textarea>
				<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form" id="katepe">
		<div class="col-xs-12 col-sm-3">
			<label for="alamat_ktp" class="menu_label">Alamat KTP</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
				<textarea id="alamat_ktp" name="alamat_ktp" type="text" class="form-control" <?php echo $readonly ?> <?php echo $background ?> style="text-transform:uppercase;height:70px;resize:none;"><?php echo $rows['alamat_ktp_z'] ?></textarea>
				<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="status_rumah" class="menu_label">Status Rumah</label>
		</div>
		<div class="col-xs-12 col-sm-8">
			<input id="status_rumah" value="<?php echo $rows['status_rumah'] ?>" <?php echo $readonly ?> <?php echo $background ?> name="status_rumah" class="form-control" type="text"/>
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="agama" class="menu_label">Agama</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="agama" name="agama" value="<?php echo $rows['agama'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="warga_negara" class="menu_label">Warga Negara</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="warga_negara" name="warga_negara" value="<?php echo $rows['warga_negara'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="telp1" class="menu_label">Telp</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="telp1" name="telp1" value="<?php echo $rows['telp1_z'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="telp2" class="menu_label">Telp Darurat</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="telp2" name="telp2" value="<?php echo $rows['telp2_z'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="alamat_email" class="menu_label">Alamat Email</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="alamat_email" name="alamat_email" value="<?php echo $rows['alamat_email_z'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="facebook_id" class="menu_label">Facebook ID</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="facebook_id" name="facebook_id" value="<?php echo $rows['facebook_id_z'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="instagram_id" class="menu_label">Instagram ID</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="instagram_id" name="instagram_id" value="<?php echo $rows['instagram_id_z'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="tweeter_id" class="menu_label">Tweeter ID</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="tweeter_id" name="tweeter_id" value="<?php echo $rows['tweeter_id_z'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>
    

    <Br>
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="divisi" class="menu_label">Divisi Yang Diinginkan</label>
		</div>
		<div class="col-xs-12 col-sm-8">
				<select name="divisi"  class="jabatan" id ="divisi" <?php echo $readonly ?> <?php echo $background ?> style="text-transform:uppercase;color: #555;">
				<option value="<?php echo $rows['divisi'] ?>"  selected="selected"><?php echo $rows['divisi'] ?></option>
                <?php
                    $sql = mysql_query("SELECT * FROM `list_jabatan` group by level");
                    while ($supplier = mysql_fetch_array($sql)) {
                    	$level="";
                    	if ($supplier[level]==SPV) {$level=" UP";}
                        echo '<option value="'.$supplier['level'].'">'.$supplier['level'].$level.'</option>';
                    }
                ?>
				</select>                                    

			<span class="text-danger"></span>
		</div>
	</div>
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="bagian" class="menu_label">Bagian Yang Diinginkan</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="bagian" name="bagian" value="<?php echo $rows['bagian'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="gaji" class="menu_label">Gaji Yang Diinginkan</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="gaji" name="gaji" value="<?php echo $rows['gaji'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="cabang" class="menu_label">Cabang</label>
		</div>
		<div class="col-xs-12 col-sm-8">      
				<select name="cabang" class = "form-control" id ="cabang" style="text-transform:uppercase"  <?php echo $readonly ?> <?php echo $background ?>>
					<option value="<?php echo $kodecbg?>" selected="selected"><?php echo $kodecbg."-".$hris_cbg[nama] ?></option>
	                <?php
	                    $cbg = mysql_query("SELECT * FROM
(SELECT kodecbg,nama,'KONVEN' pt FROM hris.cabang_konven c WHERE status = '+' UNION ALL
SELECT CONCAT('TP',kodecbg),CONCAT('TOP ',nama),'TOP' pt FROM hris.cabang_top c WHERE status = '+' AND kodecbg NOT LIKE 'A%') a
ORDER BY pt,nama");
	                    while ($supplier = mysql_fetch_array($cbg)) {
	                        echo '<option value="'.$supplier['kodecbg'].'">'.$supplier['nama'].'</option>';
	                    }
				    ?>
				</select>
		                              

			<span class="text-danger"></span>
		</div>
	</div>
</div>
        
	<?php
    $no++;
    }
    ?>

</form>

	<div class="row">
		<ul class="pager" style="vertical-align: top">
 			<li class="next"><a href="#step_3" id="btn_3" name="btn_2">PRINT</a></li>
 			<?php if ($status_id == "ADMIN")
			{
			?>
			<li class="next"><a href="#step_3" onClick="update_hal1()" id="btn_2" name="btn_2">UPDATE</a></li>
			<?php } ?>
		</ul>
	</div>

  <style type="text/css" media="print" id="print"></style>
</body>



<?php
} //tutup if ip address
else{
?>





</head>
<body>

<?php
      if($status_id == "ADMIN"){$readonly = "";}{$background = "style='background: white'";}
      if($status_id == "USERADMIN"){$readonly = "readonly";}{$background = "style='background: white'";}

/*if (isset($status_id))
{
// jika level USER
if ($status_id == "ADMIN")
{*/
?>

	<?php
    
	$sql = mysql_query("SELECT * FROM datapribadi_ck where id_calon_karyawan='$id_calon_karyawan'");
    $no = 1;
    while ($rows = mysql_fetch_array($sql)) {
    $kodecbg = $rows[kodecbg];

    $hris = mysql_query("SELECT a.nama FROM (SELECT kodecbg,nama,'KONVEN' pt FROM hris.cabang_konven c WHERE status = '+' UNION ALL
SELECT CONCAT('TP',kodecbg),CONCAT('TOP ',nama),'TOP' pt FROM hris.cabang_top c WHERE status = '+' AND kodecbg NOT LIKE 'A%') a where a.kodecbg='$kodecbg'");
    $hris_cbg = mysql_fetch_array($hris);
	?>
	<Br>
	<!-- step_2 -->
<div style="padding-left: 25px; padding-bottom: 15px" id="printculs">
	<div class="row">
		<div class="col-xs-12 col-sm-12"><h1>Data Pribadi</h1></div>
	</div>

	<div class="row row-form" id="calon_karyawan">
		<div class="col-xs-12 col-sm-3">
			<label for="id_calon_karyawan" class="menu_label">Calon No. Karyawan</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
				<input id="id_calon_karyawan" name="id_calon_karyawan" type="text" class="form-control" readonly value="<?php echo "$id_calon_karyawan"; ?>" />
				<span class="text-danger"></span>
		</div>
	</div>

	<div class="row row-form" id="sumber">
		<div class="col-xs-12 col-sm-3">
			<label for="sumber_lamaran" class="menu_label">Sumber Lamaran</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
				<input id="sumber_lamaran" name="sumber_lamaran" type="text" class="form-control" <?php echo $readonly ?> <?php echo $background ?> value="<?php echo $rows['sumber_lamaran']; ?>" />
				<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="no_ktp" class="menu_label">Nomor KTP/SIM</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="no_ktp" name="no_ktp" value="<?php echo $rows['no_ktp'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control required"/>
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="nama_lengkap" class="menu_label">Nama Lengkap</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="nama_lengkap" name="nama_lengkap" placeholder="Nama_lengkap" type="text" class="form-control" pattern="text" value="<?php echo $rows['nama_lengkap'] ?>" <?php echo $readonly ?> <?php echo $background ?> />
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="tempat" class="menu_label">Tempat, Tanggal Lahir</label>
		</div>
		<div class="col-xs-12 col-sm-5">                                    
			<input id="tempat_lahir" name="tempat_lahir" value="<?php echo $rows['tempat_lahir'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
        
		<div class="col-xs-12 col-sm-3">                                 
			<input id="tanggal_lahir" value="<?php echo $rows['tanggal_lahir'] ?>" <?php echo $readonly ?> <?php echo $background ?> name="tanggal_lahir" class="form-control" type="text"/>
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form" id="jensi_kelamin">
		<div class="col-xs-12 col-sm-3">
			<label for="jen_kel" class="menu_label">Jenis Kelamin</label>
		</div>
		<div class="col-xs-12 col-sm-8">
			<input id="jen_kel" value="<?php echo $rows['jen_kel'] ?>" <?php echo $readonly ?> <?php echo $background ?> name="jen_kel" class="form-control" type="text"/>
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="status_perkawinan" class="menu_label">Status Perkawinan</label>
		</div>
		<div class="col-xs-12 col-sm-8">
			<input id="status_perkawinan" value="<?php echo $rows['status_perkawinan'] ?>" <?php echo $readonly ?> <?php echo $background ?> name="status_perkawinan" class="form-control" type="text"/>
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form" id="domis">
		<div class="col-xs-12 col-sm-3">
			<label for="alamat_domisili" class="menu_label">Alamat Domisili</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
				<textarea id="alamat_domisili" name="alamat_domisili" type="text" class="form-control" <?php echo $readonly ?> <?php echo $background ?> style="text-transform:uppercase;height:70px;resize:none;"><?php echo $rows['alamat_domisili'] ?></textarea>
				<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form" id="katepe">
		<div class="col-xs-12 col-sm-3">
			<label for="alamat_ktp" class="menu_label">Alamat KTP</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
				<textarea id="alamat_ktp" name="alamat_ktp" type="text" class="form-control" <?php echo $readonly ?> <?php echo $background ?> style="text-transform:uppercase;height:70px;resize:none;"><?php echo $rows['alamat_ktp'] ?></textarea>
				<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="status_rumah" class="menu_label">Status Rumah</label>
		</div>
		<div class="col-xs-12 col-sm-8">
			<input id="status_rumah" value="<?php echo $rows['status_rumah'] ?>" <?php echo $readonly ?> <?php echo $background ?> name="status_rumah" class="form-control" type="text"/>
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="agama" class="menu_label">Agama</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="agama" name="agama" value="<?php echo $rows['agama'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="warga_negara" class="menu_label">Warga Negara</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="warga_negara" name="warga_negara" value="<?php echo $rows['warga_negara'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="telp1" class="menu_label">Telp</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="telp1" name="telp1" value="<?php echo $rows['telp1'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="telp2" class="menu_label">Telp Darurat</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="telp2" name="telp2" value="<?php echo $rows['telp2'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="alamat_email" class="menu_label">Alamat Email</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="alamat_email" name="alamat_email" value="<?php echo $rows['alamat_email'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="facebook_id" class="menu_label">Facebook ID</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="facebook_id" name="facebook_id" value="<?php echo $rows['facebook_id'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="instagram_id" class="menu_label">Instagram ID</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="instagram_id" name="instagram_id" value="<?php echo $rows['instagram_id'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="tweeter_id" class="menu_label">Tweeter ID</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="tweeter_id" name="tweeter_id" value="<?php echo $rows['tweeter_id'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>
    

    <Br>
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="divisi" class="menu_label">Divisi Yang Diinginkan</label>
		</div>
		<div class="col-xs-12 col-sm-8">
				<select name="divisi"  class="jabatan" id ="divisi" <?php echo $readonly ?> <?php echo $background ?> style="text-transform:uppercase;color: #555;">
				<option value="<?php echo $rows['divisi'] ?>"  selected="selected"><?php echo $rows['divisi'] ?></option>
                <?php
                    $sql = mysql_query("SELECT * FROM `list_jabatan` group by level");
                    while ($supplier = mysql_fetch_array($sql)) {
                    	$level="";
                    	if ($supplier[level]==SPV) {$level=" UP";}
                        echo '<option value="'.$supplier['level'].'">'.$supplier['level'].$level.'</option>';
                    }
                ?>
				</select>                                    

			<span class="text-danger"></span>
		</div>
	</div>
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="bagian" class="menu_label">Bagian Yang Diinginkan</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="bagian" name="bagian" value="<?php echo $rows['bagian'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="gaji" class="menu_label">Gaji Yang Diinginkan</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="gaji" name="gaji" value="<?php echo $rows['gaji'] ?>" <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="cabang" class="menu_label">Cabang</label>
		</div>
		<div class="col-xs-12 col-sm-8">      
				<select name="cabang" class = "form-control" id ="cabang" style="text-transform:uppercase"  <?php echo $readonly ?> <?php echo $background ?>>
					<option value="<?php echo $kodecbg?>" selected="selected"><?php echo $kodecbg."-".$hris_cbg[nama] ?></option>
	                <?php
	                    $cbg = mysql_query("SELECT * FROM
(SELECT kodecbg,nama,'KONVEN' pt FROM hris.cabang_konven c WHERE status = '+' UNION ALL
SELECT CONCAT('TP',kodecbg),CONCAT('TOP ',nama),'TOP' pt FROM hris.cabang_top c WHERE status = '+' AND kodecbg NOT LIKE 'A%') a
ORDER BY pt,nama");
	                    while ($supplier = mysql_fetch_array($cbg)) {
	                        echo '<option value="'.$supplier['kodecbg'].'">'.$supplier['nama'].'</option>';
	                    }
				    ?>
				</select>
		                              

			<span class="text-danger"></span>
		</div>
	</div>
</div>
        
	<?php
    $no++;
    }
    ?>

</form>

	<div class="row">
		<ul class="pager" style="vertical-align: top">
 			<li class="next"><a href="#step_3" id="btn_3" name="btn_2">PRINT</a></li>
 			<?php if ($status_id == "ADMIN")
			{
			?>
			<li class="next"><a href="#step_3" onClick="update_hal1()" id="btn_2" name="btn_2">UPDATE</a></li>
			<?php } ?>
		</ul>
	</div>

  <style type="text/css" media="print" id="print"></style>
</body>


<?php
} //tutup else ip address
?>