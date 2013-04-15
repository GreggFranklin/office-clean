<?php
/**
 * @package WordPress
 * @subpackage Office Theme
 * Template Name: FAQs
 */
?>
<?php get_header(); ?>

<?php
//start page loop
if (have_posts()) : while (have_posts()) : the_post();

//get slider meta
$page_slider = get_post_meta($post->ID, 'office_page_slider', true);

//show page slider if enabled
if ($page_slider == 'enable') {
	//get page slider template
	get_template_part( 'includes/page-slides');
}

//get meta to set parent category
$faqs_filter_parent = '';
$faqs_parent = get_post_meta($post->ID, 'office_faqs_parent', true);
if($faqs_parent != 'select_faqs_parent') { $faqs_filter_parent = $faqs_parent; } else { $faqs_filter_parent = NULL; }
?>

<header id="page-heading">
    <h1><?php the_title(); ?></h1>		
    <?php if($data['disable_breadcrumbs'] !='disable') { office_breadcrumbs(); } ?>
</header>
<!-- END page-heading -->

<?php
$content = $post->post_content;
if(!empty($content)) { ?>
	<div id="faqs-description">
    	<?php the_content(); ?>
    </div>
    <!-- /faqs-description -->
<?php }?>

<div class="post full-width clearfix">

	<?php
	//get portfolio categories
	$cats_args = array(
		'hide_empty' => '1',
		'child_of' => $faqs_filter_parent
	);
	$cats = get_terms('faqs_cats', $cats_args);
	
	//show filter if categories exist
	if($cats) {
    $args = array(
        'taxonomy' => 'faqs_cats',
        'orderby' => 'name',
        'show_count' => 0,
        'pad_counts' => 0,
        'hierarchical' => 0,
        'title_li' => ''
    );
    ?>
    <ul id="faqs-cats" class="clearfix">
        <li><a class="active" href="#all" rel="all" title="<?php _e('All FAQs', 'office'); ?>"><?php _e('All', 'office'); ?></a></li>
        <?php
        foreach ($cats as $cat ) : ?>
        <li><a href="#<?php echo $cat->slug; ?>" rel="<?php echo $cat->slug; ?>"><span><?php echo $cat->name; ?></span></a></li>
        <?php endforeach; ?>
    </ul>
    <!-- /faqs-cats -->
    <?php } ?>

    <div id="faqs-wrap clearfix">
    
    	<ul class="faqs-content">
		<?php
		//tax query
		if($faqs_filter_parent) {
			$tax_query = array(
				array(
					  'taxonomy' => 'faqs_cats',
					  'field' => 'id',
					  'terms' => $faqs_filter_parent
					  )
				);
		} else { $tax_query = NULL; }
		
		//start main loop
        global $post;
        $args = array(
            'post_type' =>'faqs',
            'numberposts' => '-1',
            'order' => 'ASC',
			'tax_query' => $tax_query
        );
        $faqs = get_posts($args);
        ?>
        
        <?php
		$count=0;
        foreach($faqs as $post) : setup_postdata($post);
		$count++;
		
		//get terms
		$terms = get_the_terms( get_the_ID(), 'faqs_cats' );
        ?>
        <li data-id="id-<?php echo $count; ?>" data-type="<?php if($terms) { foreach ($terms as $term) { echo $term->slug .' '; } } else { echo 'none'; } ?>" class="faqs-container">       
            <div class="faq-item">
                <h2 class="faq-title"><span><?php the_title(); ?></span></h2>
                <div class="faq-content entry">
                    <?php the_content(); ?>
                </div>
                <!-- /faq -->
            </div>
            <!-- /faq-item -->
        </li>
        <!-- /faqs-container -->
        
        <?php endforeach; wp_reset_postdata(); ?>
        
        </ul>
        <!-- /faqs-content -->
    
	</div>
	<!-- /faqs-wrap -->
    
</div>
<!-- /post -->

<?php endwhile; endif; ?>	  

<?php get_footer(); ?>