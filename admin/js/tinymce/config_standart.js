// JavaScript Document

tinymce.init({
  selector: 'textarea',
  theme: 'modern', 
	width: 800,
	height: 280,
	subfolder:"gambar", 
	
  plugins: [
		"advlist autolink link image lists charmap print preview hr anchor pagebreak",
		"searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking",
		"table contextmenu directionality emoticons paste textcolor filemanager" 
    ],
	image_advtab: true, 
	
	
    toolbar: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect forecolor backcolor | link unlink anchor | image media | print preview code" ,
  imagetools_cors_hosts: ['www.tinymce.com', 'codepen.io'],
  content_css: [
    '//www.tinymce.com/css/codepen.min.css'
  ]
});
