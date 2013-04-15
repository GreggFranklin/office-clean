<?php
/**
 * @package WordPress
 * @subpackage Office Theme
 */
global $data; //get theme options ?>

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
        <link rel="icon" type="image/png" href="<?php echo $data['custom_favicon']; ?>" />
    <?php } ?>
    
    <!-- Main CSS
    ================================================== -->
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
    
    <!--[if IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie8.css" media="screen" />
    <![endif]-->
    
    <!--[if IE 7]>
        <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie7.css" media="screen" />
    <![endif]-->
    
    <!-- Load HTML5 dependancies for IE
    ================================================== -->
    <!--[if IE]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <!--[if lte IE 7]>
        <script src="js/IE8.js" type="text/javascript"></script><![endif]-->
    <!--[if lt IE 7]>
        <link rel="stylesheet" type="text/css" media="all" href="css/ie6.css"/>
    <![endif]-->
    
    <!-- WP Head
    ================================================== -->
    <?php
    //Custom Google Fonts
    get_template_part( 'includes/custom-fonts');

	//header hook <== do not remove me!!
	wp_head();
	
	?>

</head>

<!-- Begin Body
================================================== -->
<body <?php body_class(); ?>>

<?php if($data['disable_top_bar'] != 'disable') { ?>
<div id="top-bar" <?php if($data['top_bar_position'] == 'fixed') { echo 'class="top-bar-fixed"'; } ?>>

	<div id="top-bar-inner">
        <?php if(!empty($data['callout_link'])) { ?><a href="<?php echo $data['callout_link']; ?>" id="top-bar-callout" title="<?php echo $data['callout_text']; ?>" target="_<?php echo $data['callout_target']; ?>"><?php echo $data['callout_text']; ?></a><?php } ?>
    
		<?php wp_nav_menu( array(
            'theme_location' => 'top_menu',
			'menu_class' => 'top-menu',
            'sort_column' => 'menu_order',
			'fallback_cb' => ''
        )); ?> 
    </div><!-- /top-bar-inner -->
    
</div><!-- /top-bar -->
<?php } ?>

<header id="header" class="clearfix <?php echo 'header-style-'.$data['header_style'].''; ?>">

    <div id="logo">
        <?php if($data['custom_logo'] !='') { ?>
            <a href="<?php echo home_url(); ?>/" title="<?php bloginfo( 'name' ); ?>" rel="home"><img src="<?php echo $data['custom_logo']; ?>" alt="<?php bloginfo( 'name' ) ?>" /></a>
        <?php } else { ?>
        <?php if (is_front_page()) { ?>
            <h1><a href="<?php echo home_url(); ?>/" title="<?php bloginfo( 'name' ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
        <?php } else { ?>
            <h2><a href="<?php echo home_url(); ?>/" title="<?php bloginfo( 'name' ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
        <?php } } ?>
    </div><!-- /logo -->
    
    <div id="header-aside">
    	<?php if($data['header_phone']) { ?>
    		<div id="header-phone"><?php echo $data['header_phone']; ?></div>
        <?php }
		
		//show social icons if not disabled
		if($data['disable_social'] != 'disable'){
			
        //get social link style
        if($data['social_style'] !='one') { $social_style = $data['social_style']; } else { $social_style = ''; }
        
        //get social links
        $social_links = array('twitter','dribbble','forrst','flickr','google','googleplus','facebook','linkedin','youtube','vimeo','rss','support','mail'); ?>
        <ul id="social">
            <?php
            //social loop
            foreach($social_links as $social_link) {
                if(!empty($data[$social_link])) {
					if($social_link == 'mail' || $social_link == 'support') {
						echo '<li><a href="'. $data[$social_link] .'" title="'. $social_link .'" target="_self" class="tooltip"><img src="'. get_template_directory_uri() .'/images/social'.$social_style.'/'.$social_link.'.png" alt="" /></a></li>';
					} else {
                    	echo '<li><a href="'. $data[$social_link] .'" title="'. $social_link .'" target="_blank" class="tooltip"><img src="'. get_template_directory_uri() .'/images/social'.$social_style.'/'.$social_link.'.png" alt="" /></a></li>';
					}
            } }
            ?>
        </ul><!-- /social -->
        <?php } ?>

        <?php
		if($data['enable_disable_search'] != 'disable') {
        	get_search_form();
		} ?>
    </div><!--/header-aside -->
              
</header><!-- /header -->

<div id="wrap" class="clearfix">

    <nav id="navigation" class="clearfix">
        <?php wp_nav_menu( array(
            'theme_location' => 'main_menu',
            'sort_column' => 'menu_order',
            'menu_class' => 'sf-menu',
            'fallback_cb' => 'default_menu'
        )); ?>
    </nav><!-- /navigation -->  
        
    <?php
	if(is_page()) {
		global $post;
		$full_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full-size');
		if($full_img) { echo '<img src="'. $full_img[0] .'" alt="'. get_the_title() .'" class="page-featured-img" />'; }
	}
	?>
    
	<div class="container clearfix fitvids">
    