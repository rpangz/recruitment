<?php
include('../../koneksi.php');
include('../../session.php');
$tglawal=$_GET['cstartDate'];
$tglakir = $_GET['cendDate'];
$id_calon_karyawan = $_GET['id_calon_karyawan'];
//echo $tglawal;
//echo $tglakir;
$approve2 = sprintf("update datapribadi_ck set status='approve2', create_user='$id_user',create_time=now() where id_calon_karyawan='$id_calon_karyawan' and status='approve1setengah'; 
    ");

  
    
  $sql2 = mysql_query($approve2);

  if ($sql2) {
    echo "<script>
    alert('Data Berhasil di approve');
    </script>";
  }
  else {
    echo "<script>
    alert('Data Gagal di approve');
    </script>";
  }
?> 
   
            <table id="example" class="table table-bordered" width="100%">
                <thead>
                    <tr>
                        <th width="1%">NO.</th>
                        <th width="5%">ID CALON KARYAWAN</th>
                        <th width="5%">KODE UNIK</th>
                        <th width="5%">NAMA CALON KARYAWAN</th>
                        <th width="5%">STATUS</th>
                        <th width="20%">TEST LOGIKA</th>
                        <th width="20%">PCT ANALYSIS </th>
                        <th width="20%">BEHAVIOR POTRAIT</th>
                        <th width="20%">TEAMWORK TEST</th>
                        <th width="20%">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                        <?php
                        /*================================= BUKA LOOP CALON KARY ========================================*/

                       if ($status_id=="ADMIN") {
                        /*================================= BUKA LOOP CALON KARY ========================================*/
                        $sql2 = mysql_query("SELECT b.nama_lengkap,b.telp1,b.divisi,b.bagian,b.status datapb,b.hasil_test, a.* FROM psikotest_data_kary a,datapribadi_ck b where a.no_calon_kary=b.id_calon_karyawan and date(create_time) >='" .  $_GET['cstartDate'] . "'  AND date(create_time) <='" . $_GET['cendDate'] . "' and b.status='approve1setengah' and b.status!='DIHAPUS'  ORDER BY a.start_a DESC" );
                        }
                        else{
                        /*================================= BUKA LOOP CALON KARY ========================================*/
                        $sql2 = mysql_query("SELECT b.nama_lengkap,b.telp1,b.divisi,b.bagian,b.status datapb,b.hasil_test, a.* FROM psikotest_data_kary a,datapribadi_ck b where a.no_calon_kary=b.id_calon_karyawan and date(create_time) >='" .  $_GET['cstartDate'] . "'  AND date(create_time) <='" . $_GET['cendDate'] . "'  and a.status='finish' and b.status!='DIHAPUS'  and b.status!='APPROVE2'  and b.status!='approve1setengah' ORDER BY a.start_a DESC" );
                        }


                        $no = 1;
                        while ($r2 = mysql_fetch_array($sql2)) {
                            $status = $r2[datapb];
                            $hasil_test = $r2[hasil_test];
                            $id_calon_karyawan = $r2[no_calon_kary];
                            $M = 0;
                            $L = 0;
                            $DIF = 0;
                            
                            $sql = mysql_query("
                                SELECT sum(nilai) from (SELECT b.no_calon_kary,a.soalke,c.jawaban,
                                CASE WHEN (c.jawaban IS NULL OR c.jawaban<>a.jawabreal) THEN 0 ELSE 1 END nilai,
                                CASE WHEN (c.jawaban IS NULL OR c.jawaban<>a.jawabreal) THEN 'SALAH' ELSE 'BENAR' END keterangan
                                FROM (psikotest_a_soal a,psikotest_data_kary b)
                                LEFT OUTER JOIN
                                (SELECT * FROM psikotest_proses_test WHERE no_calon_kary = '$r2[no_calon_kary]' AND kode_unik = '$r2[kode_unik]') c
                                ON a.soalke=c.soalno
                                WHERE b.no_calon_kary = '$r2[no_calon_kary]' AND b.kode_unik = '$r2[kode_unik]')as total
                                ");
                            $r = mysql_fetch_array($sql);



  $sql_hasil = mysql_query("SELECT
max(KECERDASAN)KECERDASAN,
max(SIKAP_KERJA)SIKAP_KERJA,
max(KEPRIBADIAN)KEPRIBADIAN,
max(JOB_PROFILE)JOB_PROFILE,
max(KEPEMIMPINAN)KEPEMIMPINAN

from (

select
if(aspek='ASPEK KECERDASAN',HASIL,'') KECERDASAN,
if(aspek='SIKAP KERJA',HASIL,'') SIKAP_KERJA,
if(aspek='ASPEK KEPRIBADIAN',HASIL,'') KEPRIBADIAN,
if(aspek='JOB PROFILE',HASIL,'') JOB_PROFILE,
if(aspek='ASPEK KEPEMIMPINAN',HASIL,'') KEPEMIMPINAN

from(

SELECT aspek,if(IF(hasil='K',1,0) + IF (hasil='R',1,0) > 0 ,'TIDAK','YA') HASIL FROM (
SELECT b.aspek,b.keterangan hasil FROM (
SELECT 'IQ' alat_tes,sum(nilai) nilai from (SELECT b.no_calon_kary,a.soalke,c.jawaban,
CASE WHEN (c.jawaban IS NULL OR c.jawaban<>a.jawabreal) THEN 0 ELSE 1 END nilai,
CASE WHEN (c.jawaban IS NULL OR c.jawaban<>a.jawabreal) THEN 'SALAH' ELSE 'BENAR' END keterangan
FROM (psikotest_a_soal a,psikotest_data_kary b)
LEFT OUTER JOIN
(SELECT * FROM psikotest_proses_test WHERE no_calon_kary = '$id_calon_karyawan') c
ON a.soalke=c.soalno
WHERE b.no_calon_kary = '$id_calon_karyawan')as total) a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'Taraf Kecerdasan' AND a.nilai between b.min AND b.max
) kecerdasan

union all

SELECT aspek,if(sum(IF(hasil='K',1,0)) > 0,'TIDAK','YA') HASIL FROM (
SELECT a.aspek,a.kompetensi,b.hasil FROM (

SELECT aspek,kompetensi,GROUP_CONCAT(keterangan separator '') kombinasi FROM (


SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT no_calon_kary,
SUM(CASE WHEN b.kategori='CH' THEN a.jawaban ELSE 0 END) nilai,'CH' alat_tes
FROM psikotest_proses_test_d a, spek_jawaban_d b WHERE
a.bagiantest=b.bagianke AND a.soalno=b.soalke
AND a.no_calon_kary = '$id_calon_karyawan' ) a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'KEMANDIRIAN' AND a.nilai between b.min AND b.max
UNION ALL
SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT a.no_calon_kary,
SUM(CASE WHEN b.nilai = 'N' THEN 1 ELSE 0 END) nilai,'N' alat_tes
FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan') a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'KEMANDIRIAN' AND a.nilai between b.min AND b.max
UNION ALL
SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT a.no_calon_kary,
SUM(CASE WHEN b.nilai = 'A' THEN 1 ELSE 0 END) nilai,'A' alat_tes
FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' ) a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'KEMANDIRIAN' AND a.nilai between b.min AND b.max


) a

) a, spek_kcb b WHERE a.kombinasi=b.kombinasi


UNION ALL


SELECT a.aspek,a.kompetensi,b.hasil FROM (

SELECT aspek,kompetensi,GROUP_CONCAT(keterangan separator '') kombinasi FROM (

SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT no_calon_kary,
SUM(CASE WHEN b.kategori='CF' THEN a.jawaban ELSE 0 END) nilai,'CF' alat_tes
FROM psikotest_proses_test_d a, spek_jawaban_d b WHERE
a.bagiantest=b.bagianke AND a.soalno=b.soalke
AND a.no_calon_kary = '$id_calon_karyawan' ) a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'Semangat Kerja' AND a.nilai between b.min AND b.max
UNION ALL
SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT a.no_calon_kary,
SUM(CASE WHEN b.nilai = 'G' THEN 1 ELSE 0 END) nilai,'G' alat_tes
FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' ) a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'Semangat Kerja' AND a.nilai between b.min AND b.max
UNION ALL
SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT a.no_calon_kary,
SUM(CASE WHEN b.nilai = 'N' THEN 1 ELSE 0 END) nilai,'N' alat_tes
FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' ) a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'Semangat Kerja' AND a.nilai between b.min AND b.max

) a

) a, spek_kcb b WHERE a.kombinasi=b.kombinasi
) SIKAP_KERJA

UNION ALL

SELECT aspek,if(sum(IF(hasil='K',1,0)) > 2,'TIDAK','YA') HASIL FROM (
SELECT a.aspek,a.kompetensi,b.hasil FROM (

SELECT aspek,kompetensi,GROUP_CONCAT(keterangan separator '') kombinasi FROM (

SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT no_calon_kary,
SUM(CASE WHEN b.kategori='CH' THEN a.jawaban ELSE 0 END) nilai,'CH' alat_tes
FROM psikotest_proses_test_d a, spek_jawaban_d b WHERE
a.bagiantest=b.bagianke AND a.soalno=b.soalke
AND a.no_calon_kary = '$id_calon_karyawan' ) a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'Percaya Diri' AND a.nilai between b.min AND b.max
UNION ALL
SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT a.no_calon_kary,
SUM(CASE WHEN b.nilai = 'X' THEN 1 ELSE 0 END) nilai,'X' alat_tes
FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' ) a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'Percaya Diri' AND a.nilai between b.min AND b.max
UNION ALL
SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT no_calon_kary,
SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) nilai,'I' alat_tes
FROM psikotest_proses_test_b a LEFT OUTER JOIN
(SELECT * FROM spek_jawaban_b WHERE disc = 'I') b ON a.soalno=b.soalke AND a.ml=b.ml
WHERE a.no_calon_kary = '$id_calon_karyawan') a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'Percaya Diri' AND a.nilai between b.min AND b.max
) a
) a, spek_kcb b WHERE a.kombinasi=b.kombinasi

UNION ALL

SELECT a.aspek,a.kompetensi,b.hasil FROM (

SELECT aspek,kompetensi,GROUP_CONCAT(keterangan separator '') kombinasi FROM (
SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT a.no_calon_kary,
SUM(CASE WHEN b.nilai = 'N' THEN 1 ELSE 0 END) nilai,'N' alat_tes
FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' ) a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'Tanggung Jawab' AND a.nilai between b.min AND b.max

UNION ALL
SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT no_calon_kary,
SUM(CASE WHEN b.kategori='CF' THEN a.jawaban ELSE 0 END) nilai,'CF' alat_tes
FROM psikotest_proses_test_d a, spek_jawaban_d b WHERE
a.bagiantest=b.bagianke AND a.soalno=b.soalke
AND a.no_calon_kary = '$id_calon_karyawan' ) a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'Tanggung Jawab' AND a.nilai between b.min AND b.max

UNION ALL
SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT no_calon_kary,
SUM(CASE WHEN b.kategori='CW' THEN a.jawaban ELSE 0 END) nilai,'CW' alat_tes
FROM psikotest_proses_test_d a, spek_jawaban_d b WHERE
a.bagiantest=b.bagianke AND a.soalno=b.soalke
AND a.no_calon_kary = '$id_calon_karyawan' ) a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'Tanggung Jawab' AND a.nilai between b.min AND b.max

) a
) a, spek_kcb b WHERE a.kombinasi=b.kombinasi

