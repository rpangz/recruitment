<script type="text/javascript" src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script>


function save_hal5()
		{

/*		var regex = /^[a-zA-Z ]*$/;
		var regex_num =  /^\d+$/;
		var regex_email = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;		
		var err = "";
*/		var err = "";
		isError = false;
						
			
						if(isError==false){
									var id_calon_karyawan = document.getElementById("id_calon_karyawan").value;

									
									
									var url = "proses/kirim_data_lainlain_CK_FINISH.php";
									url = url + "?jenis=hal1&querystr="+id_calon_karyawan;
									
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

									window.location.href='index.php';
									}
						         }); 
								}
		}
</script>