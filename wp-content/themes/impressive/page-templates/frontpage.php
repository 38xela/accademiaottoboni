<?php
/*
 * Template Name: Home Page
 */
get_header();
$impressive_options = get_option( 'impressive_theme_options' );
?>
 <section class="section-main">
		<?php if(!empty($impressive_options['home-title']) || !empty($impressive_options['home-sub-title']) || !empty($impressive_options['homedesc'])) { ?>
		   <div class="impressive-container container">	
                 <div class="about-us">
						<?php if(!empty($impressive_options['home-title']) || !empty($impressive_options['home-sub-title'])) { ?>
						<div class="title">
							<?php if(!empty($impressive_options['home-title'])) {?>
								<h2><?php echo sanitize_text_field($impressive_options['home-title']);?></h2>
							<?php } ?>
							<?php if(!empty($impressive_options['home-sub-title'])) {?>
								<p class="subtitle"><?php echo sanitize_text_field($impressive_options['home-sub-title']);?></p>
							<?php } ?>	
						</div>
						<?php } ?>
						<?php if(!empty($impressive_options['homedesc'])) {?>
							<div class="about-us-details">
								<?php echo $impressive_options['homedesc'];?>
							</div>
						<?php } ?>
				  </div>
		  </div>
        <?php } ?>  
    <?php 
	$impressive_i=1;
	for($impressive_section_i=1; $impressive_section_i <=3 ;$impressive_section_i++ ): ?>
	<?php if(!empty($impressive_options['section-icon-'.$impressive_section_i]) || !empty($impressive_options['sectiontitle-'.$impressive_section_i]) || !empty($impressive_options['sectiondesc-'.$impressive_section_i])) { ?>
	   <?php if($impressive_i == 1) { ?>
		   <div class="impressive-container container">
			  <div class="row">
			<?php } ?>	  
				<div class="col-md-4 col-sm-4 our-services services-box">
				  <?php if(!empty($impressive_options['sectiontitle-'.$impressive_section_i]) || !empty($impressive_options['sectiondesc-'.$impressive_section_i])) { ?>
				   <p class="service-icon"> <span class="fa <?php echo sanitize_text_field($impressive_options['section-icon-'.$impressive_section_i]); ?>"></span> </p>
				  <?php	} ?>
				  <?php if(!empty($impressive_options['sectiontitle-'.$impressive_section_i])) { 
					echo '<h2 class="service-title">'.sanitize_text_field($impressive_options['sectiontitle-'.$impressive_section_i]).'</h2>';
					} ?>
				  <?php if(!empty($impressive_options['sectiondesc-'.$impressive_section_i])) { 
					echo '<p class="service-detail">'.sanitize_text_field($impressive_options['sectiondesc-'.$impressive_section_i]).'</p>';
				   } ?>
				</div>
			   <?php $impressive_i++; ?>
			<?php } ?>
		<?php endfor; ?>   
	<?php if($impressive_section_i >= $impressive_i && $impressive_i > 1) { ?>
			</div>
		</div>
		<?php } ?>
		<?php if(!empty($impressive_options['homemsg']) || !empty($impressive_options['home-button-title'])) {?>
		<div class="get-in-touch">
			<span class="mask"></span>
			<div class="impressive-container container">
				<div class="get-in-touch-info">
					<?php if(!empty($impressive_options['homemsg'])) {?>
						<p><?php echo $impressive_options['homemsg'];?></p>
					<?php } ?>
					<?php if(!empty($impressive_options['home-button-title'])) {?>
					<a href="<?php echo esc_url($impressive_options['home-button-link']);?>" class="site-btn"><?php echo sanitize_text_field($impressive_options['home-button-title']);?></a>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php } ?>	
        <div class="impressive-container container">
             <div class="our-blog">
                <div class="title">
                   <h2><?php if(!empty($impressive_options['home-blog-title'])) {
					echo sanitize_text_field($impressive_options['home-blog-title']);
					}else{
					echo  _e('Our Blog','impressive');
					}	
				?></h2>
				<?php if(!empty($impressive_options['home-blog-sub-title'])) { ?>
					<p class="subtitle"><?php echo sanitize_text_field($impressive_options['home-blog-sub-title']); ?></p>
                <?php } ?>
             </div>
             <div class="row">
			<?php
				$impressive_post_number='4'; 
				if(!empty($impressive_options['bolg-post-number-home'])){
				$impressive_post_number = esc_attr($impressive_options['bolg-post-number-home']);
				}
				$impressive_args = array( 
						'orderby'      => 'post_date', 
						'order'        => 'DESC',
						'post_type'    => 'post',
						'ignore_sticky_posts' => '1',
						'posts_per_page' => $impressive_post_number,
						'post_status'    => 'publish',
						'meta_query' => array(
												array(
												'key' => '_thumbnail_id',
												'compare' => 'EXISTS'
													),
												)	
					  );
				$impressive_query = new WP_Query($impressive_args);
				if ($impressive_query->have_posts() ) : while ($impressive_query->have_posts()) : $impressive_query->the_post(); 
			?>
				<div class="col-md-6 col-sm-6 blog-gallery">
					<?php $impressive_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'impressive-home-blog-image' );   ?>
					<?php if($impressive_image[0] != "") { ?>
						<img src="<?php echo $impressive_image[0]; ?>" width="<?php echo $impressive_image[1]; ?>" height="<?php echo $impressive_image[2]; ?>" class="img-responsive" alt="<?php the_title(); ?>" />
					<?php } ?>
					<a href="<?php echo esc_url( get_permalink() ) ; ?>" class="work-title"><?php the_title(); ?></a>
						<?php impressive_entry_meta(); ?> 
				</div>
				<?php endwhile; endif; ?> 
                    </div>
                </div>
            </div>
        </section>
<?php get_footer(); ?>