UNION ALL

SELECT a.aspek,a.kompetensi,b.hasil FROM (

SELECT aspek,kompetensi,GROUP_CONCAT(keterangan separator '') kombinasi FROM (

SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT no_calon_kary,
SUM(CASE WHEN b.kategori='TW' THEN a.jawaban ELSE 0 END) nilai,'TW' alat_tes
FROM psikotest_proses_test_d a, spek_jawaban_d b WHERE
a.bagiantest=b.bagianke AND a.soalno=b.soalke
AND a.no_calon_kary = '$id_calon_karyawan' ) a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'Membangun Hubungan' AND a.nilai between b.min AND b.max


UNION ALL
SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT no_calon_kary,
SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) nilai,'I' alat_tes
FROM psikotest_proses_test_b a LEFT OUTER JOIN
(SELECT * FROM spek_jawaban_b WHERE disc = 'I') b ON a.soalno=b.soalke AND a.ml=b.ml
WHERE a.no_calon_kary = '$id_calon_karyawan') a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'Membangun Hubungan' AND a.nilai between b.min AND b.max

UNION ALL

SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT a.no_calon_kary,
SUM(CASE WHEN b.nilai = 'S' THEN 1 ELSE 0 END) nilai,'S' alat_tes
FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' ) a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'Membangun Hubungan' AND a.nilai between b.min AND b.max

) a
) a, spek_kcb b WHERE a.kombinasi=b.kombinasi

UNION ALL

SELECT a.aspek,a.kompetensi,b.hasil FROM (

SELECT aspek,kompetensi,GROUP_CONCAT(keterangan separator '') kombinasi FROM (

SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT no_calon_kary,
SUM(CASE WHEN b.kategori='PL' THEN a.jawaban ELSE 0 END) nilai,'PL' alat_tes
FROM psikotest_proses_test_d a, spek_jawaban_d b WHERE
a.bagiantest=b.bagianke AND a.soalno=b.soalke
AND a.no_calon_kary = '$id_calon_karyawan' ) a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'Berpikir Aktif' AND a.nilai between b.min AND b.max


UNION ALL
SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT a.no_calon_kary,
SUM(CASE WHEN b.nilai = 'T' THEN 1 ELSE 0 END) nilai,'T' alat_tes
FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' ) a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'Berpikir Aktif' AND a.nilai between b.min AND b.max

UNION ALL
SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT no_calon_kary,
SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) nilai,'I' alat_tes
FROM psikotest_proses_test_b a LEFT OUTER JOIN
(SELECT * FROM spek_jawaban_b WHERE disc = 'I') b ON a.soalno=b.soalke AND a.ml=b.ml
WHERE a.no_calon_kary = '$id_calon_karyawan') a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'Berpikir Aktif' AND a.nilai between b.min AND b.max

) a
) a, spek_kcb b WHERE a.kombinasi=b.kombinasi

UNION ALL

SELECT a.aspek,a.kompetensi,b.hasil FROM (

SELECT aspek,kompetensi,GROUP_CONCAT(keterangan separator '') kombinasi FROM (

SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT a.no_calon_kary,
SUM(CASE WHEN b.nilai = 'N' THEN 1 ELSE 0 END) nilai,'N' alat_tes
FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' ) a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'Ketekunan' AND a.nilai between b.min AND b.max


UNION ALL
SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT no_calon_kary,
SUM(CASE WHEN b.kategori='CF' THEN a.jawaban ELSE 0 END) nilai,'CF' alat_tes
FROM psikotest_proses_test_d a, spek_jawaban_d b WHERE
a.bagiantest=b.bagianke AND a.soalno=b.soalke
AND a.no_calon_kary = '$id_calon_karyawan' ) a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'Ketekunan' AND a.nilai between b.min AND b.max

UNION ALL
SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT no_calon_kary,
SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) nilai,'C' alat_tes
FROM psikotest_proses_test_b a LEFT OUTER JOIN
(SELECT * FROM spek_jawaban_b WHERE disc = 'C') b ON a.soalno=b.soalke AND a.ml=b.ml
WHERE a.no_calon_kary = '$id_calon_karyawan') a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'Ketekunan' AND a.nilai between b.min AND b.max

) a
) a, spek_kcb b WHERE a.kombinasi=b.kombinasi

UNION ALL

SELECT a.aspek,a.kompetensi,b.hasil FROM (

SELECT aspek,kompetensi,GROUP_CONCAT(keterangan separator '') kombinasi FROM (

SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT a.no_calon_kary,
SUM(CASE WHEN b.nilai = 'T' THEN 1 ELSE 0 END) nilai,'T' alat_tes
FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' ) a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'Dinamis' AND a.nilai between b.min AND b.max


UNION ALL
SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT no_calon_kary,
SUM(CASE WHEN b.kategori='RI' THEN a.jawaban ELSE 0 END) nilai,'RI' alat_tes
FROM psikotest_proses_test_d a, spek_jawaban_d b WHERE
a.bagiantest=b.bagianke AND a.soalno=b.soalke
AND a.no_calon_kary = '$id_calon_karyawan' ) a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'Dinamis' AND a.nilai between b.min AND b.max

UNION ALL
SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT no_calon_kary,
SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) nilai,'D' alat_tes
FROM psikotest_proses_test_b a LEFT OUTER JOIN
(SELECT * FROM spek_jawaban_b WHERE disc = 'D') b ON a.soalno=b.soalke AND a.ml=b.ml
WHERE a.no_calon_kary = '$id_calon_karyawan') a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'Dinamis' AND a.nilai between b.min AND b.max

) a
) a, spek_kcb b WHERE a.kombinasi=b.kombinasi

UNION ALL

SELECT a.aspek,a.kompetensi,b.hasil FROM (

SELECT aspek,kompetensi,GROUP_CONCAT(keterangan separator '') kombinasi FROM (

SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT 'PCT' jenis_alat_test,no_calon_kary,
SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) nilai,'C' alat_tes
FROM psikotest_proses_test_b a LEFT OUTER JOIN
(SELECT * FROM spek_jawaban_b WHERE disc = 'C') b ON a.soalno=b.soalke AND a.ml=b.ml
WHERE a.no_calon_kary = '$id_calon_karyawan') a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'Cermat' AND a.jenis_alat_test=b.jenis_alat_test
AND a.nilai between b.min AND b.max



