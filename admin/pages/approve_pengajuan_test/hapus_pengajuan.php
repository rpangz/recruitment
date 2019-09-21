<?php 
include('../../koneksi.php');
include('../../session.php');
?>


<?php

if (isset($_POST['hapus'])) {
  $id_calon_karyawan=$_POST['id_calon_karyawan'];

  //input ke db
  $query1 = sprintf("DELETE FROM datakeluarga_ck WHERE id_calon_karyawan='$id_calon_karyawan' ");
  $sql1 = mysql_query($query1);
  //input ke db
  $query2 = sprintf("DELETE FROM datapengalaman_ck WHERE id_calon_karyawan='$id_calon_karyawan' ");
  $sql2 = mysql_query($query2);
  //input ke db
  $query3 = sprintf("DELETE FROM datapribadi_ck WHERE id_calon_karyawan='$id_calon_karyawan' ");
  $sql3 = mysql_query($query3);
  //input ke db
  $query4 = sprintf("DELETE FROM dataskill_ck WHERE id_calon_karyawan='$id_calon_karyawan' ");
  $sql4 = mysql_query($query4);
  //input ke db
  $query5 = sprintf("DELETE FROM datasutri_ck WHERE id_calon_karyawan='$id_calon_karyawan' ");
  $sql5 = mysql_query($query5);
  //input ke db
  $query6 = sprintf("DELETE FROM datasekolah_ck WHERE id_calon_karyawan='$id_calon_karyawan' ");
  $sql6 = mysql_query($query6);
  //input ke db
  $query7 = sprintf("DELETE FROM log_ip WHERE id_calon_karyawan='$id_calon_karyawan' ");
  $sql7 = mysql_query($query7);

  if ($sql1) {
    echo "<script>
    alert('Data Berhasil diHapus');
    window.location.href='../../approve_pengajuan_test.php';
    </script>";
  }
  else {
    echo "<script>
    alert('Data Gagal diHapus');
    window.location.href='../../approve_pengajuan_test.php';
    </script>";
  }
}
?>
