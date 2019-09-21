<?php
include('koneksi.php');
$id=$_GET['id'];
//echo $tglawal;
//echo $tglakir;
?> 
                <?php
                   $sql = mysql_query("SELECT * FROM `list_jabatan` where level like '%$id%' ORDER BY nama_jabatan ASC");
                   while ($proyek = mysql_fetch_array($sql)) {
                       echo '<option value="'.$proyek['nama_jabatan'].'">'.$proyek['nama_jabatan'].'</option>';
                   }
                ?>
</div>