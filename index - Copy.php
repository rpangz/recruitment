<!DOCTYPE HTML>
<?php 

include('koneksi.php');
/* koneksi ke db */


   $today = date("Ymd"); //untuk mengambil tahun, tanggal dan bulan Hari INI
   //cari id terakhir ditanggal hari ini
    $NewID = '000/'.$today.'/';
    $query1 = "SELECT max(id_calon_karyawan) as maxID FROM datapribadi_ck where left(id_calon_karyawan,13)='$NewID'";
    $hasil = mysql_query($query1);
    $data = mysql_fetch_array($hasil);
    $idMax = $data['maxID'];
   //setelah membaca id terakhir, lanjut mencari nomor urut id dari id terakhir
    $NoUrut = (int) substr($idMax, 13, 4);
  	$NoUrut++;
     //nomor urut +1
    $NewID = '000/'.$today.'/'.sprintf('%04s', $NoUrut);

    $query = sprintf("insert into datapribadi_ck(id_calon_karyawan,status) VALUES ('$NewID','simpan')");
  	$sql = mysql_query($query);
   
   //setelah ketemu id terakhir lanjut membuat id baru dengan format sbb:
//$today nanti jadinya misal 20160526 .sprintf('%04s', $NoUrut) urutan id di tanggal hari ini

?>
<html>
	<head>
		<title>Recruitment MDPU & TOP Finance</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
       	<link href="assets/template/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/main.css" />
         
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
<style>
#minimenu ul.tab {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #fff;
}

/* Float the list items side by side */
#minimenu ul.tab li {float: left;width:100%;}

/* Style the links inside the list items */
#minimenu ul.tab li a {
    display: inline-block;
    color: #B7BBCB;
    text-align: center;
    padding: 3px 16px;
    text-decoration: none;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of links on hover */
#minimenu ul.tab li a:hover {
    color: black;
    
}

/* Create an active/current tablink class */
#minimenu ul.tab li .active {
   color: black;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
}
</style>
        <link href="assets/css/datepicker.css" rel="stylesheet" type="text/css" />
    
	<link href="assets/template/css/style2.css" rel="stylesheet">
	<link href="assets/template/css/jquery-ui.css" rel="stylesheet">
	<style type="text/css">
		.menu_label.required:after{ 
		   content:"*";
		   color:red;
		}
		.red{ 
		   color:black;
		}
    </style>
	<script type="text/javascript" src="assets/js/jquery.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.js"></script>
   <script type="text/javascript" src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
  <script type="text/javascript">
	$(document).ready(function() {
		$(".jabatan").change(function() {
			var jabatan =$(this).val();
			var dataString = 'jabatan='+jabatan;
			$.ajax({
				type: "POST",
				url: "get_select_bagian.php",
				data: dataString,
				cache: false,
				success: function(html) {
					$("#bagian").html(html);
				} 
			});
		});
	});
  </script>

	<script type="text/javascript" src="assets/js/jquery-ui.js"></script> 
  <script type="text/javascript" src="plugins/jQuery/moment.js"></script>

<script>
var $j = jQuery.noConflict();
</script>




<!-- <script type="text/javascript" src="daftar.js"></script>
  -->
 <style type="text/css"> 
 .ui-state-default.ui-state-active {
	background: #f1bc41;
	border: 2px solid #ffbf00;
 }
</style>
    
    
<script>

function changeToUpperCase(t) {
  var eleVal = document.getElementById(t.id);
  eleVal.value= eleVal.value.toUpperCase();
}

