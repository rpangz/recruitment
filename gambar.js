function PreviewImage() {
	  
	   	var mySpan1 = document.getElementById('mySpan1');
	   	var myLine1 = document.getElementById('hdnLinepeng1');{
		var oFReader = new FileReader();
				oFReader.readAsDataURL(document.getElementById("gambar"+myLine1.value).files[0]);

				oFReader.onload = function (oFREvent) {
				document.getElementById("uploadPreview").src = oFREvent.target.result;
				}}
				}


function lmpCreateElement(){
	  
	   var mySpan1 = document.getElementById('mySpan1');
	   var myLine1 = document.getElementById('hdnLinepeng1');
	  
	   {	
	   myLine1.value++;
	   // Create input text
	   myElement2 = document.createElement('input');
	   myElement2.setAttribute('type',"text");
	   myElement2.setAttribute('name',"pendidikan"+myLine1.value);
	   myElement2.setAttribute('id',"pendidikan"+myLine1.value);
	   myElement2.setAttribute('placeholder',"Universitas/Sekolah");
	   myElement2.setAttribute('onblur',"this.value = this.value.toUpperCase()");
	   myElement2.setAttribute('size', "20");
	   mySpan1.appendChild(myElement2);  
	   // Create input text
	   var myElement2 = document.createElement('input');
	   myElement2.setAttribute('type',"text");
	   myElement2.setAttribute('name',"tahun_pendidikan"+myLine1.value);
	   myElement2.setAttribute('id',"tahun_pendidikan"+myLine1.value);
	   myElement2.setAttribute('placeholder',"Tahun Pendidikan");
	   myElement2.setAttribute('onblur',"this.value = this.value.toUpperCase()");
	   myElement2.setAttribute('size', "20");
	   mySpan1.appendChild(myElement2);  
	   // Create input text
	   var myElement2 = document.createElement('input');
	   myElement2.setAttribute('type',"text");
	   myElement2.setAttribute('name',"status_pendidikan"+myLine1.value);
	   myElement2.setAttribute('id',"status_pendidikan"+myLine1.value);
	   myElement2.setAttribute('placeholder',"Status Pendidikan");
	   myElement2.setAttribute('onblur',"this.value = this.value.toUpperCase()");
	   myElement2.setAttribute("style", "20");
	   mySpan1.appendChild(myElement2);  
       // Create <br>
	   var myElement3 = document.createElement('br');
	   myElement3.setAttribute('id',"br"+myLine1.value);
	   mySpan1.appendChild(myElement3);
	   //myLine1.value++;
	   }
	   
	}
function deleteskill(){
		var mySpan1 = document.getElementById('mySpan1');
		var myLine1 = document.getElementById('hdnLinepeng1');
		
		{
			// Remove input text
			var deleteFile = document.getElementById("pendidikan"+myLine1.value);
			mySpan1.removeChild(deleteFile);
			// Remove input text
			var deleteFile = document.getElementById("tahun_pendidikan"+myLine1.value);
			mySpan1.removeChild(deleteFile);
			// Remove input text
			var deleteFile = document.getElementById("status_pendidikan"+myLine1.value);
			mySpan1.removeChild(deleteFile);
			// Remove <br>
			var deleteBr = document.getElementById("br"+myLine1.value);
			mySpan1.removeChild(deleteBr);
			myLine1.value--;
		}
}
//


