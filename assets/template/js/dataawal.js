
$(document).ready(function(){ 
						   
	$("ul#sidebar li").each(function() {
		$(this).on("click", function(){
			var link = $(this).val();
			hideAnotherLi();
			console.log(link);
			showCurrentLi(link);
			
		});
	});
	
	function hideAnotherLi(){
		$(".contentbar").each(function() {
			$(this).addClass("hidden");
		});
	}
	
	function showCurrentLi(liId){
		$("#"+liId).removeClass("hidden");
	}
	
});


