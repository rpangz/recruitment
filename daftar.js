	$(document).ready(function() {

		$("#intro_btn").click (function(){
			$(".steps").hide();
			$("#step_1").show();
			$(".menu_title").removeClass("active");
			$("#menu_awal").addClass("active");
		}); 
		
		$("#intro_btn_back").click (function(){
			$(".steps").hide();
			$("#intro_regis").show();
			$(".menu_title").removeClass("active");
			$("#intro").addClass("active");
		}); 

		var isFirst = false;
	
		$("#refresh_captcha").click(function(){
			$.ajax({
				type: "GET",
				url: "http://sim.korlantas.polri.go.id/captcha/refresh_captcha_non_cache",
				dataType: "html",
				cache: false,
				error:function(){
					alert("Refresh captcha error");
				},
				success: function(data){
					$("#span_captcha").html(data);
				}
			});
		});
		
		
		
		var btn_1_stat = false;
	
		$("#btn_1").bind("click",function(){
			if(!validasi_hal1()){	
				if(btn_1_stat == false){			
					isError = false;
					var regex_email = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
					if (!regex_email.test($("#alamat_email").val())) {
						isError = true;
						alert('Maaf alamat email anda tidak valid');
						$("#alamat_email").focus();
						return isError;
					}
					
					var regex =  /^\d+$/;
					if($('#jenis_permohonan').val() != "BR"){
						if (!regex.test($("#nomor_sim").val())) {
							isError = true;
							alert('Kolom Nomor SIM harus diisi karakter angka tanpa spasi');
							$("#nomor_sim").focus();
							return isError;
						}
					}
					if (!regex.test($("#polda_kedatangan").val())) {
						isError = true;
						alert('Polda Kedatangan Tidak Valid');
						$("#satpas_kedatangan").focus();
						return isError;
					}
					if (!regex.test($("#satpas_kedatangan").val())) {
						isError = true;
						alert('Satpas Kedatangan Tidak Valid');
						$("#satpas_kedatangan").focus();
						return isError;
					}
					if (!regex.test($("#lokasi_kedatangan").val())) {
						isError = true;
						alert('Lokasi Kedatangan Tidak Valid');
						$("#lokasi_kedatangan").focus();
						return isError;
					}
					var permohonan = $('#jenis_permohonan').val();
					if(permohonan == "BR"){
						var golongan = $('#golongan_sim_baru').val();
					}else{
						var golongan = $('#golongan_sim_perpanjangan').val();
					}
					$.ajax({
						url:'http://sim.korlantas.polri.go.id/general_helper/get_data_cost/'+golongan+'/'+permohonan,
					}).done(function(data){
						if(data!= ""){
							$("#biaya").html(data);
						}else{
							alert("Error Get Data Cost");
							$("#biaya").html("");
						}
					});
					$("#btn_1").html("Memproses..");
					btn_1_stat = true;
					$.ajax({
						url:'http://sim.korlantas.polri.go.id/check_sim/cek_sim/'+$("#nomor_sim").val()+'/'+golongan,
					}).done(function(data){
						if(data!= ""){
							obj = JSON.parse(data);
							var respon_code = (obj.response_code);
								if(respon_code == 01){
									$(".menu_title").removeClass("active");
									$("#menu_sukses").addClass("active");
									$("#menu_sukses").html("Registrasi Gagal");
									$(".steps").hide();
									$("#check_sim_1").show();
								}else if(respon_code == 02){
									$(".menu_title").removeClass("active");
									$("#menu_sukses").addClass("active");
									$("#menu_sukses").html("Registrasi Gagal");
									$(".steps").hide();
									$("#check_sim_2").show();
								}else if(respon_code == 03){
									$(".menu_title").removeClass("active");
									$("#menu_sukses").addClass("active");
									$("#menu_sukses").html("Registrasi Gagal");
									$(".steps").hide();
									$("#check_sim_3").show();
								}else if(respon_code == "E1"){
									$(".menu_title").removeClass("active");
									$("#menu_sukses").addClass("active");
									$("#menu_sukses").html("Registrasi Gagal");
									$(".steps").hide();
									$("#check_sim_4").show();
								}else if(respon_code == "E2"){
									$(".menu_title").removeClass("active");
									$("#menu_sukses").addClass("active");
									$("#menu_sukses").html("Registrasi Gagal");
									$(".steps").hide();
									$("#check_sim_5").show();
								}else{
									$(".steps").hide();
									$("#step_2").show();
									$(".menu_title").removeClass("active");
									$("#menu_pribadi").addClass("active");
								}
						}else{
							alert("Error validate SIM"); 
						}
						btn_1_stat = false;
						$("#btn_1").html("Lanjut");
					});
					
					//tanggal kedatangan
					var satpas = $('#satpas_kedatangan').val();
					var lokasi = $('#lokasi_kedatangan').val();
					$.ajax({
						url:'http://sim.korlantas.polri.go.id/general_helper/get_data_holiday_location/'+satpas+'/'+lokasi,
					}).done(function(data){
						if(data!= ""){
							obj = JSON.parse(data);
							
							var libur_umum = (obj.umum);
							var libur_khusus = (obj.khusus);
							var master_quota = (obj.quota_master);
							var quota = (obj.quota);
							
							$('.datepicker_kedatangan').datepicker({
								dateFormat: "yy-mm-dd",
								yearRange : 'c-50:c+50',
															inline: true,
								altField: '#tanggal_kedatangan',
								minDate: 0,
								maxDate:21,
								numberOfMonths: 2,
								beforeShowDay: function(date) {
									var day = date.getDay();
									var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
									var returns = true;
									if (day == 0){
										returns = false;
									}else{
										if(libur_umum.indexOf(string) != -1){
											returns = false;
										}
									}								
									for (var i = 0; i < libur_khusus.length; i++) {
										if(string == libur_khusus[i].date_holiday){
											if(libur_khusus[i].status == "libur"){
												returns= false;
											}else{
												returns = true;
											}
										}									
									}
									/*
									if(master_quota != []){
										for(var i = 0; i < quota.length; i++){
											if(string == quota[i].quota_date){
												if(master_quota <= quota[i].total_register){
													returns = false;
												}else{
													returns = true;
												}
											}
										}
									}*/
									return [returns,''];
								}					
							});
							$('.ui-datepicker-current-day').removeClass('ui-datepicker-current-day');
							$('#tanggal_kedatangan').val('');$('.ui-state-default').removeClass('ui-state-active');							$('#tanggal_kedatangan').change(function(){
								$('.datepicker_kedatangan').datepicker('setDate', $(this).val());
							});	
						}else{
							alert("Error Get Data Holiday Location");
						}
					});
				
				
				
				}else{
					alert('Mohon tunggu data sedang diproses');
					event.preventDefault();
				}
			}
		});
		
		$("#btn_2").bind("click",function(){
			if(!validasi_hal2()){
				isError = false;
				var regex = /^[a-zA-Z ]*$/;
				var regex_num =  /^\d+$/;
				
				if($('#kewarganegaraan').val() == "WNI"){
					if (!regex_num.test($("#nik").val())) {
						isError = true;
						alert('Kolom NIK/Nomor KTP harus diisi karakter angka tanpa spasi');
						$("#nik").focus();
						return isError;
					}
				}
				if (!regex.test($("#nama_depan").val())) {
					isError = true;
					alert('Kolom Nama harus diisi karakter huruf');
					$("#nama_depan").focus();
					return isError;
				}
				if (!regex.test($("#tempat_lahir").val())) {
					isError = true;
					alert('Kolom Tempat Lahir harus diisi karakter huruf');
					$("#tempat_lahir").focus();
					return isError;
				}
				if (!regex_num.test($("#tinggi").val())) {
					isError = false;
					alert('Kolom Tinggi harus diisi karakter angka tanpa spasi');
					$("#tinggi").focus();
					return isError;
				}
				if (!regex.test($("#asal_negara").val())) {
					isError = true; 
					alert("Kolom Asal Negara harus diisi karakter huruf");
					$("#asal_negara").focus();  
					return isError; 
				}
				
				$(".steps").hide(); 
				$("#step_3").show();
			}
		});
	 /*
		$("#btn_2_back").bind("click",function(){
			$(".steps").hide();
			$("#step_1").show();
			$(".menu_title").removeClass("active");
			$("#menu_awal").addClass("active");
		});
		
		$("#btn_3").bind("click",function(){
			if(!validasi_hal3()){
				isError = false;
				var regex = /^[a-zA-Z ]*$/;
				var regex_num =  /^\d+$/;
				
				if (!regex.test($("#nama").val())) {
					isError = true;
					alert('Kolom Nama harus diisi karakter huruf');
					$("#nama").focus();
					return isError;
				}if (!regex.test($("#ibu_kandung").val())) {
					isError = true;
					alert("Kolom Nama Ibu Kandung harus diisi karakter huruf");
					$("#ibu_kandung").focus();  
					return isError;
				}
				
				$(".steps").hide();
				$("#step_4").show();
				show_confirm();
				$(".menu_title").removeClass("active");
				$("#menu_konfirmasi").addClass("active");
			}
		});
		
		$("#btn_3_back").bind("click",function(){
			$(".steps").hide();
			$("#step_2").show();
			$(".menu_title").removeClass("active");
			$("#menu_pribadi").addClass("active");	
		});
		
		$("#btn_4_back").bind("click",function(){
			$(".steps").hide();
			$("#step_3").show();
			$(".menu_title").removeClass("active");
			$("#menu_darurat").addClass("active");
		});
		
		$("#btn_4").bind("click",function(event){
			if(!validasi_hal4()){
				if(isSubmit == false){
					isSubmit = true;
					$("#data_sim").submit();
				}else{
					alert('Data sedang dikirim');
					event.preventDefault();
				}
			}
		});
	
		$(".steps").hide(); 
		$("#step_1").show();
	*/	
		
		
		$('#input-field-id').val($('#input-field-id').val() + 'more text');

		$('#jenis_permohonan').bind('change',function(){
			if($('#polda_kedatangan').val() != ''){
				if($('#satpas_kedatangan').val() != ''){
					$('#satpas_kedatangan').trigger('change');
				}
			}
		});
		
		function show_confirm(){
			if($('#kewarganegaraan').val() != "WNI"){					
				$("#confirm_identitas_wna").html($("#nomor_kitas_kitab").val());
			}else{
				$("#confirm_identitas_wni").html($("#nik").val());
			}
			$("#confirm_nama_depan").html($("#nama_depan").val());
			$("#confirm_nama_belakang").html($("#nama_belakang").val());
			$("#confirm_alamat").html($("#alamat").val());
			$("#confirm_alamat_email").html($("#alamat_email").val());
			$("#confirm_polda_kedatangan").html($("#polda_kedatangan option:selected").text());				
			$("#confirm_satpas_kedatangan").html($("#satpas_kedatangan option:selected").text());				
			$("#confirm_lokasi_kedatangan").html($("#lokasi_kedatangan option:selected").text());				
			$("#confirm_jenis_permohonan").html($("#jenis_permohonan option:selected").text());
			if($('#jenis_permohonan').val() == "BR"){
				$("#confirm_golongan_sim").html($("#golongan_sim_baru option:selected").text());
			}else{
				$("#confirm_golongan_sim").html($("#golongan_sim_perpanjangan option:selected").text());
			}
		}

		function validasi_hal1(){
			isError = false;
			if($("#jenis_permohonan").val() == "" && !isError){
				isError = true;
				alert('Jenis Permohonan harus dipilih');
				$("#jenis_permohonan").focus();
			}else if($("#jenis_permohonan").val() == "BR" && !isError && $("#golongan_sim_baru").val() == ""){				
				isError = true;
				alert('Golongan Sim Harus dipilih');
				$("#golongan_sim_baru").focus();
			}else if($("#jenis_permohonan").val() != "BR" && !isError && $("#golongan_sim_perpanjangan").val() == ""){
				isError = true;
				alert('Golongan Sim Harus dipilih');
				$("#golongan_sim_perpanjangan").focus();
			}else if($("#jenis_permohonan").val() != "BR" && !isError && $("#nomor_sim").val() == ""){
				isError = true;
				alert('Nomor Sim Harus diisi');
				$("#nomor_sim").focus();
			}else if($("#alamat_email").val() == "" && !isError){
				isError = true;
				alert('Alamat email harus diisi');
				$("#alamat_email").focus();
			}else if($("#polda_kedatangan").val() == "" && !isError){
				isError = true;
				alert('Polda kedatangan harus dipilih');
				$("#polda_kedatangan").focus();
			}else if($("#satpas_kedatangan").val() == "" && !isError){
				isError = true;
				alert('Satpas kedatangan harus dipilih');
				$("#satpas_kedatangan").focus();
			}else if($("#lokasi_kedatangan").val() == "" && !isError){
				isError = true;
				alert('Lokasi kedatangan harus dipilih');
				$("#lokasi_kedatangan").focus();
			}
			return isError;
		}
		
		function validasi_hal2(){
			isError = false;
			if($("#kewarganegaraan").val() == "" && !isError){
				isError = true;
				alert('Kewarganegaraan harus dipilih');
				$("#kewarganegaraan").focus();
			}else if($("#kewarganegaraan").val() == "WNI" && !isError && $("#nik").val() == ""){					
				isError = true;
				alert('NIK/Nomor KTP Harus diisi');
				$("#nik").focus();
			}else if($("#kewarganegaraan").val() != "WNI" && !isError && $("#nomor_passport").val() == ""){					
				isError = true;
				alert('Nomor Passport Harus diisi');
				$("#nomor_passport").focus();
			}else if($("#kewarganegaraan").val() != "WNI" && !isError && $("#nomor_kitas_kitab").val() == ""){					
				isError = true;
				alert('Nomor Kitas/Kitab Harus diisi');
				$("#nomor_kitas_kitab").focus();
			}else if($("#kewarganegaraan").val() != "WNI" && !isError && $("#tanggal_terbit_passport").val() == ""){					
				isError = true;
				alert('Tanggal Terbit Passport Harus diisi');
				$("#tanggal_terbit_passport").focus();
			}else if($("#kewarganegaraan").val() != "WNI" && !isError && $("#tanggal_terbit_kitas_kitab").val() == ""){					
				isError = true;
				alert('Tanggal Terbit Kitas/Kitab Harus diisi');
				$("#tanggal_terbit_kitas_kitab").focus();
			}else if($("#nama_depan").val() == "" && !isError){
				isError = true;
				alert('Nama harus diisi');
				$("#nama_depan").focus();
			}else if($("#jenis_kelamin").val() == "" && !isError){
				isError = true;
				alert('Jenis kelamin harus dipilih');
				$("#jenis_kelamin").focus();
			}else if($("#tempat_lahir").val() == "" && !isError){
				isError = false;
				alert('Tempat lahir harus diisi');
				$("#tempat_lahir").focus();
			}else if($("#tanggal_lahir").val() == "" && !isError){
				isError = false;
				alert('Tanggal lahir harus diisi');
				$("#tanggal_lahir").focus();
			}else if($("#tanggal_lahir").val() > '1999-12-30' && !isError ){
				isError = true;
				alert('Usia minimal harus 17 tahun');
				$("#tanggal_lahir").focus();
			}else if($("#golongan_darah").val() == "" && !isError){
				isError = true;
				alert('Golongan darah harus pilih');
				$("#golongan_darah").focus();
			}else if($("#alamat").val() == "" && !isError){
				isError = true;
				alert('Alamat harus diisi');
				$("#alamat").focus();
			}else if($("#kabupaten_kota").val() == "" && !isError){
				isError = true;
				alert('Kabupaten/Kota harus diisi');
				$("#kabupaten_kota").focus();
			}else if($("#provinsi").val() == "" && !isError){
				isError = true;
				alert('Provinsi harus dipilih');
				$("#provinsi").focus();
			}else if($("#agama").val() == "" && !isError){
				isError = true;
				alert('Agama harus dipilih');
				$("#agama").focus();
			}else if($("#tinggi").val() == "" && !isError){
				isError = true;
				alert('Tinggi harus diisi');
				$("#tinggi").focus();
			}else if($("#pendidikan").val() == "" && !isError){
				isError = true;
				alert('Pendidikan harus dipilih');
				$("#pendidikan").focus();
			}else if($("#pekerjaan").val() == "" && !isError){
				isError = true;
				alert('Pekerjaan harus dipilih');
				$("#pekerjaan").focus();
			}else if($("#berkacamata").val() == "" && !isError){
				isError = true;
				alert('Berkacamata harus dipilih');
				$("#berkacamata").focus();
			}else if($("#cacat_fisik").val() == "" && !isError){
				isError = true;
				alert('Cacat fisik harus dipilih');
				$("#cacat_fisik").focus();
			}else if($("#telepon").val() == "" && !isError){
				isError = true;
				alert('Telepon harus diisi');
				$("#telepon").focus();
			}else if($("#asal_negara").val() == "" && !isError){
				isError = true;
				alert('Asal Negara harus diisi');
				$("#asal_negara").focus();
			}else if(isValidDate($("#tanggal_lahir").val()) == false){
				isError = true;
				alert('Gunakan format tanggal lahir YYYY-mm-dd');
				$("#tanggal_lahir").focus();
			}
			return isError;
		}

		function isValidDate(dateString) {
		  	var regEx = /^\d{4}-\d{2}-\d{2}$/;
		  	return dateString.match(regEx) != null;
		}
		
		function validasi_hal3(){
			isError = false;
			if($("#hubungan").val() == "" && !isError){
				isError = true;
				alert('Hubungan harus dipilih');
				$("#hubungan").focus();
			}else if($("#nama").val() == "" && !isError){
				isError = true;
				alert('Nama harus diisi');
				$("#nama").focus();
			}else if($("#alamat_hub").val() == "" && !isError){
				isError = true;
				alert('Alamat harus diisi');
				$("#alamat_hub").focus();
			}else if($("#telepon_hub").val() == "" && !isError){
				isError = true;
				alert('Telepon harus diisi');
				$("#telepon_hub").focus();
			}else if($("#ibu_kandung").val() == "" && !isError){
				isError = true;
				alert('Nama ibu kandung harus diisi');
				$("#ibu_kandung").focus();
			}else if($("#sekolah_mengemudi").val() == "" && !isError){
				isError = true;
				alert('Sekolah mengemudi harus dipilih');
				$("#sekolah_mengemudi").focus();
			}
			
			return isError;
		}
		
		$("#tanggal_kedatangan").hide();
		function validasi_hal4(){
			isError = false;
			if($("#tanggal_kedatangan").val() == "" && !isError){
				isError = true;
				alert('Tanggal Kedatangan harus diisi');
				$("#tanggal_kedatangan").focus();
			}else if($("#int_validation_code").val() == "" && !isError){
				isError = true;
				alert('Kode Captcha harus diisi');
				$("#int_validation_code").focus();
			}
			return isError;
		}
		
		$("#kewarganegaraan").change(function(){
			if($(this).val() == "WNI"){
				$("#validasi_ktp").show();
				$("#isian_ktp").show();
				$("#isian_passport").hide();
				$("#isian_kitas_kitab").hide();
				$("#isian_tgl_passport").hide();
				$("#isian_tgl_kitas_kitab").hide();
				$("#validasi_kitas_kitab").hide();
				$("#asal_negara").val("INDONESIA");
			}else{
				$("#validasi_ktp").hide();
				$("#isian_ktp").hide();
				$("#isian_passport").show();
				$("#isian_kitas_kitab").show();
				$("#isian_tgl_passport").show();
				$("#isian_tgl_kitas_kitab").show();
				$("#validasi_kitas_kitab").show();
				$("#asal_negara").val("");
		}
			
		});
		//tanggal lahir
		$('.datepicker').datepicker({
			dateFormat: "yy-mm-dd",
			changeMonth: true,
			changeYear: true,
			yearRange : 'c-50:c+50',
			defaultDate : 'c-6205',
			autoclose: true,
		});
		
		$('.datepicker_data').datepicker({
			dateFormat: "yy-mm-dd",
			changeMonth: true,
			changeYear: true,
			yearRange : 'c-50:c+50',
			autoclose: true,
		});
		
		$("#kewarganegaraan").trigger('change');
		
		$("#jenis_permohonan").change(function(){
			if($(this).val() == "BR"){
				$("#sim_baru").show();
				$("#sim_perpanjangan").hide();
				$("#nomor_sim_lama").hide();
			}else{
				$("#sim_baru").hide();
				$("#sim_perpanjangan").show();
				$("#nomor_sim_lama").show();
			}
		});
		
		$("#jenis_permohonan").trigger('change');
		
		$('#nik').focus();
		$('#golongan_sim').trigger("change");
		
		var isSubmit = false;
		$('#polda_kedatangan').trigger("change");
		
		var captcha_status = '';
		if(captcha_status){
			$(".steps").hide();
			$("#step_1").show();
			$(".menu_title").removeClass("active");
			$("#menu_awal").addClass("active");
		}
		
	});
	
	function isNumber(evt) {
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			return false;
		}
		return true;
	}
		