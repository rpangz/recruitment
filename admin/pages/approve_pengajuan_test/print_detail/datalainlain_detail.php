


<div style="padding-left: 25px; padding-bottom: 25px; padding-top: 25px;">

<?php
      if($status_id == "ADMIN"){$readonly = "";}{$background = "style='background: white'";}
      if($status_id == "USERADMIN"){$readonly = "readonly";}{$background = "style='background: white'";}

$id_calon_karyawan = $_GET['id_calon_karyawan'];
    
$sql = mysql_query("SELECT * FROM dataskill_ck where id_calon_karyawan='$id_calon_karyawan'");
$no = 1;
while($rows = mysql_fetch_array($sql))
{

	?>
  <div class="row row-form" id="calon_karyawan" style="display: none;">
    <div class="col-xs-12 col-sm-3">
      <label for="id_calon_karyawan" class="menu_label">Calon No. Karyawan</label>
    </div>
    <div class="col-xs-12 col-sm-8">                                    
        <input id="id_calon_karyawan" name="id_calon_karyawan" type="text" class="form-control" readonly value="<?php echo "$id_calon_karyawan"; ?>" />
        <span class="text-danger"></span>
    </div>
  </div>

  <div class="row row-form" id="">
    <div class="col-xs-12 col-sm-3">
      <label for="skill" class="menu_label">Skill</label>
    </div>
    <div class="col-xs-12 col-sm-8">                                    
        <textarea id="skill" name="skill" placeholder="skill" type="text" class="form-control" readonly=""  style="text-transform:uppercase;height:100px;resize:none;"><?php echo $rows['skill'] ?></textarea>
        <span class="text-danger"></span>
    </div>
  </div>

<Br>
  <div class="row row-form" id="Lain-Lain">
    <div class="col-xs-12 col-sm-3">
      <label for="skill" class="Lain-Lain">Lain-Lain</label>
    </div>
  </div>

  <div class="row row-form" id="">
    <div class="col-xs-12 col-sm-12">
      <label for="skill" class="menu_label"><li>Bila Saudara diterima bekerja, apakah Saudara bersedia memberikan jaminan kerja berupa Ijasah Asli selama masa bekerja ?</li></label>
    </div>
		<div class="col-xs-12 col-sm-5">                                    
			<input id="syarat_ijasah" name="syarat_ijasah" value="<?php echo $rows['pemberian_jaminan'] ?>" readonly type="text" class="form-control"/>
			<span class="text-danger"></span>
		</div>
  </div>

<Br>
  <div class="row row-form" id="">
    <div class="col-xs-12 col-sm-12">
      <label for="skill" class="menu_label"><li>Sebutkan Nama Pejabat di PT. Mitra Dana Top Finance yang mengenal anda ?</li></label>
    </div>
    <table border="0" style="color: white; padding-left: 25px;">
      <thead>
        <th style="color: white;font-weight: lighter;">Nama</th>
        <th style="color: white;font-weight: lighter;">Hubungan</th>
        <th style="color: white;font-weight: lighter;">Jabatan</th>
      </thead>
      <tbody>
        <td><input type="text" class="form-control" name="nama_kenalan" id="nama_kenalan" value="<?php echo $rows['nama_kenalan'] ?>" readonly  style="color: black;font-weight: lighter;"></td>
        <td><input type="text" class="form-control" name="hubungan_kenalan" id="hubungan_kenalan" value="<?php echo $rows['hubungan_kenalan'] ?>" readonly style="color: black;font-weight: lighter;"></td>
        <td><input type="text" class="form-control" name="jabatan_kenalan" id="jabatan_kenalan" value="<?php echo $rows['jabatan_kenalan'] ?>" readonly style="color: black;font-weight: lighter;"></td>
      </tbody>  
    </table>
  </div>

  <div class="row row-form">
    <div class="col-xs-12 col-sm-10">
      <label for="prestasi_ck" class="menu_label"><li>Selama Anda bekerja, apa prestasi kerja yang paling gemilang yang sudah diberikan kepada perusahaan anda sebelumnya ?</li></label>
    </div>
    <div class="col-xs-12 col-sm-10">                                    
      <input id="prestasi_ck" name="prestasi_ck" type="text" class="form-control" value="<?php echo $rows['prestasi_ck'] ?>" readonly style="text-transform:uppercase"/>
      <span class="text-danger"></span>
    </div>
  </div>

  <div class="row row-form">
    <div class="col-xs-12 col-sm-10">
      <label for="prestasi_ck" class="menu_label"><li>3 Kelebihan</li></label>
    </div>
    <div class="col-xs-12 col-sm-10">                                    
      <input id="kelebihan_prestasi_ck" name="kelebihan_prestasi_ck" type="text" class="form-control" value="<?php echo $rows['tiga_kelebihan'] ?>" readonly style="text-transform:uppercase"/>
      <span class="text-danger"></span>
    </div>
  </div>

  <div class="row row-form">
    <div class="col-xs-12 col-sm-10">
      <label for="kekurangan_prestasi_ck" class="menu_label"><li>3 Kekurangan</li></label>
    </div>
    <div class="col-xs-12 col-sm-10">                                    
      <input id="kekurangan_prestasi_ck" name="kekurangan_prestasi_ck" type="text" class="form-control" value="<?php echo $rows['tiga_kekurangan'] ?>" readonly style="text-transform:uppercase" />
      <span class="text-danger"></span>
    </div>
  </div>

  <div class="row row-form">
    <div class="col-xs-12 col-sm-12">
      <label for="penempatan_di_cabang" class="menu_label"><li>Apakah anda bersedia ditempatkan di cabang perusahaan diseluruh Indonesia dimana perusahaan membutuhkan anda ?</li></label>
    </div>
    <div class="col-xs-12 col-sm-10">                                    
      <input id="penempatan_di_cabang" name="penempatan_di_cabang" type="text" class="form-control" value="<?php echo $rows['penempatan_di_cabang'] ?>" readonly style="text-transform:uppercase"/>
      <span class="text-danger"></span>
    </div>
  </div>

  <br>
  <div class="row row-form">
    <div class="col-xs-12 col-sm-10">
      <label for="kesehatan" class="menu_label"><li>Apakah Saudara pernah masuk rumah sakit atau menderita sakit yang lama sembuh ?</li></label>
    </div>
    <div class="col-xs-12 col-sm-10">                                    
      <input id="kesehatan" name="kesehatan" type="text" class="form-control" style="text-transform:uppercase" value="<?php echo $rows['penempatan_di_cabang'] ?>" readonly />
      <span class="text-danger"></span>
    </div>
  </div>



<?php } ?>
</div>

        
