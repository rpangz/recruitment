    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="nama_ayah" class="menu_label">Nama Ayah</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="nama_ayah" name="nama_ayah" placeholder="nama_ayah" type="text" class="form-control" style="text-transform:uppercase" onblur="changeToUpperCase(this)" value="" />
			<span class="text-danger"></span>
		</div>
	</div>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="pekerjaan_ayah" class="menu_label">Pekerjaan Ayah</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="pekerjaan_ayah" name="pekerjaan_ayah" placeholder="pekerjaan_ayah" type="text" class="form-control" style="text-transform:uppercase" onblur="changeToUpperCase(this)" value="" />
			<span class="text-danger"></span>
		</div>
	</div>

	<br>
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="nama_ibu" class="menu_label">Nama Ibu</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="nama_ibu" name="nama_ibu" placeholder="nama_ibu" type="text" class="form-control" style="text-transform:uppercase" onblur="changeToUpperCase(this)" value="" />
			<span class="text-danger"></span>
		</div>
	</div>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="pekerjaan_ibu" class="menu_label">Pekerjaan Ibu</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="pekerjaan_ibu" name="pekerjaan_ibu" placeholder="pekerjaan_ibu" type="text" class="form-control" style="text-transform:uppercase" onblur="changeToUpperCase(this)" value="" />
			<span class="text-danger"></span>
		</div>
	</div>

	<br>
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="telp_ortu" class="menu_label">No. Telp Orang Tua</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="telp_ortu" name="telp_ortu" onkeypress="return isNumber(event)" placeholder="telp_ortu" type="text" class="form-control" style="text-transform:uppercase" onblur="changeToUpperCase(this)" value="" />
			<span class="text-danger"></span>
		</div>
	</div>
    
	<br>
	<div class="row row-form" id="alamat_ayah">
		<div class="col-xs-12 col-sm-3">
			<label for="alamat_ortu" class="menu_label">Alamat</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
				<textarea id="alamat_ortu" name="alamat_ortu" placeholder="alamat_ortu" type="text" class="form-control"  style="text-transform:uppercase;height:70px;resize:none;"  onblur="changeToUpperCase(this)" value=""></textarea>
				<span class="text-danger"></span>
		</div>
	</div>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="status_rumah_ortu" class="menu_label">Status Rumah </label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<span class="text-danger">                                     
			<select id="status_rumah_ortu" class="form-control" style="width:166">
				<option value="">- Pilih Status -</option>
				<?php
					$sql = mysql_query("SELECT * FROM `list_status_rumah`");
					while ($proyek = mysql_fetch_array($sql)) {
						echo '<option value="'.$proyek['status_rumah'].'">'.$proyek['status_rumah'].'</option>';
					}
				?>
			</select>
			</span> 
		</div>
	</div>


    <!-- 
	<div class="row row-form" id="alamat_ibu">
		<div class="col-xs-12 col-sm-3">
			<label for="alamat_ibu" class="menu_label">Alamat Ibu</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
				<textarea id="alamat_ibu" name="alamat_ibu" placeholder="alamat_ibu" type="text" class="form-control"  style="text-transform:uppercase;height:70px;resize:none;" value=""></textarea>
				<span class="text-danger"></span>
		</div>
	</div>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="status_rumah_ibu" class="menu_label">Status Rumah Ibu</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<span class="text-danger">                                     
			<select id="nama_proyek" class="form-control" style="width:166">
				<option value="">- Pilih Status -</option>
			</select>
			</span> 
		</div>
	</div>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="telp_ibu" class="menu_label">No. Telp Ibu</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="telp_ibu" name="telp_ayah1" placeholder="telp_ibu" type="text" class="form-control" style="text-transform:uppercase" onblur="changeToUpperCase(this)" value="" />
			<span class="text-danger"></span>
		</div>
	</div> -->


	<br>
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="saudara1" class="menu_label">Saudara Kandung 1</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="saudara1" name="saudara1" placeholder="saudara1" type="text" class="form-control" style="text-transform:uppercase" onblur="changeToUpperCase(this)" value="" />
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form" id="a">
		<div class="col-xs-12 col-sm-3">
			<label for="alamat_saudara1" class="menu_label">Alamat Saudara</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
				<textarea id="alamat_saudara1" name="alamat_saudara1" placeholder="alamat_saudara1" type="text" class="form-control" style="text-transform:uppercase;height:70px;resize:none;"  onblur="changeToUpperCase(this)" value=""></textarea>
				<span class="text-danger"></span>
		</div>
	</div>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="status_rumah_saudara1" class="menu_label">Status Rumah</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                   
			<span class="text-danger">                                     
			<select id="status_rumah_saudara1" class="form-control" style="width:166">
				<option value="">- Pilih Status -</option>
				<?php
					$sql = mysql_query("SELECT * FROM `list_status_rumah`");
					while ($proyek = mysql_fetch_array($sql)) {
						echo '<option value="'.$proyek['status_rumah'].'">'.$proyek['status_rumah'].'</option>';
					}
				?>
			</select>
			</span> 
		</div>
	</div>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="telp_saudara1" class="menu_label">No. Telp</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="telp_saudara1" name="telp_saudara1" onkeypress="return isNumber(event)" placeholder="telp_saudara1" type="text" class="form-control" style="text-transform:uppercase" onblur="changeToUpperCase(this)" value="" />
			<span class="text-danger"></span>
		</div>
	</div>


	<br>
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="saudara2" class="menu_label">Saudara Kandung 2</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="saudara2" name="saudara2" placeholder="saudara2" type="text" class="form-control" style="text-transform:uppercase" onblur="changeToUpperCase(this)" value="" />
			<span class="text-danger"></span>
		</div>
	</div>
    
	<div class="row row-form" id="sdr2">
		<div class="col-xs-12 col-sm-3">
			<label for="alamat_saudara2" class="menu_label">Alamat Saudara</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
				<textarea id="alamat_saudara2" name="alamat_saudara2" placeholder="alamat_saudara2" type="text" class="form-control"  style="text-transform:uppercase;height:70px;resize:none;"  onblur="changeToUpperCase(this)" value=""></textarea>
				<span class="text-danger"></span>
		</div>
	</div>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="status_rumah_saudara2" class="menu_label">Status Rumah</label>
		</div>
		<div class="col-xs-12 col-sm-8">                               
			<span class="text-danger">                                     
			<select id="status_rumah_saudara2" class="form-control" style="width:166">
				<option value="">- Pilih Status -</option>
				<?php
					$sql = mysql_query("SELECT * FROM `list_status_rumah`");
					while ($proyek = mysql_fetch_array($sql)) {
						echo '<option value="'.$proyek['status_rumah'].'">'.$proyek['status_rumah'].'</option>';
					}
				?>
			</select>
			</span> 
		</div>
	</div>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="telp_saudara2" class="menu_label">No. Telp</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<input id="telp_saudara2" name="telp_saudara2" onkeypress="return isNumber(event)" placeholder="telp_saudara2" type="text" class="form-control" style="text-transform:uppercase" onblur="changeToUpperCase(this)" value="" />
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
			<input id="nama_sutri" name="nama_sutri" placeholder="nama_sutri" type="text" class="form-control" style="text-transform:uppercase" onblur="changeToUpperCase(this)" value="" />
			<span class="text-danger"></span>
		</div>
	</div>

    
	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="alamat_sutri" class="menu_label">Alamat</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
				<textarea id="alamat_sutri" name="alamat_sutri" placeholder="alamat_sutri" type="text" class="form-control"  style="text-transform:uppercase;height:70px;resize:none;"  onblur="changeToUpperCase(this)" value=""></textarea>
				<span class="text-danger"></span>
		</div>
	</div>

	<div class="row row-form">
		<div class="col-xs-12 col-sm-3">
			<label for="status_rumah_sutri" class="menu_label">Status Rumah </label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
			<span class="text-danger">                                     
			<select id="status_rumah_sutri" class="form-control" style="width:166">
				<option value="">- Pilih Status -</option>
				<?php
					$sql = mysql_query("SELECT * FROM `list_status_rumah`");
					while ($proyek = mysql_fetch_array($sql)) {
						echo '<option value="'.$proyek['status_rumah'].'">'.$proyek['status_rumah'].'</option>';
					}
				?>
			</select>
			</span> 
		</div>
	</div>

