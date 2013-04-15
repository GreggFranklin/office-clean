<?php
/**
 * @package WordPress
 * @subpackage Office Theme
 * Template Name: Portfolio by Category
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
$portfolio_filter_parent = '';
$portfolio_parent = get_post_meta($post->ID, 'office_portfolio_parent', true);
if($portfolio_parent != 'select_portfolio_parent') { $portfolio_filter_parent = $portfolio_parent; } else { $portfolio_filter_parent = NULL; }
?>

<header id="page-heading">
	<h1><?php the_title(); ?></h1>
    <?php if($data['disable_breadcrumbs'] !='disable') { office_breadcrumbs(); } ?>
</header>
<!-- /page-header -->
 
 
<div id="portfolio-by-category-wrap" class="clearfix">

    <?php
	$content = $post->post_content;
	if(!empty($content)) { ?>
		<div id="portfolio-bycat-description" class="clearfix">
        	<?php the_content(); ?>
        </div>
        <!-- portfolio-description -->
	<?php } ?>

	<?php
	//get meta to set parent category
	$portfolio_filter_parent = '';
	$portfolio_parent = get_post_meta($post->ID, 'office_portfolio_parent', true);
	if($portfolio_parent != 'select_portfolio_parent') { $portfolio_filter_parent = $portfolio_parent; } else { $portfolio_filter_parent = NULL; };
            
	//term loop
	$terms = get_terms('portfolio_cats','orderby=custom_sort&hide_empty=1&child_of='.$portfolio_filter_parent.'');
	foreach($terms as $term) {
	?>
	
    <div class="heading">
		<h2><a href="<?php echo get_term_link($term->slug, 'portfolio_cats'); ?>" class="all-port-cat-items"><span><?php echo $term->name; ?></span></a></h2>
    </div>

	<div class="portfolio-category clearfix">
	
		<?php
		//tax query
		$tax_query = array(
		array(
			'taxonomy' => 'portfolio_cats',
			'terms' => $term->slug,
			'field' => 'slug'
			)
		);
		$term_post_args = array(
			'post_type' => 'portfolio',
			'numberposts' => '-1',
			'tax_query' => $tax_query
		);
		$term_posts = get_posts($term_post_args);
		
		//start loop
		foreach ($term_posts as $post) : setup_postdata($post);
		
		//get images
		$featured_image = get_the_post_thumbnail($post->ID, 'grid-thumb');
		?>
		  <?php if(!empty($featured_image)) { ?>
          <div class="portfolio-item">
              <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                  <?php echo $featured_image; ?>
                  <h3><?php the_title(); ?></h3>
              </a>
          </div>
          <!-- /portfolio-item -->
          <?php } ?>
 
	<?php endforeach; ?>
	</div>
	<!-- /portfolio-category -->

<?php } wp_reset_postdata(); ?>

</div>
<!-- /portfolio-by-category-wrap -->

<?php wp_reset_query(); ?>

<?php endwhile; endif; ?>
 
<?php get_footer(); ?>