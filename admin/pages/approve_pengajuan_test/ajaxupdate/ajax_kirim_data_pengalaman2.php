<script type="text/javascript" src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script>
function save_hal3()
		{
		isError = false;

			
						if(isError==false){

									var tambahoto = 0;
									var tambahoto2 = 0;
									var kirim_id_ck = document.getElementById("kirim_id_ck").value;
									
										var jenis_pendidikan = [];
										var pendidikan = [];
										var tahun_pendidikan = [];
										var status_pendidikan = [];
										var id_calon_karyawan = [];
										var no_datasekolah = [];

										var perusahaan = [];
										var gaji_sebelumnya = [];
										var jabatan_sebelumnya = [];
										var tahun_kerja_sebelumnya = [];
										var alasan_berhenti = [];
										var jobdesk_sebelumnya = [];

									for (var i = 1; i <= tambahoto; i++) {
										 jenis_pendidikan.push(document.getElementById("jenis_pendidikan"+i).value);
										 pendidikan.push(document.getElementById("pendidikan"+i).value);
										 tahun_pendidikan.push(document.getElementById("tahun_pendidikan"+i).value);
										 status_pendidikan.push(document.getElementById("status_pendidikan"+i).value);
										 id_calon_karyawan.push(document.getElementById("id_calon_karyawan"+i).value);
										 no_datasekolah.push(document.getElementById("no_datasekolah"+i).value);
									}

									for (var anak = 1; anak <= tambahoto2; anak++) {

										 perusahaan.push(document.getElementById("perusahaan"+anak).value);
										 gaji_sebelumnya.push(document.getElementById("gaji_sebelumnya"+anak).value);
										 jabatan_sebelumnya.push(document.getElementById("jabatan_sebelumnya"+anak).value);
										 tahun_kerja_sebelumnya.push(document.getElementById("tahun_kerja_sebelumnya"+anak).value);
										 alasan_berhenti.push(document.getElementById("alasan_berhenti_sebelumnya"+anak).value);
										 jobdesk_sebelumnya.push(document.getElementById("jobdesk_sebelumnya"+anak).value);
									}

									var url = "proses/kirim_data_pengalaman_CK.php";
									url = url + "?jenis=hal2&querystr="+tambahoto+"|"+pendidikan+"|"+tahun_pendidikan+"|"+status_pendidikan+"|"+tambahoto2+"|"+perusahaan+"|"+gaji_sebelumnya+"|"+jabatan_sebelumnya+"|"+tahun_kerja_sebelumnya+"|"+alasan_berhenti+"|"+jobdesk_sebelumnya+"|"+id_calon_karyawan+"|"+jenis_pendidikan+"|"+no_datasekolah+"|"+kirim_id_ck;
alert(id_calon_karyawan1);
								$.get(url, function(data) {

									// document.getElementById("bagian").value=data; untuk mengirim hasil data ke field bagian

									var replaced = data.replace(/\s/g, '');
									if (replaced == "DataGagalDiinput"){
									alert ("Data Gagal Diinput");
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