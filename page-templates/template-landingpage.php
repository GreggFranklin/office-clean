<?php
/**
 * @package WordPress
 * @subpackage Office Theme
 * Template Name: Landing Page
 */
 
 global $data; //get theme options
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<?php if($data['disable_responsive'] !='disable') { ?>
<!-- Mobile Specific
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!--[if lt IE 9]>
	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->
<?php } ?>

<!-- Title Tag
================================================== -->
<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' |'; } ?> <?php bloginfo('name'); ?></title>


<?php if(!empty($data['custom_favicon'])) { ?>
<!-- Favicon
================================================== -->
<link rel="icon" type="image/png" href="<?php echo $data['custom_favicon']; ?>" /><?php } ?>


<!-- Main CSS
================================================== -->
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />

<!--[if IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie8.css" media="screen" />
<![endif]-->

<!--[if IE 7]>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie7.css" media="screen" />
<![endif]-->

<!-- WP Head
================================================== -->
<?php if ( is_single() || is_page() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>


<?php 
//show tracking code - header 
echo stripslashes($data['tracking_header']); 
?>

</head>


<!-- Begin Body
================================================== -->
<body <?php body_class(); ?>>

<div id="wrap" class="clearfix" style="margin-top: 30px;">
    
	<div class="container clearfix fitvids">

		<?php
		//start page loop
		if (have_posts()) : while (have_posts()) : the_post();
		
		//get slider meta
		$page_slider = get_post_meta($post->ID, 'office_page_slider', true);
		
		//show page slider if enabled
		if ($page_slider == 'enable') {
			//get slider template
			get_template_part( 'includes/page-slides');
		}
        ?>
        
        <article class="post full-width clearfix">
        
            <div class="entry clearfix">
                <?php the_content(); ?>
            </div>
            <!-- /entry -->
            
        </article>
        <!-- /post -->
        
        <?php endwhile; ?>
        <?php endif; ?>
        
	</div><!-- /container -->
</div><!-- /wrap -->
<?php 
//show tracking code - footer 
echo stripslashes($data['tracking_footer']); 
?>

<!-- WP Footer -->
<?php wp_footer(); ?>
</body>
</html>