function isNumber(evt) {
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			return false;
		}
		return true;
}
function gantiform(isiid){

/*	if (isiid=="btn_2")
	{
		document.getElementById("step_2").style.display = "none" ;
		document.getElementById("step_3").style.display = "" ;
		$('#datapribadi').removeClass("menu_title active").addClass("menu_title");
		$('#datakeluarga').addClass("menu_title active");
	}*/
/*	if(isiid=="btn_3")
	{
		document.getElementById("step_2").style.display = "none" ;
		document.getElementById("step_3").style.display = "none" ;
		document.getElementById("step_4").style.display = "" ;
		$('#datapribadi').removeClass("menu_title active").addClass("menu_title");
		$('#datakeluarga').removeClass("menu_title active").addClass("menu_title");
		$('#datapengalaman').addClass("menu_title active");

	if(isiid=="btn_4")
	{
		document.getElementById("step_2").style.display = "none" ;
		document.getElementById("step_3").style.display = "none" ;
		document.getElementById("step_4").style.display = "none" ;
		document.getElementById("step_5").style.display = "" ;
		$('#datapribadi').removeClass("menu_title active").addClass("menu_title");
		$('#datakeluarga').removeClass("menu_title active").addClass("menu_title");
		$('#datapengalaman').removeClass("menu_title active").addClass("menu_title");
		$('#skill_lain').addClass("menu_title active");

	}
	else if(isiid=="btn_5")
	{
		document.getElementById("step_2").style.display = "none" ;
		document.getElementById("step_3").style.display = "none" ;
		document.getElementById("step_4").style.display = "none" ;
		document.getElementById("step_5").style.display = "none" ;
		document.getElementById("ending").style.display = "" ;
		$('#datapribadi').removeClass("menu_title active").addClass("menu_title");
		$('#datakeluarga').removeClass("menu_title active").addClass("menu_title");
		$('#datapengalaman').removeClass("menu_title active").addClass("menu_title");
		$('#skill_lain').addClass("menu_title active");

	}

	}*/
	if(isiid=="intro_btn_back2")
	{
		document.getElementById("step_2").style.display = "" ;
		document.getElementById("step_3").style.display = "none" ;
		$('#datapribadi').addClass("menu_title active");
		$('#datakeluarga').removeClass("menu_title active").addClass("menu_title");
		$('#datapengalaman').removeClass("menu_title active").addClass("menu_title");
	}
	else if(isiid=="intro_btn_back3")
	{
		document.getElementById("step_2").style.display = "" ;
		document.getElementById("step_3").style.display = "none" ;
		$('#datapribadi').addClass("menu_title active");
		$('#datakeluarga').removeClass("menu_title active").addClass("menu_title");
		$('#datapengalaman').removeClass("menu_title active").addClass("menu_title");
	}
	else if(isiid=="intro_btn_back4")
	{
		document.getElementById("step_2").style.display = "none" ;
		document.getElementById("step_3").style.display = "" ;
		document.getElementById("step_4").style.display = "none" ;
		$('#datapribadi').removeClass("menu_title active").addClass("menu_title");
		$('#datakeluarga').addClass("menu_title active");
		$('#datapengalaman').removeClass("menu_title active").addClass("menu_title");
	}	
	else if(isiid=="intro_btn_back5")
	{
		document.getElementById("step_2").style.display = "none" ;
		document.getElementById("step_3").style.display = "none" ;
		document.getElementById("step_4").style.display = "" ;
		document.getElementById("step_5").style.display = "none" ;
		$('#datapribadi').removeClass("menu_title active").addClass("menu_title");
		$('#datakeluarga').removeClass("menu_title active").addClass("menu_title");
		$('#datapengalaman').addClass("menu_title active");
		$('#skill_lain').removeClass("menu_title active").addClass("menu_title");
	}	
	else if(isiid=="intro_btn_back6")
	{
		document.getElementById("step_2").style.display = "none" ;
		document.getElementById("step_3").style.display = "none" ;
		document.getElementById("step_4").style.display = "none" ;
		document.getElementById("step_5").style.display = "" ;
		document.getElementById("ending").style.display = "none" ;
		$('#datapribadi').removeClass("menu_title active").addClass("menu_title");
		$('#datakeluarga').removeClass("menu_title active").addClass("menu_title");
		$('#datapengalaman').removeClass("menu_title active").addClass("menu_title");
		$('#skill_lain').addClass("menu_title active");
	}	
	
}
window.onload = function myFunction() {
			var h = window.innerHeight;
			var z = h-35+"px";
			h = h+"px";
			document.getElementById("one").style.height = h;
			document.getElementById("in-one").style.height = z;
			document.getElementById("in-one").style.overflow = "scroll";
		}
