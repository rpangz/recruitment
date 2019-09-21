<?php
	session_start();
	include "Proses/connect.php";
	mysql_close($id_mysql);
	if($_SESSION['user']==true)
	{
	$kas = "LAPORAN";
	$userlogin = $_SESSION['user'];
	$userkodecbg = $_SESSION['kodecbg'];
?>
<html>
<head>
<script type="text/javascript" src="jquery-1.3.2.js"></script>
	<script type="text/javascript" src="datepicker/ui.core.js"></script>
	<script type="text/javascript" src="datepicker/ui.datepicker.js"></script>
	<link type="text/css" href="datepicker/ui.core.css" rel="stylesheet" />
	<link type="text/css" href="datepicker/ui.resizable.css" rel="stylesheet" />
	<link type="text/css" href="datepicker/ui.accordion.css" rel="stylesheet" />
	<link type="text/css" href="datepicker/ui.dialog.css" rel="stylesheet" />
	<link type="text/css" href="datepicker/ui.slider.css" rel="stylesheet" />
	<link type="text/css" href="datepicker/ui.tabs.css" rel="stylesheet" />
	<link type="text/css" href="datepicker/ui.datepicker.css" rel="stylesheet" />
	<link type="text/css" href="datepicker/ui.progressbar.css" rel="stylesheet" />
	<link type="text/css" href="datepicker/ui.theme.css" rel="stylesheet" />
	<link type="text/css" href="datepicker/demos.css" rel="stylesheet" />
	<script type="text/javascript">
	
	$(function() {
		$('#datepicker').datepicker({
		      changeMonth: true,
		      changeYear: true
	        });
	});
	</script>
	
	<script type="text/javascript">
	$(function() {
		var dates = $('#from, #to').datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			numberOfMonths: 3,
			onSelect: function(selectedDate) {
				var option = this.id == "from" ? "minDate" : "maxDate";
				var instance = $(this).data("datepicker");
				var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
				dates.not(this).datepicker("option", option, date);
			}
		});
	});
	</script>
	<title>PT MDPU FINANCE</title>
	<link type="text/css" href="css/menucss.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="SpryMenuBarVertical.css"  />
<style>

/* Spry Menu Bar */

/* Outermost menu container has no borders on all sides */
ul.MenuBarVertical {
	width: 180px;
	border: 0px;
}

/* Set the active Menu Bar with this class, currently setting z-index to accomodate IE rendering bug: http://therealcrisp.xs4all.nl/meuk/IE-zindexbug.html */
ul.MenuBarActive {
	z-index: 10000;
}
ul.MenuBarVertical li {
	width: 180px;
}
ul.MenuBarVertical ul {
	width: 220px;
	z-index: 10020;
}
ul.MenuBarVertical ul li {
	width: 220px;	
	
}

/* Menu items are a block with padding and no text decoration */
ul.MenuBarVertical a {
	background-color: #F1F1F1;
	color: #000;
}

/* Menu items that have mouse over or focus have the following background and text color */
ul.MenuBarVertical a:hover, ul.MenuBarVertical a:focus {
	background-color: #33C;
	color: #FFF;
}

/* Menu items that are open with submenus are set to MenuBarItemHover with the following background and text color */
ul.MenuBarVertical a.MenuBarItemHover, ul.MenuBarVertical a.MenuBarItemSubmenuHover, ul.MenuBarVertical a.MenuBarSubmenuVisible {
	background-color: #33C;
	color: #FFF;
}
ul.MenuBarVertical a.MenuBarItemSubmenu {
	background-image: url(mdpufimages/SpryMenuBarRight.gif);
}

/* Menu items that are open with submenus have the class designation MenuBarItemSubmenuHover and are set to use a "hover" background image positioned on the far left (95%) and centered vertically (50%) */
ul.MenuBarVertical a.MenuBarItemSubmenuHover {
	background-image: url(mdpufimages/SpryMenuBarRightHover.gif);
}

