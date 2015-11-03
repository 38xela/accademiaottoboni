<?php
/*
 * impressive Breadcrumbs
*/
function impressive_custom_breadcrumbs() {

  $impressive_showonhome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $impressive_delimiter = '/'; // impressive_delimiter between crumbs
  $impressive_home = __('Home','impressive'); // text for the 'Home' link
  $impressive_showcurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $impressive_before = ' '; // tag before the current crumb
  $impressive_after = ' '; // tag after the current crumb

  global $post;
  $impressive_homelink = esc_url(home_url('/'));

  if (is_home() || is_front_page()) {

    if ($impressive_showonhome == 1) echo '<li><a href="' . $impressive_homelink . '">' . $impressive_home . '</a></li>';
    
  }  else {

    echo '<li><a href="' . $impressive_homelink . '">' . $impressive_home . '</a> ' . $impressive_delimiter . '';
    
   if ( is_category() ) {
      $impressive_thisCat = get_category(get_query_var('cat'), false);
      if ($impressive_thisCat->parent != 0) echo get_category_parents($impressive_thisCat->parent, TRUE, ' ' . $impressive_delimiter . ' ');      
		echo $impressive_before; _e('category','impressive'); echo ' "'.single_cat_title('', false) . '"' . $impressive_after;
    } 
    elseif ( is_search() ) {
      echo $impressive_before; _e('Search Results For','impressive'); echo ' "'. get_search_query() . '"' . $impressive_after;

    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $impressive_delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $impressive_delimiter . ' ';
      echo $impressive_before . get_the_time('d') . $impressive_after;

    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $impressive_delimiter . ' ';
      echo $impressive_before . get_the_time('F') . $impressive_after;

    } elseif ( is_year() ) {
      echo $impressive_before . get_the_time('Y') . $impressive_after;

    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $impressive_post_type = get_post_type_object(get_post_type());
        $impressive_slug = $impressive_post_type->rewrite;
        echo '<a href="' . $impressive_homelink . '/' . $impressive_slug['slug'] . '/">' . $impressive_post_type->labels->singular_name . '</a>';
        if ($impressive_showcurrent == 1) echo ' ' . $impressive_delimiter . ' ' . $impressive_before . get_the_title() . $impressive_after;
      } else {
        $impressive_cat = get_the_category(); $impressive_cat = $impressive_cat[0];
        $impressive_cats = get_category_parents($impressive_cat, TRUE, ' ' . $impressive_delimiter . ' ');
        if ($impressive_showcurrent == 0) $impressive_cats = preg_replace("#^(.+)\s$impressive_delimiter\s$#", "$1", $impressive_cats);
        echo $impressive_cats;
        if ($impressive_showcurrent == 1) echo $impressive_before . get_the_title() . $impressive_after;
      }

    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $impressive_post_type = get_post_type_object(get_post_type());
      echo $impressive_before . $impressive_post_type->labels->singular_name . $impressive_after;

    } elseif ( is_attachment() ) {
      $impressive_parent = get_post($post->post_parent);
      $impressive_cat = get_the_category($impressive_parent->ID); $impressive_cat = $impressive_cat[0];
      echo get_category_parents($impressive_cat, TRUE, ' ' . $impressive_delimiter . ' ');
      echo '<a href="' . get_permalink($impressive_parent) . '">' . $impressive_parent->post_title . '</a>';
      if ($impressive_showcurrent == 1) echo ' ' . $impressive_delimiter . ' ' . $impressive_before . get_the_title() . $impressive_after;

    } elseif ( is_page() && !$post->post_parent ) {
      if ($impressive_showcurrent == 1) echo $impressive_before . get_the_title() . $impressive_after;

    } elseif ( is_page() && $post->post_parent ) {
      $impressive_parent_id  = $post->post_parent;
      $impressive_breadcrumbs = array();
      while ($impressive_parent_id) {
        $impressive_page = get_page($impressive_parent_id);
        $impressive_breadcrumbs[] = '<a href="' . get_permalink($impressive_page->ID) . '">' . get_the_title($impressive_page->ID) . '</a>';
        $impressive_parent_id  = $impressive_page->post_parent;
      }
      $impressive_breadcrumbs = array_reverse($impressive_breadcrumbs);
      for ($impressive_i = 0; $impressive_i < count($impressive_breadcrumbs); $impressive_i++) {
        echo $impressive_breadcrumbs[$impressive_i];
        if ($impressive_i != count($impressive_breadcrumbs)-1) echo ' ' . $impressive_delimiter . ' ';
      }
      if ($impressive_showcurrent == 1) echo ' ' . $impressive_delimiter . ' ' . $impressive_before . get_the_title() . $impressive_after;

    } elseif ( is_tag() ) {
      echo $impressive_before; _e('Posts tagged','impressive'); echo ' "'.  single_tag_title('', false) . '"' . $impressive_after;

    } elseif ( is_author() ) {
       global $author;
      $impressive_userdata = get_userdata($author);
      echo $impressive_before; _e('Articles posted by ','impressive'); echo $impressive_userdata->display_name . $impressive_after;

    } elseif ( is_404() ) {
      echo $impressive_before; _e('Error 404','impressive'); echo $impressive_after;
    }
    
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page','impressive') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
    echo '</li>';

  }
} 
