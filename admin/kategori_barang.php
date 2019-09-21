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

    <link rel="stylesheet" href="datatables/css/dataTables.bootstrap.css"/>
<style type="text/css" title="currentStyle"> 
@import "datatables/css/demo_table_jui.css";
@import "datatables/css/jquery-ui-1.8.4.custom.css";
@import "datatables/css/TableTools.css";
@import "datatables/css/buttons.dataTables.min.css";
</style>


  <script type="text/javascript" src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
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
					  type: 'post',
					  success : function(res) {
						 parent.location.reload(true); 
					  },
				   });
				  } 
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
<!-- Bootstrap 3.3.5 -->
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<script type="text/javascript" src="plugins/jquery/jquery-1.2.3.pack.js"></script>
<script>
var $j = jQuery.noConflict();
</script>


<script type="text/javascript" language="javascript" src="datatables/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="datatables/js/jquery.dataTables.js"></script>
<script>
var $d = jQuery.noConflict();
</script>
<script type="text/javascript" language="javascript" src="datatables/js/ZeroClipboard.js"></script>
<script type="text/javascript" language="javascript" src="datatables/js/TableTools.js"></script>
<script type="text/javascript" charset="utf-8">
$d(document).ready(function() {
    $d('#example').DataTable( {
		"scrollX": true,
		"sPaginationType": "full_numbers",
        dom: 'lBfrtip',
        buttons: [
			{
				extend: 'print',
				text: '<i class="fa fa-lg fa-print"></i> Print',
				exportOptions: {
					modifier: {
						page: 'current'
					}
				}
			},
			
			{
				extend: 'excel',
				text: '<i class="fa fa-lg fa-file-excel-o"></i> excel',
			},
        ]
    } );
} );
</script>

  
<style type="text/css">
h4 { font-size: 25px; }
input { padding: 3px;}
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
  <div class="content-wrapper">
    <small><?php echo date('Y-m-d'); ?></small>
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h2>
    	Kategori Barang
    </h2>
    </section>

    <!-- Main content -->
    <section class="content">

<div style="width:100%; height:auto; overflow:auto;"> 
    
<?php 
			if (isset($status_user))
			{
				// jika level USER
				if ($status_user == "USER")
			   	{include('pages/modul/mod_kategori/kategori.php');
			}
			
			else 
			   	{include('pages/modul/mod_kategori/kategori.php');
				}
			}
?>
      <!-- Your Page Content Here -->
</div>
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