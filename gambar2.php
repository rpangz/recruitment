<?php 
include('koneksi.php');
?>
<?php
$strSQL = "SELECT * FROM list_status_rumah";
$objQuery = mysql_query($strSQL);
?>

<script type="text/javascript" charset="utf-8">

function createanak(){
	  
	   var mySutri2 = document.getElementById('mySutri2');
	   var myLinesut1 = document.getElementById('hdnLinesut2');
	  
	   {	
	   myLinesut1.value++;
	   // Create input text
	   myElement2 = document.createElement('input');
	   myElement2.setAttribute('type',"text");
	   myElement2.setAttribute('name',"nama_anak"+myLinesut1.value);
	   myElement2.setAttribute('id',"nama_anak"+myLinesut1.value);
	   myElement2.setAttribute('placeholder',"Nama Anak");
	   myElement2.setAttribute('onblur',"this.value = this.value.toUpperCase()");
	   myElement2.setAttribute('size', "20");
	   mySutri2.appendChild(myElement2);  
	   // Create input text
	   var myElement2 = document.createElement('input');
	   myElement2.setAttribute('type',"text");
	   myElement2.setAttribute('name',"ttl_anak"+myLinesut1.value);
	   myElement2.setAttribute('id',"ttl_anak"+myLinesut1.value);
	   myElement2.setAttribute('placeholder',"Tempat, Tanggal Lahir Anak");
	   myElement2.setAttribute('onblur',"this.value = this.value.toUpperCase()");
	   myElement2.setAttribute('size', "20");
	   mySutri2.appendChild(myElement2);  
	   // Create select
	   var myElement2 = document.createElement('select');
	   myElement2.setAttribute('type',"text");
	   myElement2.setAttribute('name',"jenis_kelamin_anak"+myLinesut1.value);
	   myElement2.setAttribute('id',"jenis_kelamin_anak"+myLinesut1.value);
	   myElement2.setAttribute('class',"form-control");
	   myElement2.setAttribute('placeholder',"Status Rumah");
	   myElement2.setAttribute("style", "20");
	   mySutri2.appendChild(myElement2);
	   //create option

	   var option; 
	   option = document.createElement("option");
	   option.setAttribute("value", "PRIA");
	   option.innerHTML = "PRIA";
	   myElement2.appendChild(option);
 	   option = document.createElement("option");
	   option.setAttribute("value", "WANITA");
	   option.innerHTML = "WANITA";
	   myElement2.appendChild(option);

       // Create <br>
	   var myElement3 = document.createElement('br');
	   myElement3.setAttribute('id',"br_anak"+myLinesut1.value);
	   mySutri2.appendChild(myElement3);
	   //mySutri2.value++;
	   }
	   
	}
function deleteanak(){
		var mySutri2 = document.getElementById('mySutri2');
		var myLinesut1 = document.getElementById('hdnLinesut2');
		
		{
			// Remove input text
			var deleteFile = document.getElementById("nama_anak"+myLinesut1.value);
			mySutri2.removeChild(deleteFile);
			// Remove input text
			var deleteFile = document.getElementById("ttl_anak"+myLinesut1.value);
			mySutri2.removeChild(deleteFile);
			// Remove select 
			var deleteFile = document.getElementById("jenis_kelamin_anak"+myLinesut1.value);
			mySutri2.removeChild(deleteFile);
			// Remove <br>
			var deleteBr = document.getElementById("br_anak"+myLinesut1.value);
			mySutri2.removeChild(deleteBr);
			myLinesut1.value--;
		}
}


</script>