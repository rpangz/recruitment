<?php 
	$server = "localhost";
	$ser = "root";
	$password = "ronaldaja";
	
	$id_mysql = mysql_connect($server,$ser,$password);
	
	if(! $id_mysql)
	{	
		die("can't connect database");
	}
	
	$hasil = mysql_select_db("recruitment",$id_mysql);
	
	if(! $hasil)
	{
		die("database is not exist");
	}
?>