UNION ALL
SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT '720' jenis_alat_test,a.no_calon_kary,
SUM(CASE WHEN b.nilai = 'C' THEN 1 ELSE 0 END) nilai,'C' alat_tes
FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' ) a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'Cermat' AND a.jenis_alat_test=b.jenis_alat_test
AND a.nilai between b.min AND b.max

UNION ALL
SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT '720' jenis_alat_test,a.no_calon_kary,
SUM(CASE WHEN b.nilai = 'D' THEN 1 ELSE 0 END) nilai,'D' alat_tes
FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' ) a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'Cermat' AND a.jenis_alat_test=b.jenis_alat_test
AND a.nilai between b.min AND b.max

) a
) a, spek_kcb b WHERE a.kombinasi=b.kombinasi
)ASPEK_KEPRIBADIAN


UNION ALL

SELECT 'JOB PROFILE',
CASE WHEN SUM(CASE WHEN a.L BETWEEN c.min AND c.max THEN 1 ELSE 0 END) < 3 THEN 'TIDAK' ELSE 'YA' END job_profile FROM (

                    SELECT a.no_calon_kary,'D' disc,
                    SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='M') THEN 1 ELSE 0 END) M,
                    SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) L
                    FROM psikotest_proses_test_b a LEFT OUTER JOIN
                    (SELECT * FROM spek_jawaban_b WHERE disc = 'D') b ON a.soalno=b.soalke AND a.ml=b.ml
                    WHERE a.no_calon_kary = '$id_calon_karyawan'
                    UNION ALL
                    SELECT a.no_calon_kary,'I',
                    SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='M') THEN 1 ELSE 0 END) M,
                    SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) L
                    FROM psikotest_proses_test_b a LEFT OUTER JOIN
                    (SELECT * FROM spek_jawaban_b WHERE disc = 'I') b ON a.soalno=b.soalke AND a.ml=b.ml
                    WHERE a.no_calon_kary = '$id_calon_karyawan'
                    UNION ALL
                    SELECT a.no_calon_kary,'S',
                    SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='M') THEN 1 ELSE 0 END) M,
                    SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) L
                    FROM psikotest_proses_test_b a LEFT OUTER JOIN
                    (SELECT * FROM spek_jawaban_b WHERE disc = 'S') b ON a.soalno=b.soalke AND a.ml=b.ml
                    WHERE a.no_calon_kary = '$id_calon_karyawan'
                    UNION ALL
                    SELECT a.no_calon_kary,'C',
                    SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='M') THEN 1 ELSE 0 END) M,
                    SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) L
                    FROM psikotest_proses_test_b a LEFT OUTER JOIN
                    (SELECT * FROM spek_jawaban_b WHERE disc = 'C') b ON a.soalno=b.soalke AND a.ml=b.ml
                    WHERE a.no_calon_kary = '$id_calon_karyawan'
                    UNION ALL
                    SELECT a.no_calon_kary,'N',
                    SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='M') THEN 1 ELSE 0 END) M,
                    SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) L
                    FROM psikotest_proses_test_b a LEFT OUTER JOIN
                    (SELECT * FROM spek_jawaban_b WHERE disc = 'N') b ON a.soalno=b.soalke AND a.ml=b.ml
                    WHERE a.no_calon_kary = '$id_calon_karyawan'

) a, datapribadi_ck b, spek_nilai_pct_spv c WHERE a.no_calon_kary=b.id_calon_karyawan AND b.bagian=c.jabatan
AND a.disc=c.disc

UNION ALL

SELECT aspek,if(sum(IF(hasil='K',1,0)) > 2,'TIDAK','YA') HASIL FROM (
SELECT a.aspek,a.kompetensi,b.hasil FROM (

SELECT aspek,kompetensi,GROUP_CONCAT(keterangan separator '') kombinasi FROM (

SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT 'TW' jenis_alat_test,no_calon_kary,
SUM(CASE WHEN b.kategori='RI' THEN a.jawaban ELSE 0 END) nilai,'RI' alat_tes
FROM psikotest_proses_test_d a, spek_jawaban_d b WHERE
a.bagiantest=b.bagianke AND a.soalno=b.soalke
AND a.no_calon_kary = '$id_calon_karyawan' ) a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'Inisiatif' AND a.nilai between b.min AND b.max

UNION ALL
SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT '720' jenis_alat_test,a.no_calon_kary,
SUM(CASE WHEN b.nilai = 'A' THEN 1 ELSE 0 END) nilai,'A' alat_tes
FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' ) a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'Inisiatif' AND a.jenis_alat_test=b.jenis_alat_test
AND a.nilai between b.min AND b.max

UNION ALL
SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT '720' jenis_alat_test,a.no_calon_kary,
SUM(CASE WHEN b.nilai = 'T' THEN 1 ELSE 0 END) nilai,'T' alat_tes
FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' ) a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'Inisiatif' AND a.jenis_alat_test=b.jenis_alat_test
AND a.nilai between b.min AND b.max

) a
) a, spek_kcb b WHERE a.kombinasi=b.kombinasi

UNION ALL

SELECT a.aspek,a.kompetensi,b.hasil FROM (

SELECT aspek,kompetensi,GROUP_CONCAT(keterangan separator '') kombinasi FROM (

SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT 'TW' jenis_alat_test,no_calon_kary,
SUM(CASE WHEN b.kategori='RI' THEN a.jawaban ELSE 0 END) nilai,'RI' alat_tes
FROM psikotest_proses_test_d a, spek_jawaban_d b WHERE
a.bagiantest=b.bagianke AND a.soalno=b.soalke
AND a.no_calon_kary = '$id_calon_karyawan' ) a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'Motivasi Berprestasi' AND a.nilai between b.min AND b.max

UNION ALL
SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT '720' jenis_alat_test,a.no_calon_kary,
SUM(CASE WHEN b.nilai = 'A' THEN 1 ELSE 0 END) nilai,'A' alat_tes
FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' ) a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'Motivasi Berprestasi' AND a.jenis_alat_test=b.jenis_alat_test
AND a.nilai between b.min AND b.max

UNION ALL
SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT 'TW' jenis_alat_test,no_calon_kary,
SUM(CASE WHEN b.kategori='SH' THEN a.jawaban ELSE 0 END) nilai,'SH' alat_tes
FROM psikotest_proses_test_d a, spek_jawaban_d b WHERE
a.bagiantest=b.bagianke AND a.soalno=b.soalke
AND a.no_calon_kary = '$id_calon_karyawan' ) a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'Motivasi Berprestasi' AND a.nilai between b.min AND b.max

) a
) a, spek_kcb b WHERE a.kombinasi=b.kombinasi


UNION ALL

SELECT a.aspek,a.kompetensi,b.hasil FROM (

SELECT aspek,kompetensi,GROUP_CONCAT(keterangan separator '') kombinasi FROM (


SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT '720' jenis_alat_test,a.no_calon_kary,
SUM(CASE WHEN b.nilai = 'I' THEN 1 ELSE 0 END) nilai,'I' alat_tes
FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' ) a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'PENYELESAIAN MASALAH' AND a.jenis_alat_test=b.jenis_alat_test
AND a.nilai between b.min AND b.max

UNION ALL
SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT '720' jenis_alat_test,a.no_calon_kary,
SUM(CASE WHEN b.nilai = 'R' THEN 1 ELSE 0 END) nilai,'R' alat_tes
FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' ) a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'PENYELESAIAN MASALAH' AND a.jenis_alat_test=b.jenis_alat_test
AND a.nilai between b.min AND b.max

UNION ALL
SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT 'TW' jenis_alat_test,no_calon_kary,
SUM(CASE WHEN b.kategori='ME' THEN a.jawaban ELSE 0 END) nilai,'ME' alat_tes
FROM psikotest_proses_test_d a, spek_jawaban_d b WHERE
a.bagiantest=b.bagianke AND a.soalno=b.soalke
AND a.no_calon_kary = '$id_calon_karyawan' ) a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'PENYELESAIAN MASALAH' AND a.nilai between b.min AND b.max

) a
) a, spek_kcb b WHERE a.kombinasi=b.kombinasi


UNION ALL

