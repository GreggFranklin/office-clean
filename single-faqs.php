<?php
/**
 * @package WordPress
 * @subpackage Office Theme
 */
?>
<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<header id="page-heading">
	<h1><?php _e('FAQ', 'office'); ?>: <?php the_title(); ?></h1>	
    <?php if($data['disable_breadcrumbs'] !='disable') { office_breadcrumbs(); } ?>  
</header>
<!-- /post-heading -->

<article class="post clearfix">
    <div class="entry clearfix">
		<?php the_content(); ?>
	</div>
	<!-- /entry -->    
</article>
<!-- /post -->

<?php endwhile; endif; ?>
             
<?php get_sidebar(); ?>
<?php get_footer(); ?>