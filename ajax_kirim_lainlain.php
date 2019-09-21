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
									var skill = document.getElementById("skill").value.replace(/&/g," DAN ");
									var nama_lengkap = document.getElementById("nama_lengkap").value;
									var syarat_ijasah = document.getElementById("syarat_ijasah").value;
									var nama_kenalan = document.getElementById("nama_kenalan").value.replace(/&/g," DAN ");
									var hubungan_kenalan = document.getElementById("hubungan_kenalan").value;
									var jabatan_kenalan = document.getElementById("jabatan_kenalan").value;
									var prestasi_ck = document.getElementById("prestasi_ck").value.replace(/&/g," DAN ");
									var penempatan_di_cabang = document.getElementById("penempatan_di_cabang").value;
									var kesehatan = document.getElementById("kesehatan").value;
									var id_calon_karyawan = document.getElementById("id_calon_karyawan").value;

										var tiga_kelebihan = [];
										var tiga_kekurangan = [];

										 tiga_kelebihan.push(document.getElementById("kelebihan1").value);
										 tiga_kelebihan.push(document.getElementById("kelebihan2").value);
										 tiga_kelebihan.push(document.getElementById("kelebihan3").value);

										 tiga_kekurangan.push(document.getElementById("kekurangan1").value);
										 tiga_kekurangan.push(document.getElementById("kekurangan2").value);
										 tiga_kekurangan.push(document.getElementById("kekurangan3").value);
									
									
									var url = "proses/kirim_data_lainlain_CK.php";
									url = url + "?jenis=hal1&querystr="+skill+"|"+nama_lengkap+"|"+syarat_ijasah+"|"+nama_kenalan+"|"+hubungan_kenalan+"|"+jabatan_kenalan+"|"+prestasi_ck+"|"+kesehatan+"|"+tiga_kelebihan+"|"+tiga_kekurangan+"|"+penempatan_di_cabang+"|"+id_calon_karyawan;
									
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