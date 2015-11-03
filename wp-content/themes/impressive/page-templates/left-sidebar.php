<?php 
/**
 * Template Name: Left Sidebar
**/
get_header();
?>
<section>
	<div class="impressive-container container">
		<div class="site-breadcumb">
			<h1><?php the_title(); ?> </h1>
			<ol class="breadcrumb breadcrumb-menubar">
				 <?php if (function_exists('impressive_custom_breadcrumbs')) impressive_custom_breadcrumbs(); ?>
			</ol>
		</div>
		<div class="row single-blog-page">
			<?php get_sidebar(); ?> 
			<div class="col-md-9 col-sm-8">
				<?php while ( have_posts() ) : the_post(); ?>	
				<div class="blog-box">
			<?php $impressive_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'large' );  ?>
			<?php if($impressive_image[0] != "") { ?>
				<img src="<?php echo $impressive_image[0]; ?>" width="<?php echo $impressive_image[1]; ?>" height="<?php echo $impressive_image[2]; ?>" class="img-responsive blog-image" alt="<?php the_title(); ?>" />
			<?php } ?> 
					<span class="work-title"><?php the_title(); ?></span>
					<div class="our-blog-details">
						<?php impressive_entry_meta(); ?> 
						<?php the_content(); 
						wp_link_pages( array(
							'before'      => '<div class="col-md-6 col-xs-6">' . __( 'Pages', 'impressive' ) . ':',
							'after'       => '</div>',
							'link_before' => '<span>',
							'link_after'  => '</span>',
							) ); 
						?>
					</div>                            
				</div> 
				 <div class="col-md-12 impressive_pagination">      
					<div class="impressive_previous_pagination"><?php previous_post_link(); ?></div>
					<div class="impressive_next_pagination"><?php  next_post_link(); ?></div>
				</div>
				<div class="comments-article">
							<?php comments_template( '', true ); ?>
			   </div>
			<?php endwhile;  ?>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>
