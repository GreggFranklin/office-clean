<?php
/**
 * @package WordPress
 * @subpackage Office Theme
 * Template Name: Services
 */
 global $data; //get theme options
?>

<?php get_header(); ?>

<?php
//start page loop
if (have_posts()) : while (have_posts()) : the_post();

//get slider meta
$page_slider = get_post_meta($post->ID, 'office_page_slider', true);

//show slider if enabled
if ($page_slider == 'enable') {
	//get slider template
	get_template_part( 'includes/page-slides');
}

//get meta to set parent category
$service_filter_parent = '';
$service_parent = get_post_meta($post->ID, 'office_service_parent', true);	
if($service_parent != 'select_service_parent') { $service_filter_parent = $service_parent; } else { $service_filter_parent = NULL; }
?>

<header id="page-heading">
	<h1><?php the_title(); ?></h1>	
    <?php if($data['disable_breadcrumbs'] !='disable') { office_breadcrumbs(); } ?> 
</header>
<!-- /page-heading -->
    
<?php
//show page content if not empty
$content = $post->post_content;
if(!empty($content)) { ?>
	<div id="services-description" class="clearfix">
		<?php the_content(); ?>
	</div>
	<!--/services description -->
<?php } ?>
     
     
<div id="services-wrap" class="clearfix">

	<?php		
    //tax query
    if($service_filter_parent) {
        $tax_query = array(
            array(
                  'taxonomy' => 'service_cats',
                  'field' => 'id',
                  'terms' => $service_filter_parent
                  )
            );
    } else { $tax_query = NULL; }
    
    // get custom post type ==> homepage-tabs
    global $post;
    $args = array(
        'post_type'=>'services',
        'numberposts' => -1,
        'order' => 'ASC',
        'tax_query' => $tax_query
    );
    $services_posts = get_posts($args);
    ?>
    
    <ul id="service-tabs">
        <?php
        //tabs
        $count=0;
        foreach($services_posts as $post) : setup_postdata($post);
        $count++;
        //featured image
        $feat_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full-size');
        ?>
        <li><a href="#tab-<?php echo $count; ?>" title="<?php the_title(); ?>"><?php if($feat_img) { ?><span><img src="<?php echo $feat_img[0]; ?>" alt="<?php the_title(); ?>" /></span><?php } ?><?php the_title(); ?></a></li>
        <?php endforeach; ?>
    </ul>
    <!-- /service tabs -->
    
    <div id="service-content" class="entry">
        <?php
        //tab content
        $count=0;
        foreach($services_posts as $post) : setup_postdata($post);
        $count++;
        ?>
        <article id="tab-<?php echo $count; ?>" class="service-tab-content">
            <h2><?php the_title(); ?></h2>
            <?php the_content(); ?>
        </article>
        <!-- /service-tab-content -->
        <?php endforeach; ?>
    </div>
    <!-- /service-content -->
    
</div>
<!-- /services-wrap -->

<?php wp_reset_postdata(); endwhile; endif; ?>	
<?php get_footer(); ?>