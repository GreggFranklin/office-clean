<?php
/**
 * @package WordPress
 * @subpackage Office Theme
 */
 
global $data; //get theme options

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


//show portfolio section if posts matching query exist
if($portfolio_posts) {
	
	// Load scripts for the carousel
	wp_enqueue_script('homeinit');
	wp_enqueue_script('carouFredSel'); ?>        
    <div id="home-projects" class="home-projects-carousel clearfix">
    
        <?php
        //show heading if theme options isn't empty
        if(!empty($data['home_portfolio_title'])) { ?>
            <div class="heading">
                <?php if(!empty($data['home_portfolio_title_url'])) { ?>
                    <h2><a href="<?php echo $data['home_portfolio_title_url']; ?>" title="<?php echo $data['home_portfolio_title']; ?>"><span><?php echo $data['home_portfolio_title']; ?></span></a></h2>
                <?php } else { ?>
                    <h2><span><?php echo $data['home_portfolio_title']; ?></span></h2>
                <?php } ?>
            </div>
            <!-- /heading -->
        <?php } ?>
    
        <div id="home-portfolio-carousel-wrp" class="clearfix">
            <div id="home-portfolio-carousel" class="fredcarousel">
            <?php
            $count=0;
            foreach($portfolio_posts as $post) : setup_postdata($post);
            $count++;
            
            //get portfolio thumbnail
            $thumbail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'grid-thumb');
           
            //show entry only if post has featured image
            if( has_post_thumbnail() ) {  ?>
                <div class="portfolio-item">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo $thumbail[0]; ?>" height="<?php echo $thumbail[2]; ?>" width="<?php echo $thumbail[1]; ?>" alt="<?php echo the_title(); ?>" /></a>
                    <h3><?php the_title(); ?></h3>
                </div><!-- /portfolio-item -->
            <?php } endforeach; ?>
            </div><!-- /home-portfolio-carousel -->
            <div id="carousel-prev"></div>
            <div id="carousel-next"></div>
            <div id="carousel-pagination" class="pagination"></div>
        </div><!-- /home-portfolio-carousel-wrp -->        
    </div><!-- /home-projects -->      	
<?php } wp_reset_postdata(); ?>