SELECT a.aspek,a.kompetensi,b.hasil FROM (

SELECT aspek,kompetensi,GROUP_CONCAT(keterangan separator '') kombinasi FROM (


SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT 'TW' jenis_alat_test,no_calon_kary,
SUM(CASE WHEN b.kategori='CW' THEN a.jawaban ELSE 0 END) nilai,'CW' alat_tes
FROM psikotest_proses_test_d a, spek_jawaban_d b WHERE
a.bagiantest=b.bagianke AND a.soalno=b.soalke
AND a.no_calon_kary = '$id_calon_karyawan' ) a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'Sikap Selalu bisa' AND a.nilai between b.min AND b.max

UNION ALL
SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT 'TW' jenis_alat_test,no_calon_kary,
SUM(CASE WHEN b.kategori='CF' THEN a.jawaban ELSE 0 END) nilai,'CF' alat_tes
FROM psikotest_proses_test_d a, spek_jawaban_d b WHERE
a.bagiantest=b.bagianke AND a.soalno=b.soalke
AND a.no_calon_kary = '$id_calon_karyawan' ) a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'Sikap Selalu bisa' AND a.nilai between b.min AND b.max

UNION ALL
SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT '720' jenis_alat_test,a.no_calon_kary,
SUM(CASE WHEN b.nilai = 'A' THEN 1 ELSE 0 END) nilai,'A' alat_tes
FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' ) a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'Sikap Selalu bisa' AND a.jenis_alat_test=b.jenis_alat_test
AND a.nilai between b.min AND b.max

) a
) a, spek_kcb b WHERE a.kombinasi=b.kombinasi


UNION ALL

SELECT a.aspek,a.kompetensi,b.hasil FROM (

SELECT aspek,kompetensi,GROUP_CONCAT(keterangan separator '') kombinasi FROM (


SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT 'TW' jenis_alat_test,no_calon_kary,
SUM(CASE WHEN b.kategori='CH' THEN a.jawaban ELSE 0 END) nilai,'CH' alat_tes
FROM psikotest_proses_test_d a, spek_jawaban_d b WHERE
a.bagiantest=b.bagianke AND a.soalno=b.soalke
AND a.no_calon_kary = '$id_calon_karyawan' ) a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'Organizing' AND a.nilai between b.min AND b.max

UNION ALL
SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT '720' jenis_alat_test,a.no_calon_kary,
SUM(CASE WHEN b.nilai = 'P' THEN 1 ELSE 0 END) nilai,'P' alat_tes
FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' ) a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'Organizing' AND a.jenis_alat_test=b.jenis_alat_test
AND a.nilai between b.min AND b.max

UNION ALL
SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT 'TW' jenis_alat_test,no_calon_kary,
SUM(CASE WHEN b.kategori='RI' THEN a.jawaban ELSE 0 END) nilai,'RI' alat_tes
FROM psikotest_proses_test_d a, spek_jawaban_d b WHERE
a.bagiantest=b.bagianke AND a.soalno=b.soalke
AND a.no_calon_kary = '$id_calon_karyawan' ) a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'Organizing' AND a.nilai between b.min AND b.max

) a
) a, spek_kcb b WHERE a.kombinasi=b.kombinasi


UNION ALL

