<?php
/**
 * @package WordPress
 * @subpackage Office Theme
 * Template Name: Portfolio
 */
global $data
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
$portfolio_filter_parent = '';
$portfolio_parent = get_post_meta($post->ID, 'office_portfolio_parent', true);
if($portfolio_parent != 'select_portfolio_parent') { $portfolio_filter_parent = $portfolio_parent; } else { $portfolio_filter_parent = NULL; }
?>

<header id="page-heading">
	<h1><?php the_title(); ?></h1>	
    <?php if($data['disable_breadcrumbs'] !='disable') { office_breadcrumbs(); } ?> 
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
				'posts_per_page' => $data['portfolio_pagination'],
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
            ?>
            
            <?php
			// show entry only if featured image is set
            if($thumbail) {  ?>
            <li class="portfolio-item">
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                	<img src="<?php echo $thumbail[0]; ?>" height="<?php echo $thumbail[2]; ?>" width="<?php echo $thumbail[1]; ?>" alt="<?php echo the_title(); ?>" />
                	<h3><?php the_title(); ?></h3>
				</a>
            </li>
            <!-- /portfolio-item -->
            <?php } endwhile; ?>
		</ul>
    </div>
    <!-- /portfolio-wrap -->
	<?php pagination(); wp_reset_query(); ?>

</div>
<!-- /post -->

<?php endwhile; endif; ?>
<?php get_footer(); ?>