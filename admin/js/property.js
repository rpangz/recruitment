function DoAjax(skrip,filename,postto)
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
		if(xmlhttp.responseText.indexOf("|") > 0)
		{
			var response = xmlhttp.responseText;
			var jstring = "";var jparam = "";
			
			jstring = response.substring(response.indexOf("|")+1,response.indexOf("("));
			jparam = response.substring(response.indexOf("(")+1,response.indexOf(")"));
			
			var fnstring = jstring;
			var fnparams = jparam.split(",");
			var fn = window[fnstring];
			if (typeof fn === "function") fn.apply(null, fnparams);
			
			response = response.substring(0,response.indexOf("|"));
			document.getElementById(postto).innerHTML=response;
		}
		else
		{
    		document.getElementById(postto).innerHTML=xmlhttp.responseText;
		}
    }
  }
xmlhttp.open("GET",filename+".php?skrip="+skrip,true);
xmlhttp.send();
}

function UpdateStatusProyek(posisi)
{
	var status_proyek = document.getElementById('status_proyek'+''+posisi).value;
	var tanggal_pengerjaan = document.getElementById('tanggal_pengerjaan'+''+posisi).value;
	var no_status_proyek = document.getElementById('no_status_proyek'+posisi).value;
	var id_proyek = document.getElementById('id_proyek').value;
	
	var skrip = status_proyek + "|" + tanggal_pengerjaan + "|" + id_proyek + "|" + no_status_proyek + "|" + posisi + "|";
	var filename = "AjaxUpdateStatusProyek";
	var postto = "td"+""+posisi;
	DoAjax(skrip,filename,postto);	
}

function UpdateMaterial(posisi)
{	
	var nama_material = document.getElementById('nama_material'+''+posisi).value;
	var harga = document.getElementById('harga'+''+posisi).value;
	var satuan = document.getElementById('satuan'+''+posisi).value;
	var id_material = document.getElementById('id_material'+posisi).value;
	var id_supplier = document.getElementById('id_supplier').value;
	
	var skrip = nama_material + "|" + harga + "|" + satuan + "|" + id_supplier + "|" + id_material + "|" + posisi + "|";
	var filename = "AjaxUpdateMaterial";
	var postto = "td"+""+posisi;
	DoAjax(skrip,filename,postto);	
}

function DeleteMaterial(posisi)
{	
var result = confirm("Want to delete?");
if (result) {
	var id_material = document.getElementById('id_material'+posisi).value;
	var deletee = document.getElementById('delete'+''+posisi).value;
	var id_supplier = document.getElementById('id_supplier').value;
	
	var skrip = deletee + "|" + id_supplier + "|" + id_material + "|" + posisi + "|";
	var filename = "AjaxDeleteMaterial";
	var postto = "td"+""+posisi;
	DoAjax(skrip,filename,postto);	
}
}

function UpdateSupplier(posisi)
{	
	var nama_bank = document.getElementById('nama_bank'+''+posisi).value;
	var nama_supplier = document.getElementById('nama_supplier'+''+posisi).value;
	var alamat_supplier = document.getElementById('alamat_supplier'+''+posisi).value;
	var tempo_pembayaran = document.getElementById('tempo_pembayaran'+''+posisi).value;
	var sistem_pembayaran = document.getElementById('sistem_pembayaran'+''+posisi).value;
	var nomor_rekening = document.getElementById('nomor_rekening'+''+posisi).value;
	var nama_rekening = document.getElementById('nama_rekening'+''+posisi).value;
	var nomor_supplier = document.getElementById('nomor_supplier'+posisi).value;
	var id_supplier = document.getElementById('id_supplier').value;
	
	var skrip = nama_bank + "|" + nama_supplier + "|"  + alamat_supplier + "|"  + tempo_pembayaran + "|" + sistem_pembayaran + "|" + nomor_rekening + "|" + nama_rekening + "|" + id_supplier + "|" + nomor_supplier + "|" + posisi + "|";
	var filename = "AjaxUpdateSupplier";
	var postto = "sup"+""+posisi;
	DoAjax(skrip,filename,postto);	
}

function UpdateKontraktor(posisi)
{
	var nama_kontraktor = document.getElementById('nama_kontraktor'+''+posisi).value;
	var penanggung_jawab = document.getElementById('penanggung_jawab'+''+posisi).value;
	var status_penanggung = document.getElementById('status_penanggung'+''+posisi).value;
	var alamat_kontraktor = document.getElementById('alamat_kontraktor'+''+posisi).value;
	var lingkup_pekerjaan = document.getElementById('lingkup_pekerjaan'+''+posisi).value;
	var nama_bank = document.getElementById('nama_bank'+''+posisi).value;
	var nomor_rekening = document.getElementById('nomor_rekening'+''+posisi).value;
	var nama_rekening = document.getElementById('nama_rekening'+''+posisi).value;
	var nomor_kontraktor = document.getElementById('nomor_kontraktor'+posisi).value;
	var id_kontraktor = document.getElementById('id_kontraktor').value;
	
	var skrip = nama_kontraktor + "|" + penanggung_jawab + "|"  + status_penanggung + "|"  + alamat_kontraktor + "|" + lingkup_pekerjaan + "|" + nama_bank + "|" + nomor_rekening + "|" + nama_rekening + "|" + id_kontraktor +  "|" + nomor_kontraktor + "|" + posisi + "|";
	var filename = "AjaxUpdateKontraktor";
	var postto = "kon"+""+posisi;
	DoAjax(skrip,filename,postto);	
}

function UpdateGkontraktor(posisi)
{	
	var id_gambar = document.getElementById('id_gambar'+posisi).value;
	var keterangan_gambar_kontraktor = document.getElementById('keterangan_gambar_kontraktor'+''+posisi).value;
	var id_kontraktor = document.getElementById('id_kontraktor').value;
	
	var skrip = keterangan_gambar_kontraktor + "|" + id_kontraktor + "|" + id_gambar + "|" + posisi + "|";
	var filename = "AjaxUpdateDataKontraktorImage";
	var postto = "td"+""+posisi;
	DoAjax(skrip,filename,postto);	
}

function DeleteGkontraktor(posisi)
{	
var result = confirm("Want to delete?");
if (result) {
	var id_gambar = document.getElementById('id_gambar'+posisi).value;
	var deletee = document.getElementById('delete'+''+posisi).value;
	var id_kontraktor = document.getElementById('id_kontraktor').value;
	
	var skrip = deletee + "|" + id_kontraktor + "|" + id_gambar + "|" + posisi + "|";
	var filename = "AjaxDeleteDataKontraktorImage";
	var postto = "td"+""+posisi;
	DoAjax(skrip,filename,postto);	
}
    //Logic to delete the item
}