<script type="text/javascript" src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script>
function save_approve_final(id_calon_karyawan)
		{

		isError = false;
			
						if(isError==false){
									var id_calon_karyawan = id_calon_karyawan;
									var password_test = document.getElementById("password_test"+id_calon_karyawan).value;
									
									var url = "proses/approve_pengajuan_test_final.php";
									url = url + "?jenis=hal1&querystr="+id_calon_karyawan+"|"+password_test;
									
								$.get(url, function(data) {

									// document.getElementById("bagian").value=data; untuk mengirim hasil data ke field bagian

									var replaced = data.replace(/\s/g, '');
									if (replaced == "DataGagalDiinput"){
									alert (replaced);
										return false;
									}
									else {
									alert (replaced);
									window.location.href='approve_pengajuan_test.php';
											}
						         }); 
								}
		}
</script>