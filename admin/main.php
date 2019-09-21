<?php
include('session.php');
include('header.php');
include('koneksi.php');
?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>TOP&MDPU</title>
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
  <script type="text/javascript" src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script>
    setInterval(function(){
      $("#pengajuan_calon_karyawan").load("refresh_main/pengajuan_calon_karyawan.php");
    }, 120000); //1menit
</script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="padding-top:10px">
      <h1>
        WELCOME <?php echo $login_session; ?> !!!
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
    
<?php 
if (isset($status_id))
{
				// jika level USER
	if ($status_id == "ADMIN" )
		{
?>
          <table width="100%">
            <tr>
            <td>
            <?php $result = mysql_query("SELECT COUNT(DISTINCT id_calon_karyawan) jumlah FROM datapribadi_ck where status!='' and status ='useradm_approve'"); 
            $row = mysql_fetch_row($result);
            $num_rows = $row[0]; //Here is your count
            ?>
            <a href="approve_pengajuan_test.php">
            		<div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o" style="padding-top:10px"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">PENGAJUAN <br>CALON KARYAWAN</span>
                          <span id="pengajuan_calon_karyawan" class="info-box-number" style="padding-top:4.5px">
                          	<?php echo $num_rows ?>
                          </span>
                          <span class="info-box-text" style="padding-top:10px">PENDING</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
            </a>
            </td>
            </tr>
            <tr><td>&nbsp;</td></tr>
          </table>

<?PHP
	} else {
?>
          <table width="100%">
            <tr>
            <td>
            <?php $result = mysql_query("SELECT COUNT(DISTINCT id_calon_karyawan) jumlah FROM datapribadi_ck where status!='' and status ='DONE'"); 
            $row = mysql_fetch_row($result);
            $num_rows = $row[0]; //Here is your count
            ?>
            <a href="approve_pengajuan_test.php">
                <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o" style="padding-top:10px"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">PENGAJUAN <br>CALON KARYAWAN</span>
                          <span id="pengajuan_calon_karyawan" class="info-box-number" style="padding-top:4.5px">
                            <?php echo $num_rows ?>
                          </span>
                          <span class="info-box-text" style="padding-top:10px">PENDING</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
            </a>
            </td>
            </tr>
            <tr><td>&nbsp;</td></tr>
          </table>




<?php

  }
}
?>

        
    </section>
    <!-- /.content -->
        
  </div>
  <!-- /.content-wrapper -->

  
        <!-- jQuery 2.1.4 -->
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
 
<!--<script>
$('a').bind('click', function(e) {           
  var url = $(this).attr('href');
  $('div#container').load(url); // load the html response into a DOM element ajax untuk open page tanpa reload
  e.preventDefault(); // stop the browser from following the link
});
</script>-->

<!-- Bootstrap 3.3.5 -->
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
        </section>
        </body>
<?php
include ('side.php');
include ('footer.php');
?>