<?php
/**
 * @package WordPress
 * @subpackage Office Theme
 */
 
global $data; // Get theme options

// Get post type hp highlights
global $post;
$args = array(
	'post_type' =>'hp_highlights',
	'numberposts' => '-1'
);
$hp_highlight_posts = get_posts($args);

if($hp_highlight_posts) { ?>

<div id="home-highlights" class="clearfix">
	
    <?php if(!empty($data['home_highlights_title'])) { ?>
        <div class="heading">
            <?php if(!empty($data['home_highlights_title_url'])) { ?>
                <h2><a href="<?php echo $data['home_highlights_title_url']; ?>" title="<?php echo $data['home_highlights_title']; ?>"><span><?php echo $data['home_highlights_title']; ?></span></a></h2>
            <?php } else { ?>
                <h2><span><?php echo $data['home_highlights_title']; ?></span></h2>
            <?php } ?>
        </div><!-- .heading -->
    <?php } ?>
    
	<?php
	//start loop
	$third_count=0;
	$fifth_count=0;
	foreach($hp_highlight_posts as $post) : setup_postdata($post);
	$third_count++;
	$fifth_count++;

	//meta
	$hp_highlights_url = get_post_meta($post->ID, 'office_hp_highlights_url', TRUE);
	$hp_highlights_url_target = 'self';
	$hp_highlights_url_target = get_post_meta($post->ID, 'office_hp_highlights_url_target', TRUE); ?>
	
	<div class="hp-highlight <?php if($third_count=='3') { echo 'highlight-third'; } ?> <?php if($fifth_count=='5') { echo 'highlight-fifth'; } ?>">
    	<?php if( has_post_thumbnail() ) { ?>
            <img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" title="<?php the_title(); ?>" class="hp-highlight-img" />
        <?php } ?>
		<h3><?php if(!empty($hp_highlights_url)) { ?><a href="<?php echo $hp_highlights_url; ?>" title="<?php the_title(); ?>" target="_<?php echo $hp_highlights_url_target; ?>"><?php the_title(); ?></a><?php } else { the_title(); } ?></h3>
		<?php the_content(); ?>
	</div><!-- .hp-highlight -->
	<?php if($third_count=='3') { $third_count=1; } if($fifth_count=='5') { $fifth_count=1; } endforeach; ?>

</div><!-- #home-highlights -->      	
<?php } wp_reset_postdata(); ?>