</script>
<?php

include('gambar.php');
include('gambar2.php');
include('ajax_kirim.php');
include('ajax_kirim_keluarga.php');
include('ajax_kirim_data_pengalaman.php');
include('ajax_kirim_lainlain.php');
include('ajax_kirim_lainlain_final.php');
?>
	</head>
	<body>
	
	<div class="row row-form" id="calon_karyawan" style="display: none;">
		<div class="col-xs-12 col-sm-3">
			<label for="id_calon_karyawan" class="menu_label">Calon No. Karyawan</label>
		</div>
		<div class="col-xs-12 col-sm-8">                                    
				<input id="id_calon_karyawan" name="id_calon_karyawan" type="text" class="form-control" readonly value="<?php echo "$NewID"; ?>" />
				<span class="text-danger"></span>
		</div>
	</div>
		<!-- Sidebar -->
			<section id="sidebars">
				<div class="inner">
					<nav>
						<ul>
							<li><a href="#intro">Selamat Datang</a></li>
							<li><a href="#one">Isi Data Anda</a></li>
                            <!-- <li><a href="#two">Terima Kasih</a></li> -->
						</ul>
					</nav>
				</div>
			</section>

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Intro -->
					<section id="intro" class="wrapper style1 fullscreen fade-up">
						<div class="inner">
							<h1>Selamat Datang</h1>
							<p style="color: 		#ffe6e6;">Ini adalah website recruitment calon karyawan<br />
							PT TOP & MDPU Finance.</p>
							<ul class="actions">
								<li><a href="#one" class="button scrolly" style="color: #ffe6e6;">Isi Data Anda</a></li>
							</ul>
						</div>
					</section>

				<!-- One -->
					<section id="one" class="wrapper style2 spotlights">
						
                        <div class="inner">
                        	<div id="in-one" style="background-color:#FFF; min-height:300px; color: black; padding: 15px">
                            <div class="col-xs-12 col-sm-3 col-sm-height">
				<ul id="sidebar" class="nav nav-stacked sidebar">
	<h2 class="side-title"></h2>
	<li id="datapribadi" class="menu_title active" style="position:relative;display:block;padding: 10px 15px;">Data Pribadi</li>
    <li id="datakeluarga" class="menu_title" style="position:relative;display:block;padding: 10px 15px;">Data Keluarga</li>
    <li id="datapengalaman" class="menu_title" style="position:relative;display:block;padding: 10px 15px;">Data Pengalaman</li>
    <li id="skill_lain" class="menu_title" style="position:relative;display:block;padding: 10px 15px;">Skill &amp; Lain-Lain</li>
</ul>			</div>

<!-- <form action="" id='daftar_calon_karyawan' method="post" accept-charset="utf-8"> -->
<input type="hidden" name="class" value="form-horizontal" style="display:none;" />
<input type="hidden" name="id" value="json_data_inputform" style="display:none;" />
<input type="hidden" name="name" value="json_data_inputform" style="display:none;" />



<!-- step_2 -->
<div id="step_2" class="col-xs-12 col-sm-9 col-sm-height col-sm-top contentbar" style="display:">
	<div class="row">
		<div class="col-xs-12 col-sm-12"><h1>1. Data Pribadi</h1></div>
	</div>
    
    <?php include ('input_datapribadi.php'); ?>

	<hr/ style="margin-top:0px; margin-bottom:0px;">
	<div class="row">
		<ul class="pager">
			<li class="next"><a href="#step_2" onClick="gantiform(this.id)" id="intro_btn_back2" name="button">Kembali</a></li>
			<li class="next"><a href="#step_3" onClick="save_hal1()" id="btn_2" name="btn_2">Lanjut</a></li>
		</ul>
	</div>
