
  <div class="row row-form" id="">
    <div class="col-xs-12 col-sm-3">
      <label for="skill" class="menu_label">Skill</label>
    </div>
    <div class="col-xs-12 col-sm-8">                                    
        <textarea id="skill" name="skill" placeholder="skill" type="text" class="form-control" onblur="changeToUpperCase(this)"  style="text-transform:uppercase;height:100px;resize:none;" value=""></textarea>
        <span class="text-danger"></span>
    </div>
  </div>

  <div class="row row-form" id="Lain-Lain">
    <div class="col-xs-12 col-sm-3">
      <label for="skill" class="Lain-Lain">Lain-Lain</label>
    </div>
  </div>

  <div class="row row-form">
    <div class="col-xs-12 col-sm-10">
      <label for="Nama_lengkap" class="menu_label"><li>Bila Saudara diterima bekerja, apakah Saudara bersedia memberikan jaminan kerja berupa Ijasah Asli selama masa bekerja ?</li></label>

    </div>
    <div class="col-xs-12 col-sm-2">        
      <span class="text-danger">
      <select name="syarat_ijasah" class = "form-control" id ="syarat_ijasah" onblur="changeToUpperCase(this)" style="text-transform:uppercase">
      <option value="YA">Ya</option>
      <option value="TIDAK">Tidak</option>
      </select>
    </div>
  </div>

  <br>
  <div class="row row-form">
    <div class="col-xs-12 col-sm-10">
      <label for="nama_kenalan" class="menu_label"><li>Sebutkan Nama Pejabat di PT. Mitra Dana Top Finance yang mengenal anda ?</li></label>
    <table border="0" style="color: white;">
      <thead>
        <th style="color: black;font-weight: lighter;">Nama</th>
        <th style="color: black;font-weight: lighter;">Hubungan</th>
        <th style="color: black;font-weight: lighter;">Jabatan</th>
      </thead>
      <tbody>
        <td><input type="text" onblur="changeToUpperCase(this)" name="nama_kenalan" id="nama_kenalan" style="color: black;font-weight: lighter;"></td>
        <td><input type="text" onblur="changeToUpperCase(this)" name="hubungan_kenalan" id="hubungan_kenalan" style="color: black;font-weight: lighter;"></td>
        <td><input type="text" onblur="changeToUpperCase(this)" name="jabatan_kenalan" id="jabatan_kenalan" style="color: black;font-weight: lighter;"></td>
      </tbody>  
    </table>
    </div>
  </div>

  <div class="row row-form">
    <div class="col-xs-12 col-sm-10">
      <label for="prestasi_ck" class="menu_label"><li>Selama Anda bekerja, apa prestasi kerja yang paling gemilang yang sudah diberikan kepada perusahaan anda sebelumnya ?</li></label>
    </div>
    <div class="col-xs-12 col-sm-10">                                    
      <input id="prestasi_ck" onblur="changeToUpperCase(this)" name="prestasi_ck" type="text" class="form-control" style="text-transform:uppercase" value="" />
      <span class="text-danger"></span>
    </div>
  </div>

  <br>
  <div class="row row-form">
    <div class="col-xs-12 col-sm-10">
      <label for="kekurangankelebihan" class="menu_label"><li>Sebutkan 3 kelebihan dan 3 kekurangan anda !</li></label>
    <table border="0" style="color: white;">
      <thead>
        <th style="color: black;font-weight: lighter;">Kelebihan</th>
        <th style="color: black;font-weight: lighter;">Kekurangan</th>
      </thead>
      <tbody>
      <tr>
        <td><input type="text" onblur="changeToUpperCase(this)" name="kelebihan1" id="kelebihan1" placeholder="kelebihan" style="color: black;font-weight: lighter;"></td>
        <td><input type="text" onblur="changeToUpperCase(this)" name="kekurangan1" id="kekurangan1" placeholder="kekurangan" style="color: black;font-weight: lighter;"></td>
      </tr>
      <tr>
        <td><input type="text" onblur="changeToUpperCase(this)" name="kelebihan2" id="kelebihan2" placeholder="kelebihan" style="color: black;font-weight: lighter;"></td>
        <td><input type="text" onblur="changeToUpperCase(this)" name="kekurangan2" id="kekurangan2" placeholder="kekurangan" style="color: black;font-weight: lighter;"></td>
      </tr>
      <tr>
        <td><input type="text" onblur="changeToUpperCase(this)" name="kelebihan3" id="kelebihan3" placeholder="kelebihan" style="color: black;font-weight: lighter;"></td>
        <td><input type="text" onblur="changeToUpperCase(this)" name="kekurangan3" id="kekurangan3" placeholder="kekurangan" style="color: black;font-weight: lighter;"></td>
      </tr>
      </tbody>  
    </table>
    </div>
  </div>

  <div class="row row-form">
    <div class="col-xs-12 col-sm-10">
      <label for="penempatan_di_cabang" class="menu_label"><li>Apakah anda bersedia ditempatkan di cabang perusahaan diseluruh Indonesia dimana perusahaan membutuhkan anda ?</li></label>

    </div>
    <div class="col-xs-12 col-sm-2">        
      <span class="text-danger">
      <select name="penempatan_di_cabang" onblur="changeToUpperCase(this)" class = "form-control" id = "penempatan_di_cabang" style="text-transform:uppercase">
      <option value="YA">Ya</option>
      <option value="TIDAK">Tidak</option>
      </select>
    </div>
  </div>

  <br>
  <div class="row row-form">
    <div class="col-xs-12 col-sm-10">
      <label for="kesehatan" class="menu_label"><li>Apakah Saudara pernah masuk rumah sakit atau menderita sakit yang lama sembuh ?</li></label>
    </div>
    <div class="col-xs-12 col-sm-10">                                    
      <input id="kesehatan" onblur="changeToUpperCase(this)" name="kesehatan" type="text" class="form-control" style="text-transform:uppercase" value="" />
      <span class="text-danger"></span>
    </div>
  </div>
