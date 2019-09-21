
<div style="padding-left: 25px; padding-bottom: 25px;">

<?php
      if($status_id == "ADMIN"){$readonly = "readonly";}{$background = "style='background: white'";}
      if($status_id == "USERADMIN"){$readonly = "readonly";}{$background = "style='background: white'";}

$id_calon_karyawan = $_GET['id_calon_karyawan'];
    
$sql = mysql_query("SELECT * FROM datasekolah_ck where id_calon_karyawan='$id_calon_karyawan'");

$sql2 = mysql_query("SELECT count(1) FROM datasekolah_ck where id_calon_karyawan='$id_calon_karyawan'");
$count = mysql_fetch_row($sql2);
$no = 1;

while($rows = mysql_fetch_array($sql))
{
$jenis_pendidikan .= $rows['pendidikan']."|";
$nama_sekolah .= $rows['nama_sekolah']."|";
$tahun_sekolah .= $rows['tahun_sekolah']."|";
$status_sekolah .= $rows['status_sekolah']."|";
$no_datasekolah .= $rows['no_datasekolah']."|";
}
	if (mysql_num_rows($sql) >= 1) { 
		$a = mysql_num_rows($sql);

		 for ($i=0; $i < $a; $i++) { 
		 $jenis_pendidikan2 = explode("|", $jenis_pendidikan);
		 $nama_sekolah2 = explode("|", $nama_sekolah);
		 $tahun_sekolah2 = explode("|", $tahun_sekolah);
		 $status_sekolah2 = explode("|", $status_sekolah);
		 $no_datasekolah2 = explode("|", $no_datasekolah);
	?>

  <div class="row row-form" id="calon_karyawan" style="display: none;">
    <div class="col-xs-12 col-sm-8">                                    
			<input name="hdnLinepeng1" id="hdnLinepeng1" type="text" value="<?php echo $count[0] ?>"/>	
        <span class="text-danger"></span>
    </div>
  </div>

  <div class="row row-form" id="calon_karyawan" style="display: none;">
    <div class="col-xs-12 col-sm-3">
      <label for="id_calon_karyawan" class="menu_label">Calon No. Karyawan</label>
    </div>
    <div class="col-xs-12 col-sm-8">                                    
        <input id="id_calon_karyawan<?php echo "$no"; ?>" name="id_calon_karyawan" type="text" class="form-control" readonly value="<?php echo "$id_calon_karyawan"; ?>" />
        <input id="kirim_id_ck" name="kirim_id_ck" type="text" class="form-control" readonly value="<?php echo "$id_calon_karyawan"; ?>" />
        <span class="text-danger"></span>
    </div>
  </div>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="jenis_pendidikan" class="menu_label">Pendidikan</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="jenis_pendidikan<?php echo "$no"; ?>" name="jenis_pendidikan" value="<?php echo $jenis_pendidikan2[$i]?>"  <?php echo $readonly ?> <?php echo $background ?> type="text" style="background: white" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="pendidikan" class="menu_label">Nama Univ/Sekolah</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="pendidikan<?php echo "$no"; ?>" name="pendidikan" value="<?php echo $nama_sekolah2[$i]?>"  <?php echo $readonly ?> <?php echo $background ?> type="text" style="background: white" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="tahun_pendidikan" class="menu_label">Tahun Sekolah</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="tahun_pendidikan<?php echo "$no"; ?>" name="tahun_pendidikan" value="<?php echo $tahun_sekolah2[$i]?>"  <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="status_pendidikan" class="menu_label">Status Sekolah</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="status_pendidikan<?php echo "$no"; ?>" name="status_pendidikan" value="<?php echo $status_sekolah2[$i]?>"  <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>

	<Br>
	<?php
	$no++; 
		} 
	}
	?>



<?php
$id_calon_karyawan = $_GET['id_calon_karyawan'];
    
$sql = mysql_query("SELECT * FROM datapengalaman_ck where id_calon_karyawan='$id_calon_karyawan'");


$sql2 = mysql_query("SELECT count(1) FROM datapengalaman_ck where id_calon_karyawan='$id_calon_karyawan'");
$count = mysql_fetch_row($sql2);

