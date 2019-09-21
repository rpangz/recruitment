<script type="text/javascript" src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script>
function save_hal1()
		{

/*		var regex = /^[a-zA-Z ]*$/;
		var regex_num =  /^\d+$/;
		var regex_email = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;		
		var err = "";
*/		
		isError = false;
						
		if($("#no_ktp").val() == "" && !isError){
						isError = true;
						alert('no_ktp harus diisi');
						$("#no_ktp").focus();
					}
					else if($("#sumber_lamaran").val() == "" && !isError){
						isError = true;
						alert('sumber_lamaran harus dipilih');
						$("#sumber_lamaran").focus();
					}
					else if($("#nama_lengkap").val() == "" && !isError){
						isError = true;
						alert('nama_lengkap harus diisi');
						$("#nama_lengkap").focus();
					}
					else if($("#tempat_lahir").val() == "" && !isError){
						isError = true;
						alert('tempat_lahir harus diisi');
						$("#tempat_lahir").focus();
					}
					else if($("#tanggal_lahir").val() == "" && !isError){
						isError = true;
						alert('tanggal_lahir harus diisi');
						$("#tanggal_lahir").focus();
					}
					else if($("#jen_kel").val() == "" && !isError){
						isError = true;
						alert('jen_kel harus diisi');
						$("#jen_kel").focus();
					}
					else if($("#status_perkawinan").val() == "" && !isError){
						isError = true;
						alert('status_perkawinan harus diisi');
						$("#status_perkawinan").focus();
					}
					else if($("#alamat_domisili").val() == "" && !isError){
						isError = true;
						alert('alamat_domisili harus diisi');
						$("#alamat_domisili").focus();
					}
					else if($("#alamat_ktp").val() == "" && !isError){
						isError = true;
						alert('alamat_ktp harus diisi');
						$("#alamat_ktp").focus();
					}
					else if($("#status_rumah").val() == "" && !isError){
						isError = true;
						alert('status_rumah harus diisi');
						$("#status_rumah").focus();
					}
					else if($("#agama").val() == "" && !isError){
						isError = true;
						alert('agama harus diisi');
						$("#agama").focus();
					}
					else if($("#warga_negara").val() == "" && !isError){
						isError = true;
						alert('warga_negara harus diisi');
						$("#warga_negara").focus();
					}
					else if($("#telp1").val() == "" && !isError){
						isError = true;
						alert('telp1 harus diisi');
						$("#telp1").focus();
					}
					else if($("#alamat_email").val() == "" && !isError){
						isError = true;
						alert('alamat_email harus diisi');
						$("#alamat_email").focus();
					}
					else if($("#facebook_id").val() == "" && !isError){
						isError = true;
						alert('facebook_id harus diisi');
						$("#facebook_id").focus();
					}
					else if($("#bagian").val() == "" && !isError){
						isError = true;
						alert('bagian harus diisi');
						$("#bagian").focus();
					}
					else if($("#gaji").val() == "" && !isError){
						isError = true;
						alert('gaji harus diisi');
						$("#gaji").focus();
					}
					else if($("#cabang").val() == "" && !isError){
						isError = true;
						alert('cabang harus diisi');
						$("#cabang").focus();
					}
			
						if(isError==false){
									var no_ktp = document.getElementById("no_ktp").value;
									var nama_lengkap = document.getElementById("nama_lengkap").value;
									var tempat_lahir = document.getElementById("tempat_lahir").value;
									var tanggal_lahir = document.getElementById("tanggal_lahir").value;
									var jen_kel = document.getElementById("jen_kel").value;
									var status_perkawinan = document.getElementById("status_perkawinan").value;
									var alamat_domisili = document.getElementById("alamat_domisili").value;
									var alamat_ktp = document.getElementById("alamat_ktp").value;
									var status_rumah = document.getElementById("status_rumah").value;
									var agama = document.getElementById("agama").value;
									var warga_negara = document.getElementById("warga_negara").value;
									var telp1 = document.getElementById("telp1").value;
									var telp2 = document.getElementById("telp2").value;
									var alamat_email = document.getElementById("alamat_email").value;
									var facebook_id = document.getElementById("facebook_id").value;
									var instagram_id = document.getElementById("instagram_id").value;
									var tweeter_id = document.getElementById("tweeter_id").value;
									var divisi = document.getElementById("divisi").value;
									var bagian = document.getElementById("bagian").value;
									var gaji = document.getElementById("gaji").value;
									var id_calon_karyawan = document.getElementById("id_calon_karyawan").value;
									var sumber_lamaran = document.getElementById("sumber_lamaran").value;
									var cabang = document.getElementById("cabang").value;
									
									var url = "proses/kirim_data_pribadi_CK.php";
									url = url + "?jenis=hal1&querystr="+no_ktp+"|"+nama_lengkap+"|"+tempat_lahir+"|"+tanggal_lahir+"|"+jen_kel+"|"+status_perkawinan+"|"+alamat_domisili+"|"+alamat_ktp+"|"+status_rumah+"|"+agama+"|"+warga_negara+"|"+telp1+"|"+telp2+"|"+alamat_email+"|"+facebook_id+"|"+instagram_id+"|"+tweeter_id+"|"+divisi+"|"+bagian+"|"+gaji+"|"+id_calon_karyawan+"|"+sumber_lamaran+"|"+cabang;
									
								$.get(url, function(data) {

									// document.getElementById("bagian").value=data; untuk mengirim hasil data ke field bagian

									var replaced = data.replace(/\s/g, '');
									var replaced2 = data.replace(/\s/g, '');
									if (replaced == "DataGagalDiinput"){
									alert (replaced);
										return false;
									}
/*									if (replaced2 == "Id_Sudah_Ada_Harap_Refresh_Halaman"){
									alert (replaced2);
										return true;
									}*/
									else {
									alert (replaced);
									
									
											$('#step_2').hide(); 
											$('#step_3').show();
											$('#datapribadi').removeClass("menu_title active").addClass("menu_title");
											$('#datakeluarga').addClass("menu_title active");
											}
						         }); 
								}
		}
</script>