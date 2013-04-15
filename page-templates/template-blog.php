<?php
/**
 * @package WordPress
 * @subpackage Office Theme
 * Template Name: Blog
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

//get meta to set parent category
$blog_filter_parent = '';
$blog_parent = get_post_meta($post->ID, 'office_blog_parent', true);
if($blog_parent != 'select_blog_parent') { $blog_filter_parent = $blog_parent; } else { $blog_filter_parent = NULL; }	
?>

<header id="page-heading">
	<h1><?php the_title(); ?></h1>	
    <?php if($data['disable_breadcrumbs'] !='disable') { office_breadcrumbs(); } ?>
</header>
<!-- /page-heading -->

<div class="post clearfix">
<?php
	//tax query
	if($blog_filter_parent) {
		$tax_query = array(
			array(
				  'taxonomy' => 'category',
				  'field' => 'id',
				  'terms' => $blog_filter_parent,
				  )
			);
	} else { $tax_query = NULL; }
	
    //query posts
        query_posts(
            array(
            'post_type'=> 'post',
            'paged'=>$paged,
			'tax_query' => $tax_query
        ));

	//loop
    if (have_posts()) :
		//get entry template
		get_template_part( 'loop', 'entry');            	
    endif;
	
	//show pagination
	pagination();
	
	//reset query
	wp_reset_query(); ?>

</div>
<!-- /post -->

<?php endwhile; endif; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>