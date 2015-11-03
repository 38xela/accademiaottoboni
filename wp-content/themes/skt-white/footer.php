<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package SKT White
 */
?>
 <div id="footer-wrapper">
    	<footer class="footer">    
            <div class="footer-col-1">
            	<h2><?php echo of_get_option('addresstitle',__('SKT White','skt-white')); ?></h2>
                <p><?php echo of_get_option('address',__('Street 238,52 tempor Donec ultricies mattis nulla, suscipit risus tristique ut.','skt-white')) ; ?></p>
                <div class="phone-no">
                	<?php if( of_get_option('phone',true) != ''){ ?>
                		<p><strong><?php _e('Phone:','skt-white'); ?></strong><?php  echo of_get_option('phone','+1 500 000 0000'); ?></p>
                   	<?php } ?>
                    <?php if( of_get_option('email',true) != '' ) { ?>
                    	<p><strong><?php _e('E-mail:','skt-white'); ?></strong><a href="mailto:<?php echo sanitize_email(of_get_option('email','demo@lorem.com')); ?>"><?php echo of_get_option('email','demo@lorem.com'); ?></a></p>
                    <?php } ?>
                    <?php if( of_get_option('weblink',true) != ''){ ?>
                    <p><strong><?php _e('Website:','skt-white'); ?></strong><a href="<?php echo esc_url(of_get_option('weblink','http://www.websitedomain.com')); ?>" target="_blank"><?php echo of_get_option('weblink','http://www.websitedomain.com'); ?></a></p>
                    <?php } ?>
                </div>
            </div>
			<div class="footer-col-3">
            	<div class="social-icons">
                	<?php if( of_get_option('facebook',true) !=  ''){ ?>
                		<a href="<?php echo esc_url(of_get_option('facebook','#')); ?>" target="_blank"><div class="facebook icon"></div></a>
                    <?php } ?>
                    <?php if( of_get_option('twitter',true) != '') { ?>
                        <a href="<?php echo esc_url(of_get_option('twitter','#')); ?>" target="_blank"><div class="twitt icon"></div></a>
                    <?php } ?>
                    <?php if( of_get_option('gplus',true) != ''){ ?>
                        <a href="<?php echo esc_url(of_get_option('gplus','#')); ?>" target="_blank"><div class="gplus icon"></div></a>
                   	<?php } ?>
                    <?php if( of_get_option('youtube',true) != ''){ ?>
                    	<a href="<?php echo esc_url(of_get_option('youtube','#')); ?>" target="_blank"><div class="youtube icon"></div></a>
                    <?php } ?>
                    </div><!-- social-icons -->
            </div>
            <div class="clear"></div>
        </footer>
    </div>
  
<?php wp_footer(); ?>

</body>
</html>