<?php
include ('../koneksi.php');
?>


<?php
$jenis = $_GET['jenis'];
$querystr = $_GET['querystr'];
$input = explode("|", $querystr);
$skill = $input[0];
$nama_lengkap = $input[1];
$syarat_ijasah = $input[2];
$nama_kenalan = $input[3];
$hubungan_kenalan = $input[4];
$jabatan_kenalan = $input[5];
$prestasi_ck = $input[6];
$kesehatan = $input[7];
$tiga_kelebihan = $input[8];
$tiga_kekurangan = $input[9];
$penempatan_di_cabang = $input[10];
$id_calon_karyawan = $input[11];
if ($id_calon_karyawan == "" || $syarat_ijasah == "" || $penempatan_di_cabang == "") {
    echo "Data Gagal Diinput";
} else {
    //input ke db
    $query = sprintf("REPLACE INTO dataskill_ck VALUES('$id_calon_karyawan','$skill','$syarat_ijasah','$nama_kenalan','$hubungan_kenalan','$jabatan_kenalan','$prestasi_ck','$tiga_kelebihan','$tiga_kekurangan','$penempatan_di_cabang','$kesehatan')");
    $sql = mysql_query($query);
    if ($sql) {
        echo "Data Berhasil Diinput";
    } else {
        echo "Data Gagal Diinput";
    }
}
?>
