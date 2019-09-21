<?php 
include('../../koneksi.php');
include('../../session.php');
?>


<?php

if (isset($_POST['SIMPAN'])) {
  $id_calon_karyawan=$_POST['id_calon_karyawan'];
  $hasil_test=$_POST['hasil_test'];
  $inteligensi=$_POST['inteligensi'];
  $kepribadian=$_POST['kepribadian'];
  $catatan=$_POST['catatan'];

  //input ke db
  $query1 = sprintf("update datapribadi_ck set hasil_test='$hasil_test',status='approve1setengah' where id_calon_karyawan='$id_calon_karyawan' ");
  $sql1 = mysql_query($query1);
  //input ke db
  $query2 = sprintf("REPLACE into hasil_psikotest_staff values ('$id_calon_karyawan','$inteligensi','$kepribadian','$catatan','$id_user',now()) ");
  $sql2 = mysql_query($query2);

/*  if ($sql2) {
    echo $sql2;
  }
  else {
    echo $sql2;
  }*/

  if ($sql1) {
    echo "<script>
    alert('Data Berhasil diInput');
    window.parent.location.href='../../laporan_psikotest.php';
    </script>";
  }
  else {
    echo "<script>
    alert('Data Gagal diInput');
    window.parent.location.href='../../laporan_psikotest.php';
    </script>";
  }
}
?>
