<?php
/**
 * @package WordPress
 * @subpackage Office Theme
 * Template Name: Staff By Department
*/
?>
<?php get_header(); ?>

<?php
//start loop
if (have_posts()) : while (have_posts()) : the_post();

//get slider meta
$page_slider = get_post_meta($post->ID, 'office_page_slider', true);

//show slider if enabled
if ($page_slider == 'enable') {
	//get template that includes page slider code
	get_template_part( 'includes/page-slides');
}

//get meta to set parent category
$staff_filter_parent = '';
$staff_parent = get_post_meta($post->ID, 'office_staff_parent', true);
if($staff_parent != 'select_staff_parent') { $staff_filter_parent = $staff_parent; } else { $staff_filter_parent = NULL; };		
?>

<header id="page-heading">
	<h1><?php the_title(); ?></h1>
    <?php if($data['disable_breadcrumbs'] !='disable') { office_breadcrumbs(); } ?>
</header>
<!-- /page-header -->
 
 
<div id="staff-by-department" class="clearfix">

    <?php
	//show page content if not empty
	$content = $post->post_content;
	if(!empty($content)) { ?>
		<div id="staff-bycat-description" class="clearfix">
        	<?php the_content(); ?>
        </div>
        <!-- staff-description -->
	<?php } ?>

	<?php
	//get terms
	$terms = get_terms('staff_departments','orderby=custom_sort&hide_empty=1&child_of='.$staff_filter_parent.'');
	foreach($terms as $term) {
	?>
	
    <div class="heading">
		<h2><a href="<?php echo get_term_link($term->slug, 'staff_departments'); ?>" class="all-port-cat-items"><span><?php echo $term->name; ?></span></a></h2>
    </div>
    <!-- /heading -->

	<div class="staff-category clearfix">
	
		<?php
		//tax query
		$tax_query = array(
		array(
			'taxonomy' => 'staff_departments',
			'terms' => $term->slug,
			'field' => 'slug'
			)
		);
		
		//get posts ==> staff
		$term_post_args = array(
			'post_type' => 'staff',
			'numberposts' => '-1',
			'tax_query' => $tax_query
		);
		$term_posts = get_posts($term_post_args);
		
		//start loop
		$count=0;
		foreach ($term_posts as $post) : setup_postdata($post);
		$count++;
		
		//get images
		$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'staff-thumb');
		
		//get meta
		$staff_position = get_post_meta($post->ID, 'office_staff_position', TRUE);
		?>
		<?php if($featured_image) { ?>
            <div class="staff-member clearfix">
                <div class="staff-img">
                    <a href="<?php the_permalink();?>"><img src="<?php echo $featured_image[0]; ?>" alt="<?php the_title(); ?>" width="<?php echo $featured_image[1]; ?>" height="<?php echo $featured_image[2]; ?>" /></a>
                </div>
                <!-- /staff-img -->
                <div class="staff-meta">
                    <h3><?php the_title(); ?></h3>
                    <?php if($staff_position) { ?><?php echo ''.$staff_position.''; ?><?php } ?>
                </div>
                <!-- /staff-meta -->
            </div>
            <!-- /staff-member -->
		<?php } ?>
 
	<?php endforeach; ?>
	</div>
	<!-- /staff-category -->

<?php } wp_reset_query(); ?>

</div>
<!-- /staff-by-category-wrap -->

<?php wp_reset_query(); ?>

<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>