</div>


<!-- step_3 -->
<div id="step_3" class="col-xs-12 col-sm-9 col-sm-height col-sm-top contentbar" style="display:none">
	<div class="row">
		<div class="col-xs-12 col-sm-12"><h1>2. Data Keluarga</h1></div>
	</div>
    
    <?php include ('input_datakeluarga.php'); ?>

	<hr/ style="margin-top:0px; margin-bottom:0px;">
	<div class="row">
		<ul class="pager">
			<li class="next"><a href="#step_2" onClick="gantiform(this.id)" id="intro_btn_back3" name="button">Kembali</a></li>
			<li class="next"><a href="#step_4" onClick="save_hal2()" id="btn_3" name="btn_3">Lanjut</a></li>
		</ul>
	</div>
</div>


<!-- step_4 -->
<div id="step_4" class="col-xs-12 col-sm-9 col-sm-height col-sm-top contentbar" style="display:none">
	<div class="row">
		<div class="col-xs-12 col-sm-12"><h1>3. Data Pendidikan</h1></div>
	</div>

    <?php include ('input_datapengalaman.php'); ?>

	<hr/ style="margin-top:0px; margin-bottom:0px;">
	<div class="row">
		<ul class="pager">
			<li class="next"><a href="#step_3" onClick="gantiform(this.id)" id="intro_btn_back4" name="button">Kembali</a></li>
			<li class="next"><a href="#step_5" onClick="save_hal3()" id="btn_4" name="btn_4">Lanjut</a></li>
		</ul>
	</div>
</div>


<!-- step_5 -->
<div id="step_5" class="col-xs-12 col-sm-9 col-sm-height col-sm-top contentbar" style="display:none">
	<div class="row">
		<div class="col-xs-12 col-sm-12"><h1>Skill &amp; Lain-Lain</h1></div>
	</div>

    <?php include ('input_lainlain.php'); ?>

	<hr/ style="margin-top:0px; margin-bottom:0px;">
	<div class="row">
		<ul class="pager">
			<li class="next"><a href="#step_4" onClick="gantiform(this.id)" id="intro_btn_back5" name="button">Kembali</a></li>
			<li class="next"><a href="#ending" onClick="save_hal4()" id="btn_5" name="btn_5">Lanjut</a></li>
		</ul>
	</div>
</div>


<!-- step_6 -->
<div id="ending" class="col-xs-12 col-sm-9 col-sm-height col-sm-top contentbar" style="display:none">
	<div class="row">
		<div class="col-xs-12 col-sm-12"><h1>Harap Di Finish Bila Data Sudah di Isi Dengan Benar!!</h1></div>
		<div class="col-xs-12 col-sm-12"><h1>Terima Kasih </h1></div>
	</div>



	<hr/ style="margin-top:0px; margin-bottom:0px;">
	<div class="row">
		<ul class="pager">
			<li class="next"><a href="#step_5" onClick="gantiform(this.id)" id="intro_btn_back6" name="button">Kembali</a></li>
			<li class="next"><a href="#" onClick="save_hal5()" id="btn_6" name="btn_5" style="color: red;">FINISH</a></li>
	</div>
</div>
<!-- </form> -->
                            	
                                
                            
                            </div>
                        </div>
                        
					</section>
                    
        
      <script type="text/javascript">
      $j(document).ready(function() {

        $j('#tanggal_lahir').datepicker({
        yearRange: '-70:+0',
        changeMonth: true,
      	changeYear: true
        });


      });
      </script>            
      
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
            <script src="assets/js/main.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			

	</body>
</html>