function PreviewImage() {
	  
	   	var mySpan1 = document.getElementById('mySpan1');
	   	var myLine1 = document.getElementById('hdnLine1');{
		var oFReader = new FileReader();
				oFReader.readAsDataURL(document.getElementById("gambar"+myLine1.value).files[0]);

				oFReader.onload = function (oFREvent) {
				document.getElementById("uploadPreview").src = oFREvent.target.result;
				}}
				}

function lmpCreateElement(){
	  
	   var mySpan1 = document.getElementById('mySpan1');
	   var myLine1 = document.getElementById('hdnLine1');
	  
	   {	
	   myLine1.value++;
	   // Create input file
	   var myElement2 = document.createElement('input');
	   myElement2.setAttribute('type',"file");
	   myElement2.setAttribute('name',"gambar"+myLine1.value);
	   myElement2.setAttribute('id',"gambar"+myLine1.value);
	   myElement2.setAttribute('size', "45");
	   mySpan1.appendChild(myElement2);	
	   // Create input text
	   var myElement2 = document.createElement('input');
	   myElement2.setAttribute('type',"text");
	   myElement2.setAttribute('name',"keterangan_gambar"+myLine1.value);
	   myElement2.setAttribute('id',"keterangan_gambar"+myLine1.value);
	   myElement2.setAttribute('onblur',"this.value = this.value.toUpperCase()");
	   myElement2.setAttribute("style", "width:200px;");
	   mySpan1.appendChild(myElement2);  
       // Create <br>
	   var myElement3 = document.createElement('br');
	   myElement3.setAttribute('id',"br"+myLine1.value);
	   mySpan1.appendChild(myElement3);
	   //myLine1.value++;
	   
	   var myElement3 = document.createElement('br');
	   myElement3.setAttribute('id',"br"+myLine1.value);
	   mySpan1.appendChild(myElement3);
	   //myLine1.value++;
	   }
	   
	}
function lmpDeleteElement(){
		var mySpan1 = document.getElementById('mySpan1');
		var myLine1 = document.getElementById('hdnLine1');
		
		{
			// Remove input file
			var deleteFile = document.getElementById("gambar"+myLine1.value);
			mySpan1.removeChild(deleteFile);
			// Remove input text
			var deleteFile = document.getElementById("keterangan_gambar"+myLine1.value);
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
	   var myLine2 = document.getElementById('hdnLine2');
	  
	   {	
	   myLine2.value++;
	   // Create input file
	   var myElement3 = document.createElement('input');
	   myElement3.setAttribute('type',"file");
	   myElement3.setAttribute('name',"gambara"+myLine2.value);
	   myElement3.setAttribute('id',"gambara"+myLine2.value);
	   myElement3.setAttribute('size', "45");
	   mySpan2.appendChild(myElement3);	
	   // Create input text
	   var myElement3 = document.createElement('input');
	   myElement3.setAttribute('type',"text");
	   myElement3.setAttribute('name',"keterangan_gambara"+myLine2.value);
	   myElement3.setAttribute('id',"keterangan_gambara"+myLine2.value);
	   myElement3.setAttribute('onblur',"this.value = this.value.toUpperCase()");
	   myElement3.setAttribute("style", "width:165px;");
	   mySpan2.appendChild(myElement3);  

       // Create <br>
	   var myElement3 = document.createElement('br');
	   myElement3.setAttribute('id',"br"+myLine2.value);
	   mySpan2.appendChild(myElement3);
	   //myLine2.value++;
	   
       // Create <br>
	   var myElement3 = document.createElement('br');
	   myElement3.setAttribute('id',"br"+myLine2.value);
	   mySpan2.appendChild(myElement3);
	   //myLine2.value++;
	   
	   }
	   
	}
function lmpDeleteElement2(){
		var mySpan2 = document.getElementById('mySpan2');
		var myLine2 = document.getElementById('hdnLine2');
		
		{
			// Remove input file
			var deleteFile = document.getElementById("gambara"+myLine2.value);
			mySpan2.removeChild(deleteFile);
			// Remove input text
			var deleteFile = document.getElementById("keterangan_gambara"+myLine2.value);
			mySpan2.removeChild(deleteFile);

			// Remove <br>
			var deleteBr = document.getElementById("br"+myLine2.value);
			mySpan2.removeChild(deleteBr);
			myLine2.value--;
		}
	}