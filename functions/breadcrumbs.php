<?php
/*
* Breadcrumbs Function
* Original source: http://dimox.net/wordpress-breadcrumbs-without-a-plugin/
* Modified by WPExplorer.com
*/

function office_breadcrumbs() {
	
  global $data;	//get theme options
 
  $delimiter = '&raquo;';
  $home = __('Home','office');
  $before = '<span>';
  $after = '</span>';
 
  if ( !is_home() && !is_front_page() || is_paged() ) {
 
    echo '<nav id="breadcrumbs"><span class="breadcrumbs-title">'. __('You are here','office') .':</span>';
 
    global $post; //get global post data
	global $data; //get theme options
	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); //get term
    $homeLink = get_home_url(); //home url
    echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' '; //home link


	//category
    if (is_category()) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $before . '' . single_cat_title('', false) . '' . $after;

	//daily archive
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;
 
 	//month
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;
 
 	//year
    } elseif ( is_year() ) {
		echo $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
		
	  //regular posts
      if ( get_post_type() == 'post' ) {
		if(!empty($data['blog_url'])) {
			echo '<a href="' . $data['blog_url'] . '">' . __('Blog','office') . '</a> ' . $delimiter . ' ';
		}
        $cat = get_the_category(); $cat = $cat[0];
        echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        echo $before . get_the_title() . $after;
	  }
	  
	  //staff posts
	  if ( get_post_type() == 'staff' ) {
		if(!empty($data['staff_url'])) {
			echo '<a href="' . $data['staff_url'] . '">';
		  	if($data['staff_post_type_name']) {
				echo $data['staff_post_type_name'];
			} else {
		 	 	__e('Staff','office');
			}
		  echo '</a> ' . $delimiter . ' ';
		}
		echo $before . get_the_title() . $after;
	  }
	  
	//service posts
	if ( get_post_type() == 'services' ) {
	  if(!empty($data['services_url'])) {
		  echo '<a href="' . $data['services_url'] . '">';
		  	if($data['services_post_type_name']) {
				echo $data['services_post_type_name'];
			} else {
		 	 	__e('Services','office');
			}
		  echo '</a> ' . $delimiter . ' ';
	  }
	  echo $before . get_the_title() . $after;
	}
	
	//faqs posts
	if ( get_post_type() == 'faqs' ) {
	  if(!empty($data['faqs_url'])) {
		   echo '<a href="' . $data['faqs_url'] . '">';
		  	if($data['faqs_post_type_name']) {
				echo $data['faqs_post_type_name'];
			} else {
		 	 	__e('FAQs','office');
			}
		  echo '</a> ' . $delimiter . ' ';
	  }
	  echo $before . get_the_title() . $after;
	}
	
	//portfolio posts
	if ( get_post_type() == 'portfolio' ) {
	  if(!empty($data['portfolio_url'])) {
		  echo '<a href="' . $data['portfolio_url'] . '">';
		  	if($data['portfolio_post_type_name']) {
				echo $data['portfolio_post_type_name'];
			} else {
		 	 	__e('Portfolio','office');
			}
		  echo '</a> ' . $delimiter . ' ';
	  }
	  echo $before . get_the_title() . $after;
	}
	
	//testimonials posts
	if ( get_post_type() == 'testimonials' ) {
	  if(!empty($data['testimonials_url'])) {
		  echo '<a href="' . $data['testimonials_url'] . '">';
		  	if($data['testimonials_post_type_name']) {
				echo $data['testimonials_post_type_name'];
			} else {
		 	 	__e('Testimonials','office');
			}
		  echo '</a> ' . $delimiter . ' ';
	  }
	  echo $before . get_the_title() . $after;
	}

 	//attachment page
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;

	//page
    } elseif ( is_page() && !$post->post_parent ) {
      echo $before . get_the_title() . $after;
 
	//page with parent
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;

	//search page
    } elseif ( is_search() ) {
      echo $before . 'Search results for "' . get_search_query() . '"' . $after;

	//tags
    } elseif ( is_tag() ) {
      echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;

	//author
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . 'Articles posted by ' . $userdata->display_name . $after;

	//404 page
    } elseif ( is_404() ) {
      echo $before . 'Error 404' . $after;
    }
	
	//portfolio categories
	elseif (is_tax( 'portfolio_cats') ) {
	  if(!empty($data['portfolio_url'])) {
		  echo '<a href="' . $data['portfolio_url'] . '">' . __('Portfolio','office') . '</a> ' . $delimiter . ' ';
	  }
	  echo $before . $term->name . $after;
    }
	
	//service categories
	elseif (is_tax( 'service_cats') ) {
	  if(!empty($data['services_url'])) {
		  echo '<a href="' . $data['services_url'] . '">' . __('Services','office') . '</a> ' . $delimiter . ' ';
	  }
	  echo $before . $term->name . $after;
    }
	
	//staff departments
	elseif (is_tax( 'staff_departments')) {
		if(!empty($data['staff_url'])) {
			echo '<a href="' . $data['staff_url'] . '">' . __('Staff','office') . '</a> ' . $delimiter . ' ';
		}
		 echo $before . $term->name . $after;
	}
	
	//faqs categories
	elseif (is_tax( 'faqs_cats')) {
		if(!empty($data['faqs_url'])) {
			echo '<a href="' . $data['faqs_url'] . '">' . __('FAQs','office') . '</a> ' . $delimiter . ' ';
		}
		 echo $before . $term->name . $after;
	}

	//paged
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() )
      echo ' ' .$delimiter . __(' Page', 'office') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() );
    }
 
    echo '</nav>';
 
  }
  
} // end function

?>