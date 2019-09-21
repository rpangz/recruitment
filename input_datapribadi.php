
	<div class="row row-form" id="id_calon_karyawan_show">
		<div class="col-xs-12 col-sm-3">
			<label for="id_calon_karyawan_show" class="menu_label">Calon No. Karyawan</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
				<input id="id_calon_karyawan_show" name="id_calon_karyawan_show" type="text" class="form-control" disabled="disabled" value="<?php echo "$NewID"; ?>" />
				<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="sumber_lamaran" class="menu_label">Sumber Lamaran</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
		<select id="sumber_lamaran" class="form-control" style="width:166">
			<option value="">- Pilih Sumber -</option>
			<?php
				$sql = mysql_query("SELECT * FROM `list_sumber`");
				while ($proyek = mysql_fetch_array($sql)) {
					echo '<option value="'.$proyek['nama_sumber'].'">'.$proyek['nama_sumber'].'</option>';
				}
			?>
		</select>
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="no_ktp" class="menu_label">Nomor KTP/SIM</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="no_ktp" name="no_ktp" placeholder="no_ktp" type="text" class="form-control required" onkeypress="return isNumber(event)" />
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="nama_lengkap" class="menu_label">Nama Lengkap</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="nama_lengkap" name="nama_lengkap" placeholder="Nama_lengkap" type="text" class="form-control" pattern="text" style="text-transform:uppercase" onblur="changeToUpperCase(this)"/>
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="tempat" class="menu_label">Tempat, Tanggal Lahir</label>
		</div>
		<div class="col-xs-12 col-sm-5">                                    
			<input id="tempat_lahir" name="tempat_lahir" placeholder="tempat_lahir" type="text" class="form-control" style="text-transform:uppercase" onblur="changeToUpperCase(this)"/>
			<span class="text-danger"></span>
		</div>
        
		<div class="col-xs-12 col-sm-3">                                 
			<input id="tanggal_lahir" name="tanggal_lahir" placeholder="tanggal_lahir" type="text"/>
		</div>
	</div>
    
	<div class="row row-form" id="jensi_kelamin">
		<div class="col-xs-12 col-sm-3">
			<label for="jen_kel" class="menu_label">Jenis Kelamin</label>
		</div>
		<div class="col-xs-12 col-sm-8">
						<span class="text-danger"> <select name="jen_kel" class = "form-control" id = "jen_kel" style="text-transform:uppercase">
<option value="LAKI-LAKI">Laki-Laki</option>
<option value="PEREMPUAN">Perempuan</option>
</select>
</span> 
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="status_perkawinan" class="menu_label">Status Perkawinan</label>
		</div>
		<div class="col-xs-12 col-sm-8">
						<span class="text-danger"> <select name="status_perkawinan" class = "form-control" id = "status_perkawinan" style="text-transform:uppercase">
<option value="BELUM_KAWIN">Belum Kawin</option>
<option value="MENIKAH">Menikah</option>
<option value="BERCERAI">BERCERAI</option>
</select>
</span> 
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form" id="domis">
		<div class="col-xs-12 col-sm-3">
			<label for="alamat_domisili" class="menu_label">Alamat Domisili</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
				<textarea id="alamat_domisili" name="alamat_domisili" placeholder="alamat_domisili" type="text" class="form-control" style="text-transform:uppercase;height:70px;resize:none;" onblur="changeToUpperCase(this)"></textarea>
				<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form" id="katepe">
		<div class="col-xs-12 col-sm-3">
			<label for="alamat_ktp" class="menu_label">Alamat KTP</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
				<textarea id="alamat_ktp" name="alamat_ktp" placeholder="alamat_ktp" type="text" class="form-control"  style="text-transform:uppercase;height:70px;resize:none;" value="" onblur="changeToUpperCase(this)"></textarea>
				<span class="text-danger"></span>
		</div>
	</div>
    
<!-- 	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="kode_pos" class="menu_label">Kode Pos</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="kode_pos" name="kode_pos" placeholder="kode_pos" type="text" class="form-control" style="text-transform:uppercase" onblur="changeToUpperCase(this)"  onkeypress="return isNumber(event)" value="" />
			<span class="text-danger"></span>
		</div>
	</div> -->
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="status_rumah" class="menu_label">Status Rumah</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
		<select id="status_rumah" class="form-control" style="width:166">
			<option value="">- Pilih Status -</option>
			<?php
				$sql = mysql_query("SELECT * FROM `list_status_rumah`");
				while ($proyek = mysql_fetch_array($sql)) {
					echo '<option value="'.$proyek['status_rumah'].'">'.$proyek['status_rumah'].'</option>';
				}
			?>
		</select>
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="agama" class="menu_label">Agama</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="agama" name="agama" placeholder="agama" type="text" class="form-control" style="text-transform:uppercase" onblur="changeToUpperCase(this)" value="" />
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="warga_negara" class="menu_label">Warga Negara</label>
		</div>
		<div class="col-xs-12 col-sm-8">
						<span class="text-danger"> <select name="warga_negara" class = "form-control" id = "warga_negara" style="text-transform:uppercase">
