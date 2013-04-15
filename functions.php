<?php
/**
 * @package WordPress
 * @subpackage Office Theme
*/

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width )) 
    $content_width = 980;

//get theme options
global $data;


/*-----------------------------------------------------------------------------------*/
/*	Images
/*-----------------------------------------------------------------------------------*/
if ( function_exists( 'add_theme_support' ))
	add_theme_support( 'post-thumbnails' );

if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'full-size',  9999, 9999, false );
	add_image_size( 'small-thumb',  54, 54, true );
	add_image_size( 'slider',  970, 9999, false );
	add_image_size( 'post-image',  660, 220, true );
	add_image_size( 'blog-thumb',  280, 92, true );
	add_image_size( 'grid-thumb',  215, 140, true );
	add_image_size( 'gallery-thumb',  205, 140, true );
	add_image_size( 'staff-thumb',  100, 100, true );
	add_image_size( 'portfolio-single',  500, 9999, false );
}



/*-----------------------------------------------------------------------------------*/
/*	Javascsript
/*-----------------------------------------------------------------------------------*/

function office_scripts_function() {
	
	//get theme options
	global $data;
	
	//enqueue jQuery
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-accordion');
	wp_enqueue_script('jquery-ui-tabs');
	
	// Site wide js+
	wp_enqueue_script('easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array('jquery'), '1.3', true);
	wp_enqueue_script('hoverIntent', get_template_directory_uri() . '/js/jquery.hoverIntent.minified.js', array('jquery'), 'r6', true);
	wp_enqueue_script('superfish', get_template_directory_uri() . '/js/jquery.superfish.js', array('jquery'), '1.4.8', true);
	wp_enqueue_script('prettyphoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', array('jquery'), '3.1', true);
	wp_enqueue_script('tipsy', get_template_directory_uri() . '/js/jquery.tipsy.js', array('jquery'), '1.0', true);
	wp_enqueue_script('fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array('jquery'), 1.0, true);
	wp_enqueue_script('flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array('jquery'), '1.8', true);
	
	//responsive
	if($data['disable_responsive'] !='disable') {
		wp_enqueue_script('uniform', get_template_directory_uri() . '/js/jquery.uniform.js', array('jquery'), '1.7.5', true);
		wp_enqueue_script('responsify', get_template_directory_uri() . '/js/jquery.responsify.init.js', array('jquery'), '', true);
	}
	
	//  Register scripts for homepage carousel
	wp_register_script('homeinit', get_template_directory_uri() . '/js/jquery.home.init.js', array('jquery'), '1.0', true);
	wp_register_script('carouFredSel', get_template_directory_uri() . '/js/jquery.carouFredSel-5.5.0-packed.js', array('jquery'), '5.5.0', true);
	
	//services
	if(is_page_template('template-services.php') || is_tax('service_cats')) {
		wp_enqueue_script('servicesinit', get_template_directory_uri() . '/js/jquery.services.init.js', array('jquery'), '2.0', true);
	}
	
	//staff
	if(is_page_template('template-staff.php' || is_page_template('template-staff-by-department')) || is_tax('staff_departments')) {
		wp_enqueue_script('staffinit', get_template_directory_uri() . '/js/jquery.staff.init.js', array('jquery'), '', true);
	}

	//portfolio main
	if(is_page_template('template-portfolio-with-filter.php')) {
		wp_enqueue_script('isotope',  get_template_directory_uri() . '/js/jquery.isotope.min.js', array('jquery','easing'), '1.5.19', true);
		wp_enqueue_script('isotope-portfolio',  get_template_directory_uri() . '/js/jquery.isotope.portfolio.js', array('jquery','easing','isotope'), '1.0', true);
	}
	
	//faqs
	if(is_page_template('template-faqs.php')) {
		wp_enqueue_script('faqsinit', get_template_directory_uri() . '/js/jquery.faqs.init.js', array('jquery'), '1.0', true);
		wp_enqueue_script('quicksand', get_template_directory_uri() . '/js/jquery.quicksand.js', array('jquery'), '1.2.2', true);
		wp_enqueue_script('quicksandinit', get_template_directory_uri() . '/js/jquery.quicksandinit.faqs.js', array('jquery','quicksand'), '1.0', true);
	}
	
	//testimonials widget
	if(is_active_widget( '', '', 'office_testimonials' ) ) {
        	wp_enqueue_script('testimonials-widget', get_template_directory_uri() . '/js/jquery.testimonials.widget.js', array('jquery'), '1.0', true);
    }
	
	//load comment reply js
	if(is_single() || is_page()) {
		wp_enqueue_script('comment-reply');
	}

	//js init
	wp_enqueue_script('init', get_template_directory_uri() . '/js/jquery.init.js', array('jquery'), '1.0', true);

}


add_action('wp_enqueue_scripts','office_scripts_function');


/*-----------------------------------------------------------------------------------*/
/*Enqueue CSS
/*-----------------------------------------------------------------------------------*/
add_action('wp_enqueue_scripts', 'office_enqueue_css');
function office_enqueue_css() {
	
	//get theme options
	global $data;
	
	//responsive
	if($data['disable_responsive'] !='disable') {
		wp_enqueue_style('responsive', get_template_directory_uri() . '/css/responsive.css', 'style');
	}
	
	//prettyPhoto
	wp_enqueue_style('prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css', 'style');
	
	//css3 buttons
	wp_enqueue_style('gh-buttons', get_template_directory_uri() . '/css/gh-buttons.css', 'style');
	
}

/*-----------------------------------------------------------------------------------*/
/*	Output Custom CSS Into Header
/*-----------------------------------------------------------------------------------*/

add_action('wp_head', 'office_custom_css');
function office_custom_css() {
	
		//get theme options
		global $data;
		
		$custom_css ='';
		
		/**custom css field**/
		if(!empty($data['custom_css'])) {
			$custom_css .= $data['custom_css'];
		}
		
		//background
		if(!empty($data['custom_bg'])) {
			if($data['custom_bg'] !=''.get_template_directory_uri().'/images/bg/bg_20.png') {
				$custom_css .= 'body{background-image: url('.$data['custom_bg'].');}';
			} else {
				$custom_css .= 'body{background-image: none;}';
			}
		}
		if($data['background_color'] != '#d9d9d9') {
			$custom_css .= 'body{background-color: '.$data['background_color'].';}';
		}
		
		//background pattern
		if($data['disable_background_pattern'] == 'disable') {
			$custom_css .= '#header, .container{background-image: none;}';
		}
		
		//main shadow
		if($data['disable_main_shadow'] == 'disable') {
			$custom_css .= '#wrap, #header{-webkit-box-shadow: none;-moz-box-shadow: none;box-shadow: none;}';
		}
		
		//header padding
		if(!empty($data['header_padding']) && $data['header_padding'] != '25px'){
			$custom_css .= '#header{padding-top: '.$data['header_padding'].'; padding-bottom: '.$data['header_padding'].';}';
		}
		
		//logo margin
		if(!empty($data['logo_top_margin']) && $data['logo_top_margin'] != '0px'){
			$custom_css .= '#logo{margin-top: '.$data['logo_top_margin'].';}';
		}
		
		//header-aside
		if(!empty($data['header_aside_margin']) && $data['header_aside_margin'] != '0px'){
			$custom_css .= '#header-aside{margin-top: '.$data['header_aside_margin'].';}';
		}
		
		//highlight color
		if($data['highlight_color'] !='#fc6440') {
			$custom_css .= 'a#top-bar-callout, #navigation .current-menu-item > a, #service-tabs li.active a, .heading a:hover span, .post-date, #carousel-pagination a.selected,#full-slides .prev:hover, #full-slides .next:hover, #faqs-cats a:hover,#faqs-cats .active{ background-color: '.$data['highlight_color'].'; }';
			$custom_css .= '.office-flickr-widget a:hover, .widget-recent-portfolio a:hover, .home-entry a:hover img, .loop-entry-thumbnail a:hover img, ul.filter a.active, .gallery-photo a:hover img{ border-color: '.$data['highlight_color'].' !important;}';
			$custom_css .= '#faqs-cats .active:after{ border-top-color: '.$data['highlight_color'].' !important;}';
		}	
		
		//body link color
		if($data['home_tagline_link_color'] !='#fc6440') {
			$custom_css .= '#home-tagline a{color: '.$data['home_tagline_link_color'].';border-color: '.$data['home_tagline_link_color'].';}';
		}
		
		//homepage tagline link color
		if($data['main_link_color'] !='#ec651b') {
			$custom_css .= 'body p a, #breadcrumbs a, #sidebar a, .comment-author .url, .comment-reply-link{color: '.$data['main_link_color'].';}';
			$custom_css .='.tagcloud a{color: inherit !important;}';
		}
		
		//navigation color
		if($data['nav_bg_color'] !='#2b2b2b') {
			$custom_css .= '#navigation, .sf-menu, #navigation a, #navigation .selector option{background-color: '.$data['nav_bg_color'].' !important;}';
		}
		if($data['nav_hover_color'] !='#444') {
			$custom_css .= '#navigation a:hover{background-color: '.$data['nav_hover_color'].' !important;}';
		}
		if($data['nav_link_color'] !='#FFF') {
			$custom_css .= '#navigation a{color: '.$data['nav_link_color'].' !important;}';
		}
		if($data['nav_current_background_color'] !='#fc6440') {
			$custom_css .= '#navigation .current-menu-item > a{ background-color: '.$data['nav_current_background_color'].' !important;}';
		}
		if($data['nav_current_link_color'] !='#FFF') {
			$custom_css .= '#navigation .current-menu-item > a{ color: '.$data['nav_current_link_color'].' !important;}';
		}
		if($data['nav_light_border_color']!='#3c3c3c') {
			$custom_css .= '.sf-menu { border-color: '.$data['nav_light_border_color'].' !important;} .sf-menu a { border-left-color: '.$data['nav_light_border_color'].' !important;}.sf-menu ul a{ border-top-color: '.$data['nav_light_border_color'].' !important;}';
		}
		if($data['nav_dark_border_color'] !='#111') {
			$custom_css .= '.sf-menu a { border-right-color: '.$data['nav_dark_border_color'].' !important;}.sf-menu ul a{ border-bottom-color: '.$data['nav_dark_border_color'].' !important;}.sf-menu ul, .sf-menu ul ul{border-top-color: '.$data['nav_dark_border_color'].' !important;}';
		}
		
		//slider caption color
		if($data['slider_caption_background_color'] !='#000') {
			$custom_css .= '#full-slides .caption{ background: '.$data['slider_caption_background_color'].';}';
		}
		if($data['slider_caption_color'] !='#FFF') {
			$custom_css .= '#full-slides .caption, #full-slides .caption h2, #full-slides .caption h3{ color: '.$data['slider_caption_color'].';}';
		}
		
		//menu border
		if($data['disable_menu_last_border'] == 'disable') {
			$custom_css .= '.sf-menu li:last-child a, .sf-menu{ border-right: none; }';
		}
		
		//sidebar location
		if($data['sidebar_position'] == 'left') {
			$custom_css .= '#sidebar {float: left;} .post{ float: right;}';
		}
		
		//Font Variables
		$body_font = $data['body_font'];
		$headings_font = $data['headings_font'];
		$callout_font = $data['callout_font'];
		$navigation_font = $data['navigation_font'];
		$slider_caption_font = $data['slider_caption_font'];
		$tagline_font = $data['tagline_font'];
		
		//font face-types
		if($body_font['face'] && $body_font['face'] != 'default'){
			$custom_css .= 'body{font-family: '.$body_font['face'].';}';
		}	
			
		if($headings_font['face'] && $headings_font['face'] != 'default'){
			$custom_css .= 'h1,h2,h3,h4,h5,h6{font-family: '.$headings_font['face'].' !important;}';
		}
		
		if($callout_font['face'] && $callout_font['face'] != 'default'){
			$custom_css .= '#top-bar-callout{font-family: '.$callout_font['face'].' !important;}';
		}
		
		if($navigation_font['face'] && $navigation_font['face'] != 'default'){
			$custom_css .= '#navigation{font-family: '.$navigation_font['face'].' !important;}';
		}	
		
		if($slider_caption_font['face'] && $slider_caption_font['face'] != 'default'){
			$custom_css .= '#full-slides .caption{font-family: '.$slider_caption_font['face'].' !important;}';
		}	
		
		if($tagline_font['face'] && $tagline_font['face'] != 'default'){
			$custom_css .= '#home-tagline{font-family: '.$tagline_font['face'].' !important;}';
		}	
		
		//font weights
		if($body_font['style'] == 'italic'){
			$custom_css .= 'body{font-style: italic; font-weight: normal;}';
		}
		if($body_font['style'] == 'bold'){
			$custom_css .= 'body{font-weight: bold;}';
		}
		if($body_font['style'] == 'bold italic'){
			$custom_css .= 'body{font-weight: bold;font-style: italic;}';
		}
		
		
		if($headings_font['style'] == 'normal'){
			$custom_css .= 'h1,h2,h3,h4,h5,h6{font-weight: normal;}';
		}
		if($headings_font['style'] == 'italic'){
			$custom_css .= 'h1,h2,h3,h4,h5,h6{font-style: italic; font-weight: nomal;}';
		}
		if($headings_font['style'] == 'bold italic'){
			$custom_css .= 'h1,h2,h3,h4,h5,h6{font-weight: bold;font-style: italic;}';
		}
		
		
		if($callout_font['style'] == 'normal'){
			$custom_css .= '#top-bar-callout{font-weight: normal;}';
		}
		if($callout_font['style'] == 'italic'){
			$custom_css .= '#top-bar-callout{font-style: italic; font-weight: normal;}';
		}
		if($callout_font['style'] == 'bold italic'){
			$custom_css .= '#top-bar-callout{font-weight: bold;font-style: italic;}';
		}
		
		
		if($navigation_font['style'] == 'italic'){
			$custom_css .= '#navigation,#navigation a{font-style: italic; font-weight: normal;}';
		}
		if($navigation_font['style'] == 'normal'){
			$custom_css .= '#navigation, #navigation a{font-weight: normal;}';
		}
		if($navigation_font['style'] == 'bold italic'){
			$custom_css .= '#navigation, #navigation a{font-weight: bold;font-style: italic;}';
		}
		
		
		if($slider_caption_font['style'] == 'italic'){
			$custom_css .= '#full-slides .caption{font-style: italic; font-weight: normal;}';
		}
		if($slider_caption_font['style'] == 'bold'){
			$custom_css .= '#full-slides .caption{font-weight: bold;}';
		}
		if($slider_caption_font['style'] == 'bold italic'){
			$custom_css .= '#full-slides .caption{font-weight: bold;font-style: italic;}';
		}
		
		
		if($tagline_font['style'] == 'italic'){
			$custom_css .= '#home-tagline{font-style: italic; font-weight: normal;}';
		}
		if($tagline_font['style'] == 'bold'){
			$custom_css .= '#home-tagline{font-weight: bold;}';
		}
		if($tagline_font['style'] == 'bold italic'){
			$custom_css .= '#home-tagline{font-weight: bold;font-style: italic;}';
		}
		
		//font sizes
		if($callout_font['size'] != '13px'){
			$custom_css .= 'a#top-bar-callout{font-size: '.$callout_font['size'].';}';
		}
		
		if($navigation_font['size'] != '13px'){
			$custom_css .= '#navigation, #navigation a{font-size: '.$navigation_font['size'].';}';
		}
		
		if($slider_caption_font['size'] != '14px'){
			$custom_css .= '#full-slides .caption{font-size: '.$slider_caption_font['size'].';}';
		}
		
		if($tagline_font['size'] != '28px'){
			$custom_css .= '#home-tagline{font-size: '.$tagline_font['size'].';}';
		}

		
		/**echo all css**/
		$css_output = "<!-- Custom CSS -->\n<style type=\"text/css\">\n" . $custom_css . "\n</style>";
		
		if(!empty($custom_css)) {
			echo $css_output;
		}
}


/*-----------------------------------------------------------------------------------*/
/*	Sidebars
/*-----------------------------------------------------------------------------------*/

//Register Sidebars
if ( function_exists('register_sidebar'))
	register_sidebar(array(
		'name' => 'Sidebar',
		'id' => 'sidebar',
		'description' => 'Widgets in this area will be shown in the sidebar.',
		'before_widget' => '<div class="sidebar-box %2$s clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h4><span>',
		'after_title' => '</span></h4>',
));
if ( function_exists('register_sidebar'))
	register_sidebar(array(
		'name' => 'Footer Left',
		'id' => 'footer-left',
		'description' => 'Widgets in this area will be shown in the footer left area.',
		'before_widget' => '<div class="footer-widget %2$s clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
));
if ( function_exists('register_sidebar'))
	register_sidebar(array(
		'name' => 'Footer Middle',
		'id' => 'footer-middle',
		'description' => 'Widgets in this area will be shown in the footer middle area.',
		'before_widget' => '<div class="footer-widget %2$s clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
));
if ( function_exists('register_sidebar'))
	register_sidebar(array(
		'name' => 'Footer Right',
		'id' => 'footer-right',
		'description' => 'Widgets in this area will be shown in the footer right area.',
		'before_widget' => '<div class="footer-widget %2$s clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
));

/*-----------------------------------------------------------------------------------*/
/*	Gallery MetaBox Support
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'custom_be_gallery_metabox_post_types' ) ) :
	function custom_be_gallery_metabox_post_types( $classes ) {
			return array('portfolio','page');
	}
	add_filter( 'be_gallery_metabox_post_types', 'custom_be_gallery_metabox_post_types' );
endif;


/*-----------------------------------------------------------------------------------*/
/*	Post Type Pagination
/*-----------------------------------------------------------------------------------*/

// Set number of posts per page for taxonomy pages
$option_posts_per_page = get_option( 'posts_per_page' );
add_action( 'init', 'office_modify_posts_per_page', 0);
function office_modify_posts_per_page() {
    add_filter( 'option_posts_per_page', 'office_option_posts_per_page' );
}
function office_option_posts_per_page( $value ) {
	global $data;
	global $option_posts_per_page;
	
	// Get theme panel admin
	if($data['portfolio_cat_pagination']) {
		$portfolio_posts_per_page = $data['portfolio_cat_pagination'];
		} else {
			$portfolio_posts_per_page = '-1';
			}
	
    if (is_tax( 'portfolio_cats') ) {
        return $portfolio_posts_per_page;
    }
	if (is_tax( 'staff_departments')) {
		return -1;
	}
	else {
        return $option_posts_per_page;
    }
}


/*-----------------------------------------------------------------------------------*/
/*	Custom Login Logo
/*-----------------------------------------------------------------------------------*/
function wpex_custom_login_logo() {

    global $data;
    if($data['custom_login_logo'] !='') {
        $custom_login_logo_css = '';
        $custom_login_logo_css .= '<style type="text/css">';
        $custom_login_logo_css .= 'h1 a {';
        $custom_login_logo_css .= 'background-image:url('. $data['custom_login_logo'] .') !important;width: auto !important;background-size: auto !important;';
        if($data['custom_login_logo_height']) {
            $custom_login_logo_css .= 'height: '.$data['custom_login_logo_height'].' !important;';
        }
        $custom_login_logo_css .= '}</style>';

        echo $custom_login_logo_css;
    }
}

add_action('login_head', 'wpex_custom_login_logo');


/*-----------------------------------------------------------------------------------*/
/*	Add taxonomy filter - thanks Pippin!
/*-----------------------------------------------------------------------------------*/
function office_add_taxonomy_filters() {
	global $typenow;

	if( $typenow == 'services' || $typenow == 'portfolio' || $typenow == 'staff' || $typenow == 'faqs' ){
		if( $typenow == 'portfolio') { $taxonomies = array('portfolio_cats'); }
		if( $typenow == 'services') { $taxonomies = array('service_cats'); }
		if( $typenow == 'staff') { $taxonomies = array('staff_departments'); }
		if( $typenow == 'faqs') { $taxonomies = array('faqs_cats'); }
		
 
		foreach ($taxonomies as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);
			if(count($terms) > 0) {
				echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
				echo "<option value=''>All Categories</option>";
				foreach ($terms as $term) { 
					echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>'; 
				}
				echo "</select>";
			}
		}
	}
}
add_action( 'restrict_manage_posts', 'office_add_taxonomy_filters' );

/*-----------------------------------------------------------------------------------*/
/*	Other functions
/*-----------------------------------------------------------------------------------*/

//enable more post editor buttons
add_filter("mce_buttons_3", "enable_more_buttons");
function enable_more_buttons($buttons) {
  $buttons[] = 'fontselect';
  $buttons[] = 'fontsizeselect';
  return $buttons;
}


// Limit Post Word Count
add_filter('excerpt_length', 'new_excerpt_length');
function new_excerpt_length($length) {
	
	global $data;
	return $data['blog_excerpt'];
}

//Replace Excerpt Link
add_filter('excerpt_more', 'new_excerpt_more');
function new_excerpt_more($more) {
	global $post;
	return '...<a href="'. get_permalink($post->ID) . '">'.__('read more','office').' &rarr;</a>';
}

// Enable Custom Background
add_theme_support( 'custom-background');

// register navigation menus
register_nav_menus(
	array(
	'top_menu' => __('Top','office'),
	'main_menu' => __('Main','office'),
	'footer_menu' => __('Footer','office')
	)
);

/// add home link to menu
add_filter( 'wp_page_menu_args', 'home_page_menu_args' );
function home_page_menu_args( $args ) {
$args['show_home'] = true;
return $args;
}

// menu fallback
function default_menu() {
	require_once (TEMPLATEPATH . '/includes/default-menu.php');
}


// Localization Support
load_theme_textdomain( 'office', TEMPLATEPATH.'/lang' );

// functions run on activation --> important flush to clear rewrites
if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {
	$wp_rewrite->flush_rules();
}

/*-----------------------------------------------------------------------------------*/
/*	Include functions
/*-----------------------------------------------------------------------------------*/

// Recommended plugins
require_once ( get_template_directory() .'/functions/recommend-plugins.php');

// Admin Options
require_once ( get_template_directory() .'/admin/index.php');

// Common files
require_once( get_template_directory() .'/functions/pagination.php');
require_once( get_template_directory() .'/functions/shortcodes.php');
require_once( get_template_directory() .'/functions/breadcrumbs.php');
require_once( get_template_directory() .'/functions/custom-excerpts.php');
require_once( get_template_directory() .'/functions/widgets/flickr-widget.php');
require_once( get_template_directory() .'/functions/widgets/testimonials.php');
require_once( get_template_directory() .'/functions/widgets/recent-portfolio.php');

// Load files ONLY in the back-end
if ( defined( 'WP_ADMIN' ) && WP_ADMIN ) {
	require_once( get_template_directory() .'/mce/shortcode-popup.php');
}