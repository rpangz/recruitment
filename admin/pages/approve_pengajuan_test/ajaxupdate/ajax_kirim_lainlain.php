<script type="text/javascript" src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script>
function save_hal4()
		{

/*		var regex = /^[a-zA-Z ]*$/;
		var regex_num =  /^\d+$/;
		var regex_email = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;		
		var err = "";
*/		
		isError = false;
			
						if(isError==false){
									var skill = document.getElementById("skill").value;
									var syarat_ijasah = document.getElementById("syarat_ijasah").value;
									var nama_kenalan = document.getElementById("nama_kenalan").value;
									var hubungan_kenalan = document.getElementById("hubungan_kenalan").value;
									var jabatan_kenalan = document.getElementById("jabatan_kenalan").value;
									var prestasi_ck = document.getElementById("prestasi_ck").value;
									var penempatan_di_cabang = document.getElementById("penempatan_di_cabang").value;
									var kesehatan = document.getElementById("kesehatan").value;
									var id_calon_karyawan = document.getElementById("id_calon_karyawan").value;
									var kelebihan_prestasi_ck = document.getElementById("kelebihan_prestasi_ck").value;
									var kekurangan_prestasi_ck = document.getElementById("kekurangan_prestasi_ck").valu
									
									
									var url = "proses/kirim_data_lainlain_CK.php";
									url = url + "?jenis=hal1&querystr="+skill+"|"+syarat_ijasah+"|"+nama_kenalan+"|"+hubungan_kenalan+"|"+jabatan_kenalan+"|"+prestasi_ck+"|"+kesehatan+"|"+penempatan_di_cabang+"|"+id_calon_karyawan+"|"+kelebihan_prestasi_ck+"|"+kekurangan_prestasi_ck;
									
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
											$('#step_4').hide();
											$('#step_5').hide();
											$('#ending').show();
											$('#datapribadi').removeClass("menu_title active").addClass("menu_title");
											$('#datakeluarga').removeClass("menu_title active").addClass("menu_title");
											$('#datapengalaman').removeClass("menu_title active").addClass("menu_title");
											$('#skill_lain').addClass("skill_lain active");

											}
						         }); 
								}
		}
</script>