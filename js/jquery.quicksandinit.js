jQuery(function($){
	$(document).ready(function() {
		
		//set height on container via css to fix some bugs
		var $portfolioHeight = $("#portfolio-wrap").innerHeight();
		$(".portfolio-content").height($portfolioHeight)
		
		//Options for the portfolio filter
		var $filterType = $('#portfolio-cats a.active').attr('rel');
		var $holder = $('ul.portfolio-content');
		var $data = $holder.clone();
		
		$('#portfolio-cats li a').click(function(e) {
		$('#portfolio-cats a').removeClass('active');
			var $filterType = $(this).attr('rel');
			$(this).addClass('active');
			
			if ($filterType == 'all') {
				var $filteredData = $data.find('li');
			}
			else {
				var $filteredData = $data.find('li[data-type~=' + $filterType + ']');
			}
			
			$holder.quicksand($filteredData, {
				duration: 400,
				adjustHeight:"dynamic",
				easing: 'easeInOutQuad'
	
				}, function() {
				
				// callback functions here
				jQuery(function($){	
					//animation
					$('.portfolio-item img').hover(function() {
					$(this).stop(true, true).animate({opacity: 0.6},200) }
					,function(){
					$(this).stop(true, true).animate({opacity: 1},200)
					});
					
					//equal heights
					function equalHeight(group) {
						var tallest = 0;
						group.each(function() {
							var thisHeight = $(this).height();
							if(thisHeight > tallest) {
								tallest = thisHeight;
							}
						});
						group.height(tallest);
					}
					equalHeight($(".portfolio-item h3"));

				});
		  	});
		  
		  return false;
		});
	});
});