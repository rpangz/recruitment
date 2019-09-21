<?php
include('../../koneksi.php');
?>
<!-- 
        <link href="../../../assets/template/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../assets/css/main.css" /> -->

<script type="text/javascript" src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
  <script type="text/javascript">
      $(function() {
      var buttons     = $('#btn_3');
      var printStyle  = $('#print');
      var style;

      buttons.click(function() {
        style = 'div { color: ' + $(this).attr('class') + '};';
        printStyle.text(style);
        window.print();
      });
    });

function SimpanJawaban(id_calon_karyawan,subaspek,inisialsubaspek,aspek,jawaban)
{
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("tempdiv").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","simpan_hasilakhir_psikotest.php?id_calon_karyawan="+id_calon_karyawan+"&subaspek="+subaspek+"&inisialsubaspek="+inisialsubaspek+"&aspek="+aspek+"&jawaban="+jawaban,true);
xmlhttp.send();
}


function simpan_select()
{
var id_ck = document.getElementById("id_ck").value;
var keterangan_hasil = document.getElementById("keterangan_hasil").value;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      var peringatan = xmlhttp.responseText;
      var replaced = peringatan.replace(/\s/g, '');
      document.getElementById("tempdiv").innerHTML=xmlhttp.responseText;
      alert (replaced);
    }
  }
xmlhttp.open("GET","simpan_keteranganhasilakhir.php?id_calon_karyawan="+id_ck+"&keterangan_hasil="+keterangan_hasil,true);
xmlhttp.send();
}

  </script>

<style type="text/css">
  input[type="radio"] {
    -webkit-appearance: checkbox;
    -moz-appearance: checkbox;
    -ms-appearance: checkbox;     /* not currently supported */
    -o-appearance: checkbox;      /* not currently supported */
}
/*input[type='radio']:before {
  content:'';
  display:block;
  width:60%;
  height:60%;
  margin: 20% auto;    
  border-radius:50%;    
}
input[type='radio']:checked:before {
  background:green;
}*/
  .fancybox-wrap { 
    top: 40px !important; 
    left: 10px !important; 
  }
  th{text-align: left;
    padding-left: 8px;
  }
  .printttd{
    display: none;
  }
  @page {
    size: A4;
    margin: 0;
  }

  @media print {
      button {
        display: none;
      }
.print:last-child {
     page-break-after: auto;
}
    html, body {
        height: 99%;    
    }
  .printttd{
    display: block;
   }
      #btn_3 {
        display: none;
      }
      div,td,th {
      font-family: Arial Black; 
     font-size: 9pt;
      }
    a[href]:after {
      content: none !important;
    }
    }
    @media screen {
      .red {
        color: black;
      }
      .green {
        color: green;
      }
    }
  </style>

<style type="text/css" media="print" id="print">
  .fancybox-wrap { 
    top: 40px !important; 
    left: 10px !important; 
  }
  th{text-align: left;
    padding-left: 8px;
  }
  .printttd{
    display: none;
  }
  @page {
    size: A4;
    margin: 0;
  }

  @media print {
      button {
        display: none;
      }
  html, body {
    width: 210mm;
    height: 297mm;
  }
  .printttd{
    display: block;
   }
      #btn_3 {
        display: none;
      }
      div,td,th {
      font-family: Arial Black; 
     font-size: 9pt;
      }
    a[href]:after {
      content: none !important;
    }
    }
    @media screen {
      .red {
        color: black;
      }
      .green {
        color: green;
      }
    }
  </style>
<div style="padding-left: 25px; padding-bottom: 25px; padding-top: 25px;">

