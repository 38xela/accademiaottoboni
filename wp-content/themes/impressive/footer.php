
<?php $impressive_options = get_option( 'impressive_theme_options' ); ?>
        <footer>
            <div class="footer-bg">
                <div class="impressive-container container">
				  <?php if(empty($impressive_options['remove-footer-logo'])): ?>
					<?php if(!empty($impressive_options['logo']) ) { ?>
						<div class="footer-logo">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img alt="<?php _e('logo','impressive') ?>" src="<?php echo esc_url($impressive_options['logo']); ?>"></a> 
						</div>
				    <?php } ?>
                  <?php endif; ?> 
			      <?php if(empty($impressive_options['remove-footer-socialicon'])): ?>
					<?php if(!empty($impressive_options['fburl']) || !empty($impressive_options['twitter']) || !empty($impressive_options['youtube']) || !empty($impressive_options['rss'])) { ?>
					<div class="footer-social-icon">
						<ul>
							<?php if(!empty($impressive_options['fburl'])) { ?>
							<li> <a href="<?php echo esc_url($impressive_options['fburl']);?>"> <span class="fa fa-facebook"></span> </a> </li>
							<?php } ?>
							<?php if(!empty($impressive_options['twitter'])) { ?>
							<li> <a href="<?php echo esc_url($impressive_options['twitter']);?>"> <span class="fa fa-twitter"></span> </a> </li>
							<?php } ?>
							<?php if(!empty($impressive_options['youtube'])) { ?>
							<li> <a href="<?php echo esc_url($impressive_options['youtube']);?>"> <span class="fa fa-youtube"></span> </a> </li>
							<?php } ?>
							<?php if(!empty($impressive_options['rss'])) { ?>
							<li> <a href="<?php echo esc_url($impressive_options['rss']);?>"> <span class="fa fa-rss"></span> </a> </li>
							<?php } ?>
						</ul>
					</div>
					<?php } ?>
                    <?php endif; ?> 
                    <div class="copyright">
					    <p class="color-text"><?php echo esc_attr($impressive_options['footertext']);?></p>
					    <p>
						<?php
						 printf( __( 'Powered by %1$s and %2$s.', 'impressive' ), '<a href="https://wordpress.org/" target="_blank">WordPress</a>', '<a href="http://fruitthemes.com/wordpress-themes/impressive" target="_blank">Impressive</a>' );
						 ?>
						 </p>
                    </div>
                </div>
            </div>
        </footer>
<?php wp_footer(); ?>
</body>
</html>
