<?php 
include('../../koneksi.php');
include('../../session.php');
?>


<?php

if (isset($_POST['approve'])) {
  $id_calon_karyawan=$_POST['id_calon_karyawan'];

  //input ke db
  $query = sprintf("update datapribadi_ck set status='approve2', create_user='$id_user',create_time=now() where id_calon_karyawan='$id_calon_karyawan' and status='approve1setengah'");
    
  $sql = mysql_query($query);

  if ($sql) {
    echo "<script>
    alert('Data Berhasil diInput');
    window.location.href='../../laporan_psikotest.php';
    </script>";
  }
  else {
    echo "<script>
    alert('Data Gagal diInput');
    window.location.href='../../laporan_psikotest.php';
    </script>";
  }
}
?>
