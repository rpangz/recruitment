<?php
/*include('../../session.php');*/
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
  .fancybox-wrap { 
    top: 40px !important; 
    left: 10px !important; 
  }
  .printttd{
    display: none;
  }
  th{text-align: left;
    padding-left: 8px;
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
        
  $sql = mysql_query("SELECT a.*, b.kode_unik,b.start_c, c.* FROM datapribadi_ck a,psikotest_data_kary b left join (select *from hasil_psikotest_staff where id_calon_karyawan='$id_calon_karyawan') c on c.id_calon_karyawan=c.id_calon_karyawan where a.id_calon_karyawan='$id_calon_karyawan' and b.no_calon_kary='$id_calon_karyawan' ");
   $rows = mysql_fetch_array($sql);
    $kodecbg = $rows[kodecbg];
    $hasil_test = $rows[hasil_test];
    $status = $rows[status];

    $hris = mysql_query("SELECT nama FROM hris.cabang_konven where kodecbg='$kodecbg'");
    $hris_cbg = mysql_fetch_array($hris);

$sql2 = mysql_query("SELECT IQ.*, PCT.*, BHV.* FROM

(select
if(difference >= akhir.min AND difference <= akhir.max,'TIDAK SESUAI','SESUAI') hasil,
SUM(if(difference >= akhir.min AND difference <= akhir.max,0,1)) tdksesuai_PCT
from (
SELECT a.*,l difference, b.bagian,c.min,c.max FROM (

                    SELECT 'D' disc,
                    SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='M') THEN 1 ELSE 0 END) M,
                    SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) L
                    FROM psikotest_proses_test_b a LEFT OUTER JOIN
                    (SELECT * FROM spek_jawaban_b WHERE disc = 'D') b ON a.soalno=b.soalke AND a.ml=b.ml
                    WHERE a.no_calon_kary = '$id_calon_karyawan' AND a.kode_unik = '$rows[kode_unik]'
                    UNION ALL

                    SELECT 'I',
                    SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='M') THEN 1 ELSE 0 END) M,
                    SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) L
                    FROM psikotest_proses_test_b a LEFT OUTER JOIN
                    (SELECT * FROM spek_jawaban_b WHERE disc = 'I') b ON a.soalno=b.soalke AND a.ml=b.ml
                    WHERE a.no_calon_kary = '$id_calon_karyawan' AND a.kode_unik = '$rows[kode_unik]'
                    UNION ALL

                    SELECT 'S',
                    SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='M') THEN 1 ELSE 0 END) M,
                    SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) L
                    FROM psikotest_proses_test_b a LEFT OUTER JOIN
                    (SELECT * FROM spek_jawaban_b WHERE disc = 'S') b ON a.soalno=b.soalke AND a.ml=b.ml
                    WHERE a.no_calon_kary = '$id_calon_karyawan' AND a.kode_unik = '$rows[kode_unik]'
                    UNION ALL

                    SELECT 'C',
                    SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='M') THEN 1 ELSE 0 END) M,
                    SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) L
                    FROM psikotest_proses_test_b a LEFT OUTER JOIN
                    (SELECT * FROM spek_jawaban_b WHERE disc = 'C') b ON a.soalno=b.soalke AND a.ml=b.ml
                    WHERE a.no_calon_kary = '$id_calon_karyawan' AND a.kode_unik = '$rows[kode_unik]'
                    UNION ALL

                    SELECT 'N',
                    SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='M') THEN 1 ELSE 0 END) M,
                    SUM(CASE WHEN (a.jawaban=b.jawaban AND a.ml='L') THEN 1 ELSE 0 END) L
                    FROM psikotest_proses_test_b a LEFT OUTER JOIN
                    (SELECT * FROM spek_jawaban_b WHERE disc = 'N') b ON a.soalno=b.soalke AND a.ml=b.ml
                    WHERE a.no_calon_kary = '$id_calon_karyawan' AND a.kode_unik = '$rows[kode_unik]'
                    ) A, datapribadi_ck b, spek_nilai_pct_staff c
                    where id_calon_karyawan='$id_calon_karyawan' and c.jabatan=b.bagian and c.disc=a.disc) akhir ) PCT,

