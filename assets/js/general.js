$(document).ready(function () {
//sub menu show hide
	$('ul#topmenu li.headlink').hover 
	(		
		function () {
			$('ul.submenu', this).show();
		},
		function () {
			$('ul.submenu', this).hide();
		}
	);	
	
	//subsubmenu
	$('ul.submenu li.headlink').hover 
	(		
		function () {
			$('ul.subsubmenu', this).show();
		},
		function () {
			$('ul.subsubmenu', this).hide();
		}
	);
	$('ul.subsubmenu li').click ( function () 
	{
		if ($(this).attr('lang')!='')
			window.location = $(this).attr('lang');
	});
	
	$('div.detailpage-submenu-item .title, div.detailpage-submenu-item-active .title').click(function(e) {
		var all_menu_list = $('ul.detailpage-submenu-list');
		var target = $(this).next();
		var display = target.css('display');
		
		all_menu_list.css('display','none');
		//target.css('display','block');
		target.slideDown("fast");
		if(display != 'block') {
			target.css('display','block');
			//target.slideUp('fast', function() {
				target.slideDown("fast");
			//});
		}  
	});
});
	/*********** handle show hide submenu in detail page ***/

	function isNumberKey(evt)
	{
		var charCode = evt.which;
		if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
	
		return true;
	}
	
	function isNumberCommaKey(evt,currency)
	{
		var charCode = evt.which;
		if (charCode > 31 && (charCode < 48 || charCode > 57)){
			if(charCode != 44){
				return false;
			}else{
				if(currency != "IDR" && currency != "JPY"){
					return true;
				}else{
					return false;
				}
			}
		}else{
			return true
		}
	}