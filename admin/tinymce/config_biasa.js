// JavaScript Document

tinymce.init({
  selector: 'textarea',
  theme: 'modern', 
	width: 800,
	height: 280,
	subfolder:"images", 
	
  plugins: [
		"advlist autolink lists charmap print preview pagebreak",
		"searchreplace wordcount visualblocks visualchars code insertdatetime nonbreaking",
		"table contextmenu directionality emoticons paste textcolor" 
    ],
	image_advtab: true, 
	
	
    toolbar: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect forecolor | print preview code" ,
  imagetools_cors_hosts: ['www.tinymce.com', 'codepen.io'],
  content_css: [
    '//www.tinymce.com/css/codepen.min.css'
  ]
});
