<?php
/**
 * @package WordPress
 * @subpackage Office Theme
 */
?>
<?php get_header(); ?>

<?php if(have_posts()) : ?>

<header id="page-heading">
	<?php $term = $wp_query->queried_object; ?>
	<h1><?php echo $term->name; ?></h1>
    <?php if($data['disable_breadcrumbs'] !='disable') { office_breadcrumbs(); } ?> 
</header>
<!-- /page-heading -->

<?php
$category_description = category_description();
if(!empty($category_description )) {
	echo apply_filters('category_archive_meta','<div id="services-description" class="clearfix">' . $category_description . '</div>');
}
?>

<div class="post full-width clearfix">
    
    <div id="services-wrap" class="clearfix">
        
        <ul id="service-tabs">
			<?php
            global $query_string; 
            query_posts( $query_string . '&order=ASC' );
            //start loop
			$count=0;
            while (have_posts()) : the_post();  
			$count++; 
			//featured image
			$feat_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full-size');
            ?>
                <li><a href="#tab-<?php echo $count; ?>" title="<?php the_title(); ?>"><?php if($feat_img) { ?><span><img src="<?php echo $feat_img[0]; ?>" alt="<?php the_title(); ?>" /></span><?php } ?><?php the_title(); ?></a></li>
            <?php endwhile; ?>
		</ul>
        <!-- /service tabs -->
        
        <div id="service-content" class="entry">
			<?php
            global $query_string;
            query_posts( $query_string . '&order=ASC' );
            //start loop
			$count=0;
            while (have_posts()) : the_post();   
			$count++;
            ?>
                <article id="tab-<?php echo $count; ?>" class="service-tab-content">
                    <h2><?php the_title(); ?></h2>
                    <?php the_content(); ?>
                </article>
                <!-- /service-tab-content -->
            <?php endwhile; ?>
		</div>
        <!-- /service-content -->
    
    </div>
    <!-- /services-wrap -->

</div>
<!-- .post -->

<?php endif; ?>
<?php get_footer(); ?>