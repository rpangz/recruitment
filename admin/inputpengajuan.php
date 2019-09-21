<?php
include('session.php');
include('header.php');
$date = date('now()');
?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MAXONE</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="dist/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <link rel="stylesheet" type="text/css" media="all" href="plugins/jQuery/daterangepicker.css" />
  <script type="text/javascript" src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
  
  <script type="text/javascript">
	$(document).ready(function() {
		$(".id_lantai").change(function() {
			var id_lantai =$(this).val();
			var dataString = 'id_lantai='+id_lantai;
			$.ajax({
				type: "POST",
				url: "pages/divisi/get_room.php",
				data: dataString,
				cache: false,
				success: function(html) {
					$("#get_room").html(html);
				} 
			});
		});
	});
	$(document).ready(function() {
		$(".kode_kategori").change(function() {
			var kode_kategori =$(this).val();
			var dataString = 'kode_kategori='+kode_kategori;
			$.ajax({
				type: "POST",
				url: "pages/divisi/get_namabarang.php",
				data: dataString,
				cache: false,
				success: function(html) {
					$("#get_namabarang").html(html);
				} 
			});
		});
	});
  </script>

  <script type="text/javascript" src="plugins/jQuery/moment.js"></script>
  <script type="text/javascript" src="plugins/jQuery/daterangepicker.js"></script>
<script type="text/javascript">
      $(document).ready(function() {
        $('#tanggal_keluar').daterangepicker({
          singleDatePicker: true,
          tanggal: moment().subtract(6, 'days')
        });
      });
</script>
<!-- Bootstrap 3.3.5 -->
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<script type="text/javascript" src="plugins/jquery/jquery-1.2.3.pack.js"></script>
<script>
var $j = jQuery.noConflict();
</script>
<script type="text/javascript" src="plugins/jquery/jquery.validate.pack.js"></script>
<script type="text/javascript">
$j(document).ready(function() {
	$j("#sell").validate({
		messages: {
			email: {
				required: "E-mail harus diisi",
				email: "Masukkan E-mail yang valid"
			}
		},
		errorPlacement: function(error, element) {
			error.appendTo(element.parent("td"));
		}
	});
})
</script>

  <script src="tinymce/tinymce.min.js"></script>
  <script src="tinymce/plugins/filemanager/plugin.min.js"></script>
  <script src="tinymce/config_biasa.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
  
<style type="text/css">
h4 { font-size: 25px; }
input { padding: 3px; border: 1px solid #999; }
input.error, select.error { border: 1px solid red; }
label.error { color:red; margin-left: 10px; }

th{padding:20px 7px; font-size:12px; color:#444; background:#66C2E0; border:1px;}

.search-table { overflow-x: scroll; }
select { width: 11.0em }

td { padding: 5px;
 font: 13px Verdana, sans-serif; }

input { 
    text-transform: uppercase;
}
::-webkit-input-placeholder { /* WebKit browsers */
    text-transform: none;
}
:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
    text-transform: none;
}
::-moz-placeholder { /* Mozilla Firefox 19+ */
    text-transform: none;
}
:-ms-input-placeholder { /* Internet Explorer 10+ */
    text-transform: none;
}
</style>

</head>
<body class="hold-transition skin-blue sidebar-mini">
   <!-- Content Wrapper. Contains page content -->
  <div id="my_div" class="content-wrapper">
    <small><?php echo date('Y-m-d'); ?></small>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h2>
       Input Pengajuan baru
      </h2>
    </section>

    <!-- Main content -->
    <section class="content">
<?php 
			if (isset($status_user) && ($divisi))
			{
				// jika level USER
				if ($status_user == "USER" && $divisi !== "PROPERTY")
			   	{include('pages/DIVISI/inputpengajuan.php');
			}
			
			else 
				{include('pages/DIVISI/inputpengajuan.php');
				}
			}
?>
      <!-- Your Page Content Here -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

        </section>
        </body>
<?php
include ('side.php');
include ('footer.php');
?>