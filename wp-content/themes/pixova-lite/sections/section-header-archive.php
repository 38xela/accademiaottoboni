<?php

$pixova_lite_header_logo_text = get_theme_mod('pixova_lite_text_logo', 'Pixova');

echo '<!-- Header -->';
echo '<header id="header-wrap">';
    echo '<div class="container header clearfix">';
        echo '<div class="row">';
            echo '<div class="col-md-12">';
                echo '<!-- logo -->';
                    echo '<a class="logo" href="'.esc_url( get_site_url() ).'">'.esc_html( $pixova_lite_header_logo_text ).'</a>';
                echo '<!-- /logo -->';        
                
                echo '<!-- menu icon -->';       
                echo '<a id="nav-expander" class="pull-right" href="#">';
                    echo '<i class="fa fa-bars fa-lg white"></i>';
                echo '</a>';

                echo '<!-- /menu icon -->';
                echo '<!-- main navigation -->';
                
                echo '<nav class="main-navigation">';
                    echo wp_nav_menu( array('theme_location' => 'primary', 'fallback_cb' => 'pixova_lite_fallback_cb') );
                echo '</nav>';
                    echo '<!-- /main-navigation -->';
            echo '</div><!--/.col-md-12-->';
        echo '</div><!--/.row-->';
    echo '</div><!--/.container.header.clearfix-->';

    echo '<!-- main navigation mobile -->';
    echo '<div class="offset-canvas-mobile">';
        echo '<nav class="mobile-nav-holder">';
            echo '  <a href="#" class="close-btn mobile-nav-close-btn"><span class="fa fa-close"></span></a>';
            echo '<ul class="mobile-nav">';
                echo wp_nav_menu( array('theme_location' => 'primary', 'fallback_cb' => 'pixova_lite_fallback_cb') );
            echo '</ul><!--/.mobile-nav-->';
        echo '</nav><!--/.mobile-nav-holder-->';
    echo '</div><!--/.offset-canvas-mobile-->';
    echo '<!-- /main navigation mobile -->';
echo '</header><!-- /Header -->';


echo '<section id="intro" class="blog-intro" style="background-color:' .pixova_lite_hex2rgba('#000000'). '">';
  echo '<div class="parallax-bg-container" style="opacity:.85">';

  $pixova_lite_header_image = get_header_image();

    if ( ! empty( $pixova_lite_header_image ) ) {
            echo '<div class="parallax-bg-image" style="background-image:url('.esc_url( $pixova_lite_header_image ).')" alt="" /></div>';
     } else {
        echo '<div class="parallax-bg-image" style="background-image:url('. get_template_directory_uri() .'/layout/images/header-bg.jpg)"></div>';
     }

   echo '</div><!--/.parallax-bg-container-->';

    echo '<div class="container">';
        echo '<div class="intro-content parallax-text-fade">';
            echo '<div class="row">';
                echo '<div class="col-md-12">';
                    echo '<div class="text-center">';
                    if( is_page_template('page-templates/blog-template.php') ) {
                        echo '<h1 class="intro-title">'.esc_html( get_option('blogname') ).'</h1>';
                        echo '<p class="intro-tagline">'.esc_html( get_option('blogdescription') ).'</p>';
                    } else if(is_category() ) {
                        echo the_archive_title('<h1 class="intro-title">', '</h1>');
                        echo the_archive_description('<p class="intro-tagline">', '</p>'); 
                    } else if(is_tag() ) {
                        echo '<h1 class="intro-title">';
                            printf(__('Posts tagged with: %s', 'pixova-lite'), single_tag_title('', false) );
                        echo '</h1>';
                        echo '<p class="intro-tagline">'.tag_description().'</p>';
                    } else if (is_search() ) {
                        echo '<h1 class="intro-title">';
                            printf( __( 'Search Results for: %s', 'pixova-lite' ), '<span><u>' . esc_html( get_search_query() ). '</u></span>' );
                        echo '</h1>';
                    }
                    echo '</div><!--/.text-center-->';
                echo '</div><!--/.col-md-12-->';
            echo '</div><!--/.row-->';
        echo '</div><!--/.intro-content.parallax-text-fade-->';
    echo '</div><!--/.container-->';

echo '</section><!--/ SECTION -->';