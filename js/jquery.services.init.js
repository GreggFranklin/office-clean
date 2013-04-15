jQuery(function($){
	$(document).ready(function(){
		
		/*incoming URL*/
		$("#service-content article").hide();
		if(location.hash != "") {
			$(location.hash + ":hidden").show();
			$('a[href$="'+location.hash+'"]').parent().addClass('active');
		}
		
		/*set active state of current tab*/
		if(location.hash == "") {
			$('ul#service-tabs li:first').addClass('active');
			$('#tab-1.service-tab-content').show();
		}
		 
		/*Handle tab clicking*/
		$('ul#service-tabs a').click(function(){
			$('ul#service-tabs li').removeClass('active');
			$(this).parent().addClass('active');
			var currentTab = $(this).attr('href');
			$('#service-content .service-tab-content').hide();
			$(currentTab).fadeIn(1000);
			return false;
		});
		
	});
});