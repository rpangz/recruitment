<?php
	include "connect.php";	
	session_start();

	$u = strtoupper($_REQUEST[u]);
	$p = strtoupper($_REQUEST[p]);
	$ip = $_SERVER['REMOTE_ADDR'];
	$tgl = time();
	$tgl2 = date("Y-m-d H:i:s");
	$nullaje = "NULL";	
	if(empty($u) || empty($p))
	{
		print ("<META HTTP-EQUIV = 'Refresh' Content = '0; URL =../index.php?msg=Username dan password harap diisi'>");
	}	
	else
	{
		$st = mysql_query("SELECT no_calon_kary, kode_unik, start_a, start_b, start_c, start_d, status FROM psikotest_data_kary WHERE no_calon_kary = '$u' AND kode_unik = '$p' AND status NOT IN ('FINISH');");

		if( ($row = mysql_fetch_array($st)) )
		{
			$_SESSION['user'] = $u;
			$_SESSION['kodeunik'] = $p;
			$_SESSION['sesi'] = md5($u.$tgl2);
			$log = strtoupper(md5($tgl.$u.$p.$ip.rand(1,10000)));
			$_SESSION['seslog'] = $log;		
			$status = $row[6];	
			mysql_query("insert into secure_user_session values ('$log','$ip','$u','$kodecbg','$p','$tgl2',$nullaje,'+');");
			if($status == "START")
				{
					print ("<META HTTP-EQUIV = 'Refresh' Content = '0; URL =../intro_a.php'>");
				}
			elseif($status == "SOAL A")
				{
					print ("<META HTTP-EQUIV = 'Refresh' Content = '0; URL =../soal_a_kulit.php'>");
				}
			elseif($status == "START B")
				{
					print ("<META HTTP-EQUIV = 'Refresh' Content = '0; URL =../intro_b.php'>");
				}
			elseif($status == "SOAL B")
				{
					print ("<META HTTP-EQUIV = 'Refresh' Content = '0; URL =../soal_b.php'>");
				}
			elseif($status == "START C")
				{
					print ("<META HTTP-EQUIV = 'Refresh' Content = '0; URL =../intro_c.php'>");
				}
			elseif($status == "SOAL C")
				{
					print ("<META HTTP-EQUIV = 'Refresh' Content = '0; URL =../soal_c.php'>");
				}
			elseif($status == "START D")
				{
					print ("<META HTTP-EQUIV = 'Refresh' Content = '0; URL =../intro_d.php'>");
				}
			elseif($status == "SOAL D")
				{
					print ("<META HTTP-EQUIV = 'Refresh' Content = '0; URL =../soal_d.php'>");
				}
			else
				{
					print ("<META HTTP-EQUIV = 'Refresh' Content = '0; URL =../index.php'>");
				}
				
			
		}
		else
		{
				$log = strtoupper(md5($tgl.$u.$p.$ip.rand(1,10000)));
				mysql_query("insert into secure_user_session values ('$log','$ip','$u',$nullaje,'$p','$tgl2',$nullaje,'-');");
		
			print ("<META HTTP-EQUIV = 'Refresh' Content = '0; URL =../index.php?msg=Anda Tidak Berhak Melakukan Test !!!'>");
		}
	}
	mysql_close($id_mysql);		
?>