/* HACK FOR IE: to make sure the sub menus show above form controls, we underlay each submenu with an iframe */
ul.MenuBarVertical iframe {
	z-index: 10010;
}
</style>
<link rel="stylesheet" type="text/css" href="phprptcss/button.css" />
<link rel="stylesheet" type="text/css" href="phprptcss/container.css" />
<link rel="stylesheet" type="text/css" href="phprptcss/demo7.css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="generator" content="PHP Report Maker v4.0.0.0" />
</head>
<body class="yui-skin-sam">
<script type="text/javascript" src="phprptcss/utilities.js"></script>
<script type="text/javascript" src="phprptcss/button-min.js"></script>
<script type="text/javascript" src="phprptcss/container-min.js"></script>
<script type="text/javascript">
<!--
var EWRPT_LANGUAGE_ID = "en";
var EWRPT_DATE_SEPARATOR = "/";
if (EWRPT_DATE_SEPARATOR == "") EWRPT_DATE_SEPARATOR = "/"; // Default date separator

//var EWRPT_EMAIL_EXPORT_BUTTON_SUBMIT_TEXT = "   Send   ";
//var EWRPT_BUTTON_CANCEL_TEXT = "  Cancel  ";

var EWRPT_MAX_EMAIL_RECIPIENT = 3;

//-->
</script>
<script type="text/javascript" src="phprptjs/ewrpt.js"></script>
<script src="phprptjs/x.js" type="text/javascript"></script>

<script type="text/javascript" src="phprptjs/SpryMenuBar.js"></script>
<script type="text/javascript">
var EWRPT_IMAGES_FOLDER = "mdpufimages";
</script>

   <script language=JavaScript>
<!--
function printPartOfPage(elementId)
{
 var printContent = document.getElementById(elementId);
 var printWindow = window.open('', '', 'left=50000,top=50000,width=0,height=0');

 printWindow.document.write(printContent.innerHTML);
 printWindow.document.close();
 printWindow.focus();
 printWindow.print();
 printWindow.close();
}
// -->

function SimpanJawaban(nomor,jawaban)
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
    document.getElementById("prsesjwb").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","TestKacab_simpan.php?nomor="+nomor+"&jawaban="+jawaban,true);
xmlhttp.send();
}
</script>

<div class="ewLayout">

	<!-- header (begin) -->
	<div class="ewHeaderRow"><img src="mdpufimages/phprptmkrlogo2_X.png" alt="" border="0" /></div>
	<!-- header (end) -->
	<!-- content (begin) -->
  <table cellspacing="0" class="ewContentTable">
		<tr>
			<td class="ewMenuColumn">
			<!-- left column (begin) -->
<!-- Begin Main Menu -->

<?php 
include("menu.php");
?>
			</td>
			<td class="ewContentColumn">			
			
            <div id="prsesjwb" style="display:none" ></div>
            
        <div style="float:left;width:100%">
        
            <div style="width:100%;height:20mm;float:left;font-size:20px">
<center><b>Soal Ujian </b></center>
            </div>
            <div style="width:100%;min-height:15mm;float:left;font-size:16px">
<center><b>Ada 100 soal, dipilih jawaban yang menurut anda paling benar.<br>
Ujian Dimulai 10.30 WIB sampai 12.00 WIB, harap di kerjakan semaksimal mungkin.Terima Kasih.</b>
</center>
            </div>
            <?php include "Proses/connect151.php";?>
            
<?php
$noa = 1;
$result2 = mysql_query("select case when (now()>'2017-01-01 10:30:00' and now()<'2016-01-27 15:17:01') THEN 'TRUE' ELSE 'FALSE' END"); 
while ($row2 = mysql_fetch_array($result2)) 
{
	$mulai=$row2[0];
}

$result2 = mysql_query("select count(tipesoal) from soal_test_jawab where tipesoal='KACAB' and jenis='TIPEB' and user='".$userlogin."' and kodecbg='".$userkodecbg."'"); 
while ($row2 = mysql_fetch_array($result2)) 
{
	$jumjwb=$row2[0];
	if($jumjwb>99){$selesai="SUDAH";}else{$selesai="BELUM";}
}

