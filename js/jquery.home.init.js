jQuery(function($){
	$(document).ready(function(){
		$('#home-portfolio-carousel').carouFredSel({
			circular: false,
			infinite: true,
			width: 720,
			wipe: true,
			items: {
				minimum: 3,
				visible: 3
			},
			pagination: {
			  easing: "easeInQuart",
			  duration: 1000,
			  items: 3,
			  container: "#carousel-pagination"
			},
			  prev    : {
				  button: "#carousel-prev",
				  key: "",
				  easing: "easeInQuart",
				  duration: 1000
		  },
		  next    : {
			  button: "#carousel-next",
			  key: "",
			  easing: "easeInQuart",
			  duration: 1000
		  },
			auto: false,
			scroll: {
			  duration: 1000
			}
		});
		var $carouselwidth = $('#carousel-pagination').outerWidth();
		$('#carousel-pagination').css("marginLeft", -$carouselwidth/2);	
	});
});