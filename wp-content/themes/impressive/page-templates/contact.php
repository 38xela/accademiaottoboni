<?php
/**
 * Template Name: Contact Us
 * */
get_header();
$impressive_options = get_option( 'impressive_theme_options' );
?>
<section>
    <div class="impressive-container container">
        <div class="site-breadcumb">
            <h1><?php the_title(); ?> </h1>
            <ol class="breadcrumb breadcrumb-menubar">
                <?php if (function_exists('impressive_custom_breadcrumbs')) impressive_custom_breadcrumbs(); ?>
            </ol>
        </div>
        <div class="row contact-page">       
            <?php while (have_posts()) : the_post(); ?>
                <div class="col-md-8 col-sm-6 contact-form">
                    <?php the_content(); ?> 
                </div>
            <?php endwhile; ?>	
            <div class="col-md-4 col-sm-6">
                <div class="contact-info">
					<h3>
					<?php
						if (!empty($impressive_options['contact-info-title'])) {
							echo esc_attr($impressive_options['contact-info-title']);
						} else {
							 _e('Contact Information','impressive');
						}
						?>
					</h3>
 				 <?php if (!empty($impressive_options['contact-info'])) { 
						echo '<p>'.esc_attr($impressive_options['contact-info']).'</p>';
                  } ?>   
                 <?php if(!empty($impressive_options['contact-telephone']) || !empty($impressive_options['contact-fax']) || !empty($impressive_options['contact-email']) || !empty($impressive_options['contact-web']) || !empty($impressive_options['contact-address'])) { ?>  
                    <div class="contact-add">
                        <ul> 
							<?php if (!empty($impressive_options['contact-telephone'])) {  ?>
								<li><p><?php _e('Telephone  ','impressive'); ?></p> :<span>  <?php echo esc_attr($impressive_options['contact-telephone']) ?></span></li>         
                            <?php  } ?>  
                            <?php if (!empty($impressive_options['contact-fax'])) {  ?>               
								<li><p><?php _e('Fax  ','','impressive'); ?></p>:<span> <?php echo esc_attr($impressive_options['contact-fax']) ?></span></li>
                            <?php } ?>
                            <?php if (!empty($impressive_options['contact-email'])) {  ?>
								<li><p><?php _e('E-Mail  ','impressive'); ?> </p>:<span> <?php echo sanitize_email($impressive_options['contact-email']) ?></span></li>
                            <?php } ?>
                            <?php if (!empty($impressive_options['contact-web'])) {  ?>
								<li><p><?php _e('Website  ','impressive'); ?></p>:<span> <a href="<?php echo esc_url($impressive_options['contact-web']) ?>"><?php echo esc_url($impressive_options['contact-web']) ?></a></span></li>
                            <?php } ?>
                            <?php if (!empty($impressive_options['contact-address'])) {  ?>
								<li><p><?php _e('Address  ','impressive'); ?></p>:<span>  <?php echo esc_attr($impressive_options['contact-address']) ?></span></li>
                            <?php } ?>
                        </ul>
                    </div>                    
                 <?php } ?>
                </div>                
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>
