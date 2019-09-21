<?php
require_once "../pengaturan/koneksi.php";
$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "select kode_brg,nama_brg from barang where nama_brg LIKE '%$q%' or kode_brg LIKE '%$q%'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$cname = $rs['kode_brg'] . " - " . $rs['nama_brg'];
	echo "$cname\n";
}
?>