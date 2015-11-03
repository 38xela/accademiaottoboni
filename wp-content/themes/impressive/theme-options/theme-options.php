<?php
function impressive_options_init(){
 register_setting( 'impressive_option', 'impressive_theme_options','impressive_option_validate');
} 
add_action( 'admin_init', 'impressive_options_init' );
function impressive_option_validate($input)
{
	 $input['logo'] = impressive_image_validation(esc_url_raw( $input['logo'] ));
	 $input['favicon'] = impressive_image_validation(esc_url_raw( $input['favicon'] ));
	 $input['footertext'] = sanitize_text_field( $input['footertext'] );
	 $input['blogtitle'] = sanitize_text_field( $input['blogtitle'] );
	 
	 $input['fburl'] = esc_url_raw( $input['fburl'] );
	 $input['twitter'] = esc_url_raw( $input['twitter'] );
	 $input['rss'] = esc_url_raw( $input['rss'] );	
	 $input['youtube'] = esc_url_raw( $input['youtube'] ); 
	 
	 $input['headertop-bg'] = impressive_image_validation(esc_url_raw( $input['headertop-bg'] ));
	 $input['get-in-touch-background'] = impressive_image_validation(esc_url_raw( $input['get-in-touch-background'] ));
	 
	 $input['home-title'] = sanitize_text_field( $input['home-title'] );
	 $input['home-sub-title'] = sanitize_text_field( $input['home-sub-title'] );
	 
	 for($impressive_l=1; $impressive_l <= 3 ;$impressive_l++ ):
	 	$input['section-icon-'.$impressive_l] = sanitize_text_field( $input['section-icon-'.$impressive_l] );
	 	$input['sectiontitle-'.$impressive_l] = sanitize_text_field( $input['sectiontitle-'.$impressive_l] );
	 	$input['sectiondesc-'.$impressive_l] = sanitize_text_field( $input['sectiondesc-'.$impressive_l] );
	 endfor;

	  $input['home-button-link'] = esc_url_raw( $input['home-button-link'] );
	  $input['home-blog-title'] = sanitize_text_field( $input['home-blog-title'] );
	  $input['home-blog-sub-title'] = sanitize_text_field( $input['home-blog-sub-title'] );
	  
	  $input['contact-info-title'] = sanitize_text_field( $input['contact-info-title'] );
	  $input['contact-info'] = sanitize_text_field( $input['contact-info'] );
	  $input['contact-telephone'] = wp_filter_nohtml_kses( $input['contact-telephone'] );
	  $input['contact-fax'] = wp_filter_nohtml_kses( $input['contact-fax'] );
	  $input['contact-email'] = sanitize_email( $input['contact-email'] );
	  $input['contact-web'] = esc_url_raw( $input['contact-web'] );
	  $input['contact-address'] = sanitize_text_field( $input['contact-address'] );
		 
    return $input;
}
function impressive_image_validation($impressive_imge_url){
	$impressive_filetype = wp_check_filetype($impressive_imge_url);
	$impressive_supported_image = array('gif','jpg','jpeg','png','ico');
	if (in_array($impressive_filetype['ext'], $impressive_supported_image)) {
		return $impressive_imge_url;
	} else {
	return '';
	}
}
function impressive_framework_load_scripts(){
	wp_enqueue_media();
	wp_enqueue_style( 'impressive_framework', get_template_directory_uri(). '/theme-options/css/impressive_framework.css' ,false, '1.0.0');	
	wp_enqueue_script( 'options-custom', get_template_directory_uri(). '/theme-options/js/impressive-custom.js', array( 'jquery' ) );
	wp_enqueue_script( 'media-uploader', get_template_directory_uri(). '/theme-options/js/media-uploader.js', array( 'jquery') );		

}
add_action( 'admin_enqueue_scripts', 'impressive_framework_load_scripts' );
function impressive_framework_menu_settings() {
	$impressive_menu = array(
				'page_title' => __( 'Theme Options', 'impressive_framework'),
				'menu_title' => __('Theme Options', 'impressive_framework'),
				'capability' => 'edit_theme_options',
				'menu_slug' => 'impressive_framework',
				'callback' => 'impressive_framework_page'
				);
	return apply_filters( 'impressive_framework_menu', $impressive_menu );
}
add_action( 'admin_menu', 'impressive_options_add_page' ); 
function impressive_options_add_page() {
	$impressive_menu = impressive_framework_menu_settings();
   	add_theme_page($impressive_menu['page_title'],$impressive_menu['menu_title'],$impressive_menu['capability'],$impressive_menu['menu_slug'],$impressive_menu['callback']);
} 
function impressive_framework_page(){ 
		global $select_options; 
		if ( ! isset( $_REQUEST['settings-updated'] ) ) 
		$_REQUEST['settings-updated'] = false;		
?>
<div class="themeoption-themes">
	<form method="post" action="options.php" id="form-option" class="theme_option_ft">
  <div class="themeoption-header">
    <div class="logo">
      <?php
		$impressive_image=get_template_directory_uri().'/theme-options/images/logo.png';
			echo "<a href='http://fruitthemes.com' target='_blank'><img src='".esc_url($impressive_image)."' alt='".__('FruitThemes','impressive')."'  /></a>";
		?>
    </div>
    <div class="header-right">
    	<div class='btn-save'><input type='submit' class='button-primary' value='<?php _e('Save Options','impressive'); ?>' />
	</div>
    </div>
  </div>
  <div class="themeoption-details">
    <div class="themeoption-options">
      <div class="right-box">
        <div class="nav-tab-wrapper">
          <div class="option-title">
            <h2><?php _e('Theme Options','impressive'); ?></h2>
          </div>  
          <ul>
            <li><a id="options-group-1-tab" class="nav-tab basicsettings-tab" title="<?php _e('Basic Settings','impressive');?>" href="#options-group-1"><?php _e('Basic Settings','impressive');?></a></li>
            <li><a id="options-group-5-tab" class="nav-tab headersettings-tab" title="<?php _e('Header Settings','impressive');?>" href="#options-group-5"><?php _e('Header Settings','impressive');?></a></li>  
            <li><a id="options-group-4-tab" class="nav-tab footersettings-tab" title="<?php _e('Footer Settings','impressive');?>" href="#options-group-4"><?php _e('Footer Settings','impressive');?></a></li>  
            <li><a id="options-group-2-tab" class="nav-tab homepagesettings-tab" title="<?php _e('Home Page Settings','impressive');?>" href="#options-group-2"><?php _e('Home Page Settings','impressive');?></a></li>
            <li><a id="options-group-3-tab" class="nav-tab socialsettings-tab" title="<?php _e('Social Settings','impressive');?>" href="#options-group-3"><?php _e('Social Settings','impressive');?></a></li>
             <li><a id="options-group-6-tab" class="nav-tab contactsettings-tab" title="<?php _e('Contact Us Settings','impressive');?>" href="#options-group-6"><?php _e('Contact Us Settings','impressive');?></a></li>
              <li><a id="options-group-7-tab" class="nav-tab profeatures-tab" title="<?php _e('PRO Theme Features','impressive');?>" href="#options-group-7"><?php _e('PRO Theme Features','impressive');?></a></li> 
 		  </ul>
        </div>
      </div>
      <div class="right-box-bg"></div>
      <div class="postbox left-box"> 
        <!--======================== F I N A L - - T H E M E - - O P T I O N ===================-->
          <?php settings_fields( 'impressive_option' );  
			$impressive_options = get_option( 'impressive_theme_options' );
		 ?>
          <!-------------- Basic Settings group ----------------->
          <div id="options-group-1" class="group theme-option-inner-tabs">   
			<div class="section theme-tabs theme-logo">
            <a class="heading theme-option-inner-tab active" href="javascript:void(0)"><?php _e('Site Logo (Recommended Size : 600px * 100px)','impressive'); ?></a>
            <div class="theme-option-inner-tab-group active">
				<div class="explain"><?php _e('Size of Logo should be exactly 600x100px for best results.','impressive'); ?></div>
              	<div class="ft-control">
                <input id="logo-img" class="upload" type="text" name="impressive_theme_options[logo]" 
                            value="<?php if(!empty($impressive_options['logo'])) { echo esc_url_raw($impressive_options['logo']); } ?>" placeholder="<?php _e('No file chosen','impressive'); ?>" />
                <input id="upload_image_button" class="upload-button button" type="button" value="<?php _e('Upload','impressive'); ?>" />
                <div class="screenshot" id="logo-image">
                  <?php if(!empty($impressive_options['logo'])) { ?>
					  <img src="<?php echo esc_url($impressive_options['logo']) ?>" alt="<?php _e('logo','impressive'); ?>" />
					  <a class='remove-image'> </a>
				  <?php } ?>
                </div>
              </div>
              
            </div>
          </div>
          <div class="section theme-tabs theme-favicon">
              <a class="heading theme-option-inner-tab" href="javascript:void(0)"><?php _e('Favicon (Recommended Size : 32px * 32px)','impressive'); ?></a>
              <div class="theme-option-inner-tab-group">
              	<div class="explain"><?php _e('Size of favicon should be exactly 32x32px for best results.','impressive'); ?></div>
                <div class="ft-control">
                  <input id="favicon-img" class="upload" type="text" name="impressive_theme_options[favicon]" 
                            value="<?php if(!empty($impressive_options['favicon'])) { echo esc_url_raw($impressive_options['favicon']); } ?>" placeholder="<?php _e('No file chosen','impressive'); ?>" />
                  <input id="upload_image_button1" class="upload-button button" type="button" value="<?php _e('Upload','impressive'); ?>" />
                  <div class="screenshot" id="favicon-image">
                    <?php  if(!empty($impressive_options['favicon'])) { ?>
						<img src="<?php echo esc_url($impressive_options['favicon']) ?>" alt="<?php _e('favicon','impressive'); ?>" />	<a class='remove-image'> </a>
					<?php } ?>
                  </div>
                </div>
              </div>
            </div>     
            <div id="section-blogtitle" class="section theme-tabs">
            	<a class="heading theme-option-inner-tab" href="javascript:void(0)"><?php _e('Blog Title','impressive'); ?></a>
              <div class="theme-option-inner-tab-group">
              	<div class="ft-control">
                  	<input type="text" id="blogtitle" class="of-input" name="impressive_theme_options[blogtitle]" maxlength="30" size="32"  value="<?php if(!empty($impressive_options['blogtitle'])) { echo sanitize_text_field($impressive_options['blogtitle']); } ?>">
                </div>                
              </div>
            </div>
          </div>          
          <!-------------- Header Settings group ----------------->
          <div id="options-group-5" class="group theme-option-inner-tabs">
			 <div class="theme-tabs theme-fonts">
				<div style="display: block;">
				<div class="ft-control">
					<input type="checkbox" id="impressive-remove-header-socialicon" name="impressive_theme_options[remove-header-socialicon]" <?php if(!empty($impressive_options['remove-header-socialicon'])) { ?> checked="checked" <?php } ?> value="yes">
					<label class="remove-slider-class" for="impressive-remove-header-socialicon"><?php _e('Check this if you want to hide the header social menu icon.','impressive') ?></label>
               </div>
			   </div>
			</div> 
            <div id="headertop-bg" class="section theme-tabs">
            	<a class="heading theme-option-inner-tab" href="javascript:void(0)"><?php _e('Header Backgroung Image (Recommended Size : 1350px * 667px)','impressive'); ?></a>
              <div class="theme-option-inner-tab-group">
              		<div class="ft-control">
                <input id="headertop-bg" class="upload" type="text" name="impressive_theme_options[headertop-bg]" 
                            value="<?php if(!empty($impressive_options['headertop-bg'])) { echo esc_url($impressive_options['headertop-bg']); } ?>" placeholder="<?php _e('No file chosen','impressive'); ?>" />
                <input id="upload_image_button" class="upload-button button" type="button" value="<?php _e('Upload','impressive'); ?>" />
                <div class="screenshot" id="headertop-bg">
                  <?php if(!empty($impressive_options['headertop-bg'])) { echo "<img src='".esc_url($impressive_options['headertop-bg'])."' /><a class='remove-image'></a>"; } ?>
                </div>
              </div>
              </div>
            </div>
		</div>
          <!-------------- Footer Settings group ----------------->
          <div id="options-group-4" class="group theme-option-inner-tabs">
			<div class="theme-tabs theme-hide-check">
				<div style="display: block;">
				<div class="ft-control">
					<input type="checkbox" id="impressive-remove-footer-logo" name="impressive_theme_options[remove-footer-logo]" <?php if(!empty($impressive_options['remove-footer-logo'])) { ?> checked="checked" <?php } ?> value="yes">
					<label class="remove-slider-class" for="impressive-remove-footer-logo"><?php _e('Check this if you want to hide the footer logo.','impressive') ?></label>
               </div>
			   </div>
			</div>  
			<div class="theme-tabs theme-fonts">
				<div style="display: block;">
				<div class="ft-control">
					<input type="checkbox" id="impressive-remove-footer-socialicon" name="impressive_theme_options[remove-footer-socialicon]" <?php if(!empty($impressive_options['remove-footer-socialicon'])) { ?> checked="checked" <?php } ?> value="yes">
					<label class="remove-slider-class" for="impressive-remove-footer-socialicon"><?php _e('Check this if you want to hide the footer social icon.','impressive') ?></label>
               </div>
			   </div>
			</div>
			<div id="section-footertext" class="section theme-tabs">
            	<a class="heading theme-option-inner-tab" href="javascript:void(0)"><?php _e('Copyright Text','impressive'); ?></a>
              <div class="theme-option-inner-tab-group">
              	<div class="ft-control">
              		<div class="explain"><?php _e('Some text regarding copyright of your site, you would like to display in the footer.','impressive'); ?></div>                
                  	<input type="text" id="footertext" class="of-input" maxlength="100" name="impressive_theme_options[footertext]" size="32"  value="<?php if(!empty($impressive_options['footertext'])) { echo sanitize_text_field($impressive_options['footertext']); } ?>">
                </div>                
              </div>
            </div>
		</div>
          <!-------------- Home Page Settings group ----------------->
          <div id="options-group-2" class="group theme-option-inner-tabs">
		 <h3><?php _e('Title Bar','impressive'); ?></h3>		  
		 <div class="section theme-tabs theme-logo">
            <a class="heading theme-option-inner-tab" href="javascript:void(0)"><?php _e('Title Bar','impressive');?> </a>
               <div class="theme-option-inner-tab-group">
				  <div class="ft-control">
					<input id="home-title" class="of-input" name="impressive_theme_options[home-title]" type="text" maxlength="30" size="46" value="<?php if(!empty($impressive_options['home-title'])) { echo esc_attr($impressive_options['home-title']); } ?>"  placeholder="<?php _e('Home Title ','impressive'); ?>" />
				  </div>
				  <div class="ft-control">	
					<input id="home-sub-title" class="of-input" name="impressive_theme_options[home-sub-title]" type="text" maxlength="100" size="46" value="<?php if(!empty($impressive_options['home-sub-title'])) { echo esc_attr($impressive_options['home-sub-title']); } ?>"  placeholder="<?php _e('Home Sub Title','impressive'); ?>" />
				  </div>
				  <div class="ft-control">	
					<?php 				
						 $impressive_content = wpautop($impressive_options['homedesc']);
						 $impressive_editor_id = 'homedesc';
						 $impressive_settings = array(
								'textarea_name' => 'impressive_theme_options[homedesc]',
								'textarea_rows' => 20,
								'media_buttons' => false,
								);
						 wp_editor($impressive_content, $impressive_editor_id, $impressive_settings);
					 ?> 
                  </div>
                </div>
         </div>
	  <?php /** Our Services tab... **/	 ?> 		
		 <h3><?php _e('Our Services','impressive'); ?></h3>	 
		 <?php for($impressive_j=1; $impressive_j <= 3 ;$impressive_j++ ):?> 
           <div class="section theme-tabs theme-logo">
            <a class="heading theme-option-inner-tab" href="javascript:void(0)"><?php _e('Tab','impressive');?> <?php echo $impressive_j; ?></a>
               <div class="theme-option-inner-tab-group">
				  <div class="ft-control">
					<input id="section-icon-<?php echo $impressive_j; ?>" class="of-input" maxlength="30" name="impressive_theme_options[section-icon-<?php echo $impressive_j; ?>]" type="text" size="46" value="<?php if(!empty($impressive_options['section-icon-'.$impressive_j])) { echo  esc_attr($impressive_options['section-icon-'.$impressive_j]); } ?>"  placeholder="<?php _e('Section Icon','impressive'); ?>" />
					<span><?php _e('Font Awesome icon names','impressive'); ?> <a target="_blank" href="http://fortawesome.github.io/Font-Awesome/icons/"><?php _e('[View all]','impressive'); ?></a></span>
				  </div>
				  <div class="ft-control">	
					<input id="sectiontitle-<?php echo $impressive_j; ?>" class="of-input" maxlength="50" name="impressive_theme_options[sectiontitle-<?php echo $impressive_j; ?>]" type="text" size="46" value="<?php if(!empty($impressive_options['sectiontitle-'.$impressive_j])) { echo esc_attr($impressive_options['sectiontitle-'.$impressive_j]); } ?>"  placeholder="<?php _e('Section Title','impressive'); ?>" />
				  </div>
				  <div class="ft-control">	
					<textarea name="impressive_theme_options[sectiondesc-<?php echo $impressive_j; ?>]" id="sectiondesc-<?php echo $impressive_j; ?>" class="of-input" placeholder="<?php _e('Section Description','impressive'); ?>" maxlength="150" rows="5" ><?php if(!empty($impressive_options['sectiondesc-'.$impressive_j])) { echo esc_attr($impressive_options['sectiondesc-'.$impressive_j]); } ?></textarea>
                  </div>
              </div>
           </div>
         <?php endfor; ?>
		<h3><?php _e('Get In Touch','impressive'); ?></h3>		  
		<div id="get-in-touch-background" class="section theme-tabs">
            	<a class="heading theme-option-inner-tab" href="javascript:void(0)"><?php _e('Home page get in touch backgroung image (Recommended Size : 1350px * 400px)','impressive'); ?></a> 
              <div class="theme-option-inner-tab-group"> 
              		<div class="ft-control">
                <input id="get-in-touch-background" class="upload" type="text" name="impressive_theme_options[get-in-touch-background]" 
                            value="<?php if(!empty($impressive_options['get-in-touch-background'])) { echo esc_url($impressive_options['get-in-touch-background']); } ?>" placeholder="<?php _e('No file chosen','impressive'); ?>" />
                <input id="upload_image_button" class="upload-button button" type="button" value="<?php _e('Upload','impressive'); ?>" />
                <div class="screenshot" id="get-in-touch-background">
                  <?php if(!empty($impressive_options['get-in-touch-background'])) { echo "<img src='".esc_url($impressive_options['get-in-touch-background'])."' alt='".__('get in touch bg','impressive')."' /><a class='remove-image'></a>"; } ?>
                </div>
              </div>
             </div>
            </div>
            <div id="button-title" class="section theme-tabs">
            	<a class="heading theme-option-inner-tab" href="javascript:void(0)"><?php _e('Button title','impressive'); ?></a> 
              <div class="theme-option-inner-tab-group"> 
					<div class="ft-control">	
					<input id="home-button-title" class="of-input" maxlength="30" name="impressive_theme_options[home-button-title]" type="text" size="46" value="<?php if(!empty($impressive_options['home-button-title'])) { echo esc_attr($impressive_options['home-button-title']); } ?>"  placeholder="<?php _e('Button Title','impressive'); ?>" />
				  </div>
			  </div>
			  </div> 	
			 <div id="button-link" class="section theme-tabs">
            	<a class="heading theme-option-inner-tab" href="javascript:void(0)"><?php _e('Button Link','impressive'); ?></a> 
              <div class="theme-option-inner-tab-group"> 
					<div class="ft-control">	
					<input id="home-button-link" class="of-input" name="impressive_theme_options[home-button-link]"  type="text" size="46" value="<?php if(!empty($impressive_options['home-button-link'])) { echo esc_url_raw($impressive_options['home-button-link']); } ?>"  placeholder="<?php _e('Button Link','impressive'); ?>" />
				  </div>
			 </div></div>	     
		 <div class="section theme-tabs">
            <a class="heading theme-option-inner-tab" href="javascript:void(0)"><?php _e('Get In Touch Text','impressive');?> </a>
               <div class="theme-option-inner-tab-group">
				  <div class="ft-control">	
				   <?php 				
						 $impressive_content = wpautop($impressive_options['homemsg']);
						 $impressive_editor_id = 'homemsg';
						 $impressive_settings = array(
								'textarea_name' => 'impressive_theme_options[homemsg]',
								'textarea_rows' => 20,
								'media_buttons' => false
								);
						 wp_editor($impressive_content, $impressive_editor_id, $impressive_settings);
				   ?> 
                  </div>
                </div>
         </div>
		 <h3><?php _e('Blog Section','impressive'); ?></h3>		  
		  <div class="section theme-tabs theme-logo">
            <a class="heading theme-option-inner-tab" href="javascript:void(0)"><?php _e('Blog Section','impressive');?> </a>
               <div class="theme-option-inner-tab-group">
				   <div class="ft-control">
					<input id="home-blog-title" class="of-input" name="impressive_theme_options[home-blog-title]" type="text" maxlength="30" size="46" value="<?php if(!empty($impressive_options['home-blog-title'])) { echo esc_attr($impressive_options['home-blog-title']); } ?>"  placeholder="<?php _e('Blog Title','impressive'); ?>" />
				  </div>		
				  <div class="ft-control">
					<input id="home-blog-sub-title" class="of-input" name="impressive_theme_options[home-blog-sub-title]" maxlength="60" type="text" size="46" value="<?php if(!empty($impressive_options['home-blog-sub-title'])) { echo esc_attr($impressive_options['home-blog-sub-title']); } ?>"  placeholder="<?php _e('Blog Sub Title','impressive'); ?>" />
				  </div>
				  	
				  <div class="ft-control">
						<div class="explain"><?php _e('Enter number of blog items , you would like to display in the home page.','impressive'); ?></div>
						<input type="number" name="impressive_theme_options[blog-post-number-home]" min=0 max=99 value="<?php if(!empty($impressive_options['blog-post-number-home'])) { echo $impressive_options['blog-post-number-home']; } ?>" />
				  </div>	
              </div>
         </div>
           </div>
          <!-------------- Social Settings group ----------------->
          <div id="options-group-3" class="group theme-option-inner-tabs">            
            <div id="section-facebook" class="section theme-tabs">
            	<a class="heading theme-option-inner-tab active" href="javascript:void(0)"><?php _e('Facebook','impressive'); ?></a>
              <div class="theme-option-inner-tab-group active">
              	<div class="ft-control">
              		<div class="explain"><?php _e('Facebook profile or page URL ','impressive'); ?>i.e. http://facebook.com/username/ </div>      	<input id="facebook" class="of-input" name="impressive_theme_options[fburl]" size="30" type="text" value="<?php if(!empty($impressive_options['fburl'])) { echo esc_url_raw($impressive_options['fburl']); } ?>" />
                </div>                
              </div>
            </div>
            <div id="section-twitter" class="section theme-tabs">
            	<a class="heading theme-option-inner-tab" href="javascript:void(0)"><?php _e('Twitter','impressive'); ?></a>
              <div class="theme-option-inner-tab-group">
              	<div class="ft-control">
              		<div class="explain"><?php _e('Twitter profile or page URL ','impressive'); ?>i.e. http://www.twitter.com/username/</div>                
                  	<input id="twitter" class="of-input" name="impressive_theme_options[twitter]" type="text" size="30" value="<?php if(!empty($impressive_options['twitter'])) { echo esc_url_raw($impressive_options['twitter']); } ?>" />
                </div>                
              </div>
            </div>
            <div id="section-youtube" class="section theme-tabs">
            	<a class="heading theme-option-inner-tab" href="javascript:void(0)"><?php _e('Youtube','impressive'); ?></a>
              <div class="theme-option-inner-tab-group">
              	<div class="ft-control">
              		<div class="explain"><?php _e('youtube profile or page URL ','impressive'); ?>i.e. https://youtube.com/username/</div>                
                  	 <input id="youtube" class="of-input" name="impressive_theme_options[youtube]" type="text" size="30" value="<?php if(!empty($impressive_options['youtube'])) { echo esc_url_raw($impressive_options['youtube']); } ?>" />
                </div>                
              </div>
            </div>
			<div id="section-rss" class="section theme-tabs">
            	<a class="heading theme-option-inner-tab" href="javascript:void(0)"><?php _e('RSS','impressive'); ?></a>
              <div class="theme-option-inner-tab-group">
              	<div class="ft-control">
              		<div class="explain"><?php _e('RSS profile or page URL ','impressive'); ?>i.e. https://www.rss.com/username/</div>                
                  	<input id="rss" class="of-input" name="impressive_theme_options[rss]" type="text" size="30" value="<?php if(!empty($impressive_options['rss'])) { echo esc_url_raw($impressive_options['rss']); } ?>" />
                </div>                
              </div>
            </div>
          </div>
		  <!-------------- Contact page Settings group ----------------->
          <div id="options-group-6" class="group theme-option-inner-tabs">       
			<div id="section-contact-info-title" class="section theme-tabs">
            	<a class="heading theme-option-inner-tab" href="javascript:void(0)"><?php _e('Contact Info Title','impressive'); ?></a>
              <div class="theme-option-inner-tab-group">
              	<div class="ft-control">
                  	<input type="text" id="contactinfotitle" class="of-input" name="impressive_theme_options[contact-info-title]" maxlength="30" size="32"  value="<?php if(!empty($impressive_options['contact-info-title'])) { echo sanitize_text_field($impressive_options['contact-info-title']); } ?>">
                </div>                
              </div>
            </div>
            <div id="section-contact-info" class="section theme-tabs">
            	<a class="heading theme-option-inner-tab" href="javascript:void(0)"><?php _e('Contact Info','impressive'); ?></a>
              <div class="theme-option-inner-tab-group">
              	<div class="ft-control">
                  	<textarea name="impressive_theme_options[contact-info]" id="contact-info" class="of-input" placeholder="<?php _e('Description','impressive'); ?>" maxlength="200" rows="5" ><?php if(!empty($impressive_options['contact-info'])) { echo esc_attr($impressive_options['contact-info']); } ?></textarea>
                </div>                
              </div>
            </div>
            <div id="section-contact-telephone" class="section theme-tabs">
            	<a class="heading theme-option-inner-tab" href="javascript:void(0)"><?php _e('Contact Telephone','impressive'); ?></a>
              <div class="theme-option-inner-tab-group">
              	<div class="ft-control">
                  	<input type="text" id="contact-telephone" class="of-input" name="impressive_theme_options[contact-telephone]" maxlength="30" size="32"  value="<?php if(!empty($impressive_options['contact-telephone'])) { echo sanitize_text_field($impressive_options['contact-telephone']); } ?>">
                </div>                
              </div>
            </div>
            <div id="section-contact-fax" class="section theme-tabs">
            	<a class="heading theme-option-inner-tab" href="javascript:void(0)"><?php _e('Contact Fax','impressive'); ?></a>
              <div class="theme-option-inner-tab-group">
              	<div class="ft-control">
                  	<input type="text" id="contact-fax" class="of-input" name="impressive_theme_options[contact-fax]" maxlength="30" size="32"  value="<?php if(!empty($impressive_options['contact-fax'])) { echo sanitize_text_field($impressive_options['contact-fax']); } ?>">
                </div>                
              </div>
            </div>
            <div id="section-contact-email" class="section theme-tabs">
            	<a class="heading theme-option-inner-tab" href="javascript:void(0)"><?php _e('Contact Email','impressive'); ?></a>
              <div class="theme-option-inner-tab-group">
              	<div class="ft-control">
                  	<input type="text" id="contact-fax" class="of-input" name="impressive_theme_options[contact-email]" maxlength="30" size="32"  value="<?php if(!empty($impressive_options['contact-email'])) { echo sanitize_text_field($impressive_options['contact-email']); } ?>">
                </div>                
              </div>
            </div>
            <div id="section-contact-web" class="section theme-tabs">
            	<a class="heading theme-option-inner-tab" href="javascript:void(0)"><?php _e('Contact web','impressive'); ?></a>
              <div class="theme-option-inner-tab-group">
              	<div class="ft-control">
                  	<input type="text" id="contactweb" class="of-input" name="impressive_theme_options[contact-web]" maxlength="30" size="32"  value="<?php if(!empty($impressive_options['contact-web'])) { echo esc_url_raw($impressive_options['contact-web']); } ?>">
                </div>                
              </div>
            </div>
            <div id="section-contact-address" class="section theme-tabs">
            	<a class="heading theme-option-inner-tab" href="javascript:void(0)"><?php _e('Contact Address','impressive'); ?></a>
              <div class="theme-option-inner-tab-group">
              	<div class="ft-control">
                  	<textarea name="impressive_theme_options[contact-address]" id="contactaddress" class="of-input" placeholder="<?php _e('Contact Address','impressive'); ?>" maxlength="150" rows="5"><?php if(!empty($impressive_options['contact-address'])) { echo esc_attr($impressive_options['contact-address']); } ?></textarea>
                </div>                
              </div>
            </div>
        </div>   
      
		  <div id="options-group-7" class="group theme-option-inner-tabs impressive-pro-image">  
			<div class="impressive-pro-header">
              <img src="<?php echo get_template_directory_uri(); ?>/theme-options/images/impressive_logopro_features.png" class="impressive-pro-logo" />
              <a href="http://fruitthemes.com/wordpress-themes/impressive" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/theme-options/images/impressive-buy-now.png" class="impressive-pro-buynow" /></a>
              </div>
          	<img src="<?php echo get_template_directory_uri(); ?>/theme-options/images/impressive_pro_features.jpg" />
		  </div> 
			
       <!--======================== F I N A L - - T H E M E - - O P T I O N S ===================--> 
      </div>
     </div>
	</div>
	<div class="themeoption-footer">
      	<ul>        	
            <li class="btn-save"><input type="submit" class="button-primary" value="<?php _e('Save Options','impressive');?>" /></li>
        </ul>
    </div>
    </form>    
</div>
<?php } ?>
