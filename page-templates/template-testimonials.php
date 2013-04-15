<?php
/**
 * @package WordPress
 * @subpackage Office Theme
 * Template Name: Testimonials
 */
?>
<?php get_header(); ?>

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

<header id="page-heading">
    <h1><?php the_title(); ?></h1>		
    <?php if($data['disable_breadcrumbs'] !='disable') { office_breadcrumbs(); } ?>
</header>
<!-- END page-heading -->

<?php
$content = $post->post_content;
if(!empty($content)) { ?>
	<div id="testimonials-description">
    	<?php the_content(); ?>
    </div>
    <!-- /testimonials-description -->
<?php }?>

<article class="post full-width clearfix">

    <div id="testimonials-wrap clearfix">
    
    <?php
	global $post;
	$args = array(
		'post_type' =>'testimonials',
		'numberposts' => '-1'
	);
	$testimonials = get_posts($args);

	$count=0;
	foreach($testimonials as $post) : setup_postdata($post);
	$count++;
	?>
    
    <div class="testimonial-item one-third <?php if($count == '3') { echo 'column-last'; } ?>">
        <div class="testimonial">
            <?php the_content(); ?>
        </div>
        <!-- /testimonial -->
        <div class="testimonial-author"><?php the_title(); ?></div>
    </div>
    <!-- /testimonial-item -->
    
	<?php if($count == '3') { echo '<div class="clear"></div>'; $count=0; } endforeach; wp_reset_postdata(); ?>
    
	</div>
	<!-- /testimonials-wrap -->
    
</article>
<!-- /post -->

<?php endwhile; endif; ?>	  

<?php get_footer(); ?>