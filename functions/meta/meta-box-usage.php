<?php
/**
 * Registering meta boxes
 *
 * In this file, I'll show you how to extend the class to add more field type (in this case, the 'taxonomy' type)
 * All the definitions of meta boxes are listed below with comments, please read them carefully.
 * Note that each validation method of the Validation Class MUST return value instead of boolean as before
 *
 * You also should read the changelog to know what has been changed
 *
 * For more information, please visit: http://www.deluxeblogtips.com/2010/04/how-to-create-meta-box-wordpress-post.html
 *
 */
 
 
 /********************* Theme Admin Variables ***********************/
 
//get theme options
if(get_option('office_options')) {
	global $data;
}

//portfolio name
$portfolio_post_type_name = 'Portfolio';
if($data['portfolio_post_type_name']) {
	$portfolio_post_type_name = $data['portfolio_post_type_name'];
}

//staff name
$staff_post_type_name = 'Staff';
if($data['staff_post_type_name']) {
	$staff_post_type_name = $data['staff_post_type_name'];
}
	
//services name
$services_post_type_name = 'Services';
if($data['services_post_type_name']) {
	$services_post_type_name = $data['services_post_type_name'];
}

//faqs name
$faqs_post_type_name = 'FAQs';
if($data['faqs_post_type_name']) {
		$faqs_post_type_name = $data['faqs_post_type_name'];
}
	

/********************* BEGIN META BOXES ***********************/
$prefix = 'office_';

$office_meta_boxes = array();

// meta box ===> Image Slides
$office_meta_boxes[] = array(
	'id' => 'slides_meta',
	'title' => __('Image Slide Options','office'),
	'pages' => array('slides'),

	'fields' => array(
		array(
            'name' => __('Enable/Disable Caption Title','office'),
            'desc' => __('Select to enable or disable your slide caption.','office'),
            'id' => $prefix . 'enable_caption',
			'type' => 'select',
			'options' => array( 'disable' => 'disable', 'enable' => 'enable', ),
			'multiple' => false,
			'std' => 'default'
        ),
		array(
            'name' => __('Description','office'),
            'desc' => __('Enter a description for your slide.','office'),
            'id' => $prefix . 'slides_description',
            'type' => 'textarea',
            'std' => ''
        ),
		array(
            'name' => __('Slide Link URL','office'),
            'desc' => __('Enter a URL to link this slide to - perfect for linking slides to pages on your site or other sites. Do not forget the http:// in the url. (Optional)','office'),
            'id' => $prefix . 'slides_url',
            'type' => 'text',
            'std' => ''
        ),
		array(
            'name' => __('Link Target','office'),
            'desc' => __('Select the target for the slide link.','office'),
            'id' => $prefix . 'slides_url_target',
			'type' => 'select',
			'options' => array( 'disable' => 'self', 'enable' => 'blank', ),
			'multiple' => false,
			'std' => 'default'
        ),
	)
);
// meta box ===> Video Slides
$office_meta_boxes[] = array(
	'id' => 'slides_video_meta',
	'title' => __('Video Slide Options','office'),
	'pages' => array('slides'),

	'fields' => array(
		array(
            'name' => __('Video Embed Code','office'),
            'desc' => __('Enter your video embed code for your slide. For ideal transition make your embeded code height match the height of other slides. <strong>Width of your video should be 970px</strong>.','office'),
            'id' => $prefix . 'slides_video',
            'type' => 'textarea',
            'std' => ''
        ),
	)
);

// meta box ===> HP Highlights
$office_meta_boxes[] = array(
	'id' => 'hp_highlights_meta',
	'title' => __('Options','office'),
	'pages' => array('hp_highlights'),

	'fields' => array(
		array(
            'name' => __('Link URL','office'),
            'desc' => __('Enter a URL to link the title of this highlight to. Optional.','office'),
            'id' => $prefix . 'hp_highlights_url',
            'type' => 'text',
            'std' => ''
        ),
		array(
            'name' => __('Link Target','office'),
            'desc' => __('Select the target for the highlight link. Do not forget the http:// in the url. (Optional)','office'),
            'id' => $prefix . 'hp_highlights_url_target',
			'type' => 'select',
			'options' => array( 'disable' => 'self', 'enable' => 'blank', ),
			'multiple' => false,
			'std' => 'default'
        ),
	)
);

