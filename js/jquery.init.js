jQuery(function($){
	$(document).ready(function(){
		
		/*tipsy*/
		$('.tooltip').tipsy({
			fade: false,
			gravity: 's'
		});
		
		/*give top bar opacity*/
		$(window).scroll(function () {
			if ($(this).scrollTop() > 45) {
				$('.top-bar-static').css({
					opacity: "0.95"
				});
			} else {
				$('#top-bar').css({
					opacity: "1"
				});
			}
		});
		
		/* superFish*/
		$("ul.sf-menu").superfish({ 
			autoArrows: true,
			animation:  {opacity:'show', height:'show'}
		});
		
		/*remove current menu class from drop-downs*/
		$("ul.sf-menu ul li").removeClass("current-menu-item");

		/* back to top*/
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('a[href=#toplink]').fadeIn();
			} else {
				$('a[href=#toplink]').fadeOut();
			}
		});
		$('a[href=#toplink]').on('click', function(){
			$('html, body').animate({scrollTop:0}, 'fast');
			return false;
		});
		
		/* portfolio hover*/
		$('.portfolio-item').hover(function(){
			$(this).find('img').stop(true, true).animate({opacity: 0.8},200) }
			,function(){
			$(this).find('img').stop(true, true).animate({opacity: 1},200)
		});
		
		/* PrettyPhoto Without gallery		*/
		$(".prettyphoto-link").prettyPhoto({
			theme: 'pp_default',
			animation_speed:'normal',
			allow_resize: true,
			keyboard_shortcuts: true,
			show_title: false,
			social_tools: false,
			slideshow: false,
			autoplay_slideshow: false
		});
	
		/*PrettyPhoto With Gallery*/
		$("a[rel^='prettyPhoto'],.gallery a").prettyPhoto({
			theme: 'pp_default',
			animation_speed:'normal',
			allow_resize: true,
			keyboard_shortcuts: true,
			show_title: false,
			slideshow: 5000,
			social_tools: false,
			autoplay_slideshow: false,
			overlay_gallery: true
		});
		
		/*opacity animations*/
		$('.home-entry img, .gallery-photo img, .loop-entry-thumbnail img, .post-thumbnail img').hover(function(){
			$(this).stop(true, true).animate({opacity: 0.8},500) }
			,function(){
			$(this).stop(true, true).animate({opacity: 1},500)
		});
		
		/* Toggle*/
		$(".toggle_container").hide(); 
		$("h3.trigger").click(function(){
			$(this).toggleClass("active").next().slideToggle("normal");
			return false;
		});
		
		/* Tabvs & Accordion*/			
		$( ".tabs" ).tabs({ fx: { height: 'toggle', opacity: 'toggle' } });
		$( ".accordion" ).accordion({
			autoHeight: false
		});
		
		/* Equal Heights*/
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
		equalHeight($(".pricing-content li"));
		equalHeight($(".pricing-header"));
		equalHeight($(".portfolio-item h3"));

		/*comment check*/
		$('#commentform').submit(function(e) {
			var $urlField = $(this).children('#url');
			if($urlField.val() == 'Website') {
				$urlField.val('')
			}
		});
	
	}); /* END doc ready*/
}); /* END function*/


