<script type="text/javascript" src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script>
function save_hal2()
		{
		isError = false;

						
		if($("#nama_ayah").val() == "" && !isError){
						isError = true;
						alert('nama_ayah harus diisi');
						$("#nama_ayah").focus();
					}
					else if($("#pekerjaan_ayah").val() == "" && !isError){
						isError = true;
						alert('pekerjaan_ayah harus diisi');
						$("#pekerjaan_ayah").focus();
					}
					else if($("#nama_ibu").val() == "" && !isError){
						isError = true;
						alert('nama_ibu harus diisi');
						$("#nama_ibu").focus();
					}
					else if($("#pekerjaan_ibu").val() == "" && !isError){
						isError = true;
						alert('pekerjaan_ibu harus diisi');
						$("#pekerjaan_ibu").focus();
					}
					else if($("#telp_ortu").val() == "" && !isError){
						isError = true;
						alert('telp_ortu harus diisi');
						$("#telp_ortu").focus();
					}
					else if($("#alamat_ortu").val() == "" && !isError){
						isError = true;
						alert('alamat_ortu harus diisi');
						$("#alamat_ortu").focus();
					}
					else if($("#status_rumah_ortu").val() == "" && !isError){
						isError = true;
						alert('status_rumah_ortu harus diisi');
						$("#status_rumah_ortu").focus();
					}
			
						if(isError==false){

									var nama_ayah = document.getElementById("nama_ayah").value;
									var pekerjaan_ayah = document.getElementById("pekerjaan_ayah").value;
									var nama_ibu = document.getElementById("nama_ibu").value;
									var pekerjaan_ibu = document.getElementById("pekerjaan_ibu").value;
									var telp_ortu = document.getElementById("telp_ortu").value;
									var alamat_ortu = document.getElementById("alamat_ortu").value;
									var status_rumah_ortu = document.getElementById("status_rumah_ortu").value;
									var saudara1 = document.getElementById("saudara1").value;
									var alamat_saudara1 = document.getElementById("alamat_saudara1").value;
									var status_rumah_saudara1 = document.getElementById("status_rumah_saudara1").value;
									var telp_saudara1 = document.getElementById("telp_saudara1").value;
									var saudara2 = document.getElementById("saudara2").value;
									var alamat_saudara2 = document.getElementById("alamat_saudara2").value;
									var status_rumah_saudara2 = document.getElementById("status_rumah_saudara2").value;
									var telp_saudara2 = document.getElementById("telp_saudara2").value;
									var nama_sutri = document.getElementById("nama_sutri").value;
									var alamat_sutri = document.getElementById("alamat_sutri").value;
									var status_rumah_sutri = document.getElementById("status_rumah_sutri").value;
									var id_calon_karyawan = document.getElementById("id_calon_karyawan").value;


/*
									var tambahoto = document.getElementById("hdnLinesut1").value;
										var nama_sutri = [];
										var alamat_sutri = [];
										var status_rumah_sutri = [];
									for (var i = 1; i <= tambahoto; i++) {
										 nama_sutri.push(document.getElementById("nama_sutri"+i).value);
										 alamat_sutri.push(document.getElementById("alamat_sutri"+i).value);
										 status_rumah_sutri.push(document.getElementById("status_rumah_sutri"+i).value);
									}*/



									var tambahoto2 = document.getElementById("hdnLinesut2").value;
										var nama_anak = [];
										var ttl_anak = [];
										var jenis_kelamin_anak = [];
									for (var anak = 1; anak <= tambahoto2; anak++) {

										 nama_anak.push(document.getElementById("nama_anak"+anak).value);
										 ttl_anak.push(document.getElementById("ttl_anak"+anak).value);
										 jenis_kelamin_anak.push(document.getElementById("jenis_kelamin_anak"+anak).value);
									}

									var url = "proses/kirim_data_keluarga_CK.php";
									url = url + "?jenis=hal2&querystr="+nama_ayah+"|"+pekerjaan_ayah+"|"+nama_ibu+"|"+pekerjaan_ibu+"|"+telp_ortu+"|"+alamat_ortu+"|"+status_rumah_ortu+"|"+saudara1+"|"+alamat_saudara1+"|"+status_rumah_saudara1+"|"+telp_saudara1 +"|"+saudara2+"|"+alamat_saudara2+"|"+status_rumah_saudara2+"|"+telp_saudara2+"|"+nama_sutri+"|"+alamat_sutri+"|"+status_rumah_sutri+"|"+tambahoto2+"|"+nama_anak+"|"+ttl_anak+"|"+jenis_kelamin_anak+"|"+id_calon_karyawan;

								$.get(url, function(data) {

									// document.getElementById("bagian").value=data; untuk mengirim hasil data ke field bagian

									var replaced = data.replace(/\s/g, '');
									if (replaced == "DataGagalDiinput"){
									alert (replaced);
										return false;
									}
									else {
									alert (replaced);
									
									
											$('#step_2').hide(); 
											$('#step_3').hide();
											$('#step_4').show();
											$('#datapribadi').removeClass("menu_title active").addClass("menu_title");
											$('#datakeluarga').removeClass("menu_title active").addClass("menu_title");
											$('#datapengalaman').addClass("menu_title active");
											}
						         }); 
								}
		}
</script>