if($mulai=="TRUE" && $selesai=="BELUM")
{
		$tkcek = "";
		$result2 = mysql_query("SELECT AA.*,CASE WHEN BB.jawaban IS NULL THEN '' ELSE BB.jawaban END FROM (SELECT a.*,mark,pilihan FROM soal_test a left join soal_test_detail b on a.tipesoal = b.tipesoal and a.jenis = b.jenis and a.no = b.no WHERE a.jenis='TIPEB' order by rand(a.no))AA
LEFT JOIN
(SELECT * from soal_test_jawab where tipesoal='KACAB' and jenis = 'TIPEB' and user='".$userlogin."' and kodecbg='".$userkodecbg."')BB
ON AA.tipesoal=BB.tipesoal and AA.jenis = BB.jenis and AA.no=BB.no and AA.mark = BB.jawaban"); 
		while ($row2 = mysql_fetch_array($result2)) 
		{
		if($tkcek=="")
		{
		if(strlen($row2[6])>0){$checked="checked";}else{$checked="";}
		$tkcek = $row2[0]."".$row2[1]."".$row2[2];
		echo '<div style="width:100%;float:left;font-size:11px;margin-top:5mm;">';
		echo '<div style="width:100%;float:left;"><div style="width:70%;float:left">No.'.$noa.' '.$row2[3].'</div></div>';
		echo '<div style="width:100%;float:left;">
		<div style="width:70%;float:left">
		<input '.$checked.' type="radio" name="'.$row2[2].'" id="'.$row2[4].'" value="'.$row2[4].'" onClick="SimpanJawaban(this.name,this.value)">'.$row2[4].'. '.$row2[5].'</div>
		</div>';
		}
		elseif($tkcek==$row2[0]."".$row2[1]."".$row2[2])
		{
			if(strlen($row2[6])>0){$checked="checked";}else{$checked="";}
		echo '<div style="width:100%;float:left;">
		<div style="width:70%;float:left">
		<input type="radio" name="'.$row2[2].'" id="'.$row2[4].'" value="'.$row2[4].'" onClick="SimpanJawaban(this.name,this.value)" '.$checked.'>'.$row2[4].'. '.$row2[5].'</div>
		</div>';
		}
		else
		{
		if(strlen($row2[6])>0){$checked="checked";}else{$checked="";}
		echo '</div>';
		$noa++;	
		echo '<div style="width:100%;float:left;font-size:11px;margin-top:5mm;">';
		echo '<div style="width:100%;float:left;"><div style="width:70%;float:left">No.'.$noa.' '.$row2[3].'</div></div>';
		$tkcek = $row2[0]."".$row2[1]."".$row2[2];
		echo '<div style="width:100%;float:left;">
		<div style="width:70%;float:left">
		<input type="radio" name="'.$row2[2].'" id="'.$row2[4].'" value="'.$row2[4].'" onClick="SimpanJawaban(this.name,this.value)" '.$checked.'>'.$row2[4].'. '.$row2[5].'</div>
		</div>';
		}				 
		}
		echo "</div>";
		
		echo '<input type="button" onClick="location.reload();" value="SELESAI" style="margin-top:5mm;">';
}
else
{
echo '<div style="width:100%;height:20mm;float:left;font-size:20px">
<center><b>Ujian Belum Dimulai atau Sudah Selesai</b></center>
            </div>';
			
			if($selesai == "SUDAH"){
			echo '<div style="width:100%;height:20mm;float:left;font-size:20px">
<center><b>ANDA SUDAH SELESAI MENGERJAKAN SEMUA SOALNYA</b></center>
            </div>';	
			}
}
		
?>
            
            
            
        
        </div>
            
            
            
            
			
		  </td></tr>
	</table>
	<!-- content (end) -->
	<!-- footer (begin) -->
	<div class="ewFooterRow">
	<?php
	include("footer.php");
	?>
		<!-- Place other links, for example, disclaimer, here -->
	</div>
	<!-- footer (end) -->	
</div>
</body>
<?php
	}
	else
	{
		print ("<META HTTP-EQUIV = 'Refresh' Content = '0; URL =index.php'>");
	}
	mysql_close($id_mysql);
?>
</html>