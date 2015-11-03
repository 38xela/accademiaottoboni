<?php 
/**
 * The Search template file
**/
get_header(); ?>
<section>
  <div class="impressive-container container">
      <div class="site-breadcumb"> 
		<?php if ( have_posts() ) : ?>        
			<h1><?php printf( __( 'Search Results for: %s', 'impressive' ), get_search_query() ); ?></h1>
			<ol class="breadcrumb breadcrumb-menubar">
				<?php if (function_exists('impressive_custom_breadcrumbs')) impressive_custom_breadcrumbs(); ?>
			</ol>
		<?php else :
				echo '<h1>' . __('Nothing Found','impressive') . '</h1>';
		endif; ?>	        
      </div>
      <div class="row blog-page">
     <div class="col-md-9 blog-left-page">
	<?php if ( have_posts() ) : ?>   	 
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
	<?php else : ?>
		<div class="blog-search-not-found">
			<?php echo	'<h3>' . __('Sorry, but nothing matched your search terms. Please try again with some different keywords.','impressive') . '</h3>';
			 get_search_form(); ?>
		</div>	 
	<?php endif; ?>
			 
		<div class="site-pagination">      
			<?php impressive_pagination(); ?>
		</div>       
      </div>     
	   <?php  get_sidebar();  ?>	
	</div>
 </div>
</section>
<?php get_footer(); ?>
