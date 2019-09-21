<?php
include('../../koneksi.php');
include('../../session.php');

$id_calon_karyawan = $_GET['id_calon_karyawan'];
$subaspek = $_GET['subaspek'];
$inisialsubaspek = $_GET['inisialsubaspek'];
$aspek = $_GET['aspek'];
$jawaban = $_GET['jawaban'];

if($jawaban=="R") 
{
	$query = sprintf("replace into hasil_psikotest(id_calon_karyawan, subaspek, aspek, id_radio,nilai,create_user) values ('$id_calon_karyawan','$subaspek','$aspek','$inisialsubaspek','$jawaban','$id_user')");
	$sql = mysql_query($query);
/*	if ($sql) {
	}
	else {
		echo $query;
	}*/
} 
if($jawaban=="K") 
{
	$query = sprintf("replace into hasil_psikotest(id_calon_karyawan, subaspek, aspek, id_radio,nilai,create_user) values ('$id_calon_karyawan','$subaspek','$aspek','$inisialsubaspek','$jawaban','$id_user')");
	$sql = mysql_query($query);
} 
if($jawaban=="S") 
{
	$query = sprintf("replace into hasil_psikotest(id_calon_karyawan, subaspek, aspek, id_radio,nilai,create_user) values ('$id_calon_karyawan','$subaspek','$aspek','$inisialsubaspek','$jawaban','$id_user')");
	$sql = mysql_query($query);
} 
if($jawaban=="B") 
{
	$query = sprintf("replace into hasil_psikotest(id_calon_karyawan, subaspek, aspek, id_radio,nilai,create_user) values ('$id_calon_karyawan','$subaspek','$aspek','$inisialsubaspek','$jawaban','$id_user')");
	$sql = mysql_query($query);
} 
else 
{
	$query = sprintf("replace into hasil_psikotest(id_calon_karyawan, subaspek, aspek, id_radio,nilai,create_user) values ('$id_calon_karyawan','$subaspek','$aspek','$inisialsubaspek','$jawaban','$id_user')");
	$sql = mysql_query($query);
} 


?>
	