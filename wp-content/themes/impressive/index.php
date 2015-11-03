<?php 
/**
 *The main index template file
**/
get_header(); ?>
<?php $impressive_options = get_option( 'impressive_theme_options' ); ?>
<section>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
	<div class="impressive-container container">
		<div class="site-breadcumb">
			<h1>
				<?php if(!empty($impressive_options['blogtitle'])) { 
					echo esc_attr($impressive_options['blogtitle']);
				 } else { 	
					echo _e('Our Blog','impressive');
				} ?>
			</h1>
		</div>
		<?php get_template_part( 'content', get_post_format() ); ?>
	</div>
</div>	
</section>
<?php get_footer(); ?>
