<?php

$host='172.16.100.151';
$user='root';
$pass='Mysql100151'; //---- Password root ----
$db='mdpuf'; // ------ Nama database --
$connection=mysql_connect($host,$user,$pass,TRUE) or die ('gagal konek'.mysql_error());
mysql_select_db($db,$connection);


?>