SELECT a.aspek,a.kompetensi,b.hasil FROM (

SELECT aspek,kompetensi,GROUP_CONCAT(keterangan separator '') kombinasi FROM (


SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT 'TW' jenis_alat_test,no_calon_kary,
SUM(CASE WHEN b.kategori='SH' THEN a.jawaban ELSE 0 END) nilai,'SH' alat_tes
FROM psikotest_proses_test_d a, spek_jawaban_d b WHERE
a.bagiantest=b.bagianke AND a.soalno=b.soalke
AND a.no_calon_kary = '$id_calon_karyawan' ) a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'Kaderisasi' AND a.nilai between b.min AND b.max

UNION ALL
SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT '720' jenis_alat_test,a.no_calon_kary,
SUM(CASE WHEN b.nilai = 'P' THEN 1 ELSE 0 END) nilai,'P' alat_tes
FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' ) a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'Kaderisasi' AND a.jenis_alat_test=b.jenis_alat_test
AND a.nilai between b.min AND b.max

UNION ALL
SELECT b.aspek,b.kompetensi,b.keterangan FROM (
SELECT 'TW' jenis_alat_test,no_calon_kary,
SUM(CASE WHEN b.kategori='CH' THEN a.jawaban ELSE 0 END) nilai,'CH' alat_tes
FROM psikotest_proses_test_d a, spek_jawaban_d b WHERE
a.bagiantest=b.bagianke AND a.soalno=b.soalke
AND a.no_calon_kary = '$id_calon_karyawan' ) a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'Kaderisasi' AND a.nilai between b.min AND b.max

) a
) a, spek_kcb b WHERE a.kombinasi=b.kombinasi
)ASPEK_KEPEMIMPINAN

)a

)a;
");
   $rows2 = mysql_fetch_row($sql_hasil);

                        ?>
                        <tr align='left'>
                            <td><?php echo  $no;?></td>
                            <td><a data-fancybox-href="pages/approve_pengajuan_test/semuadata_detail.php?id_calon_karyawan=<?php echo  $r2[no_calon_kary];?>" href="javascript:;" class="fancybox-effects-b">
                                <?php echo  $r2['no_calon_kary'];?>
                                <br><br><?php echo  $r2['divisi']; ?><br><?php echo  $r2['bagian']; ?>
                                </a>
                            </td>
                            <td><?php echo  $r2['kode_unik'];?>
                            </td>
                            <td><?php echo  $r2['nama_lengkap']; ?></td>
                            <td>
                            <?php
                            if ($status=="approve") {
                                echo "<div style='color: #660066'>";
                            }
                            else if($status=="approve1setengah"){
                                echo "<div style='color: #ff6600'>";
                            }
                            
                            ?>
                                <?php echo  $r2['status'];?><br><br>
                                <?php
                                if ($hasil_test=="") 
                                {

                                      if ($rows2[0]== 'YA' && $rows2[1]== 'YA' && $rows2[2]== 'YA' && $rows2[3]== 'YA' && $rows2[4]== 'YA'){
                                          echo 'DISARANKAN';
                                      }
                                      elseif ($rows2[0]== 'YA' && $rows2[1]== 'YA' && $rows2[2]== 'YA' && $rows2[3]== 'YA' && $rows2[4]== 'TIDAK'){
                                          echo 'TIDAK DISARANKAN';
                                      }
                                      elseif ($rows2[0]== 'YA' && $rows2[1]== 'YA' && $rows2[2]== 'YA' && $rows2[3]== 'TIDAK' && $rows2[4]== 'YA'){
                                          echo 'DIPERTIMBANGKAN';
                                      }
                                      elseif ($rows2[0]== 'YA' && $rows2[1]== 'YA' && $rows2[2]== 'YA' && $rows2[3]== 'TIDAK' && $rows2[4]== 'TIDAK'){
                                          echo 'TIDAK DISARANKAN';
                                      }

                                      elseif ($rows2[0]== 'YA' && $rows2[1]== 'YA' && $rows2[2]== 'TIDAK' && $rows2[3]== 'YA' && $rows2[4]== 'YA'){
                                          echo 'DIPERTIMBANGKAN DGN CATATAN';
                                      }
                                      elseif ($rows2[0]== 'YA' && $rows2[1]== 'YA' && $rows2[2]== 'TIDAK' && $rows2[3]== 'YA' && $rows2[4]== 'TIDAK'){
                                          echo 'TIDAK DISARANKAN';
                                      }
                                      elseif ($rows2[0]== 'YA' && $rows2[1]== 'YA' && $rows2[2]== 'TIDAK' && $rows2[3]== 'TIDAK' && $rows2[4]== 'YA'){
                                          echo 'TIDAK DISARANKAN';
                                      }
                                      elseif ($rows2[0]== 'YA' && $rows2[1]== 'YA' && $rows2[2]== 'TIDAK' && $rows2[3]== 'TIDAK' && $rows2[4]== 'TIDAK'){
                                          echo 'TIDAK DISARANKAN';
                                      }

                                        //SIKAP KERJA TIDAK ROW 1

                                      elseif ($rows2[0]== 'YA' && $rows2[1]== 'TIDAK' && $rows2[2]== 'YA' && $rows2[3]== 'YA' && $rows2[4]== 'YA'){
                                          echo 'DIPERTIMBANGKAN DGN CATATAN';
                                      }
                                      elseif ($rows2[0]== 'YA' && $rows2[1]== 'TIDAK' && $rows2[2]== 'YA' && $rows2[3]== 'YA' && $rows2[4]== 'TIDAK'){
                                          echo 'TIDAK DISARANKAN';
                                      }
                                      elseif ($rows2[0]== 'YA' && $rows2[1]== 'TIDAK' && $rows2[2]== 'YA' && $rows2[3]== 'TIDAK' && $rows2[4]== 'YA'){
                                          echo 'DIPERTIMBANGKAN DGN CATATAN';
                                      }
                                      elseif ($rows2[0]== 'YA' && $rows2[1]== 'TIDAK' && $rows2[2]== 'YA' && $rows2[3]== 'TIDAK' && $rows2[4]== 'TIDAK'){
                                          echo 'TIDAK DISARANKAN';
                                      }
                                      
                                      elseif ($rows2[0]== 'YA' && $rows2[1]== 'TIDAK' && $rows2[2]== 'TIDAK' && $rows2[3]== 'YA' && $rows2[4]== 'YA'){
                                          echo 'TIDAK DISARANKAN';
                                      }
                                      elseif ($rows2[0]== 'YA' && $rows2[1]== 'TIDAK' && $rows2[2]== 'TIDAK' && $rows2[3]== 'YA' && $rows2[4]== 'TIDAK'){
                                          echo 'TIDAK DISARANKAN';
                                      }
                                      elseif ($rows2[0]== 'YA' && $rows2[1]== 'TIDAK' && $rows2[2]== 'TIDAK' && $rows2[3]== 'TIDAK' && $rows2[4]== 'YA'){
                                          echo 'TIDAK DISARANKAN';
                                      }
                                      elseif ($rows2[0]== 'YA' && $rows2[1]== 'TIDAK' && $rows2[2]== 'TIDAK' && $rows2[3]== 'TIDAK' && $rows2[4]== 'TIDAK'){
                                          echo 'TIDAK DISARANKAN';
                                      }

                                      //kecerdasan TIDAK ROW 0
                                        //SIKAP KERJA YA ROW 1

                                      elseif ($rows2[0]== 'TIDAK' && $rows2[1]== 'YA' && $rows2[2]== 'YA' && $rows2[3]== 'YA' && $rows2[4]== 'YA'){
                                          echo 'DIPERTIMBANGKAN DGN CATATAN';
                                      }
                                      elseif ($rows2[0]== 'TIDAK' && $rows2[1]== 'YA' && $rows2[2]== 'YA' && $rows2[3]== 'YA' && $rows2[4]== 'TIDAK'){
                                          echo 'TIDAK DISARANKAN';
                                      }
                                      elseif ($rows2[0]== 'TIDAK' && $rows2[1]== 'YA' && $rows2[2]== 'YA' && $rows2[3]== 'TIDAK' && $rows2[4]== 'YA'){
                                          echo 'DIPERTIMBANGKAN DGN CATATAN';
                                      }
                                      elseif ($rows2[0]== 'TIDAK' && $rows2[1]== 'YA' && $rows2[2]== 'YA' && $rows2[3]== 'TIDAK' && $rows2[4]== 'TIDAK'){
                                          echo 'TIDAK DISARANKAN';
                                      }

                                      elseif ($rows2[0]== 'TIDAK' && $rows2[1]== 'YA' && $rows2[2]== 'TIDAK' && $rows2[3]== 'YA' && $rows2[4]== 'YA'){
                                          echo 'TIDAK DISARANKAN';
                                      }
                                      elseif ($rows2[0]== 'TIDAK' && $rows2[1]== 'YA' && $rows2[2]== 'TIDAK' && $rows2[3]== 'YA' && $rows2[4]== 'TIDAK'){
                                          echo 'TIDAK DISARANKAN';
                                      }
                                      elseif ($rows2[0]== 'TIDAK' && $rows2[1]== 'YA' && $rows2[2]== 'TIDAK' && $rows2[3]== 'TIDAK' && $rows2[4]== 'YA'){
                                          echo 'TIDAK DISARANKAN';
                                      }
                                      elseif ($rows2[0]== 'TIDAK' && $rows2[1]== 'YA' && $rows2[2]== 'TIDAK' && $rows2[3]== 'TIDAK' && $rows2[4]== 'TIDAK'){
                                          echo 'TIDAK DISARANKAN';
                                      }

                                        //SIKAP KERJA TIDAK ROW 1

                                      elseif ($rows2[0]== 'TIDAK' && $rows2[1]== 'TIDAK' && $rows2[2]== 'YA' && $rows2[3]== 'YA' && $rows2[4]== 'YA'){
                                          echo 'DIPERTIMBANGKAN DGN CATATAN';
                                      }
                                      elseif ($rows2[0]== 'TIDAK' && $rows2[1]== 'TIDAK' && $rows2[2]== 'YA' && $rows2[3]== 'YA' && $rows2[4]== 'TIDAK'){
                                          echo 'TIDAK DISARANKAN';
                                      }
                                      elseif ($rows2[0]== 'TIDAK' && $rows2[1]== 'TIDAK' && $rows2[2]== 'YA' && $rows2[3]== 'TIDAK' && $rows2[4]== 'YA'){
                                          echo 'TIDAK DISARANKAN';
                                      }
                                      elseif ($rows2[0]== 'TIDAK' && $rows2[1]== 'TIDAK' && $rows2[2]== 'YA' && $rows2[3]== 'TIDAK' && $rows2[4]== 'TIDAK'){
                                          echo 'TIDAK DISARANKAN';
                                      }
                                      
                                      elseif ($rows2[0]== 'TIDAK' && $rows2[1]== 'TIDAK' && $rows2[2]== 'TIDAK' && $rows2[3]== 'YA' && $rows2[4]== 'YA'){
                                          echo 'TIDAK DISARANKAN';
                                      }
                                      elseif ($rows2[0]== 'TIDAK' && $rows2[1]== 'TIDAK' && $rows2[2]== 'TIDAK' && $rows2[3]== 'YA' && $rows2[4]== 'TIDAK'){
                                          echo 'TIDAK DISARANKAN';
                                      }
                                      elseif ($rows2[0]== 'TIDAK' && $rows2[1]== 'TIDAK' && $rows2[2]== 'TIDAK' && $rows2[3]== 'TIDAK' && $rows2[4]== 'YA'){
                                          echo 'TIDAK DISARANKAN';
                                      }
                                      elseif ($rows2[0]== 'TIDAK' && $rows2[1]== 'TIDAK' && $rows2[2]== 'TIDAK' && $rows2[3]== 'TIDAK' && $rows2[4]== 'TIDAK'){
                                          echo 'TIDAK DISARANKAN';
                                      }
                                      else {
                                        echo "BELUM SELESAI TEST/INPUT HASIL STAFF";
                                      }
                                } else 
                                {
                                    echo  $hasil_test;
                                }
                                ?> 
                            </td>


                            <?php 
                            if ($r2['status']=="START" || $r2['status']=="SOAL A") 
                            { 
                            ?>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>
                                    <?php 
                                        if ($status_soal=='START') {
                                    ?>
                                        <input type="submit" onclick="dihapus('<?php echo $tglawal ?>','<?php echo $tglakir?>','<?php echo $r2['no_calon_kary']?>')" id="dihapus" name="dihapus" value="HAPUS">
                                    <?php
                                        }
                                    ?>
                                </td>
                            <?php 
                            }
                            if ($r2['status']=="START B" || $r2['status']=="SOAL B") 
                            { 
                            ?>
                                <td align="center">BENAR = <?php echo  $r[0]; ?> 
                                <br>
                                SALAH = <?php $jum_soal=60;
                                $salah = $jum_soal - $r[0]; 
                                echo $salah ?>
                                <br>
                                <a data-fancybox-href="pages/laporan_psikotest/laporan_psikotest_detail_logika.php?id_calon_karyawan=<?php echo  $r2['no_calon_kary'];?>" href="javascript:;" class="fancybox-effects-b"><input type="submit" name="detail" value="detail"></a>
                                </td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>

                            <?php 
                            }
                            if ($r2['status']=="START C" || $r2['status']=="SOAL C") 
                            { 
                            ?>
                                <td align="center">BENAR = <?php echo  $r[0]; ?> 
                                <br>
                                SALAH = <?php $jum_soal=60;
                                $salah = $jum_soal - $r[0]; 
                                echo $salah ?>
                                <br>
                                <a data-fancybox-href="pages/laporan_psikotest/laporan_psikotest_detail_logika.php?id_calon_karyawan=<?php echo  $r2['no_calon_kary'];?>" href="javascript:;" class="fancybox-effects-b"><input type="submit" name="detail" value="detail"></a>
                                </td>
                                <td> 
                                    <table class="altrowstable" id="alternatecolor" style="text-align: center;">
                                        <thead>
                                            <th width="25%">DISC</th>
                                            <th width="25%">M</th>
                                            <th width="25%">L</th>
                                            <th width="25%">DIFERENCE</th>
                                        </thead>
                                        <?php
                                        $sql_discn = mysql_query("
                                        SELECT a.*,m-l difference FROM (

                                        SELECT 'D' disc,
                                        SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='M') THEN 1 ELSE 0 END) M,
                                        SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) L
                                        FROM psikotest_proses_test_b a LEFT OUTER JOIN
                                        (SELECT * FROM spek_jawaban_b WHERE disc = 'D') b ON a.soalno=b.soalke AND a.ml=b.ml
                                        WHERE a.no_calon_kary = '$r2[no_calon_kary]' AND a.kode_unik = '$r2[kode_unik]'
                                        UNION ALL
                                        SELECT 'I',
                                        SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='M') THEN 1 ELSE 0 END) M,
                                        SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) L
                                        FROM psikotest_proses_test_b a LEFT OUTER JOIN
                                        (SELECT * FROM spek_jawaban_b WHERE disc = 'I') b ON a.soalno=b.soalke AND a.ml=b.ml
                                        WHERE a.no_calon_kary = '$r2[no_calon_kary]' AND a.kode_unik = '$r2[kode_unik]'
                                        UNION ALL
                                        SELECT 'S',
                                        SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='M') THEN 1 ELSE 0 END) M,
                                        SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) L
                                        FROM psikotest_proses_test_b a LEFT OUTER JOIN
                                        (SELECT * FROM spek_jawaban_b WHERE disc = 'S') b ON a.soalno=b.soalke AND a.ml=b.ml
                                        WHERE a.no_calon_kary = '$r2[no_calon_kary]' AND a.kode_unik = '$r2[kode_unik]'
                                        UNION ALL
                                        SELECT 'C',
                                        SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='M') THEN 1 ELSE 0 END) M,
                                        SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) L
                                        FROM psikotest_proses_test_b a LEFT OUTER JOIN
                                        (SELECT * FROM spek_jawaban_b WHERE disc = 'C') b ON a.soalno=b.soalke AND a.ml=b.ml
                                        WHERE a.no_calon_kary = '$r2[no_calon_kary]' AND a.kode_unik = '$r2[kode_unik]'
                                        UNION ALL
                                        SELECT 'N',
                                        SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='M') THEN 1 ELSE 0 END) M,
                                        SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) L
                                        FROM psikotest_proses_test_b a LEFT OUTER JOIN
                                        (SELECT * FROM spek_jawaban_b WHERE disc = 'N') b ON a.soalno=b.soalke AND a.ml=b.ml
                                        WHERE a.no_calon_kary = '$r2[no_calon_kary]' AND a.kode_unik = '$r2[kode_unik]'
                                        ) A
                                        ");
                                        while ($r_discn = mysql_fetch_array($sql_discn)) {

                                        ?>
                                        <tbody>
                                            <tr>
                                                <td style="font-weight: bold;"><?php echo $r_discn[0]; ?></td>
                                                <td><?php echo $r_discn[1]; ?></td>
                                                <td><?php echo $r_discn[2]; ?></td>
                                                <td><?php echo $r_discn[3]; ?></td>
                                            </tr>
                                        <?php

                                        $M += $r_discn[1];
                                        $L += $r_discn[2];
                                        $DIF += $r_discn[3];

                                        }
                                        ?>
                                            <tr>
                                                <td>SUM</td>
                                                <td><?php echo $M ?></td>
                                                <td><?php echo $L ?></td>
                                                <td><?php echo $DIF ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>

                            <?php 
                            }
                            if ($r2['status']=="START D" || $r2['status']=="SOAL D")
                            { 
                            ?>
                                <td align="center">BENAR = <?php echo  $r[0]; ?> 
                                <br>
                                SALAH = <?php $jum_soal=60;
                                $salah = $jum_soal - $r[0]; 
                                echo $salah ?>
                                <br>
                                <a data-fancybox-href="pages/laporan_psikotest/laporan_psikotest_detail_logika.php?id_calon_karyawan=<?php echo  $r2['no_calon_kary'];?>" href="javascript:;" class="fancybox-effects-b"><input type="submit" name="detail" value="detail"></a>
                                </td>
                                <td> 
                                    <table class="altrowstable" id="alternatecolor" style="text-align: center;">
                                        <thead>
                                            <th width="25%">PCT</th>
                                            <th width="25%">M</th>
                                            <th width="25%">L</th>
                                            <th width="25%">DIFERENCE</th>
                                        </thead>
                                        <?php
                                        $sql_discn = mysql_query("
                                        SELECT a.*,m-l difference FROM (

                                        SELECT 'D' disc,
                                        SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='M') THEN 1 ELSE 0 END) M,
                                        SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) L
                                        FROM psikotest_proses_test_b a LEFT OUTER JOIN
                                        (SELECT * FROM spek_jawaban_b WHERE disc = 'D') b ON a.soalno=b.soalke AND a.ml=b.ml
                                        WHERE a.no_calon_kary = '$r2[no_calon_kary]' AND a.kode_unik = '$r2[kode_unik]'
                                        UNION ALL
                                        SELECT 'I',
                                        SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='M') THEN 1 ELSE 0 END) M,
                                        SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) L
                                        FROM psikotest_proses_test_b a LEFT OUTER JOIN
                                        (SELECT * FROM spek_jawaban_b WHERE disc = 'I') b ON a.soalno=b.soalke AND a.ml=b.ml
                                        WHERE a.no_calon_kary = '$r2[no_calon_kary]' AND a.kode_unik = '$r2[kode_unik]'
                                        UNION ALL
                                        SELECT 'S',
                                        SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='M') THEN 1 ELSE 0 END) M,
                                        SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) L
                                        FROM psikotest_proses_test_b a LEFT OUTER JOIN
                                        (SELECT * FROM spek_jawaban_b WHERE disc = 'S') b ON a.soalno=b.soalke AND a.ml=b.ml
                                        WHERE a.no_calon_kary = '$r2[no_calon_kary]' AND a.kode_unik = '$r2[kode_unik]'
                                        UNION ALL
                                        SELECT 'C',
                                        SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='M') THEN 1 ELSE 0 END) M,
                                        SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) L
                                        FROM psikotest_proses_test_b a LEFT OUTER JOIN
                                        (SELECT * FROM spek_jawaban_b WHERE disc = 'C') b ON a.soalno=b.soalke AND a.ml=b.ml
                                        WHERE a.no_calon_kary = '$r2[no_calon_kary]' AND a.kode_unik = '$r2[kode_unik]'
                                        UNION ALL
                                        SELECT 'N',
                                        SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='M') THEN 1 ELSE 0 END) M,
                                        SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) L
                                        FROM psikotest_proses_test_b a LEFT OUTER JOIN
                                        (SELECT * FROM spek_jawaban_b WHERE disc = 'N') b ON a.soalno=b.soalke AND a.ml=b.ml
                                        WHERE a.no_calon_kary = '$r2[no_calon_kary]' AND a.kode_unik = '$r2[kode_unik]'
                                        ) A
                                        ");

                                        
                                        while ($r_discn = mysql_fetch_array($sql_discn)) {

                                        ?>
                                        <tbody>
                                            <tr>
                                                <td style="font-weight: bold;"><?php echo $r_discn[0]; ?></td>
                                                <td><?php echo $r_discn[1]; ?></td>
                                                <td><?php echo $r_discn[2]; ?></td>
                                                <td><?php echo $r_discn[3]; ?></td>
                                            </tr>
                                        <?php

                                        $M += $r_discn[1];
                                        $L += $r_discn[2];
                                        $DIF += $r_discn[3];

                                        }
                                        ?>
                                            <tr>
                                                <td>SUM</td>
                                                <td><?php echo $M ?></td>
                                                <td><?php echo $L ?></td>
                                                <td><?php echo $DIF ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td> 
                                    <table class="altrowstable" id="alternatecolor" style="text-align: center;">

                                        <?php
                                        $sql_behavior = mysql_query("
                                        SELECT a.no_calon_kary,
                                        SUM(CASE WHEN b.nilai = 'G' THEN 1 ELSE 0 END) G,
                                        SUM(CASE WHEN b.nilai = 'L' THEN 1 ELSE 0 END) L,
                                        SUM(CASE WHEN b.nilai = 'I' THEN 1 ELSE 0 END) I,
                                        SUM(CASE WHEN b.nilai = 'T' THEN 1 ELSE 0 END) T,
                                        SUM(CASE WHEN b.nilai = 'V' THEN 1 ELSE 0 END) V,
                                        SUM(CASE WHEN b.nilai = 'S' THEN 1 ELSE 0 END) S,
                                        SUM(CASE WHEN b.nilai = 'R' THEN 1 ELSE 0 END) R,
                                        SUM(CASE WHEN b.nilai = 'D' THEN 1 ELSE 0 END) D,
                                        SUM(CASE WHEN b.nilai = 'C' THEN 1 ELSE 0 END) C,
                                        SUM(CASE WHEN b.nilai = 'E' THEN 1 ELSE 0 END) E,
                                        SUM(CASE WHEN b.nilai = 'N' THEN 1 ELSE 0 END) N,
                                        SUM(CASE WHEN b.nilai = 'A' THEN 1 ELSE 0 END) A,
                                        SUM(CASE WHEN b.nilai = 'P' THEN 1 ELSE 0 END) P,
                                        SUM(CASE WHEN b.nilai = 'X' THEN 1 ELSE 0 END) X,
                                        SUM(CASE WHEN b.nilai = 'B' THEN 1 ELSE 0 END) B,
                                        SUM(CASE WHEN b.nilai = 'O' THEN 1 ELSE 0 END) O,
                                        SUM(CASE WHEN b.nilai = 'Z' THEN 1 ELSE 0 END) Z,
                                        SUM(CASE WHEN b.nilai = 'K' THEN 1 ELSE 0 END) K,
                                        SUM(CASE WHEN b.nilai = 'F' THEN 1 ELSE 0 END) F,
                                        SUM(CASE WHEN b.nilai = 'W' THEN 1 ELSE 0 END) W
                                         FROM psikotest_proses_test_c a,spek_jawaban_c b
                                        WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
                                        no_calon_kary = '$r2[no_calon_kary]' AND kode_unik='$r2[kode_unik]'
                                        ");
                                        while ($r_behavior = mysql_fetch_array($sql_behavior)) {

                                        ?>
                                        <thead>
                                            <tr>
                                                <th>G</th>
                                                <th>L</th>
                                                <th>I</th>
                                                <th>T</th>
                                                <th>V</th>
                                                <th>S</th>
                                                <th>R</th>
                                                <th>D</th>
                                                <th>C</th>
                                                <th>E</th>
                                            </tr>
                                            <tr>
                                                <td><?php echo $r_behavior[1]; ?></td>
                                                <td><?php echo $r_behavior[2]; ?></td>
                                                <td><?php echo $r_behavior[3]; ?></td>
                                                <td><?php echo $r_behavior[4]; ?></td>
                                                <td><?php echo $r_behavior[5]; ?></td>
                                                <td><?php echo $r_behavior[6]; ?></td>
                                                <td><?php echo $r_behavior[7]; ?></td>
                                                <td><?php echo $r_behavior[8]; ?></td>
                                                <td><?php echo $r_behavior[9]; ?></td>
                                                <td><?php echo $r_behavior[10]; ?></td>
                                            </tr>
                                            <tr>
                                                <th style="border: 0">&nbsp</th>
                                            </tr>
                                            <tr>
                                                <th>N</th>
                                                <th>A</th>
                                                <th>P</th>
                                                <th>X</th>
                                                <th>B</th>
                                                <th>O</th>
                                                <th>Z</th>
                                                <th>K</th>
                                                <th>F</th>
                                                <th>W</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $r_behavior[11]; ?></td>
                                                <td><?php echo $r_behavior[12]; ?></td>
                                                <td><?php echo $r_behavior[13]; ?></td>
                                                <td><?php echo $r_behavior[14]; ?></td>
                                                <td><?php echo $r_behavior[15]; ?></td>
                                                <td><?php echo $r_behavior[16]; ?></td>
                                                <td><?php echo $r_behavior[17]; ?></td>
                                                <td><?php echo $r_behavior[18]; ?></td>
                                                <td><?php echo $r_behavior[19]; ?></td>
                                                <td><?php echo $r_behavior[20]; ?></td>
                                            </tr>
                                        <?php

                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </td>
                                <td>-</td>
                                <td>-</td>
                            <?php
                            }
                            if($r2['status']=="FINISH")
                            {
                            ?>
                                <td align="center">BENAR = <?php echo  $r[0]; ?> 
                                    <br>
                                    SALAH = <?php $jum_soal=60;
                                    $salah = $jum_soal - $r[0]; 
                                    echo $salah ?>
                                    <br>
                                    <a data-fancybox-href="pages/laporan_psikotest/laporan_psikotest_detail_logika.php?id_calon_karyawan=<?php echo  $r2['no_calon_kary'];?>" href="javascript:;" class="fancybox-effects-b"><input type="submit" name="detail" value="detail"></a>
                                </td>
                                <td> 
                                    <table class="altrowstable" id="alternatecolor" style="text-align: center;">
                                        <thead>
                                            <th width="25%">PCT</th>
                                            <th width="25%">M</th>
                                            <th width="25%">L</th>
                                            <th width="25%">DIFERENCE</th>
                                        </thead>
                                        <?php
                                        $sql_discn = mysql_query("
                                        SELECT a.*,m-l difference FROM (

                                        SELECT 'D' disc,
                                        SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='M') THEN 1 ELSE 0 END) M,
                                        SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) L
                                        FROM psikotest_proses_test_b a LEFT OUTER JOIN
                                        (SELECT * FROM spek_jawaban_b WHERE disc = 'D') b ON a.soalno=b.soalke AND a.ml=b.ml
                                        WHERE a.no_calon_kary = '$r2[no_calon_kary]' AND a.kode_unik = '$r2[kode_unik]'
                                        UNION ALL
                                        SELECT 'I',
                                        SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='M') THEN 1 ELSE 0 END) M,
                                        SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) L
                                        FROM psikotest_proses_test_b a LEFT OUTER JOIN
                                        (SELECT * FROM spek_jawaban_b WHERE disc = 'I') b ON a.soalno=b.soalke AND a.ml=b.ml
                                        WHERE a.no_calon_kary = '$r2[no_calon_kary]' AND a.kode_unik = '$r2[kode_unik]'
                                        UNION ALL
                                        SELECT 'S',
                                        SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='M') THEN 1 ELSE 0 END) M,
                                        SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) L
                                        FROM psikotest_proses_test_b a LEFT OUTER JOIN
                                        (SELECT * FROM spek_jawaban_b WHERE disc = 'S') b ON a.soalno=b.soalke AND a.ml=b.ml
                                        WHERE a.no_calon_kary = '$r2[no_calon_kary]' AND a.kode_unik = '$r2[kode_unik]'
                                        UNION ALL
                                        SELECT 'C',
                                        SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='M') THEN 1 ELSE 0 END) M,
                                        SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) L
                                        FROM psikotest_proses_test_b a LEFT OUTER JOIN
                                        (SELECT * FROM spek_jawaban_b WHERE disc = 'C') b ON a.soalno=b.soalke AND a.ml=b.ml
                                        WHERE a.no_calon_kary = '$r2[no_calon_kary]' AND a.kode_unik = '$r2[kode_unik]'
                                        UNION ALL
                                        SELECT 'N',
                                        SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='M') THEN 1 ELSE 0 END) M,
                                        SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) L
                                        FROM psikotest_proses_test_b a LEFT OUTER JOIN
                                        (SELECT * FROM spek_jawaban_b WHERE disc = 'N') b ON a.soalno=b.soalke AND a.ml=b.ml
                                        WHERE a.no_calon_kary = '$r2[no_calon_kary]' AND a.kode_unik = '$r2[kode_unik]'
                                        ) A
                                        ");
                                        while ($r_discn = mysql_fetch_array($sql_discn)) {

                                        ?>
                                        <tbody>
                                            <tr>
                                                <td style="font-weight: bold;"><?php echo $r_discn[0]; ?></td>
                                                <td><?php echo $r_discn[1]; ?></td>
                                                <td><?php echo $r_discn[2]; ?></td>
                                                <td><?php echo $r_discn[3]; ?></td>
                                            </tr>
                                        <?php

                                        $M += $r_discn[1];
                                        $L += $r_discn[2];
                                        $DIF += $r_discn[3];

                                        }
                                        ?>
                                            <tr>
                                                <td>SUM</td>
                                                <td><?php echo $M ?></td>
                                                <td><?php echo $L ?></td>
                                                <td><?php echo $DIF ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td> 
                                    <table class="altrowstable" id="alternatecolor" style="text-align: center;">

                                        <?php
                                        $sql_behavior = mysql_query("
                                        SELECT a.no_calon_kary,
                                        SUM(CASE WHEN b.nilai = 'G' THEN 1 ELSE 0 END) G,
                                        SUM(CASE WHEN b.nilai = 'L' THEN 1 ELSE 0 END) L,
                                        SUM(CASE WHEN b.nilai = 'I' THEN 1 ELSE 0 END) I,
                                        SUM(CASE WHEN b.nilai = 'T' THEN 1 ELSE 0 END) T,
                                        SUM(CASE WHEN b.nilai = 'V' THEN 1 ELSE 0 END) V,
                                        SUM(CASE WHEN b.nilai = 'S' THEN 1 ELSE 0 END) S,
                                        SUM(CASE WHEN b.nilai = 'R' THEN 1 ELSE 0 END) R,
                                        SUM(CASE WHEN b.nilai = 'D' THEN 1 ELSE 0 END) D,
                                        SUM(CASE WHEN b.nilai = 'C' THEN 1 ELSE 0 END) C,
                                        SUM(CASE WHEN b.nilai = 'E' THEN 1 ELSE 0 END) E,
                                        SUM(CASE WHEN b.nilai = 'N' THEN 1 ELSE 0 END) N,
                                        SUM(CASE WHEN b.nilai = 'A' THEN 1 ELSE 0 END) A,
                                        SUM(CASE WHEN b.nilai = 'P' THEN 1 ELSE 0 END) P,
                                        SUM(CASE WHEN b.nilai = 'X' THEN 1 ELSE 0 END) X,
                                        SUM(CASE WHEN b.nilai = 'B' THEN 1 ELSE 0 END) B,
                                        SUM(CASE WHEN b.nilai = 'O' THEN 1 ELSE 0 END) O,
                                        SUM(CASE WHEN b.nilai = 'Z' THEN 1 ELSE 0 END) Z,
                                        SUM(CASE WHEN b.nilai = 'K' THEN 1 ELSE 0 END) K,
                                        SUM(CASE WHEN b.nilai = 'F' THEN 1 ELSE 0 END) F,
                                        SUM(CASE WHEN b.nilai = 'W' THEN 1 ELSE 0 END) W
                                         FROM psikotest_proses_test_c a,spek_jawaban_c b
                                        WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
                                        no_calon_kary = '$r2[no_calon_kary]' AND kode_unik='$r2[kode_unik]'
                                        ");
                                        while ($r_behavior = mysql_fetch_array($sql_behavior)) {

                                        ?>
                                        <thead>
                                            <tr>
                                                <th>G</th>
                                                <th>L</th>
                                                <th>I</th>
                                                <th>T</th>
                                                <th>V</th>
                                                <th>S</th>
                                                <th>R</th>
                                                <th>D</th>
                                                <th>C</th>
                                                <th>E</th>
                                            </tr>
                                            <tr>
                                                <td><?php echo $r_behavior[1]; ?></td>
                                                <td><?php echo $r_behavior[2]; ?></td>
                                                <td><?php echo $r_behavior[3]; ?></td>
                                                <td><?php echo $r_behavior[4]; ?></td>
                                                <td><?php echo $r_behavior[5]; ?></td>
                                                <td><?php echo $r_behavior[6]; ?></td>
                                                <td><?php echo $r_behavior[7]; ?></td>
                                                <td><?php echo $r_behavior[8]; ?></td>
                                                <td><?php echo $r_behavior[9]; ?></td>
                                                <td><?php echo $r_behavior[10]; ?></td>
                                            </tr>
                                            <tr>
                                                <th style="border: 0">&nbsp</th>
                                            </tr>
                                            <tr>
                                                <th>N</th>
                                                <th>A</th>
                                                <th>P</th>
                                                <th>X</th>
                                                <th>B</th>
                                                <th>O</th>
                                                <th>Z</th>
                                                <th>K</th>
                                                <th>F</th>
                                                <th>W</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $r_behavior[11]; ?></td>
                                                <td><?php echo $r_behavior[12]; ?></td>
                                                <td><?php echo $r_behavior[13]; ?></td>
                                                <td><?php echo $r_behavior[14]; ?></td>
                                                <td><?php echo $r_behavior[15]; ?></td>
                                                <td><?php echo $r_behavior[16]; ?></td>
                                                <td><?php echo $r_behavior[17]; ?></td>
                                                <td><?php echo $r_behavior[18]; ?></td>
                                                <td><?php echo $r_behavior[19]; ?></td>
                                                <td><?php echo $r_behavior[20]; ?></td>
                                            </tr>
                                        <?php

                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </td>
                                <td> 
                                    <table class="altrowstable" id="alternatecolor" style="width: 100%; text-align: center;" width="">
                                        <thead>
                                            <th>PL</th>
                                            <th>CH</th>
                                            <th>ME</th>
                                            <th>CW</th>
                                            <th>CF</th>
                                            <th>RI</th>
                                            <th>SH</th>
                                            <th>TW</th>
                                        </thead>
                                        <?php
                                        $sql_teamwork = mysql_query("
                                        SELECT no_calon_kary,
                                        SUM(CASE WHEN b.kategori='PL' THEN a.jawaban ELSE 0 END) PL,
                                        SUM(CASE WHEN b.kategori='CH' THEN a.jawaban ELSE 0 END) CH,
                                        SUM(CASE WHEN b.kategori='ME' THEN a.jawaban ELSE 0 END) ME,
                                        SUM(CASE WHEN b.kategori='CW' THEN a.jawaban ELSE 0 END) CW,
                                        SUM(CASE WHEN b.kategori='CF' THEN a.jawaban ELSE 0 END) CF,
                                        SUM(CASE WHEN b.kategori='RI' THEN a.jawaban ELSE 0 END) RI,
                                        SUM(CASE WHEN b.kategori='SH' THEN a.jawaban ELSE 0 END) SH,
                                        SUM(CASE WHEN b.kategori='TW' THEN a.jawaban ELSE 0 END) TW
                                        FROM psikotest_proses_test_d a, spek_jawaban_d b WHERE
                                        a.bagiantest=b.bagianke AND a.soalno=b.soalke AND a.no_calon_kary = '$r2[no_calon_kary]' AND a.kode_unik = '$r2[kode_unik]'
                                        ");
                                        while ($r_teamwork = mysql_fetch_array($sql_teamwork)) {

                                        ?>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $r_teamwork[1]; ?></td>
                                                <td><?php echo $r_teamwork[2]; ?></td>
                                                <td><?php echo $r_teamwork[3]; ?></td>
                                                <td><?php echo $r_teamwork[4]; ?></td>
                                                <td><?php echo $r_teamwork[5]; ?></td>
                                                <td><?php echo $r_teamwork[6]; ?></td>
                                                <td><?php echo $r_teamwork[7]; ?></td>
                                                <td><?php echo $r_teamwork[8]; ?></td>
                                            </tr>
                                        <?php

                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </td>

                                <?php   
                                if  ($r2['datapb'] == 'approve1setengah')  
                                {
                                ?>

                                <td align="center">
                                    <div>
                                        <?php if ($r2['divisi'] == STAFF) { ?>
                                        <a data-fancybox-href="pages/laporan_psikotest/hasilakhir_psikotest_staff.php?id_calon_karyawan=<?php echo  $r2['no_calon_kary'];?>" href="javascript:;" class="fancybox-effects-b"><input type="submit" name="hasil" value="HASIL">
                                        </a>
                                        <?php } ?>

                                        <?php if($r2['divisi'] == SPV) { ?>
                                        <a data-fancybox-href="pages/laporan_psikotest/hasilakhir_psikotest.php?id_calon_karyawan=<?php echo  $r2['no_calon_kary'];?>" href="javascript:;" class="fancybox-effects-b"><input type="submit" name="hasil" value="HASIL">
                                        </a>
                                        <?php } ?>
                                    </div>

                                    <?php if ($status_id=="ADMIN") { ?>
                                    <div>&nbsp</div>
                                    <div><!-- 
                                        <form onsubmit="return confirm('Yakin Ingin Approve?');" action="pages/laporan_psikotest/approve2.php" method="post">
                                        <a class="button"><input type="submit" onclick="save_hal2()" id="approve" name="approve" value="APPROVE"></a> 
                                        </form> -->
                                        
                                        <a class="button"><input type="submit" onclick="save_hal1('<?php echo $tglawal ?>','<?php echo $tglakir?>','<?php echo $r2['no_calon_kary']?>')" id="approve" name="approve" value="APPROVE"></a> 
                                    </div>
                                    <?php
                                    }
                                    ?>

                                </td>

                                <?php
                                } 
                                else  { 
                                ?>
                                <td align="center">
                                    <div>
                                        <?php if ($r2['divisi'] == STAFF) { ?>
                                        <a data-fancybox-href="pages/laporan_psikotest/hasilakhir_psikotest_staff.php?id_calon_karyawan=<?php echo  $r2['no_calon_kary'];?>" href="javascript:;" class="fancybox-effects-b"><input type="submit" name="hasil" value="HASIL">
                                        </a>
                                        <?php } ?>

                                        <?php if($r2['divisi'] == SPV) { ?>
                                        <a data-fancybox-href="pages/laporan_psikotest/hasilakhir_psikotest.php?id_calon_karyawan=<?php echo  $r2['no_calon_kary'];?>" href="javascript:;" class="fancybox-effects-b"><input type="submit" name="hasil" value="HASIL">
                                        </a>
                                        <?php } ?>
                                    </div>

                                </td>
                                <?php 
                                } //tutup else
                                ?>
                            <?php 
                            } // tutup if = finish
                            ?>
                        </tr>
                    <?php
                    $no++;
                    } // tutup while paling atas
                    ?>
                </tbody>
            </table> 

</div>
