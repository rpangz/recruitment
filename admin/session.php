<?php
include ('koneksi.php');
if(!isset($_SESSION)){
    session_start();
}
// Menyimpan Session
$user_check=$_SESSION['login_user'];
// Ambil nama karyawan berdasarkan username karyawan dengan mysql_fetch_assoc
$ses_sql=mysql_query("select * from user where id_user='$user_check'", $connection);
$row = mysql_fetch_assoc($ses_sql);
$no =$row['no'];
$login_session =$row['nama_user'];
$id_user =$row['id_user'];
$status_id =$row['status_id'];

if(!isset($login_session)){
mysql_close($connection); // Menutup koneksi
header('Location: index.php'); // Mengarahkan ke Home Page
}

?>