<?php
/**
 * @package WordPress
 * @subpackage Office Theme
 * Template Name: Portfolio With Filter
 */
 global $data //get theme options
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
    <?php
	//show breadcrumbs unless disabled
    if($data['disable_breadcrumbs'] !='disable') { office_breadcrumbs(); } ?> 
    
        <?php 
		//get portfolio categories
		$cats_args = array(
			'hide_empty' => '1',
			'child_of' => $portfolio_filter_parent
		);
		$cats = get_terms('portfolio_cats', $cats_args);
		
		//show filter if categories exist
		if($cats) { ?>
        <!-- Portfolio Filter -->
        <ul id="portfolio-cats" class="filter clearfix">
            <li><a href="#all" rel="all" class="active" data-filter="*"><span><?php _e('All', 'office'); ?></span></a></li>
            <?php
            foreach ($cats as $cat ) : ?>
            <li><a href="#<?php echo $cat->slug; ?>" data-filter=".<?php echo $cat->slug; ?>"><span><?php echo $cat->name; ?></span></a></li>
            <?php endforeach; ?>
        </ul>
        <!-- /portfolio-cats -->
	<?php } ?>
    
</header>
<!-- /page-heading -->

<?php
$content = $post->post_content;
if(!empty($content)) { ?>
	<div id="portfolio-description" class="clearfix">
		<?php the_content(); ?>
	</div>
	<!-- portfolio-description -->
<?php } ?>

    
<div class="post full-width clearfix">

    <div id="portfolio-wrap" class="clearfix">
    	<ul class="portfolio-content">
			<?php
			//tax query
			if($portfolio_filter_parent) {
			$tax_query = array(
				array(
					  'taxonomy' => 'portfolio_cats',
					  'field' => 'id',
					  'terms' => $portfolio_filter_parent
					  )
				);
			} else { $tax_query = NULL; }
			
            //get post type ==> portfolio
            query_posts(array(
                'post_type'=>'portfolio',
                'posts_per_page' => -1,
                'paged'=>$paged,
				'tax_query' => $tax_query
            ));
            ?>
        
            <?php
			$count=0;
            while (have_posts()) : the_post();
			$count++;
			
            //get portfolio thumbnail
            $thumbail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'grid-thumb');
			
            //get terms
            $terms = get_the_terms( get_the_ID(), 'portfolio_cats' );
			$terms_list = get_the_term_list( get_the_ID(), 'portfolio_cats' );
            ?>
            
            <?php
			//show entry only if it has a featured image
            if($thumbail) {  ?>
            <li class="portfolio-item <?php if($terms) { foreach ($terms as $term) { echo $term->slug .' '; } } ?>">
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                	<img src="<?php echo $thumbail[0]; ?>" alt="<?php echo the_title(); ?>" />
                	<h3><?php the_title(); ?></h3>
                </a>
            </li>
            <!-- /portfolio-item -->
            <?php } ?>
            
            <?php endwhile; wp_reset_query(); ?>
		</ul>
    </div>
    <!-- /portfolio-wrap -->

</div>
<!-- /post -->

<?php endwhile; endif; ?>
<?php get_footer(); ?>