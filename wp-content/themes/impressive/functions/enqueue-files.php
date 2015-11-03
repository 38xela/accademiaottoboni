<?php 
/*
 * Impressive Enqueue css and js files
*/
function impressive_enqueue()
{
	wp_enqueue_style('impressive-bootstrap',get_template_directory_uri().'/css/bootstrap.css',array());
	wp_enqueue_style('impressive-font-awesome',get_template_directory_uri().'/css/font-awesome.css',array());
	wp_enqueue_style('impressive-default',get_template_directory_uri().'/css/default.css',array());
	wp_enqueue_style('impressive-style',get_stylesheet_uri(),array());
	
	wp_enqueue_script('impressive-bootstrapjs',get_template_directory_uri().'/js/bootstrap.js',array('jquery'));    
	wp_enqueue_script('impressive-defaultjs',get_template_directory_uri().'/js/default.js',array('jquery'));
	if ( is_singular() ) wp_enqueue_script( "comment-reply" ); 
}
add_action('wp_enqueue_scripts', 'impressive_enqueue');
