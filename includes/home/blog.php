<?php
/**
 * @package WordPress
 * @subpackage Office Theme
 */
 
 global $data; //get theme options
?>

<?php
//get and set blog category
if($data['home_blog_cat'] != 'Select') { $home_blog_cat = $data['home_blog_cat']; } else { $home_blog_cat = NULL; }

//tax query
if($home_blog_cat) {
	$blog_tax_query = array(
		array(
			  'taxonomy' => 'category',
			  'field' => 'slug',
			  'terms' => $home_blog_cat
			  )
		);
} else { $blog_tax_query = NULL; }

//get post type ==> blog
global $post;
$args = array(
	'post_type' =>'post',
	'numberposts' => $data['home_blog_count'],
	'tax_query' => $blog_tax_query
);
$blog_posts = get_posts($args);
?>
<?php
//show blog section only if posts exist
if($blog_posts) { ?>
<div id="home-blog" class="clearfix">

	<?php if(!empty($data['home_blog_title'])) { ?>
        <div class="heading">
            <?php if(!empty($data['home_blog_title_url'])) { ?>
                <h2><a href="<?php echo $data['home_blog_title_url']; ?>" title="<?php echo $data['home_blog_title']; ?>"><span><?php echo $data['home_blog_title']; ?></span></a></h2>
            <?php } else { ?>
                <h2><span><?php echo $data['home_blog_title']; ?></span></h2>
            <?php } ?>
        </div>
        <!-- /heading -->
    <?php } ?>
	
	
	<?php
	foreach($blog_posts as $post) : setup_postdata($post);
	//get portfolio thumbnail
	$thumbail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'blog-thumb');
	?>
	
	<div class="home-entry">
    	<?php if($thumbail) { ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo $thumbail[0]; ?>" alt="<?php echo the_title(); ?>" /></a>
        <?php } ?>
		<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
		<?php echo excerpt($data['home_blog_excerpt_length']); ?>
	</div>
	
	<?php endforeach; ?>

</div>
<!-- END #home-blog -->      	
<?php } wp_reset_postdata(); ?>