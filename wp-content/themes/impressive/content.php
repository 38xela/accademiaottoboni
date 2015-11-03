<?php
/**
 * The default template for displaying content
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row blog-page">
     <div class="col-md-9 blog-left-page">
	 <?php while ( have_posts() ) : the_post(); ?>		  
         <div class="blog-box">	
		  <?php $impressive_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'large' );   ?>
			<?php if($impressive_image[0] != "") { ?>
						<img src="<?php echo $impressive_image[0]; ?>" width="<?php echo $impressive_image[1]; ?>" height="<?php echo $impressive_image[2]; ?>" class="img-responsive blog-image" alt="<?php the_title(); ?>" />
			<?php } ?> 				
          <div class="blog-data">
              <a href="<?php echo esc_url( get_permalink() ); ?>" class="work-title"><?php the_title();?></a>
              <div class="our-blog-details">
				<?php impressive_entry_meta(); ?>              				
				<?php the_excerpt(); ?>                             
			  </div>	
          </div>
        </div>               
	<?php endwhile;  ?> 	 
		<div class="site-pagination">      
			<?php impressive_pagination(); ?>
		</div>       
      </div>     
	   <?php  get_sidebar();  ?>	
	</div>
</article><!-- #post-## -->
