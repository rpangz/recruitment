<?php 
include('../../koneksi.php');
include('../../session.php');
?>


<?php

if (isset($_POST['approve'])) {
  $id_calon_karyawan=$_POST['id_calon_karyawan'];

  $A1=$_POST['A1'];

  $B1=$_POST['B1'];
  $B2=$_POST['B2'];

  $C1=$_POST['C1'];
  $C2=$_POST['C2'];
  $C3=$_POST['C3'];
  $C4=$_POST['C4'];
  $C5=$_POST['C5'];
  $C6=$_POST['C6'];
  $C7=$_POST['C7'];

  $D1=$_POST['D1'];
  $D2=$_POST['D2'];
  $D3=$_POST['D3'];
  $D4=$_POST['D4'];
  $D5=$_POST['D5'];
  $D6=$_POST['D6'];

  $KETERANGAN_HASIL=$_POST['keterangan_hasil'];
/*
  //input ke db
  $query = sprintf("
  	REPLACE INTO HASIL_PSIKOTEST VALUES 
  	('$id_calon_karyawan','A. KEMAMPUAN UMUM','Taraf Kecerdasan','','A1.$A1','$id_user'),

  	('$id_calon_karyawan','B. SIKAP KERJA','Kemandirian','','$B1','$id_user'),
  	('$id_calon_karyawan','B. SIKAP KERJA','Semangat Kerja','','$B2','$id_user'),

  	('$id_calon_karyawan','C. ASPEK KEPRIBADIAN','Berpikir Aktif','','$C1','$id_user'),
  	('$id_calon_karyawan','C. ASPEK KEPRIBADIAN','Cermat','','$C2','$id_user'),
  	('$id_calon_karyawan','C. ASPEK KEPRIBADIAN','Dinamis','','$C3','$id_user'),
  	('$id_calon_karyawan','C. ASPEK KEPRIBADIAN','Ketekunan','','$C4','$id_user'),
  	('$id_calon_karyawan','C. ASPEK KEPRIBADIAN','Membangun Hubungan','','$C5','$id_user'),
  	('$id_calon_karyawan','C. ASPEK KEPRIBADIAN','Percaya Diri','','$C6','$id_user'),
  	('$id_calon_karyawan','C. ASPEK KEPRIBADIAN','Tanggung Jawab','','$C7','$id_user'),

  	('$id_calon_karyawan','D. KEPEMIMPINAN','Inisiatif','','$D1','$id_user'),
  	('$id_calon_karyawan','D. KEPEMIMPINAN','Kaderisasi','','$D2','$id_user'),
  	('$id_calon_karyawan','D. KEPEMIMPINAN','Motivasi Berprestasi','','$D3','$id_user'),
  	('$id_calon_karyawan','D. KEPEMIMPINAN','Organizing','','$D4','$id_user'),
  	('$id_calon_karyawan','D. KEPEMIMPINAN','Penyelesaian Masalah','','$D5','$id_user'),
  	('$id_calon_karyawan','D. KEPEMIMPINAN','Sikap Selalu Bisa','','$D6','$id_user');


  	");


    
  $sql = mysql_query($query);*/
/*
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
  }*/



  //input ke db
  $HASILAKHIR = sprintf("
  	UPDATE DATAPRIBADI_CK SET hasil_test='$KETERANGAN_HASIL', status='approve1setengah' where id_calon_karyawan='$id_calon_karyawan'; 
  	");

  
    
  $sql2 = mysql_query($HASILAKHIR);

  if ($sql2) {
    echo "<script>
    alert('Data Berhasil diInput');
    </script>";
  }
  else {
    echo "<script>
    alert('Data Gagal diInput');
    </script>";
  }


}
?>
