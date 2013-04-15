<?php
/**
 * @package WordPress
 * @subpackage Office Theme
 */
 
global $data; // Get theme panel data
get_header(); // Get header template 
if (have_posts()) : while (have_posts()) : the_post(); //start post loop

// Get post categories
$terms = get_the_term_list( get_the_ID(), 'portfolio_cats' );

// Full-Width Style Slider/Video
if(get_post_meta(get_the_ID(), 'office_portfolio_style', TRUE) == 'full') {
	if( get_post_meta(get_the_ID(), 'office_portfolio_video', TRUE) !== '') {
		// Show video
		echo '<div id="slider-wrap" class="portfolio-video fitvids">'.do_shortcode( get_post_meta(get_the_ID(), 'office_portfolio_video', TRUE) ).'</div>';
	} else {
		// Show image slider
		get_template_part( 'includes/page-slides'); //show slider
	}
} ?>

<header id="page-heading">
	<h1><?php the_title(); ?></h1>
    <?php if($data['disable_breadcrumbs'] !='disable') { office_breadcrumbs(); } ?>
</header>
<!-- /page-heading -->

<article class="post full-width clearfix">

<?php
/*-----------------------------------------------------------------------------------*/
// Full-Width Portfolio Style 
/*-----------------------------------------------------------------------------------*/
if(get_post_meta(get_the_ID(), 'office_portfolio_style', TRUE) == 'full') { ?>

<div id="single-portfolio" class="full-portfolio clearfix meta-<?php echo $data['disable_portfolio_meta']; ?>">

		<?php if($data['disable_portfolio_meta'] !='disable') { ?>
		<div id="single-portfolio-left">
            <div id="single-portfolio-meta" class="clearfix">
				<ul>
                    <li><span><?php _e('Date','office'); ?>:</span><?php the_date('M Y'); ?></li>
                    <?php if($terms) { ?><li><span><?php _e('Labeled','office'); ?>:</span><?php echo get_the_term_list( get_the_ID(), 'portfolio_cats', '',', ',' ') ?></li><?php } ?>    
                    <?php if( get_post_meta(get_the_ID(), 'office_portfolio_cost', TRUE) !=='' ) {?><li><span><?php _e('Cost','office'); ?>:</span><?php echo get_post_meta(get_the_ID(), 'office_portfolio_cost', TRUE); ?></li><?php } ?>
                    <?php if( get_post_meta(get_the_ID(), 'office_portfolio_client', TRUE) !=='' ) {?><li><span><?php _e('Client','office'); ?>:</span><?php echo get_post_meta(get_the_ID(), 'office_portfolio_client', TRUE); ?></li><?php } ?>
                    <?php if( get_post_meta(get_the_ID(), 'office_portfolio_url', TRUE) !=='' ) {?><li><span><?php _e('Website','office'); ?>:</span><a href="<?php echo get_post_meta(get_the_ID(), 'office_portfolio_url', TRUE); ?>" title="<?php _e('Visit Website','office'); ?>"><?php echo get_post_meta(get_the_ID(), 'office_portfolio_url', TRUE); ?></a></li><?php } ?>
            	</ul>
            </div>
            <!-- /single-portfolio-meta -->
        </div>
        <!-- /single--portfolio-left -->
        <?php } ?>
        
        <div id="full-portfolio-content" class="clearfix">
			<?php the_content(); ?>

        </div>
        <!-- /full-portfolio-content -->
        
		<div class="clear"></div><!-- /clear any content floats -->
		<?php
        // Show comments, unless disabled
        if($data['enable_disable_portfolio_comments'] != 'disable') {
        comments_template(); } ?>
  
</div>   
<!-- /single-portfolio -->

<?php
/*-----------------------------------------------------------------------------------*/
// Grid Portfolio Style 
/*-----------------------------------------------------------------------------------*/
} elseif(get_post_meta(get_the_ID(), 'office_portfolio_style', TRUE) == 'grid') { ?>

<div id="single-portfolio" class="full-portfolio clearfix meta-<?php echo $data['disable_portfolio_meta']; ?>">

		<div id="portfolio-grid" class="gallery-wrap clearfix">
			<?php
            //get attachement count
            $get_attachments = get_children( array( 'post_parent' => get_the_ID() ) );
            
            //get ID of featured image
            $featured_image_id = get_post_thumbnail_id( get_the_ID() );
            
            //attachement loop
            $args = array(
                'orderby' => 'menu_order',
                'post_type' => 'attachment',
                'post_parent' => get_the_ID(),
                'post_mime_type' => 'image',
                'post_status' => null,
                'posts_per_page' => -1,
                'exclude' => $featured_image_id
            );
            $attachments = get_posts($args);
            
			if($attachments) {
				
                foreach ($attachments as $attachment) :
				
                //get images
                $cropped_thumb = wp_get_attachment_image_src($attachment->ID, 'gallery-thumb');
                $full_image = wp_get_attachment_image_src($attachment->ID, 'full-size'); ?>
                <div class="gallery-photo">
                    <a href="<?php echo $full_image[0]; ?>" class="single-gallery-thumb" rel="prettyPhoto[gallery]" title="<?php echo apply_filters('the_title', $attachment->post_title); ?>"><img src="<?php echo $cropped_thumb[0]; ?>" alt="<?php echo apply_filters('the_title', $attachment->post_title); ?>" class="attachment-post-thumbnail" height="" /></a>
                </div>
                <!-- /gallery-photo -->
            <?php endforeach;
			
			} ?>
        </div><!-- /portfolio-grid -->

		<?php if($data['disable_portfolio_meta'] !='disable') { ?>
		<div id="single-portfolio-left">
            <div id="single-portfolio-meta" class="clearfix">
				<ul>
                    <li><span><?php _e('Date','office'); ?>:</span><?php the_date('M Y'); ?></li>
                    <?php if($terms) { ?><li><span><?php _e('Labeled','office'); ?>:</span><?php echo get_the_term_list( get_the_ID(), 'portfolio_cats', '',', ',' ') ?></li><?php } ?>    
                    <?php if( get_post_meta(get_the_ID(), 'office_portfolio_cost', TRUE) !=='' ) {?><li><span><?php _e('Cost','office'); ?>:</span><?php echo get_post_meta(get_the_ID(), 'office_portfolio_cost', TRUE); ?></li><?php } ?>
                    <?php if( get_post_meta(get_the_ID(), 'office_portfolio_client', TRUE) !=='' ) {?><li><span><?php _e('Client','office'); ?>:</span><?php echo get_post_meta(get_the_ID(), 'office_portfolio_client', TRUE); ?></li><?php } ?>
                    <?php if( get_post_meta(get_the_ID(), 'office_portfolio_url', TRUE) !=='' ) {?><li><span><?php _e('Website','office'); ?>:</span><a href="<?php echo get_post_meta(get_the_ID(), 'office_portfolio_url', TRUE); ?>" title="<?php _e('Visit Website','office'); ?>"><?php echo get_post_meta(get_the_ID(), 'office_portfolio_url', TRUE); ?></a></li><?php } ?>
            	</ul>
            </div><!-- /single-portfolio-meta -->
        </div><!-- /single--portfolio-left -->
        <?php } ?>
        
        <div id="full-portfolio-content" class="clearfix">
			<?php the_content(); ?>
        </div><!-- /full-portfolio-content -->

		<div class="clear"></div><!-- /clear any content floats -->
		<?php
		// Show comments, unless disabled
		if($data['enable_disable_portfolio_comments'] != 'disable') {
		comments_template(); } ?>
  
</div>   
<!-- /single-portfolio -->

<?php
/*-----------------------------------------------------------------------------------*/
// Default Portfolio Style 
/*-----------------------------------------------------------------------------------*/
} else {
?>

<div id="single-portfolio" class="clearfix">

        <div id="single-portfolio-right">
        
        <?php
        // Show video
		if( get_post_meta(get_the_ID(), 'office_portfolio_video', TRUE) !== '') {
			echo '<div class="portfolio-video fitvids">'.do_shortcode( get_post_meta(get_the_ID(), 'office_portfolio_video', TRUE) ).'</div>';
		} else {
			
        //get attachement count
		$get_attachments = get_children( array( 'post_parent' => get_the_ID() ) );
		$attachments_count = count( $get_attachments );
		
		if($attachments_count == '0') {	
		
		//show only the 1 single image
		$portfolio_single = wp_get_attachment_image_src(get_post_thumbnail_id(), 'portfolio-single');
		$portfolio_single_full = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full-size');	?>
        
        <a href="<?php echo $portfolio_single_full[0]; ?>" title="<?php the_title(); ?>" class="prettyphoto-link"><img src="<?php echo $portfolio_single[0]; ?>" height="<?php echo $portfolio_single[2]; ?>" width="<?php echo $portfolio_single[1]; ?>" alt="<?php the_title(); ?>" /></a>
		
        <?php } else {
			//show image slider
			?>
        <div  id="portfolio-slides-wrap">
            <div id="portfolio-slides" class="flexslider clearfix">
                <ul class="slides">
                        <?php
                        
                        //attachement loop
                        $args = array(
                            'orderby' => 'menu_order',
                            'post_type' => 'attachment',
                            'post_parent' => get_the_ID(),
                            'post_mime_type' => 'image',
                            'post_status' => null,
                            'posts_per_page' => -1
                        );
                        $attachments = get_posts($args);
                        
                        //start loop
                        foreach ($attachments as $attachment) :
                        
                        //get images
                        $full_img = wp_get_attachment_image_src( $attachment->ID, 'full-size');
                        $portfolio_single = wp_get_attachment_image_src( $attachment->ID, 'portfolio-single'); ?>
                            <li class="slide">
                                <a href="<?php echo $full_img[0]; ?>" title="<?php echo apply_filters('the_title', $attachment->post_title); ?>" <?php if($attachments_count =='1') { echo 'class="prettyphoto-link"'; } else { echo 'rel="prettyPhoto[gallery]"'; } ?>><img src="<?php echo $portfolio_single[0]; ?>" height="<?php echo $portfolio_single[2]; ?>" width="<?php echo $portfolio_single[1]; ?>" alt="<?php echo apply_filters('the_title', $attachment->post_title); ?>" /></a>
                            </li><!-- /slide -->
                        <?php endforeach; ?>
                        </ul><!-- /slides -->
                    </div><!-- /portfolio-slides -->
                </div><!-- /portfolio-slides-wrap -->
            <?php } } ?>
        </div><!-- /single-portfolio-right -->
        
        <div id="single-portfolio-left">
			<?php the_content(); ?>
            <div class="clear"></div>
            
           <?php if($data['disable_portfolio_meta'] !='disable') { ?>
            <div id="single-portfolio-meta" class="clearfix">
                <ul>
                    <li><span><?php _e('Date','office'); ?>:</span><?php the_date('M Y'); ?></li>
                    <?php if($terms) { ?><li><span><?php _e('Labeled','office'); ?>:</span><?php echo get_the_term_list( get_the_ID(), 'portfolio_cats', '', ', ', ' ') ?></li><?php } ?>  
                    <?php if( get_post_meta(get_the_ID(), 'office_portfolio_cost', TRUE) !=='' ) {?><li><span><?php _e('Cost','office'); ?>:</span><?php echo get_post_meta(get_the_ID(), 'office_portfolio_cost', TRUE); ?></li><?php } ?>
                    <?php if( get_post_meta(get_the_ID(), 'office_portfolio_client', TRUE) !=='' ) {?><li><span><?php _e('Client','office'); ?>:</span><?php echo get_post_meta(get_the_ID(), 'office_portfolio_client', TRUE); ?></li><?php } ?>
                    <?php if( get_post_meta(get_the_ID(), 'office_portfolio_url', TRUE) !=='' ) {?><li><span><?php _e('Website','office'); ?>:</span><a href="<?php echo get_post_meta(get_the_ID(), 'office_portfolio_url', TRUE); ?>"><?php echo get_post_meta(get_the_ID(), 'office_portfolio_url', TRUE); ?></a></li><?php } ?>
                </ul>
            </div><!-- /single-portfolio-meta -->  
            <?php } ?>
        </div><!-- /single-portfolio-left -->
  
        <div class="clear"></div><!-- /clear any content floats -->
		<?php
        // Show comments, unless disabled
        if($data['enable_disable_portfolio_comments'] != 'disable') {
        comments_template(); } ?>
    </div>   <!-- /single-portfolio -->
    
    <?php } ?>
    
    
