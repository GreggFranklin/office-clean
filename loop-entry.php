<?php
global $data;
while (have_posts()) : the_post(); ?>  

<?php
/*-----------------------------------------------------------------------------------*/
// Posts Entry  - used in the blog page & archives
/*-----------------------------------------------------------------------------------*/
?>
<article class="loop-entry clearfix">

	<?php
	$blog_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'post-image');
    if(has_post_thumbnail() ) {  ?>
        <div class="loop-entry-thumbnail">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo $blog_thumb[0]; ?>" alt="<?php echo the_title(); ?>" /></a>
        </div>
        <!-- /loop-entry-thumbnail -->
    <?php } ?>
  
	<div class="loop-entry-right">
    	<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
        <?php
        if($data['enable_full_blog'] == 'enable') {
    		the_content();
		}
		else {
			the_excerpt();
		}
		?>
    </div>
    <!-- /loop-entry-right -->
    
	<div class="loop-entry-left">
		<div class="post-meta">
            <div class="post-date">
               <?php the_time('j'); ?> <?php the_time('M'); ?>, <?php the_time('Y'); ?>
            </div>
            <!-- /post-date -->
            <div class="post-cat">
               <?php the_category(); ?>
            </div>
            <!-- /post-cat -->
        </div>
    	<!-- /post-meta -->
    </div>
    <!-- /loop-entry-left -->
     
</article><!-- /entry -->

<?php endwhile; ?>