<?php
$id_calon_karyawan = $_GET['id_calon_karyawan'];
/*SELECT a.* FROM datapribadi_ck a,psikotest_data_kary b where id_calon_karyawan='$id_calon_karyawan*/
        
  $sql = mysql_query("SELECT * FROM (
SELECT * FROM datapribadi_ck a
left join
(select no_calon_kary, end_d from psikotest_data_kary p)b on a.id_calon_karyawan=b.no_calon_kary where b.no_calon_kary='$id_calon_karyawan'
) a;");
   $rows = mysql_fetch_array($sql);
    $kodecbg = $rows[kodecbg];
    $hasil_test = $rows[hasil_test];
    $status = $rows[status];

    $hris = mysql_query("SELECT nama FROM (SELECT * FROM
(SELECT kodecbg,nama,'KONVEN' pt FROM hris.cabang_konven c WHERE status = '+' UNION ALL
SELECT CONCAT('TP',kodecbg),CONCAT('TOP ',nama),'TOP' pt FROM hris.cabang_top c WHERE status = '+' AND kodecbg NOT LIKE 'A%') a
ORDER BY pt,nama)A where kodecbg='$kodecbg'");
    $hris_cbg = mysql_fetch_array($hris);
?>

<div align="center" style="font-weight: bold; font-size: 20">HASIL PEMERIKSAAN PSIKOTEST</div>
<table border="1" style="border-style: groove; border-width: 1px; border-collapse: collapse;" align="center" width="500px">
<br>
  <tr>
    <th>ID CALON KARYAWAN</th>
    <th><?php echo $id_calon_karyawan ?></th>
  </tr>
  <tr>
    <th>NAMA CALON KARYAWAN</th>
    <th><?php echo $rows[nama_lengkap] ?></th>
  </tr>
  <tr>
    <th>JABATAN</th>
    <th><?php echo $rows[bagian] ?></th>
  </tr>
  <tr>
    <th>TANGGAL LAHIR</th>
    <th><?php echo date('d-m-Y',strtotime($rows[tanggal_lahir])) ?></th>
  </tr>
  <tr>
    <th>TANGGAL TEST</th>
    <th><?php echo date('d-m-Y',strtotime($rows[end_d]) ) ?></th>
  </tr>

  <tr>
    <th>CABANG</th>
    <th><?php echo $kodecbg."-".$hris_cbg[nama]?>
    </th>
  </tr>
</table>

<form onsubmit="return confirm('Yakin Ingin Simpan?');" action="simpan_hasilakhir_semuanya.php" method="post">
<input type="hidden" name="id_calon_karyawan" value="<?php echo  $id_calon_karyawan;?>">

<?php
  $rksbt = mysql_query("SELECT b.aspek,b.kompetensi,b.keterangan hasil FROM (
SELECT 'IQ' alat_tes,sum(nilai) nilai from (SELECT b.no_calon_kary,a.soalke,c.jawaban,
CASE WHEN (c.jawaban IS NULL OR c.jawaban<>a.jawabreal) THEN 0 ELSE 1 END nilai,
CASE WHEN (c.jawaban IS NULL OR c.jawaban<>a.jawabreal) THEN 'SALAH' ELSE 'BENAR' END keterangan
FROM (psikotest_a_soal a,psikotest_data_kary b)
LEFT OUTER JOIN
(SELECT * FROM psikotest_proses_test WHERE no_calon_kary = '$id_calon_karyawan') c
ON a.soalke=c.soalno
WHERE b.no_calon_kary = '$id_calon_karyawan')as total) a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'Taraf Kecerdasan' AND a.nilai between b.min AND b.max

union all


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



UNION ALL



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


UNION ALL

SELECT 'JOB PROFILE','PCT' KOMPETENSI,
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
) a, spek_kcb b WHERE a.kombinasi=b.kombinasi");


    ?>