<option value="WNI">WNI</option>
<option value="WNA">WNA</option>
</select>
</span> 
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="telp1" class="menu_label">Telp</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="telp1" name="telp1" placeholder="telp1" type="text" class="form-control" style="text-transform:uppercase" onblur="changeToUpperCase(this)" onkeypress="return isNumber(event)"  />
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="telp2" class="menu_label">Telp Darurat</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="telp2" name="telp2" placeholder="telp2" type="text" class="form-control" style="text-transform:uppercase" onblur="changeToUpperCase(this)" onkeypress="return isNumber(event)"  />
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="alamat_email" class="menu_label">Alamat Email</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="alamat_email" name="alamat_email" placeholder="alamat email" type="text" class="form-control" style="text-transform:uppercase" onblur="changeToUpperCase(this)" value="" />
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="facebook_id" class="menu_label">Facebook ID</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="facebook_id" name="facebook_id" placeholder="ID FACEBOOK" type="text" class="form-control" style="text-transform:uppercase" onblur="changeToUpperCase(this)" value="" />
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="instagram_id" class="menu_label">Instagram ID</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="instagram_id" name="instagram_id" placeholder="ID INSTAGRAM" type="text" class="form-control" style="text-transform:uppercase" onblur="changeToUpperCase(this)" value="" />
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="tweeter_id" class="menu_label">Tweeter ID</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="tweeter_id" name="tweeter_id" placeholder="ID TWEETER" type="text" class="form-control" style="text-transform:uppercase" onblur="changeToUpperCase(this)" value="" />
			<span class="text-danger"></span>
		</div>
	</div>
    <!-- 
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="tinggi" class="menu_label">Tinggi</label>
		</div>
		<div class="col-xs-12 col-sm-3">                                    
			<input id="tinggi" name="tinggi" placeholder="tinggi" type="text" class="form-control" style="text-transform:uppercase" onblur="changeToUpperCase(this)" value="" onkeypress="return isNumber(event)"/>
			<span class="text-danger"></span>
		</div>
			<label for="tinggi" class="menu_label" style="float: left;vertical-align: middle; padding-left: 0;">CM,</label>

		<div class="col-xs-12 col-sm-1">
			<label for="berat_badan" class="menu_label">Berat Badan</label>
		</div>
		<div class="col-xs-12 col-sm-3">                                 
			<input id="berat_badan" name="berat_badan" placeholder="berat_badan" type="text" class="form-control" style="text-transform:uppercase" onblur="changeToUpperCase(this)" value="" />
		</div>
			<label for="tinggi" class="menu_label" style="float: left;vertical-align: middle; padding-left: 0;">KG</label>
	</div> -->
    

    <Br>
	<div class="row row-form" style="display: ;">
		<div class="col-xs-12 col-sm-3">
			<label for="divisi" class="menu_label">Jabatan Yang Diinginkan</label>
		</div>
		<div class="col-xs-12 col-sm-8">
			<span class="text-danger"> 
				<select name="divisi"  class="jabatan" id ="divisi" style="text-transform:uppercase;color: #555;">
				<option value="" selected="selected">- Silakan Pilih -</option>
                <?php
                    $sql = mysql_query("SELECT * FROM `list_jabatan` group by level");
                    while ($supplier = mysql_fetch_array($sql)) {
                    	$level="";
                    	if ($supplier[level]==SPV) {$level=" UP";}
                        echo '<option value="'.$supplier['level'].'">'.$supplier['level'].$level.'</option>';
                    }
                ?>
				</select>
			</span> 
			<span class="text-danger"></span>
		</div>
	</div>
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="bagian" class="menu_label">Bagian Yang Diinginkan</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                                
			<span class="text-danger">

				<select name="room" id="bagian" name="bagian" class = "form-control" style="text-transform:uppercase"  onblur="changeToUpperCase(this)">
                <option value=""></option>
                </select>

		</div>
	</div>
    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="gaji" class="menu_label">Gaji Yang Diinginkan</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="gaji" name="gaji" placeholder="gaji" type="text" class="form-control" style="text-transform:uppercase" onblur="changeToUpperCase(this)" value="" onkeypress="return isNumber(event)"  />
			<span class="text-danger"></span>
		</div>
	</div>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="cabang" class="menu_label">Cabang Yang Diinginkan</label>
		</div>            		<div class="col-xs-12 col-sm-8">
			<span class="text-danger">
				<select name="cabang" class = "form-control" id ="cabang" style="text-transform:uppercase">
					<option value="" selected="selected">- Silakan Pilih -</option>
	                <?php
	                    $cbg = mysql_query("SELECT * FROM
(SELECT kodecbg,nama,'KONVEN' pt FROM cabang_konven c WHERE status = '+' ) a
ORDER BY pt,nama");
	                    while ($supplier = mysql_fetch_array($cbg)) {
	                        echo '<option value="'.$supplier['kodecbg'].'">'.$supplier['nama'].'</option>';
	                    }
				    ?>
				</select>
			</span> 
			<span class="text-danger"></span>
		</div>
	</div>