/*flexslider JS*/
jQuery(function($){
	$(window).load(function() {
		
	/*homepage slides*/
	$('body.home #full-slides').flexslider({
		animation: "fade", /*Select your animation type (fade/slide)*/
		smoothHeight: true,
		slideDirection: "horizontal",   /*String: Select the sliding direction, "horizontal" or "vertical"*/
		slideshow: false, /*Should the slider animate automatically by default? (true/false)*/
		slideshowSpeed: 6000, /*Set the speed of the slideshow cycling, in milliseconds*/
		animationDuration: 800, /*Set the speed of animations, in milliseconds*/
		directionNav: true, /*Create navigation for previous/next navigation? (true/false)*/
		controlNav: false, /*Create navigation for paging control of each slide? (true/false)*/
		keyboardNav: true, /*Allow for keyboard navigation using left/right keys (true/false)*/
		touchSwipe: true, /*Touch swipe gestures for left/right slide navigation (true/false)*/
		prevText: "Previous", /*Set the text for the "previous" directionNav item*/
		nextText: "Next", /*Set the text for the "next" directionNav item*/
		pausePlay: false, /*Create pause/play dynamic element (true/false)*/
		pauseText: 'Pause', /*Set the text for the "pause" pausePlay item*/
		playText: 'Play', /*Set the text for the "play" pausePlay item*/
		randomize: false, /*Randomize slide order on page load? (true/false)*/
		slideToStart: 0, /*The slide that the slider should start on. Array notation (0 = first slide)*/
		animationLoop: true, /*Should the animation loop? If false, directionNav will received disabled classes when at either end (true/false)*/
		pauseOnAction: true, /*Pause the slideshow when interacting with control elements, highly recommended. (true/false)*/
		pauseOnHover: true /*Pause the slideshow when hovering over slider, then resume when no longer hovering (true/false)*/
	});
	
	/*page slides*/
	$('body.page #full-slides').flexslider({
		animation: "fade", /*Select your animation type (fade/slide)*/
		smoothHeight: true,
		slideDirection: "horizontal",   /*String: Select the sliding direction, "horizontal" or "vertical"*/
		slideshow: false, /*Should the slider animate automatically by default? (true/false)*/
		slideshowSpeed: 6000, /*Set the speed of the slideshow cycling, in milliseconds*/
		animationDuration: 800, /*Set the speed of animations, in milliseconds*/
		directionNav: true, /*Create navigation for previous/next navigation? (true/false)*/
		controlNav: false, /*Create navigation for paging control of each slide? (true/false)*/
		keyboardNav: true, /*Allow for keyboard navigation using left/right keys (true/false)*/
		touchSwipe: true, /*Touch swipe gestures for left/right slide navigation (true/false)*/
		prevText: "Previous", /*Set the text for the "previous" directionNav item*/
		nextText: "Next", /*Set the text for the "next" directionNav item*/
		pausePlay: false, /*Create pause/play dynamic element (true/false)*/
		pauseText: 'Pause', /*Set the text for the "pause" pausePlay item*/
		playText: 'Play', /*Set the text for the "play" pausePlay item*/
		randomize: false, /*Randomize slide order on page load? (true/false)*/
		slideToStart: 0, /*The slide that the slider should start on. Array notation (0 = first slide)*/
		animationLoop: true, /*Should the animation loop? If false, directionNav will received disabled classes when at either end (true/false)*/
		pauseOnAction: true, /*Pause the slideshow when interacting with control elements, highly recommended. (true/false)*/
		pauseOnHover: true /*Pause the slideshow when hovering over slider, then resume when no longer hovering (true/false)*/
	});
	
	/*portfolio full-width slides*/
	$('body.single-portfolio #full-slides').flexslider({
		animation: "fade", /*Select your animation type (fade/slide)*/
		smoothHeight: true,
		slideDirection: "horizontal",   /*String: Select the sliding direction, "horizontal" or "vertical"*/
		slideshow: false, /*Should the slider animate automatically by default? (true/false)*/
		slideshowSpeed: 6000, /*Set the speed of the slideshow cycling, in milliseconds*/
		animationDuration: 800, /*Set the speed of animations, in milliseconds*/
		directionNav: true, /*Create navigation for previous/next navigation? (true/false)*/
		controlNav: false, /*Create navigation for paging control of each slide? (true/false)*/
		keyboardNav: true, /*Allow for keyboard navigation using left/right keys (true/false)*/
		touchSwipe: true, /*Touch swipe gestures for left/right slide navigation (true/false)*/
		prevText: "Previous", /*Set the text for the "previous" directionNav item*/
		nextText: "Next", /*Set the text for the "next" directionNav item*/
		pausePlay: false, /*Create pause/play dynamic element (true/false)*/
		pauseText: 'Pause', /*Set the text for the "pause" pausePlay item*/
		playText: 'Play', /*Set the text for the "play" pausePlay item*/
		randomize: false, /*Randomize slide order on page load? (true/false)*/
		slideToStart: 0, /*The slide that the slider should start on. Array notation (0 = first slide)*/
		animationLoop: true, /*Should the animation loop? If false, directionNav will received disabled classes when at either end (true/false)*/
		pauseOnAction: true, /*Pause the slideshow when interacting with control elements, highly recommended. (true/false)*/
		pauseOnHover: true /*Pause the slideshow when hovering over slider, then resume when no longer hovering (true/false)*/
	});
		  
	/*portfolio slides*/
	$('#portfolio-slides').flexslider({
		animation: "fade",
		smoothHeight: false,
		slideshow: true,
		slideshowSpeed: 4000,
		animationDuration: 800,
		directionNav: false,
		controlNav: true,
		keyboardNav: false,
		touchSwipe: true,
		slideToStart: 0
	});
	
	});
});