(SELECT if(betul >= totalbenar,'SESUAI','TIDAK SESUAI') KETERANGAN FROM (
SELECT sum(nilai) betul from (SELECT b.no_calon_kary,a.soalke,c.jawaban,
                                CASE WHEN (c.jawaban IS NULL OR c.jawaban<>a.jawabreal) THEN 0 ELSE 1 END nilai,
                                CASE WHEN (c.jawaban IS NULL OR c.jawaban<>a.jawabreal) THEN 'SALAH' ELSE 'BENAR' END keterangan
                                FROM (psikotest_a_soal a,psikotest_data_kary b)
                                LEFT OUTER JOIN
                                (SELECT * FROM psikotest_proses_test WHERE no_calon_kary = '$id_calon_karyawan' AND kode_unik = '$rows[kode_unik]') c
                                ON a.soalke=c.soalno
                                WHERE b.no_calon_kary = '$id_calon_karyawan' AND b.kode_unik = '$rows[kode_unik]')as total) a, spek_nilai_iq_staff b) IQ,


(SELECT COUNT(1) tdksesuai_BHV,CASE WHEN COUNT(1) < 1 THEN 'SESUAI' ELSE CONCAT('TIDAK SESUAI : ',COUNT(1),' POINT') END KETERANGAN   FROM (

SELECT a.no_calon_kary,a.huruf,a.nilai,c.min,c.max,CASE WHEN a.nilai BETWEEN c.min AND c.max THEN 'SESUAI' ELSE 'TIDAK' END ceksesuai FROM (

SELECT a.no_calon_kary,'G' huruf,
SUM(CASE WHEN b.nilai = 'G' THEN 1 ELSE 0 END) nilai FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' AND kode_unik='$rows[kode_unik]'
UNION ALL
SELECT a.no_calon_kary,'L',
SUM(CASE WHEN b.nilai = 'L' THEN 1 ELSE 0 END) nilai FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' AND kode_unik='$rows[kode_unik]'
UNION ALL
SELECT a.no_calon_kary,'I',
SUM(CASE WHEN b.nilai = 'I' THEN 1 ELSE 0 END) nilai FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' AND kode_unik='$rows[kode_unik]'
UNION ALL
SELECT a.no_calon_kary,'T',
SUM(CASE WHEN b.nilai = 'T' THEN 1 ELSE 0 END) nilai FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' AND kode_unik='$rows[kode_unik]'
UNION ALL
SELECT a.no_calon_kary,'V',
SUM(CASE WHEN b.nilai = 'V' THEN 1 ELSE 0 END) nilai FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' AND kode_unik='$rows[kode_unik]'
UNION ALL
SELECT a.no_calon_kary,'S',
SUM(CASE WHEN b.nilai = 'S' THEN 1 ELSE 0 END) nilai FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' AND kode_unik='$rows[kode_unik]'
UNION ALL
SELECT a.no_calon_kary,'R',
SUM(CASE WHEN b.nilai = 'R' THEN 1 ELSE 0 END) nilai FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' AND kode_unik='$rows[kode_unik]'
UNION ALL
SELECT a.no_calon_kary,'D',
SUM(CASE WHEN b.nilai = 'D' THEN 1 ELSE 0 END) nilai FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' AND kode_unik='$rows[kode_unik]'
UNION ALL
SELECT a.no_calon_kary,'C',
SUM(CASE WHEN b.nilai = 'C' THEN 1 ELSE 0 END) nilai FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' AND kode_unik='$rows[kode_unik]'
UNION ALL
SELECT a.no_calon_kary,'E',
SUM(CASE WHEN b.nilai = 'E' THEN 1 ELSE 0 END) nilai FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' AND kode_unik='$rows[kode_unik]'
UNION ALL
SELECT a.no_calon_kary,'N',
SUM(CASE WHEN b.nilai = 'N' THEN 1 ELSE 0 END) nilai FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' AND kode_unik='$rows[kode_unik]'
UNION ALL
SELECT a.no_calon_kary,'A',
SUM(CASE WHEN b.nilai = 'A' THEN 1 ELSE 0 END) nilai FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' AND kode_unik='$rows[kode_unik]'
UNION ALL
SELECT a.no_calon_kary,'P',
SUM(CASE WHEN b.nilai = 'P' THEN 1 ELSE 0 END) nilai FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' AND kode_unik='$rows[kode_unik]'
UNION ALL
SELECT a.no_calon_kary,'X',
SUM(CASE WHEN b.nilai = 'X' THEN 1 ELSE 0 END) nilai FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' AND kode_unik='$rows[kode_unik]'
UNION ALL
SELECT a.no_calon_kary,'B',
SUM(CASE WHEN b.nilai = 'B' THEN 1 ELSE 0 END) nilai FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' AND kode_unik='$rows[kode_unik]'
UNION ALL
SELECT a.no_calon_kary,'O',
SUM(CASE WHEN b.nilai = 'O' THEN 1 ELSE 0 END) nilai FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' AND kode_unik='$rows[kode_unik]'
UNION ALL
SELECT a.no_calon_kary,'Z',
SUM(CASE WHEN b.nilai = 'Z' THEN 1 ELSE 0 END) nilai FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' AND kode_unik='$rows[kode_unik]'
UNION ALL
SELECT a.no_calon_kary,'K',
SUM(CASE WHEN b.nilai = 'K' THEN 1 ELSE 0 END) nilai FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' AND kode_unik='$rows[kode_unik]'
UNION ALL
SELECT a.no_calon_kary,'F',
SUM(CASE WHEN b.nilai = 'F' THEN 1 ELSE 0 END) nilai FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' AND kode_unik='$rows[kode_unik]'
UNION ALL
SELECT a.no_calon_kary,'W',
SUM(CASE WHEN b.nilai = 'W' THEN 1 ELSE 0 END) nilai FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' AND kode_unik='$rows[kode_unik]'
) a, datapribadi_ck b,spek_nilai_behavior_staff c
WHERE b.id_calon_karyawan=a.no_calon_kary AND b.bagian=c.jabatan AND a.huruf=c.huruf

)a WHERE ceksesuai = 'TIDAK') BHV");
   $rows2 = mysql_fetch_row($sql2);


  $sql3 = mysql_query("SELECT ARAHKERJA.*, ARAHKERJA.*,EMOSI.*,AKTIFITAS.* FROM (

SELECT ROUND(SUM(nilai)/3),
CASE WHEN ROUND(SUM(nilai)/3) < 3 THEN 'BURUK' ELSE
CASE WHEN ROUND(SUM(nilai)/3) IN (3,4) THEN 'NORMAL' ELSE
'BAIK' END END arah
FROM (
SELECT a.no_calon_kary,'G' huruf,
SUM(CASE WHEN b.nilai = 'G' THEN 1 ELSE 0 END) nilai FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' AND kode_unik='$rows[kode_unik]'
UNION ALL
SELECT a.no_calon_kary,'N',
SUM(CASE WHEN b.nilai = 'N' THEN 1 ELSE 0 END) nilai FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' AND kode_unik='$rows[kode_unik]'
UNION ALL
SELECT a.no_calon_kary,'A',
SUM(CASE WHEN b.nilai = 'A' THEN 1 ELSE 0 END) nilai FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' AND kode_unik='$rows[kode_unik]' ) a)ARAHKERJA,



(SELECT ROUND(SUM(nilai)/3),
CASE WHEN ROUND(SUM(nilai)/3) < 4 THEN 'BURUK' ELSE
CASE WHEN ROUND(SUM(nilai)/3) IN (5,6,7) THEN 'NORMAL' ELSE
'BAIK' END END arah
FROM (
SELECT a.no_calon_kary,'Z' huruf,
SUM(CASE WHEN b.nilai = 'Z' THEN 1 ELSE 0 END) nilai FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' AND kode_unik='$rows[kode_unik]'
UNION ALL
SELECT a.no_calon_kary,'E',
SUM(CASE WHEN b.nilai = 'E' THEN 1 ELSE 0 END) nilai FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' AND kode_unik='$rows[kode_unik]'
UNION ALL
SELECT a.no_calon_kary,'K',
SUM(CASE WHEN b.nilai = 'K' THEN 1 ELSE 0 END) nilai FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' AND kode_unik='$rows[kode_unik]' ) a) EMOSI,



(SELECT ROUND(SUM(nilai)/3),
CASE WHEN ROUND(SUM(nilai)/3) < 4 THEN 'BURUK' ELSE
CASE WHEN ROUND(SUM(nilai)/3) IN (5,6) THEN 'NORMAL' ELSE
'BAIK' END END arah
FROM (
SELECT a.no_calon_kary,'L' huruf,
SUM(CASE WHEN b.nilai = 'L' THEN 1 ELSE 0 END) nilai FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' AND kode_unik='$rows[kode_unik]'
UNION ALL
SELECT a.no_calon_kary,'I',
SUM(CASE WHEN b.nilai = 'I' THEN 1 ELSE 0 END) nilai FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' AND kode_unik='$rows[kode_unik]'
UNION ALL
SELECT a.no_calon_kary,'P',
SUM(CASE WHEN b.nilai = 'P' THEN 1 ELSE 0 END) nilai FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' AND kode_unik='$rows[kode_unik]' ) a) LEADERSHIP,


(SELECT ROUND(SUM(nilai)/2,1),
CASE WHEN ROUND(SUM(nilai)/2,1) <= 3.4 THEN 'BURUK' ELSE
CASE WHEN ROUND(SUM(nilai)/2,1) BETWEEN 3.5 AND 5 THEN 'NORMAL' ELSE
'BAIK' END END arah
FROM (
SELECT a.no_calon_kary,'T' huruf,
SUM(CASE WHEN b.nilai = 'T' THEN 1 ELSE 0 END) nilai FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' AND kode_unik='$rows[kode_unik]'
UNION ALL
SELECT a.no_calon_kary,'V',
SUM(CASE WHEN b.nilai = 'V' THEN 1 ELSE 0 END) nilai FROM psikotest_proses_test_c a,spek_jawaban_c b
WHERE a.soalno=b.soalno and a.jawaban=b.jawaban AND
no_calon_kary = '$id_calon_karyawan' AND kode_unik='$rows[kode_unik]' ) a) AKTIFITAS") ;

   $rows3= mysql_fetch_row($sql3);

          $hasilcoyy="";
          
          if ($rows2[0]== 'SESUAI' && $rows2[2]== '0' && $rows2[3]== '0'){
              $hasilcoyy="DISARANKAN";
          }
          elseif (($rows2[0]== 'SESUAI' && $rows2[2]== '0') && ( $rows2[3] >= 1 || $rows2[3] <= 3)) {
              $hasilcoyy="DIPERTIMBANGKAN";
          } 
          elseif ($rows2[0]== 'SESUAI' && $rows2[2]== '1' && $rows2[3] <= '0') {
              $hasilcoyy="DIPERTIMBANGKAN";
          } 
          elseif ($rows2[0]== 'SESUAI' && $rows2[2]== '2' && $rows2[3] <= '0') {
              $hasilcoyy="DIPERTIMBANGKAN DGN CATATAN";
          } 
          elseif (($rows2[0]== 'SESUAI' && $rows2[2]== '0') && ( $rows2[3] >= 4 || $rows2[3] <= 7)) {
              $hasilcoyy="DIPERTIMBANGKAN DGN CATATAN";
          } 
          elseif ($rows2[0]== 'TIDAK SESUAI' && $rows2[2]== '0' && $rows2[3] <= '0') {
              $hasilcoyy="DIPERTIMBANGKAN DGN CATATAN";
          } 
          elseif (($rows2[0]== 'SESUAI' && $rows2[2]== '1') && ( $rows2[3] >= 1 || $rows2[3] <= 3)) {
              $hasilcoyy="DIPERTIMBANGKAN DGN CATATAN";
          }
          else {
            $hasilcoyy="DITOLAK";
          } 
?>

<form method="post" onsubmit="return confirm('Yakin Ingin Save?');" action="save_hasil_staff.php">

<div align="center" style="font-weight: bold; font-size: 20">HASIL PEMERIKSAAN PSIKOTEST</div>
<table border="1" style="border-style: groove; border-width: 1px; border-collapse: collapse;" align="center" width="500px">
<br>
  <tr>
    <th>ID CALON KARYAWAN</th>
    <th><?php echo $id_calon_karyawan ?><input type="hidden" value="<?php echo  $id_calon_karyawan?>" name="id_calon_karyawan"></th>
  </tr>
  <tr>
    <th>TANGGAL TEST</th>
    <th><?php echo date('d-m-Y',strtotime($rows[start_c]) ) ?></th>
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
    <th>CABANG</th>
    <th><?php echo $kodecbg."-".$hris_cbg[nama]?>
    </th>
  </tr>
</table>
<br><br>

<table border="0" style="border-style: groove; border-width: 0px; border-collapse: collapse;" align="center" width="500px">
  <tr>
    <th>HASIL TEST</th>
    <th style="padding-left: 0">

          <select  name="hasil_test" class = "form-control" id="hasil_test" style="text-transform:uppercase" 
              <?php if ($status!="approve2")  { ?> onchange="simpan_select()" <?php } ?> >

          <option value="DISARANKAN" <?php if ($hasil_test == DISARANKAN) { echo ' selected="selected"'; } else { echo ' disabled="disabled" '; }?> >DISARANKAN</option>
          <option value="DIPERTIMBANGKAN" <?php if ($hasil_test == DIPERTIMBANGKAN) { echo ' selected="selected"'; } else { echo ' disabled="disabled" '; }?>>DIPERTIMBANGKAN</option>
          <option value="DIPERTIMBANGKAN DGN CATATAN" <?php if ($hasil_test == "DIPERTIMBANGKAN DGN CATATAN") { echo ' selected="selected"'; } else { echo ' disabled="disabled" '; } ?>>DIPERTIMBANGKAN DGN CATATAN</option>
          <option value="TIDAK DISARANKAN" <?php if ($hasil_test == "TIDAK DISARANKAN") { echo ' selected="selected"'; } else { echo ' disabled="disabled" '; }?>>TIDAK DISARANKAN</option>
          </select>

    </th>
  </tr>
  <tr>
    <th>INTELIGENSI</th>
    <th style="padding-left: 0">
        <select <?php if ($status=="approve2") { echo ' disabled="disabled"'; }?> name="inteligensi" class = "form-control" id = "inteligensi" style="text-transform:uppercase;width: 100%; padding-left: 6px; font-weight:  bold">
          <option value="" <?php if ($rows[inteligensi] == "") { echo ' selected="selected"'; } ?> >-SILAHKAN PILIH-</option>
          <option value="GENIUS" <?php if ($rows[inteligensi] == "GENIUS") { echo ' selected="selected"'; } ?>>GENIUS</option>
          <option value="VERY SUPERIOR" <?php if ($rows[inteligensi] == "VERY SUPERIOR") { echo ' selected="selected"'; } ?>>VERY SUPERIOR</option>
          <option value="SUPERIOR" <?php if ($rows[inteligensi] == "SUPERIOR") { echo ' selected="selected"'; } ?>>SUPERIOR</option>
          <option value="NORMAL" <?php if ($rows[inteligensi] == "NORMAL") { echo ' selected="selected"'; } ?>>NORMAL</option>
          <option value="DULL" <?php if ($rows[inteligensi] == "DULL") { echo ' selected="selected"'; } ?>>DULL</option>
          <option value="BORDER LINE" <?php if ($rows[inteligensi] == "BORDER LINE") { echo ' selected="selected"'; } ?>>BORDER LINE</option>
          <option value="MORRONS" <?php if ($rows[inteligensi] == "MORRONS") { echo ' selected="selected"'; } ?>>MORRONS</option>
          <option value="EMBICILE" <?php if ($rows[inteligensi] == "EMBICILE") { echo ' selected="selected"'; } ?>>EMBICILE</option>
          <option value="IDIOT" <?php if ($rows[inteligensi] == "DIOT") { echo ' selected="selected"'; } ?>>IDIOT</option>
        </select>
    </th>
  </tr>
  <tr>
    <th>KEPRIBADIAN</th>
    <th style="padding-left: 0">
        <input type="text" name="kepribadian"
        <?php 
            if ($rows[kepribadian] != "") { echo ' value='."$rows[kepribadian]".' '; }
            if ($status=="approve2") { echo ' disabled="disabled"'; }; 
        ?>  
        style="width: 100%; padding-left: 10px; font-weight:  bold"></th>
  </tr>
  <tr>
    <th>ARAH KERJA</th>
    <th><?php echo $rows3[1] ?></th>
  </tr>
  <tr>
    <th>KONDISI EMOSI</th>
    <th><?php echo $rows3[3] ?></th>
  </tr>
  <tr>
    <th>LEADERSHIP</th>
    <th><?php echo $rows3[5] ?></th>
  </tr>
  <tr>
    <th>AKTIFITAS KERJA</th>
    <th><?php echo $rows3[7] ?></th>
  </tr>
  <tr><td>&nbsp</td></tr>
  <tr>
    <th>NOTE</th>
    <th style="padding-left: 0">
        <textarea <?php if ($status=="approve2") { echo ' disabled="disabled"'; }; ?> name="catatan"
        style="width: 100%; padding-left: 10px; font-weight: bold; height:100px; resize:none;"><?php 
            if ($rows[catatan] != "") { echo $rows[catatan]; }?></textarea>
    </th>
  </tr>

</table>
<br>
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
<?php if ($status != "approve2") {
  echo "<div align='center'><button name=\"SIMPAN\">SIMPAN</button></div> ";
}
/*elseif ($status == "approve" && $hasil_test !=""){ 
echo "<div align='center'>MENUNGGU DI APPROVE</div>";
}*/
else{
echo "<div align='center'><input type='button' id='btn_3' value='PRINT' class='black'></div>";
}
?>  
              

</div>
<div id="tempdiv"></div>
  <style type="text/css" media="print" id="print"></style>
</form>