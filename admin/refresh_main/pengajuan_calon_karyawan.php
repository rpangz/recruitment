<?php
include('../session.php');
include('../koneksi.php');
?>
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="dist/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
  
<?php 
			if (isset($status_id))
			{
				// jika level USER
				if ($status_id == "ADMIN")
			   	{
?>


<?php $result = mysql_query("SELECT COUNT(DISTINCT id_calon_karyawan) jumlah FROM datapribadi_ck where status!='' and status ='useradm_approve'"); 
$row = mysql_fetch_row($result);
$num_rows = $row[0]; //Here is your count
?>
<a href="approve_pengajuan_test.php">
              <span class="info-box-number" style="padding-top:4.5px">
              	<?php echo $num_rows ?>
              </span>
</a>

<?php  	
			} else{
?>

<?php $result = mysql_query("SELECT COUNT(DISTINCT id_calon_karyawan) jumlah FROM datapribadi_ck where status!='' and status ='DONE'"); 
$row = mysql_fetch_row($result);
$num_rows = $row[0]; //Here is your count
?>
<a href="approve_pengajuan_test.php">
              <span class="info-box-number" style="padding-top:4.5px">
                <?php echo $num_rows ?>
              </span>
</a>


<?php
      }
			}
?>