<?php
/*-----------------------------------------------------------------------------------*/
// Related posts if not disabled 
/*-----------------------------------------------------------------------------------*/

    if($data['disable_related_port'] !='disable') {
    //get related portfolio posts
    $cats = wp_get_post_terms(get_the_ID(), 'portfolio_cats');
    if ($cats) {  ?>
        <div id="single-portfolio-related" class="clearfix">
        
            <div class="heading">
                <h2><span><?php _e('Related Items','office'); ?></span></h2>
                <a href="#"><?php _e('View all','office'); ?> &rarr;</a>
            </div>
            <!-- /heading -->
          	<?php
            $args = array(
                'post__not_in' => array( get_the_ID() ),
                'orderby'=> 'post_date',
                'order' => 'rand',
                'post_type' => 'portfolio',
                'posts_per_page' => 4,
                'tax_query' => array(
                    'relation' => 'OR',
                    array(
                        'taxonomy' => 'portfolio_cats',
                        'terms' => $cats[0]->term_id
                    ),
                )
            );
            $my_query = new WP_Query($args);
            if( $my_query->have_posts() ) {
            $count=0;
            while ($my_query->have_posts()) : $my_query->the_post();
            $count++;
            //get portfolio thumbnail
            $thumbail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'grid-thumb');
        	?>
			<?php if( has_post_thumbnail() ) {  ?>
                <div class="portfolio-item <?php if($count == '4') { echo 'no-margin'; } ?>">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo $thumbail[0]; ?>" height="<?php echo $thumbail[2]; ?>" width="<?php echo $thumbail[1]; ?>" alt="<?php echo the_title(); ?>" /></a>
                    <h3><?php the_title(); ?></h3>
                </div><!-- /portfolio-item -->
            <?php } ?>
            <?php if($count == '4'){ $count=0; } ?>
            <?php endwhile; wp_reset_query(); } ?>
            </div><!-- /single-portfolio-related -->
        <?php } ?>
    <?php } ?>
    
</article><!-- /post -->

<nav id="single-portfolio-nav" class="clearfix"> 
	<div class="one-half"><?php next_post_link('%link', '&larr; %title', false); ?></div>
	<div class="one-half column-last"><?php previous_post_link('%link', '%title &rarr;', false); ?></div>
</nav><!-- /single-portfolio-nav -->
  
<?php endwhile; ?>
<?php endif; ?>	
<?php get_footer(); ?>