// meta box ===> Portfolio Options
$office_meta_boxes[] = array(
	'id' => 'single_portfolio_options',
	'title' => __('Post Options','office'),
	'pages' => array('portfolio'),

	'fields' => array(
		array(
			'name' => __('Post Style', 'office'),
			'id' => $prefix . 'portfolio_style',
			'type' => 'select',
			'options' => array(
				'default' => 'default',
				'full' => 'full',
				'grid' => 'grid'
			),
			'std' => 'default',
			'desc' => __('Select your post style.', 'office')
		),
		array(
            'name' => __('Video Embed Code','office'),
            'desc' => __('Enter your video embeded code if you want a video instead. <strong>Max width of 510px</strong>.','office'),
            'id' => $prefix . 'portfolio_video',
            'type' => 'textarea',
            'std' => ''
        ),
		array(
            'name' => __('Cost','office'),
            'desc' => __('Enter your cost for the project details optional)','office'),
            'id' => $prefix . 'portfolio_cost',
            'type' => 'text',
            'std' => ''
        ),
		array(
            'name' => __('Client','office'),
            'desc' => __('Enter a client name the project details (optional)','office'),
            'id' => $prefix . 'portfolio_client',
            'type' => 'text',
            'std' => ''
        ),
		array(
            'name' => __('Link URL','office'),
            'desc' => __('Enter a URL for the project details (optional)','office'),
            'id' => $prefix . 'portfolio_url',
            'type' => 'text',
            'std' => ''
        ),
	)
);


// meta box ===> Staff
$office_meta_boxes[] = array(
	'id' => 'staff_options',
	'title' => __('Options','office'),
	'pages' => array('staff'),

	'fields' => array(
		array(
            'name' => __('Position','office'),
            'desc' => __('Enter a position for your staff member.','office'),
            'id' => $prefix . 'staff_position',
            'type' => 'text',
            'std' => ''
        ),
	)
);


// meta box ===> Image Slider Options
$office_meta_boxes[] = array(
	'id' => 'page_option',
	'title' => __('Image Slider','office'),
	'pages' => array('page'),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => __('Enable FullWidth Image Slider', 'office'),
			'id' => $prefix . 'page_slider',
			'type' => 'select',
			'options' => array('disable' => 'disable', 'enable' => 'enable'),
			'multiple' => false,
			'std' => 'disable',
			'desc' => __('Choose to enable or disable the page slider based on image <a href="http://codex.wordpress.org/Using_Image_and_File_Attachments">attachments</a>.', 'office')
		),
	)
);

// meta box ===> Page Options
$office_meta_boxes[] = array(
	'id' => 'page_options',
	'title' => __('Template Options','office'),
	'pages' => array('page'),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => __('Blog Category', 'office'),
			'id' => $prefix . 'blog_parent',
			'type' => 'blog_cat',
			'desc' => __('Select a category for your blog page.', 'office')
		),
		array(
			'name' => $portfolio_post_type_name . ' ' . __('Category', 'office'),
			'id' => $prefix . 'portfolio_parent',
			'type' => 'portfolio_cat',
			'desc' => __('Select a category for your portfolio page.<br />For the filterable portfolio and portfolio by category it must be a parent category.', 'office')
		),
		array(
			'name' => $services_post_type_name . ' ' . __('Category', 'office'),
			'id' => $prefix . 'service_parent',
			'type' => 'service_cat',
			'desc' => __('Select a category for your services page.', 'office')
		),
		array(
			'name' => $faqs_post_type_name . ' ' . __('Category', 'office'),
			'id' => $prefix . 'faqs_parent',
			'type' => 'faqs_cat',
			'desc' => __('Select a category for your FAQs page.<br />Must choose a parent category.', 'office')
		),
		array(
			'name' => $staff_post_type_name . ' ' . __('Category', 'office'),
			'id' => $prefix . 'staff_parent',
			'type' => 'staff_cat',
			'desc' => __('Select a category for your staff page.<br />Must choose a parent category for the staff by category page template.', 'office')
		),
	)
);

foreach ($office_meta_boxes as $meta_box) {
	new office_meta_box($meta_box);
}
?>