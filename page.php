<?php
/**
 * @package WordPress
 * @subpackage Office Theme
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
	get_template_part( 'includes/page-slides'); //show slider
}
?>

<header id="page-heading">
    <h1><?php the_title(); ?></h1>		
    <?php if($data['disable_breadcrumbs'] !='disable') { office_breadcrumbs(); } ?>
</header>
<!-- END page-heading -->


<article class="post clearfix">

    <div class="entry clearfix">	
    	<?php the_content(); ?>
	</div>
	<!-- /entry -->
    
	<?php
	// Show comments, unless disabled
	if($data['enable_disable_page_comments'] != 'disable') {
	comments_template(); } ?>
	
</article>
<!-- /post -->

<?php endwhile; endif; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>