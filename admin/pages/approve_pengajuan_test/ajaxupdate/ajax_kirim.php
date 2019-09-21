<script type="text/javascript" src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script>
function update_hal1()
		{

/*		var regex = /^[a-zA-Z ]*$/;
		var regex_num =  /^\d+$/;
		var regex_email = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;		
		var err = "";
*/		
		isError = false;
	
			
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
									if (replaced2 == "Id_Sudah_Ada_Harap_Refresh_Halaman"){
									alert (replaced2);
										return true;
									}
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