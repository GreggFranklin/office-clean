<?php
/**
 * @package WordPress
 * @subpackage Office Theme
 */

// Get all images attached to the post
$args = array(
	'orderby' => 'menu_order',
	'post_type' => 'attachment',
	'post_parent' => get_the_ID(),
	'post_mime_type' => 'image',
	'post_status' => null,
	'posts_per_page' => -1
);
$attachments = get_posts($args); 
if($attachments) { ?>
    <div id="slider-wrap">
        <div id="full-slides" class="flexslider clearfix">
            <ul class="slides">
                <?php
                // start loop
                foreach ($attachments as $attachment) :
					//get img
					$slide_img = wp_get_attachment_image_src( $attachment->ID, 'slider');
					//set variables
					$slides_description = $attachment->post_content; ?>
					<li class="slide">
						<img src="<?php echo $slide_img[0]; ?>" alt="<?php echo apply_filters('the_title', $attachment->post_title); ?>" />
						<?php if(!empty($slides_description)) { ?>
						<div class="caption">
							<h3><?php echo apply_filters('the_title', $attachment->post_title); ?></h3>
							<p><?php echo $slides_description; ?></p>
						</div>
						<!-- /caption -->
						<?php } ?>
					</li>
					<!--/slide --> 
                <?php endforeach; ?>
            </ul><!-- /slides -->
        </div><!--/full-slides -->
    </div>
    <!-- /slider-wrap -->
<?php } ?>