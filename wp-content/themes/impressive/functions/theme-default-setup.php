<?php
/*
 * thumbnail list
*/ 
function impressive_thumbnail_image($content) {
    if( has_post_thumbnail() )
         return the_post_thumbnail( 'thumbnail' ); 
}
/*
* Register Josefin Sans Google font for impressive
*/
function impressive_font_url() {
   $impressive_font_url = '';
   if ('off' !== _x('on', 'JosefinSans font: on or off', 'impressive')) {
       $impressive_font_url = add_query_arg('family', urlencode('Josefin+Sans:400,400italic,600italic,700'), "//fonts.googleapis.com/css");
   }
   return $impressive_font_url;
}
/*
 * impressive Main Sidebar
*/
function impressive_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Main Sidebar', 'impressive' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Main sidebar that appears on the right.', 'impressive' ),
		'before_widget' => '<div class="sidebar-widget %2$s" id="%1$s" >',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'impressive_widgets_init' );

/*
 * impressive Set up post entry meta.
 *
 * Meta information for current post: categories, tags, permalink, author, and date.
 */
function impressive_entry_meta() {

	$impressive_category_list = get_the_category_list( ', ',' ');
	
	$impressive_tag_list = get_the_tag_list(__('Tags : ','impressive'),', ',' ');
	$impressive_date = sprintf( '<time datetime="%1$s">%2$s</time>',
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$impressive_author = sprintf( '<a href="%1$s" title="%2$s" >%3$s</a>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'impressive' ), get_the_author() ) ),
		get_the_author()
	);

	if ($impressive_tag_list) {
		$impressive_utility_text = '<div class="post-meta"><ul><li>'. __('Posted in','impressive') .' : %1$s '. __('on','impressive').' %3$s</li><li> ' . __('by','impressive').' : %4$s </li> <li> %2$s </li> <li> '.impressive_comment_number_custom().'</li></ul></div>';
	} elseif ( $impressive_category_list ) {
		$impressive_utility_text = '<div class="post-meta"><ul><li>'.__('Posted in','impressive').' : %1$s '. __('on','impressive').' %3$s</li><li>'.__('by','impressive').' : %4$s</li><li>  %2$s </li> <li>'.impressive_comment_number_custom().'</li></ul></div>';
	} else {
		$impressive_utility_text = '<div class="post-meta"><ul><li>'. __('Posted on','impressive').' : %3$s </li><li>'.__('by','impressive').' : %4$s </li><li>  %2$s </li><li>'.impressive_comment_number_custom().'</li></ul></div>';
	}
	printf(
		$impressive_utility_text,
		$impressive_category_list,
		$impressive_tag_list,
		$impressive_date,
		$impressive_author
	);
}
function impressive_comment_number_custom(){
$impressive_num_comments = get_comments_number(); // get_comments_number returns only a numeric value
$impressive_comments=__('No Comments','impressive');
if ( comments_open() ) {
	if ( $impressive_num_comments == 0 ) {
		$impressive_comments = __('No Comments','impressive');
	} elseif ( $impressive_num_comments > 1 ) {
		$impressive_comments = $impressive_num_comments . __(' Comments','impressive');
	} else {
		$impressive_comments = __('1 Comment','impressive');
	}
}
return $impressive_comments;
}
/*
 * Comments placeholder function
 * 
**/
add_filter( 'comment_form_default_fields', 'impressive_comment_placeholders' );

function impressive_comment_placeholders( $fields )
{
	$fields['author'] = str_replace(
		'<input',
		'<input placeholder="'
		/* Replace 'theme_text_domain' with your theme’s text domain.
		* I use _x() here to make your translators life easier. :)
		* See http://codex.wordpress.org/Function_Reference/_x
		*/
		. _x(
		'Name *',
		'comment form placeholder',
		'impressive'
		)
		. '" required',
		
	$fields['author']
	);
	$fields['email'] = str_replace(
		'<input',
		'<input placeholder="'
		. _x(
		'Email Id *',
		'comment form placeholder',
		'impressive'
		)
		. '" required',
	$fields['email']
	);
	$fields['url'] = str_replace(
		'<input',
		'<input placeholder="'
		. _x(
		'Website URl',
		'comment form placeholder',
		'impressive'
		)
		. '" required',
	$fields['url']
	);
	
	return $fields;
}
add_filter( 'comment_form_defaults', 'impressive_textarea_insert' );
	function impressive_textarea_insert( $fields )
	{
		$fields['comment_field'] = str_replace(
			'<textarea',
			'<textarea  placeholder="'
			. _x(
			'Comment',
			'comment form placeholder',
			'impressive'
			)
		. '" ',
		$fields['comment_field']
		);
	return $fields;
	}
function impressive_pagination()
{
	the_posts_pagination( array(
				'prev_text'          => __( 'Previous', 'impressive' ),
				'next_text'          => __( 'Next', 'impressive' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . ' ' . ' </span>',
			) );  
}
?>
