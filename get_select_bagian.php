<?php
include('koneksi.php');
?>
<?php
if($_POST['jabatan']) {
	$id2	= $_POST['jabatan'];
?>

                <?php
                   $sql = mysql_query("SELECT * FROM `list_jabatan` where level like '%$id2%' ORDER BY nama_jabatan ASC");
                   while ($proyek = mysql_fetch_array($sql)) {
                       echo '<option value="'.$proyek['nama_jabatan'].'">'.$proyek['nama_jabatan'].'</option>';
                   }
                ?>
<?php 
}
?>