<!-- 

    <br>
	<table id="table_SUTRI" border="1" style="border-color: #808080">
	  <thead>
	  	<th>Data Suami/Istri<p style="font-weight: lighter;">(bagi yang sudah berkeluarga)</p></th>
	  </thead>
	  <tbody>
	  	<tr>
	  		<td align="center">
	            <span id="mySutri1"></span>
				<input name="hdnLinesut1" id="hdnLinesut1" type="hidden" value="0"/>	
				&nbsp;<input style="align-content: center;" name="lmpCreate1" type="button" value="tambah" onClick="JavaScript:createsutri();"/>
				&nbsp;<input name="lmpDelete1" type="button" value="kurang" onClick="JavaScript:deletesutri();"/><br>
	            &nbsp;&nbsp;<label class="menu_label">Klik tambah Untuk Mengisi Data Suami/Istri Dan Klik kurang Untuk Mengurangi Data Data Suami/Istri</label>
	        </td>
	  	</tr>
	  </tbody>
	</table> -->


    <br>
	<table id="table_anak" border="0"  style="border-color: #808080">
	  <thead>
	  	<th style="font-weight: normal;">Data Anak<!-- <p style="font-weight: lighter;">(bagi yang sudah berkeluarga)</p> --></th>
	  </thead>
	  <tbody>
	  	<tr>
	  		<td align="center">
	            <span id="mySutri2"></span>
				<input name="hdnLinesut2" id="hdnLinesut2" type="hidden" value="0"/>	
				&nbsp;<input name="lmpCreate2" type="button" value="tambah" onClick="JavaScript:createanak();"/>
				&nbsp;<input name="lmpDelete2" type="button" value="kurang" onClick="JavaScript:deleteanak();"/><br>
	            &nbsp;&nbsp;<label class="menu_label">Klik tambah Untuk Mengisi Data Anak Dan Klik kurang Untuk Mengurangi Data Data Anak</label>
	        </td>
	  	</tr>
	  </tbody>
	</table>