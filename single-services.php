<?php
/**
 * @package WordPress
 * @subpackage Office Theme
 */

get_header(); // Get header template
global $data; // Get theme options
if (have_posts()) : while (have_posts()) : the_post(); // Start main loop ?>

<header id="page-heading">
	<h1><?php the_title(); ?></h1>	
    <?php if($data['disable_breadcrumbs'] !='disable') { office_breadcrumbs(); } ?>  
</header><!-- /post-meta -->

<article class="post service-post clearfix">
    <div class="entry clearfix">        
		<?php the_content(); ?>
	</div><!-- /entry -->        
</article><!-- /post -->

<?php endwhile; ?>
<?php endif; ?>
            
<?php get_sidebar(); // Get sidebar template ?>
<?php get_footer(); // Get footer template ?>