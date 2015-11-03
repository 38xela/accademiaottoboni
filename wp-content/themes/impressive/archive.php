<?php 
/**
 * The Archive template file
**/
get_header(); ?>
<section>
  <div class="impressive-container container">
		<div class="site-breadcumb">
			<?php if ( is_day() ) : ?>
				<h1><?php printf( __('Daily Archives: %s', 'impressive' ), get_the_date() ); ?> </h1>
			<?php	elseif ( is_month() ) : ?>
				<h1><?php	printf( __( 'Monthly Archives: %s', 'impressive' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'impressive' ) ) ); ?> </h1>
			<?php elseif ( is_year() ) : ?>
				<h1><?php	printf( __( 'Yearly Archives: %s', 'impressive' ), get_the_date( _x( 'Y', 'yearly archives date format', 'impressive' ) ) ); ?> </h1>
			<?php else : ?>
				<h1><?php _e( 'Archives', 'impressive' ); ?> </h1>
			<?php endif; ?>
			<ol class="breadcrumb breadcrumb-menubar">
			   <?php if (function_exists('impressive_custom_breadcrumbs')) impressive_custom_breadcrumbs(); ?>
			</ol>        
	   </div>
	   <?php get_template_part( 'content', get_post_format() ); ?>
  </div>
</section>
<?php get_footer(); ?>
