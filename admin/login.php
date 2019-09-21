<?php
session_start(); // Memulai Session
$error = ''; // Variabel untuk menyimpan pesan error
if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
$error = "Username dan Password Harus di Isi"; 
}
else
{
// Variabel username dan password
$username=$_POST['username'];
$password=MD5($_POST['password']);
// Membangun koneksi ke database
include ('koneksi.php');
// Mencegah MySQL injection 
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);
// Seleksi Database
include ('koneksi.php');
// SQL query untuk memeriksa apakah karyawan terdapat di database?
$query = mysql_query("select * from USER where pass_user='$password' AND id_user='$username'", $connection);
//echo "select * from USER where pass_user='$password' AND id_user='$username'";
//exit;
$rows = mysql_num_rows($query);
if ($rows == 1) {
$_SESSION['login_user']=$username; // Membuat Sesi/session
$_SESSION['login_time'] = time();

header("location: main.php"); // Mengarahkan ke halaman profil
} else {
$error = "Username Atau Password Salah";
}
mysql_close($connection); // Menutup koneksi
}
}
?>