<?php
  $strxx = mysql_query("SELECT subaspek FROM spek_format_hasiltest s GROUP BY subaspek");
    while($row = mysql_fetch_row($strxx))
    {
      $subaspek = $row[0];
      $id_radio = $row[3];
    ?>
<table border="1" style="border-style: groove; border-width: 3px; border-collapse: collapse;" align="center" width="500px">
<br>
<tr>
  <th colspan="6" style="border-width: 2px"><?php echo $subaspek; ?></th>
</tr> 
<tr>
  <th>ASPEK</th>
  <th>R</th>
  <th>K</th>
  <th>S</th>
  <th>B</th>
  <th>T</th>
</tr> 
    <?php
  $strxx2 = mysql_query("
SELECT a.*, b.kompetensi, b.hasil from (
SELECT a.*,left(a.subaspek,1),id_radio FROM spek_format_hasiltest a LEFT OUTER JOIN
                        (SELECT * FROM hasil_psikotest WHERE id_calon_karyawan = '$id_calon_karyawan') b
                        ON a.subaspek=b.subaspek AND a.aspek=b.aspek  WHERE a.subaspek = '$subaspek') a
left join (

SELECT b.aspek,b.kompetensi,b.keterangan hasil FROM (
SELECT 'IQ' alat_tes,sum(nilai) nilai from (SELECT b.no_calon_kary,a.soalke,c.jawaban,
CASE WHEN (c.jawaban IS NULL OR c.jawaban<>a.jawabreal) THEN 0 ELSE 1 END nilai,
CASE WHEN (c.jawaban IS NULL OR c.jawaban<>a.jawabreal) THEN 'SALAH' ELSE 'BENAR' END keterangan
FROM (psikotest_a_soal a,psikotest_data_kary b)
LEFT OUTER JOIN
(SELECT * FROM psikotest_proses_test WHERE no_calon_kary = '$id_calon_karyawan') c
ON a.soalke=c.soalno
WHERE b.no_calon_kary = '$id_calon_karyawan')as total) a, spek_konfigurasi_spv b
WHERE a.alat_tes=b.alat_tes AND b.kompetensi = 'Taraf Kecerdasan' AND a.nilai between b.min AND b.max

union all


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



UNION ALL



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


UNION ALL


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

)b on a.aspek=b.kompetensi
");



    while($row2 = mysql_fetch_row($strxx2))
    { 
      $checkedR = "";
      $checkedK = "";
      $checkedS = "";
      $checkedB = "";
      $checkedT = "";

      $disabledR = "";
      $disabledK = "";
      $disabledS = "";
      $disabledB = "";
      $disabledT = "";

      $pilihR = "";
      $pilihK = "";
      $pilihC = "";
      $pilihB = "";
      $pilihT = "";

      $disabledRR = "";
      $disabledKK = "";
      $disabledSS = "";
      $disabledBB = "";
      $disabledTT = "";


      $no = $row2[2];
      $aspek = $row2[1];
      $subaspek = $row2[0];
      $inisialsubaspek = $row2[3];
      $idradio = $row2[4];
      $hasilauto = $row2[6] ;


      $idnyaR = $inisialsubaspek.$no.'R';
      $idnyaK = $inisialsubaspek.$no.'K';
      $idnyaS = $inisialsubaspek.$no.'S';
      $idnyaB = $inisialsubaspek.$no.'B';
      $idnyaT = $inisialsubaspek.$no.'T';


      $autopilihR = $inisialsubaspek.$no.'R';
      $autopilihK = $inisialsubaspek.$no.'K';
      $autopilihC = $inisialsubaspek.$no.'C';
      $autopilihB = $inisialsubaspek.$no.'B';
      $autopilihT = $inisialsubaspek.$no.'T';


      if($idradio=="" && $autopilihR==$inisialsubaspek.$no.$hasilauto){$pilihR = "checked";}
      if($idradio=="" && $autopilihK==$inisialsubaspek.$no.$hasilauto){$pilihK = "checked";}
      if($idradio=="" && $autopilihC==$inisialsubaspek.$no.$hasilauto){$pilihC = "checked";}
      if($idradio=="" && $autopilihB==$inisialsubaspek.$no.$hasilauto){$pilihB = "checked";}
      if($idradio=="" && $autopilihT==$inisialsubaspek.$no.$hasilauto){$pilihT = "checked";}


      if($idnyaR==$idradio){$checkedR = "checked";}
      if($idnyaK==$idradio){$checkedK = "checked";}
      if($idnyaS==$idradio){$checkedS = "checked";}
      if($idnyaB==$idradio){$checkedB = "checked";}
      if($idnyaT==$idradio){$checkedT = "checked";}


      if($idradio=="" && $hasilauto=='R'){$disabledRR = "";}
      if($idradio=="" && $hasilauto!='K'){$disabledKK = "disabled";}
      if($idradio=="" && $hasilauto!='C'){$disabledSS = "disabled";}
      if($idradio=="" && $hasilauto!='B'){$disabledBB = "disabled";}
      if($idradio=="" && $hasilauto!='T'){$disabledTT = "disabled";}

      if($idradio=="" && $hasilauto!='R'){$disabledRR = "disabled";}
      if($idradio=="" && $hasilauto=='K'){$disabledKK = "";}
      if($idradio=="" && $hasilauto!='C'){$disabledSS = "disabled";}
      if($idradio=="" && $hasilauto!='B'){$disabledBB = "disabled";}
      if($idradio=="" && $hasilauto!='T'){$disabledTT = "disabled";}

      if($idradio=="" && $hasilauto!='R'){$disabledRR = "disabled";}
      if($idradio=="" && $hasilauto!='K'){$disabledKK = "disabled";}
      if($idradio=="" && $hasilauto=='C'){$disabledSS = "";}
      if($idradio=="" && $hasilauto!='B'){$disabledBB = "disabled";}
      if($idradio=="" && $hasilauto!='T'){$disabledTT = "disabled";}

      if($idradio=="" && $hasilauto!='R'){$disabledRR = "disabled";}
      if($idradio=="" && $hasilauto!='K'){$disabledKK = "disabled";}
      if($idradio=="" && $hasilauto!='C'){$disabledSS = "disabled";}
      if($idradio=="" && $hasilauto=='B'){$disabledBB = "";}
      if($idradio=="" && $hasilauto!='T'){$disabledTT = "disabled";}

      if($idradio=="" && $hasilauto!='R'){$disabledRR = "disabled";}
      if($idradio=="" && $hasilauto!='K'){$disabledKK = "disabled";}
      if($idradio=="" && $hasilauto!='C'){$disabledSS = "disabled";}
      if($idradio=="" && $hasilauto!='B'){$disabledBB = "disabled";}
      if($idradio=="" && $hasilauto=='T'){$disabledTT = "";}


      if($idradio!="" && $idnyaR==$idradio){$disabledR = "";}
      if($idradio!="" && $idnyaK!=$idradio){$disabledK = "disabled";}
      if($idradio!="" && $idnyaS!=$idradio){$disabledS = "disabled";}
      if($idradio!="" && $idnyaB!=$idradio){$disabledB = "disabled";}
      if($idradio!="" && $idnyaT!=$idradio){$disabledT = "disabled";}

      if($idradio!="" && $idnyaR!=$idradio){$disabledR = "disabled";}
      if($idradio!="" && $idnyaK==$idradio){$disabledK = "";}
      if($idradio!="" && $idnyaS!=$idradio){$disabledS = "disabled";}
      if($idradio!="" && $idnyaB!=$idradio){$disabledB = "disabled";}
      if($idradio!="" && $idnyaT!=$idradio){$disabledT = "disabled";}

      if($idradio!="" && $idnyaR!=$idradio){$disabledR = "disabled";}
      if($idradio!="" && $idnyaK!=$idradio){$disabledK = "disabled";}
      if($idradio!="" && $idnyaS==$idradio){$disabledS = "";}
      if($idradio!="" && $idnyaB!=$idradio){$disabledB = "disabled";}
      if($idradio!="" && $idnyaT!=$idradio){$disabledT = "disabled";}

      if($idradio!="" && $idnyaR!=$idradio){$disabledR = "disabled";}
      if($idradio!="" && $idnyaK!=$idradio){$disabledK = "disabled";}
      if($idradio!="" && $idnyaS!=$idradio){$disabledS = "disabled";}
      if($idradio!="" && $idnyaB==$idradio){$disabledB = "";}
      if($idradio!="" && $idnyaT!=$idradio){$disabledT = "disabled";}

      if($idradio!="" && $idnyaR!=$idradio){$disabledR = "disabled";}
      if($idradio!="" && $idnyaK!=$idradio){$disabledK = "disabled";}
      if($idradio!="" && $idnyaS!=$idradio){$disabledS = "disabled";}
      if($idradio!="" && $idnyaB!=$idradio){$disabledB = "disabled";}
      if($idradio!="" && $idnyaT==$idradio){$disabledT = "";}


    ?>
<div>    
            <?php
            if ($status == approve2) {
            ?>
            <tr>
              <td><?php echo $aspek; ?></td>
              <td><input type="radio" <?php echo $pilihR;?>  <?php echo $checkedR; ?><?php echo $disabledRR;?> <?php echo $disabledR;?> name="<?php echo $inisialsubaspek.$no; ?>" id="<?php echo $idnyaR; ?>" value="R" onClick="SimpanJawaban('<?php echo $id_calon_karyawan; ?>','<?php echo $subaspek ?>',this.id,'<?php echo $aspek; ?>','R')" ></td>

              <td><input type="radio" <?php echo $pilihK;?>  <?php echo $checkedK; ?><?php echo $disabledKK;?> <?php echo $disabledK; ?> name="<?php echo $inisialsubaspek.$no; ?>" id="<?php echo $idnyaK; ?>" value="K" onClick="SimpanJawaban('<?php echo $id_calon_karyawan; ?>','<?php echo $subaspek ?>',this.id,'<?php echo $aspek; ?>','K')" ></td>

              <td><input type="radio" <?php echo $pilihC;?>  <?php echo $checkedS; ?><?php echo $disabledSS;?> <?php echo $disabledS; ?> name="<?php echo $inisialsubaspek.$no; ?>" id="<?php echo $idnyaS; ?>" value="S" onClick="SimpanJawaban('<?php echo $id_calon_karyawan; ?>','<?php echo $subaspek ?>',this.id,'<?php echo $aspek; ?>','S')" ></td>

              <td><input type="radio" <?php echo $pilihB;?>  <?php echo $checkedB; ?><?php echo $disabledBB;?> <?php echo $disabledB; ?> name="<?php echo $inisialsubaspek.$no; ?>" id="<?php echo $idnyaB; ?>" value="B" onClick="SimpanJawaban('<?php echo $id_calon_karyawan; ?>','<?php echo $subaspek ?>',this.id,'<?php echo $aspek; ?>','B')" ></td>

              <td><input type="radio" <?php echo $pilihT;?>  <?php echo $checkedT; ?><?php echo $disabledTT;?> <?php echo $disabledT; ?> name="<?php echo $inisialsubaspek.$no; ?>" id="<?php echo $idnyaT; ?>" value="T" onClick="SimpanJawaban('<?php echo $id_calon_karyawan; ?>','<?php echo $subaspek ?>',this.id,'<?php echo $aspek; ?>','T')" ></td>
            </tr> 
            <?php 
            }
            else{
            ?>
            <tr>
              <td><?php echo $aspek; ?></td>
              <td><input type="radio" <?php echo $pilihR;?> <?php echo $checkedR; ?> name="<?php echo $inisialsubaspek.$no; ?>" id="<?php echo $idnyaR; ?>" value="R" onClick="SimpanJawaban('<?php echo $id_calon_karyawan; ?>','<?php echo $subaspek ?>',this.id,'<?php echo $aspek; ?>','R')" ></td>
              <td><input type="radio" <?php echo $pilihK;?> <?php echo $checkedK; ?> name="<?php echo $inisialsubaspek.$no; ?>" id="<?php echo $idnyaK; ?>" value="K" onClick="SimpanJawaban('<?php echo $id_calon_karyawan; ?>','<?php echo $subaspek ?>',this.id,'<?php echo $aspek; ?>','K')" ></td>
              <td><input type="radio" <?php echo $pilihC;?> <?php echo $checkedS; ?> name="<?php echo $inisialsubaspek.$no; ?>" id="<?php echo $idnyaS; ?>" value="S" onClick="SimpanJawaban('<?php echo $id_calon_karyawan; ?>','<?php echo $subaspek ?>',this.id,'<?php echo $aspek; ?>','S')" ></td>
              <td><input type="radio" <?php echo $pilihB;?> <?php echo $checkedB; ?> name="<?php echo $inisialsubaspek.$no; ?>" id="<?php echo $idnyaB; ?>" value="B" onClick="SimpanJawaban('<?php echo $id_calon_karyawan; ?>','<?php echo $subaspek ?>',this.id,'<?php echo $aspek; ?>','B')" ></td>
              <td><input type="radio" <?php echo $pilihT;?> <?php echo $checkedT; ?> name="<?php echo $inisialsubaspek.$no; ?>" id="<?php echo $idnyaT; ?>" value="T" onClick="SimpanJawaban('<?php echo $id_calon_karyawan; ?>','<?php echo $subaspek ?>',this.id,'<?php echo $aspek; ?>','T')" ></td>
            </tr> 
            <?php  
            }
            ?>
  <?php 
  } 
  ?>
</div>


<?php } ?>
</table>

<?php
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

<?php 

          $hasilcoyy="";
          //KECERDASAN YA ROW 0
            //SIKAP KERJA YA ROW 1

          if ($rows2[0]== 'YA' && $rows2[1]== 'YA' && $rows2[2]== 'YA' && $rows2[3]== 'YA' && $rows2[4]== 'YA'){
              $hasilcoyy="DISARANKAN";
          }
          elseif ($rows2[0]== 'YA' && $rows2[1]== 'YA' && $rows2[2]== 'YA' && $rows2[3]== 'YA' && $rows2[4]== 'TIDAK'){
              $hasilcoyy="TIDAK DISARANKAN";
          }
          elseif ($rows2[0]== 'YA' && $rows2[1]== 'YA' && $rows2[2]== 'YA' && $rows2[3]== 'TIDAK' && $rows2[4]== 'YA'){
              $hasilcoyy="DIPERTIMBANGKAN";
          }
          elseif ($rows2[0]== 'YA' && $rows2[1]== 'YA' && $rows2[2]== 'YA' && $rows2[3]== 'TIDAK' && $rows2[4]== 'TIDAK'){
              $hasilcoyy="TIDAK DISARANKAN";
          }

          elseif ($rows2[0]== 'YA' && $rows2[1]== 'YA' && $rows2[2]== 'TIDAK' && $rows2[3]== 'YA' && $rows2[4]== 'YA'){
              $hasilcoyy="DIPERTIMBANGKAN DGN CATATAN";
          }
          elseif ($rows2[0]== 'YA' && $rows2[1]== 'YA' && $rows2[2]== 'TIDAK' && $rows2[3]== 'YA' && $rows2[4]== 'TIDAK'){
              $hasilcoyy="TIDAK DISARANKAN";
          }
          elseif ($rows2[0]== 'YA' && $rows2[1]== 'YA' && $rows2[2]== 'TIDAK' && $rows2[3]== 'TIDAK' && $rows2[4]== 'YA'){
              $hasilcoyy="TIDAK DISARANKAN";
          }
          elseif ($rows2[0]== 'YA' && $rows2[1]== 'YA' && $rows2[2]== 'TIDAK' && $rows2[3]== 'TIDAK' && $rows2[4]== 'TIDAK'){
              $hasilcoyy="TIDAK DISARANKAN";
          }

            //SIKAP KERJA TIDAK ROW 1

          elseif ($rows2[0]== 'YA' && $rows2[1]== 'TIDAK' && $rows2[2]== 'YA' && $rows2[3]== 'YA' && $rows2[4]== 'YA'){
              $hasilcoyy="DIPERTIMBANGKAN DGN CATATAN";
          }
          elseif ($rows2[0]== 'YA' && $rows2[1]== 'TIDAK' && $rows2[2]== 'YA' && $rows2[3]== 'YA' && $rows2[4]== 'TIDAK'){
              $hasilcoyy="TIDAK DISARANKAN";
          }
          elseif ($rows2[0]== 'YA' && $rows2[1]== 'TIDAK' && $rows2[2]== 'YA' && $rows2[3]== 'TIDAK' && $rows2[4]== 'YA'){
              $hasilcoyy="DIPERTIMBANGKAN DGN CATATAN";
          }
          elseif ($rows2[0]== 'YA' && $rows2[1]== 'TIDAK' && $rows2[2]== 'YA' && $rows2[3]== 'TIDAK' && $rows2[4]== 'TIDAK'){
              $hasilcoyy="TIDAK DISARANKAN";
          }
          
          elseif ($rows2[0]== 'YA' && $rows2[1]== 'TIDAK' && $rows2[2]== 'TIDAK' && $rows2[3]== 'YA' && $rows2[4]== 'YA'){
              $hasilcoyy="TIDAK DISARANKAN";
          }
          elseif ($rows2[0]== 'YA' && $rows2[1]== 'TIDAK' && $rows2[2]== 'TIDAK' && $rows2[3]== 'YA' && $rows2[4]== 'TIDAK'){
              $hasilcoyy="TIDAK DISARANKAN";
          }
          elseif ($rows2[0]== 'YA' && $rows2[1]== 'TIDAK' && $rows2[2]== 'TIDAK' && $rows2[3]== 'TIDAK' && $rows2[4]== 'YA'){
              $hasilcoyy="TIDAK DISARANKAN";
          }
          elseif ($rows2[0]== 'YA' && $rows2[1]== 'TIDAK' && $rows2[2]== 'TIDAK' && $rows2[3]== 'TIDAK' && $rows2[4]== 'TIDAK'){
              $hasilcoyy="TIDAK DISARANKAN";
          }

          //kecerdasan TIDAK ROW 0
            //SIKAP KERJA YA ROW 1

          elseif ($rows2[0]== 'TIDAK' && $rows2[1]== 'YA' && $rows2[2]== 'YA' && $rows2[3]== 'YA' && $rows2[4]== 'YA'){
              $hasilcoyy="DIPERTIMBANGKAN DGN CATATAN";
          }
          elseif ($rows2[0]== 'TIDAK' && $rows2[1]== 'YA' && $rows2[2]== 'YA' && $rows2[3]== 'YA' && $rows2[4]== 'TIDAK'){
              $hasilcoyy="TIDAK DISARANKAN";
          }
          elseif ($rows2[0]== 'TIDAK' && $rows2[1]== 'YA' && $rows2[2]== 'YA' && $rows2[3]== 'TIDAK' && $rows2[4]== 'YA'){
              $hasilcoyy="DIPERTIMBANGKAN DGN CATATAN";
          }
          elseif ($rows2[0]== 'TIDAK' && $rows2[1]== 'YA' && $rows2[2]== 'YA' && $rows2[3]== 'TIDAK' && $rows2[4]== 'TIDAK'){
              $hasilcoyy="TIDAK DISARANKAN";
          }

          elseif ($rows2[0]== 'TIDAK' && $rows2[1]== 'YA' && $rows2[2]== 'TIDAK' && $rows2[3]== 'YA' && $rows2[4]== 'YA'){
              $hasilcoyy="TIDAK DISARANKAN";
          }
          elseif ($rows2[0]== 'TIDAK' && $rows2[1]== 'YA' && $rows2[2]== 'TIDAK' && $rows2[3]== 'YA' && $rows2[4]== 'TIDAK'){
              $hasilcoyy="TIDAK DISARANKAN";
          }
          elseif ($rows2[0]== 'TIDAK' && $rows2[1]== 'YA' && $rows2[2]== 'TIDAK' && $rows2[3]== 'TIDAK' && $rows2[4]== 'YA'){
              $hasilcoyy="TIDAK DISARANKAN";
          }
          elseif ($rows2[0]== 'TIDAK' && $rows2[1]== 'YA' && $rows2[2]== 'TIDAK' && $rows2[3]== 'TIDAK' && $rows2[4]== 'TIDAK'){
              $hasilcoyy="TIDAK DISARANKAN";
          }

            //SIKAP KERJA TIDAK ROW 1

          elseif ($rows2[0]== 'TIDAK' && $rows2[1]== 'TIDAK' && $rows2[2]== 'YA' && $rows2[3]== 'YA' && $rows2[4]== 'YA'){
              $hasilcoyy="DIPERTIMBANGKAN DGN CATATAN";
          }
          elseif ($rows2[0]== 'TIDAK' && $rows2[1]== 'TIDAK' && $rows2[2]== 'YA' && $rows2[3]== 'YA' && $rows2[4]== 'TIDAK'){
              $hasilcoyy="TIDAK DISARANKAN";
          }
          elseif ($rows2[0]== 'TIDAK' && $rows2[1]== 'TIDAK' && $rows2[2]== 'YA' && $rows2[3]== 'TIDAK' && $rows2[4]== 'YA'){
              $hasilcoyy="TIDAK DISARANKAN";
          }
          elseif ($rows2[0]== 'TIDAK' && $rows2[1]== 'TIDAK' && $rows2[2]== 'YA' && $rows2[3]== 'TIDAK' && $rows2[4]== 'TIDAK'){
              $hasilcoyy="TIDAK DISARANKAN";
          }
          
          elseif ($rows2[0]== 'TIDAK' && $rows2[1]== 'TIDAK' && $rows2[2]== 'TIDAK' && $rows2[3]== 'YA' && $rows2[4]== 'YA'){
              $hasilcoyy="TIDAK DISARANKAN";
          }
          elseif ($rows2[0]== 'TIDAK' && $rows2[1]== 'TIDAK' && $rows2[2]== 'TIDAK' && $rows2[3]== 'YA' && $rows2[4]== 'TIDAK'){
              $hasilcoyy="TIDAK DISARANKAN";
          }
          elseif ($rows2[0]== 'TIDAK' && $rows2[1]== 'TIDAK' && $rows2[2]== 'TIDAK' && $rows2[3]== 'TIDAK' && $rows2[4]== 'YA'){
              $hasilcoyy="TIDAK DISARANKAN";
          }
          elseif ($rows2[0]== 'TIDAK' && $rows2[1]== 'TIDAK' && $rows2[2]== 'TIDAK' && $rows2[3]== 'TIDAK' && $rows2[4]== 'TIDAK'){
              $hasilcoyy="TIDAK DISARANKAN";
          }
          else {
            echo "ADA YANG SALAH";
          }
?>

<table align="center" width="500px">
  <tr style="border:0;">
    <td style="border:0;">
    Ket; R :Rendah, K :Kurang, S :Standard, B :Baik, T :Tinggi
    </td>
  </tr>
</table>
<table align="center" width="500px">
<br>
  <tr style="border:0;">
    <td style="border:0;">
    <input type="hidden" name="" id="id_ck" value="<?php echo $id_calon_karyawan ?>">
    Keterangan Hasil <select <?php if ($status=="approve2") { echo ' disabled="disabled"'; }?> name="keterangan_hasil" class = "form-control" id="keterangan_hasil" style="text-transform:uppercase" 
    onchange="simpan_select()">
<option value="<?php echo $hasilcoyy;?>" <?php if ($hasil_test == "") { echo ' selected="selected"'; } ?>><?php echo $hasilcoyy;?>

  
</option>
<option value="DISARANKAN" <?php if ($hasil_test == DISARANKAN) { echo ' selected="selected"'; } ?>>DISARANKAN</option>
<option value="DIPERTIMBANGKAN" <?php if ($hasil_test == DIPERTIMBANGKAN) { echo ' selected="selected"'; }?>>DIPERTIMBANGKAN</option>
<option value="DIPERTIMBANGKAN DGN CATATAN" <?php if ($hasil_test == "DIPERTIMBANGKAN DGN CATATAN") { echo ' selected="selected"'; }?>>DIPERTIMBANGKAN DGN CATATAN</option>
<option value="TIDAK DISARANKAN" <?php if ($hasil_test == "TIDAK DISARANKAN") { echo ' selected="selected"'; }?>>TIDAK DISARANKAN</option>
</select>
    </td>
  </tr>
</table>
</div>
<div id="tempdiv"></div>

  <?php if ($status !=approve2){ ?>
  <div align="center"><a class="button"><input type="submit" id="approve" name="approve" value="SIMPAN"></a></div><br>
  <?php
  }
  ?>
</form>


<div class="printttd">
<table align="center" width="100%" id="tandatangan">
<tr align="center">
  <td width="33%">
    <br>Dibuat Oleh,
    <br>
    <br>
    <br>
    <br>_____________
    <br>Recruitment
  </td>
  <td width="33%">
    <br>Diketahui,
    <br>
    <br>
    <br>
    <br>_____________
    <br>Head Divisi
  </td>
  <td width="33%">
    <br>Disetujui,
    <br>
    <br>
    <br>
    <br>_____________
    <br>Direksi
  </td>
</tr>  
</table>
</div>

<?php if ($status == "approve2") {
echo "<div align='center'><input type='button' id='btn_3' value='PRINT' class='red'></div>";

}
else{
echo "";
}
?>  
              

