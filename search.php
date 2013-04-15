<?php
/**
 * @package WordPress
 * @subpackage Office Theme
 */
?>
<?php get_header(); ?>
	<?php
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	query_posts($query_string .'&posts_per_page=10&paged=' . $paged);
    if (have_posts()) : ?>
    
        <header id="page-heading">
            <h1 id="archive-title">Search Results For: <?php the_search_query(); ?></h1>
            <?php if($data['disable_breadcrumbs'] !='disable') { office_breadcrumbs(); } ?>
        </header>
        <!-- /page-heading -->
        
        <div class="post clearfix">
        
			<?php
            while (have_posts()) : the_post(); ?>
        
                <article class="search-entry clearfix">
                    <?php
                    $portfolio_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'grid-thumb');
                    if($portfolio_thumb) { ?>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="search-portfolio-thumb"><img src="<?php echo $portfolio_thumb[0]; ?>" height="<?php echo $portfolio_thumb[2]; ?>" width="<?php echo $portfolio_thumb[1]; ?>" alt="<?php echo the_title(); ?>" /></a>
                    <?php } ?>
                    <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                    <?php echo excerpt('50'); ?>
                </article>
                <!-- /search-entry -->
                
            <?php endwhile; ?>
            
            <?php pagination(); ?>
    
        </div>
        <!-- /post  -->
    
    <?php else : ?>
    
        <header id="page-heading">
            <h1 id="archive-title">Search Results For "<?php the_search_query(); ?>"</h1>
        </header>
        <!-- END page-heading -->
        
        <div id="post" class="post clearfix">
        <?php _e('No results found for that query.', 'office'); ?>
        </div>
        <!-- /post  -->
        
    <?php endif; ?>
<?php get_sidebar(); ?>		  
<?php get_footer(); ?>