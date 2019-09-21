<?php
include('session.php');
include('header.php');
$date = date('now()');
?><head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

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
  <link rel="stylesheet" type="text/css" media="all" href="plugins/jQuery/daterangepicker.css" />
  <link rel="stylesheet" href="datatables/css/dataTables.bootstrap.css"/>
  
<style type="text/css" title="currentStyle"> 
@import "datatables/css/demo_table_jui.css";
@import "datatables/css/jquery-ui-1.8.4.custom.css";
@import "datatables/css/TableTools.css";
@import "datatables/css/buttons.dataTables.min.css";

</style>

  <script type="text/javascript" src="plugins/jQuery/jQuery-2.1.4.min.js"></script>


	<style type="text/css">
		.fancybox-custom .fancybox-skin {
			box-shadow: 0 0 50px #222;
		}
		.fancybox-wrap { 
		  top: 50px !important;  
		}

	</style>
 		<!--.fancybox-wrap { 
		  top: 180px !important; 
		  left: 47px !important; 
		} -->

  <script src="datatables/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<!-- Bootstrap 3.3.5 -->
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script type="text/javascript" language="javascript" src="datatables/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="datatables/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="datatables/js/ZeroClipboard.js"></script>
<script type="text/javascript" language="javascript" src="datatables/js/TableTools.js"></script>
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
    $('#example').DataTable( {
		"scrollX": true,
		"sPaginationType": "full_numbers",
        dom: 'lBfrtip',
        buttons: [
			
			{
				extend: 'excel',
				text: '<i class="fa fa-lg fa-file-excel-o"></i> excel',
			},
        ]
    } );
} );
</script>
<script type="text/javascript">
$(document).ready(function(){
	$('#tanggal_mulai, #tanggal_selesai').daterangepicker({
		singleDatePicker:true,
		showDropdowns:true,
		tanggal:moment().subtract(6,'day'),
		locale : { format : 'YYYY/MM/DD' }
		});
});

</script>               
</head>
<body class="hold-transition skin-blue sidebar-mini">

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <small><?php echo date('Y-m-d'); ?></small>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h2>
        APPROVE LAPORAN PSIKOTEST
      </h2>
    </section>

    <!-- Main content -->
    <section class="content">

<div style="width:100%; height:auto; overflow:auto;"> 
<?php include('pages/laporan_psikotest/laporan_psikotest.php');?>
</div>
      <!-- Your Page Content Here -->

    </section>
    <!-- /.content -->


  </div>
  <!-- /.content-wrapper -->
</body>

<div class="dontprint">
<aside class="main-sidebar">
<?php
include ('side.php');
?>
<!-- /.sidebar -->
</aside>
<script src="datatables/js/jquery-1.12.0.min.js"></script>
  <script type="text/javascript" src="plugins/jQuery/moment.js"></script>
  <script type="text/javascript" src="plugins/jQuery/daterangepicker.js"></script>
	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />

	<script type="text/javascript">
	$(document).ready(function() {
			
			$(".fancybox").fancybox({
				// API options 
				autoScale: false,
				type: 'iframe',
				padding: 0,
				closeClick: true,
				
				  afterClose: function() {
				   $.ajax({
					  url: 'pages/laporan_psikotest/laporan_psikotest.php',
					  type: 'post',
					  success : function(res) {
						 parent.location.reload(true); 
					  },
				   });
				  } 
				
			});
			
			$(".fancybox-effects-b").fancybox({
				// API options 
				autoScale: false,
				type: 'iframe',
				padding: 0
				
			});
			
			$(".fancybox-effects-d").fancybox({
				padding: 0,

				openEffect : 'elastic',
				openSpeed  : 150,

				closeEffect : 'elastic',
				closeSpeed  : 150,

				closeClick : true,

				helpers : {
					overlay : null
				}
			});
});
	</script>

<script src="datatables/js/jquery.dataTables.min.js"></script>
<script src="dist/js/app.min.js"></script>
<script src="datatables/js/fnFilterAll.js"></script>
<script src="datatables/js/dataTables.buttons.min.js"></script>
<script src="datatables/js/buttons.flash.min.js"></script>
<script src="datatables/js/jszip.min.js"></script>
<script src="datatables/js/vfs_fonts.js"></script>
<script src="datatables/js/buttons.html5.min.js"></script>
</div>