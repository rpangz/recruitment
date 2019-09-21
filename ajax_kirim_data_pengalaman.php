<script type="text/javascript" src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script>
function save_hal3()
		{
		isError = false;

			
						if(isError==false){

									var tambahoto = document.getElementById("hdnLinepeng1").value;
									var tambahoto2 = document.getElementById("hdnLinepeng2").value;
									var id_calon_karyawan = document.getElementById("id_calon_karyawan").value;
									
										var jenis_pendidikan = [];
										var pendidikan = [];
										var tahun_pendidikan = [];
										var status_pendidikan = [];

										var perusahaan = [];
										var gaji_sebelumnya = [];
										var jabatan_sebelumnya = [];
										var tahun_kerja_sebelumnya = [];
										var alasan_berhenti = [];
										var jobdesk_sebelumnya = [];

									for (var for_pend = 1; for_pend <= tambahoto; for_pend++) {
										 jenis_pendidikan.push(document.getElementById("jenis_pendidikan"+for_pend).value);
										 pendidikan.push(document.getElementById("pendidikan"+for_pend).value.replace(/&/g," DAN "));
										 tahun_pendidikan.push(document.getElementById("tahun_pendidikan"+for_pend).value);
										 status_pendidikan.push(document.getElementById("status_pendidikan"+for_pend).value);


									}

									for (var for_peng_kerja = 1; for_peng_kerja <= tambahoto2; for_peng_kerja++) {

										 perusahaan.push(document.getElementById("perusahaan"+for_peng_kerja).value.replace(/,/g," "));
										 gaji_sebelumnya.push(document.getElementById("gaji_sebelumnya"+for_peng_kerja).value);
										 jabatan_sebelumnya.push(document.getElementById("jabatan_sebelumnya"+for_peng_kerja).value.replace(/&/g," DAN "));
										 tahun_kerja_sebelumnya.push(document.getElementById("tahun_kerja_sebelumnya"+for_peng_kerja).value.replace(/&/g," DAN "));
										 alasan_berhenti.push(document.getElementById("alasan_berhenti_sebelumnya"+for_peng_kerja).value.replace(/&/g," DAN "));
										 jobdesk_sebelumnya.push(document.getElementById("jobdesk_sebelumnya"+for_peng_kerja).value.replace(/&/g," DAN "));

									}




									var url = "proses/kirim_data_pengalaman_CK.php";
									url = url + "?jenis=hal2&querystr="+tambahoto+"|"+pendidikan+"|"+tahun_pendidikan+"|"+status_pendidikan+"|"+tambahoto2+"|"+perusahaan+"|"+gaji_sebelumnya+"|"+jabatan_sebelumnya+"|"+tahun_kerja_sebelumnya+"|"+alasan_berhenti+"|"+jobdesk_sebelumnya+"|"+jenis_pendidikan+"|"+id_calon_karyawan;

								$.get(url, function(data) {

									// document.getElementById("bagian").value=data; untuk mengirim hasil data ke field bagian

									var replaced = data.replace(/\s/g, '');
									if (replaced == "DataGagalDiinput"){
									alert ("data harus di isi");
										return false;
									}
									else {
									alert (replaced);
									
									
											$('#step_2').hide(); 
											$('#step_3').hide();
											$('#step_4').hide();
											$('#step_5').show();
											$('#datapribadi').removeClass("menu_title active").addClass("menu_title");
											$('#datakeluarga').removeClass("menu_title active").addClass("menu_title");
											$('#datapengalaman').removeClass("menu_title active").addClass("menu_title");
											$('#skill_lain').addClass("skill_lain active");
											}
						         }); 
								}
		}
</script>