$no = 1;
while($rows = mysql_fetch_array($sql))
{
$perusahaan .= $rows['perusahaan']."|";
$gaji_sebelumnya .= $rows['gaji_sebelumnya']."|";
$jabatan_sebelumnya .= $rows['jabatan_sebelumnya']."|";
$tahun_kerja_sebelumnya .= $rows['tahun_kerja_sebelumnya']."|";
$alasan_berhenti .= $rows['alasan_berhenti']."|";
$jobdesk_sebelumnya .= $rows['jobdesk_sebelumnya']."|";
}
	if (mysql_num_rows($sql) >= 1) { 
		$a = mysql_num_rows($sql);

		 for ($i=0; $i < $a; $i++) { 
		 $perusahaan2 = explode("|", $perusahaan);
		 $gaji_sebelumnya2 = explode("|", $gaji_sebelumnya);
		 $jabatan_sebelumnya2 = explode("|", $jabatan_sebelumnya);
		 $tahun_kerja_sebelumnya2 = explode("|", $tahun_kerja_sebelumnya);
		 $alasan_berhenti2 = explode("|", $alasan_berhenti);
		 $jobdesk_sebelumnya2 = explode("|", $jobdesk_sebelumnya);
	?>
  <div class="row row-form" id="calon_karyawan" style="display: none;">
    <div class="col-xs-12 col-sm-8">                                    
			<input name="hdnLinepeng2" id="hdnLinepeng2" type="text" value="<?php echo $count[0] ?>"/>	
        <span class="text-danger"></span>
    </div>
  </div>

  <div class="row row-form" id="calon_karyawan" style="display: none;">
    <div class="col-xs-12 col-sm-3">
      <label for="id_calon_karyawan2" class="menu_label">Calon No. Karyawan</label>
    </div>
    <div class="col-xs-12 col-sm-8">                                    
        <input id="id_calon_karyawan2<?php echo "$no"; ?>" name="id_calon_karyawan2" type="text" class="form-control" readonly value="<?php echo "$id_calon_karyawan"; ?>" />
        <span class="text-danger"></span>
    </div>
  </div>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-4">
			<label for="perusahaan" class="menu_label">Perusahaan</label>
		</div>
		<div class="col-xs-12 col-sm-7">                                    
			<input id="perusahaan<?php echo "$no"; ?>" name="perusahaan" value="<?php echo $perusahaan2[$i]?>"  <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-4">
			<label for="gaji_sebelumnya" class="menu_label">Gaji Sebelumnya</label>
		</div>
		<div class="col-xs-12 col-sm-7">                                    
			<input id="gaji_sebelumnya<?php echo "$no"; ?>" name="gaji_sebelumnya" value="<?php echo $gaji_sebelumnya2[$i]?>"  <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-4">
			<label for="jabatan_sebelumnya" class="menu_label">Jabatan Sebelumnya</label>
		</div>
		<div class="col-xs-12 col-sm-7">                                    
			<input id="jabatan_sebelumnya<?php echo "$no"; ?>" name="jabatan_sebelumnya" value="<?php echo $jabatan_sebelumnya2[$i]?>"  <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-4">
			<label for="tahun_kerja_sebelumnya" class="menu_label">Tahun Kerja Sebelumnya</label>
		</div>
		<div class="col-xs-12 col-sm-7">                                    
			<input id="tahun_kerja_sebelumnya<?php echo "$no"; ?>" name="tahun_kerja_sebelumnya" value="<?php echo $tahun_kerja_sebelumnya2[$i]?>"  <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-4">
			<label for="alasan_berhenti_sebelumnya" class="menu_label">Alasan Berhenti</label>
		</div>
		<div class="col-xs-12 col-sm-7">                                    
			<input id="alasan_berhenti_sebelumnya<?php echo "$no"; ?>" name="alasan_berhenti_sebelumnya" value="<?php echo $alasan_berhenti2[$i]?>"  <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-4">
			<label for="jobdesk_sebelumnya" class="menu_label">Jobdesk Sebelumnya</label>
		</div>
		<div class="col-xs-12 col-sm-7">                                    
			<input id="jobdesk_sebelumnya<?php echo "$no"; ?>" name="jobdesk_sebelumnya" value="<?php echo $jobdesk_sebelumnya2[$i]?>"  <?php echo $readonly ?> <?php echo $background ?> type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
	</div>
	
	<Br>
	<?php 
	$no++;
		} 
	}
	?>


</div>
