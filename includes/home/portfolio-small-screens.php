<?php
/**
 * @package WordPress
 * @subpackage Office Theme
 */
 
 global $data; //get theme options
?>


<?php
//get and set portfolio category
if($data['home_portfolio_cat'] != 'Select') { $home_portfolio_cat = $data['home_portfolio_cat']; } else { $home_portfolio_cat = NULL; }

//tax query
if($home_portfolio_cat) {
	$portfolio_tax_query = array(
		array(
			  'taxonomy' => 'portfolio_cats',
			  'field' => 'slug',
			  'terms' => $home_portfolio_cat
			  )
		);
} else { $portfolio_tax_query = NULL; }

//get post type ==> portfolio
	global $post;
	$args = array(
		'post_type' =>'portfolio',
		'numberposts' => $data['home_portfolio_count'],
		'tax_query' => $portfolio_tax_query
	);
	$portfolio_posts = get_posts($args);
?>
<?php
//show portfolio section if posts matching query exist
if($portfolio_posts) { ?>        

<div id="home-projects-responsive" class="home-projects-responsive clearfix">

	<?php if(!empty($data['home_portfolio_title'])) { ?>
        <div class="heading">
            <?php if(!empty($data['home_portfolio_title_url'])) { ?>
                <h2><a href="<?php echo $data['home_portfolio_title_url']; ?>" title="<?php echo $data['home_portfolio_title']; ?>"><span><?php echo $data['home_portfolio_title']; ?></span></a></h2>
            <?php } else { ?>
                <h2><span><?php echo $data['home_portfolio_title']; ?></span></h2>
            <?php } ?>
        </div>
        <!-- /heading -->
    <?php } ?>

	<div id="portfolio-wrap" class="clearfix">
		<?php
        $count=0;
        foreach($portfolio_posts as $post) : setup_postdata($post);
        $count++;
		
        //get portfolio thumbnail
        $thumbail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'grid-thumb');
        ?>
        
        <?php
		//show only if post has thumbnail
        if($thumbail) {  ?>
            <div class="portfolio-item">
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo $thumbail[0]; ?>" height="<?php echo $thumbail[2]; ?>" width="<?php echo $thumbail[1]; ?>" alt="<?php echo the_title(); ?>" /></a>
                <h3><?php the_title(); ?></h3>
            </div>
            <!-- /portfolio-item -->
        <?php } endforeach; ?>
        </div>
        <!-- /portfolio-wrap -->

</div>
<!-- /home-projects-responsive -->      	
<?php } wp_reset_postdata(); ?>