function lmpCreateElement2(){
	  
	   var mySpan2 = document.getElementById('mySpan2');
	   var myLine2 = document.getElementById('hdnLinepeng2');
	  
	   {	
	   myLine2.value++;
	   // Create input text
	   myElement3 = document.createElement('input');
	   myElement3.setAttribute('type',"text");
	   myElement3.setAttribute('name',"perusahaan"+myLine2.value);
	   myElement3.setAttribute('id',"perusahaan"+myLine2.value);
	   myElement3.setAttribute('placeholder',"Perusahaan");
	   myElement3.setAttribute('onblur',"this.value = this.value.toUpperCase()");
	   myElement3.setAttribute('size', "20");
	   mySpan2.appendChild(myElement3);  
	   // Create input text
	   var myElement3 = document.createElement('input');
	   myElement3.setAttribute('type',"text");
	   myElement3.setAttribute('name',"gaji_sebelumnya"+myLine2.value);
	   myElement3.setAttribute('id',"gaji_sebelumnya"+myLine2.value);
	   myElement3.setAttribute('placeholder',"Gaji");
	   myElement3.setAttribute('onkeypress',"return isNumber(event)");
	   myElement3.setAttribute('size', "100%");
	   mySpan2.appendChild(myElement3);  
	   // Create input text
	   var myElement3 = document.createElement('input');
	   myElement3.setAttribute('type',"text");
	   myElement3.setAttribute('name',"jabatan_sebelumnya"+myLine2.value);
	   myElement3.setAttribute('id',"jabatan_sebelumnya"+myLine2.value);
	   myElement3.setAttribute('placeholder',"Jabatan");
	   myElement3.setAttribute('onblur',"this.value = this.value.toUpperCase()");
	   myElement3.setAttribute("style", "20");
	   mySpan2.appendChild(myElement3);  
	   // Create input text
	   var myElement3 = document.createElement('input');
	   myElement3.setAttribute('type',"text");
	   myElement3.setAttribute('name',"tahun_kerja_sebelumnya"+myLine2.value);
	   myElement3.setAttribute('id',"tahun_kerja_sebelumnya"+myLine2.value);
	   myElement3.setAttribute('placeholder',"Tahun Kerja Sampai Dengan");
	   myElement3.setAttribute('onblur',"this.value = this.value.toUpperCase()");
	   myElement3.setAttribute("style", "20");
	   mySpan2.appendChild(myElement3); 
	   // Create input text
	   var myElement3 = document.createElement('input');
	   myElement3.setAttribute('type',"text");
	   myElement3.setAttribute('name',"alasan_berhenti_sebelumnya"+myLine2.value);
	   myElement3.setAttribute('id',"alasan_berhenti_sebelumnya"+myLine2.value);
	   myElement3.setAttribute('placeholder',"Alasan Berhenti");
	   myElement3.setAttribute('onblur',"this.value = this.value.toUpperCase()");
	   myElement3.setAttribute("style", "20");
	   mySpan2.appendChild(myElement3);
	   // Create input text
	   var myElement3 = document.createElement('textarea');
	   myElement3.setAttribute('type',"text");
	   myElement3.setAttribute('name',"jobdesk_sebelumnya"+myLine2.value);
	   myElement3.setAttribute('id',"jobdesk_sebelumnya"+myLine2.value);
	   myElement3.setAttribute('placeholder',"Jobdesk Sebelumnya");
	   myElement3.setAttribute('onblur',"this.value = this.value.toUpperCase()");
	   myElement3.setAttribute("style", "20");
	   mySpan2.appendChild(myElement3);
       // Create <br>
	   var myElement3 = document.createElement('br');
	   myElement3.setAttribute('id',"br"+myLine2.value);
	   mySpan2.appendChild(myElement3);
	   //myLine1.value++;
	   }
	   
	}
function deletepengalaman(){
		var mySpan2 = document.getElementById('mySpan2');
		var myLine2 = document.getElementById('hdnLinepeng2');
		
		{
			// Remove input text
			var deleteFile = document.getElementById("perusahaan"+myLine2.value);
			mySpan2.removeChild(deleteFile);
			// Remove input text
			var deleteFile = document.getElementById("gaji_sebelumnya"+myLine2.value);
			mySpan2.removeChild(deleteFile);
			// Remove input text
			var deleteFile = document.getElementById("jabatan_sebelumnya"+myLine2.value);
			mySpan2.removeChild(deleteFile);
			// Remove input text
			var deleteFile = document.getElementById("tahun_kerja_sebelumnya"+myLine2.value);
			mySpan2.removeChild(deleteFile);
			// Remove input text
			var deleteFile = document.getElementById("alasan_berhenti_sebelumnya"+myLine2.value);
			mySpan2.removeChild(deleteFile);
			// Remove input text
			var deleteFile = document.getElementById("jobdesk_sebelumnya"+myLine2.value);
			mySpan2.removeChild(deleteFile);

			// Remove <br>
			var deleteBr = document.getElementById("br"+myLine2.value);
			mySpan2.removeChild(deleteBr);
			myLine2.value--;
		}
}
