<?php
/**
 * The Header template file
 */
$impressive_options = get_option('impressive_theme_options');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <!--[if lt IE 9]>
        <script src="<?php echo esc_url(get_template_directory_uri()); ?>/js/html5.js"></script>
        <![endif]-->
        <?php if (!empty($impressive_options['favicon'])) { ?>
            <link rel="shortcut icon" href="<?php echo esc_url($impressive_options['favicon']); ?>"> 
        <?php } ?>	
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <header>
            <?php if (is_page_template('page-templates/frontpage.php')) { ?>
                <div class="header_bg">
                    <span class="mask-overlay"></span>
                    <div class="impressive-container container">
                        <div class="impressive-header col-md-12">
                            <div class="logo">
                                <?php if (!empty($impressive_options['logo'])) { ?>
                                    <a href="<?php echo esc_url(home_url('/')); ?>"><img alt="<?php _e('logo', 'impressive') ?>" src="<?php echo esc_url($impressive_options['logo']); ?>"></a> 
                                <?php } else { ?>		  
                                    <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo sanitize_text_field(get_bloginfo('name', 'display')); ?>" rel="home"><h2><?php bloginfo('name'); ?></h2></a>
                                <?php } ?>
                            </div>

                            <?php if (!empty($impressive_options['fburl']) || !empty($impressive_options['twitter']) || !empty($impressive_options['youtube']) || !empty($impressive_options['rss'])) { ?>
                                <div class="social-icon">
                                    <ul>
                                        <?php if (!empty($impressive_options['fburl'])) { ?>
                                            <li> <a href="<?php echo esc_url($impressive_options['fburl']); ?>"> <span class="fa fa-facebook"></span> </a> </li>
                                        <?php } ?>
                                        <?php if (!empty($impressive_options['twitter'])) { ?>
                                            <li> <a href="<?php echo esc_url($impressive_options['twitter']); ?>"> <span class="fa fa-twitter"></span> </a> </li>
                                        <?php } ?>
                                        <?php if (!empty($impressive_options['youtube'])) { ?>
                                            <li> <a href="<?php echo esc_url($impressive_options['youtube']); ?>"> <span class="fa fa-youtube"></span> </a> </li>
                                        <?php } ?>
                                        <?php if (!empty($impressive_options['rss'])) { ?>
                                            <li> <a href="<?php echo esc_url($impressive_options['rss']); ?>"> <span class="fa fa-rss"></span> </a> </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            <?php } ?>

                            <div class="searchform-wrap">
                                <form class="searchform" method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>">
                                    <i class="icon-search"></i>
                                    <input type="text" value="<?php the_search_query(); ?>" class="search-box" name="s" id="s"  placeholder="<?php _e('Search', 'impressive'); ?>" />
                                </form>
                            </div>
                            <div class="menu-bar">

                                <?php
                                $impressive_defaults = array(
                                    'theme_location' => 'primary',
                                    'container' => 'div',
                                    'container_class' => 'collapse navbar-collapse main-menu-ul no-padding',
                                    'container_id' => '',
                                    'menu_class' => '',
                                    'menu_id' => '',
                                    'submenu_class' => '',
                                    'echo' => true,
                                    'before' => '',
                                    'after' => '',
                                    'link_before' => '',
                                    'link_after' => '',
                                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                    'depth' => 0,
                                    'walker' => ''
                                );
                                if (has_nav_menu('primary')) {
                                    wp_nav_menu($impressive_defaults);
                                }
                                ?>        
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <div  class="scrolling-menubar" >                
                <div class="scroll-header" >
                    <div class="impressive-container container">
                        <div class="row">
                            <div class="col-md-3 logo-small col-sm-12">
                                <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo sanitize_text_field(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                            </div>
                            
                            <?php if (empty($impressive_options['remove-header-socialicon'])) { ?>
                                <?php
                                if (!empty($impressive_options['fburl']) || !empty($impressive_options['twitter']) || !empty($impressive_options['youtube']) || !empty($impressive_options['rss'])) {
                                    $impressive_div_class = 'col-md-9';
                                } else {
                                    $impressive_div_class = 'col-md-12';
                                }
                                ?>
                                <?php
                            } else {
                                $impressive_div_class = 'col-md-12';
                            }
                            ?> 	
                            <div class="col-md-9 center-content">
                                <div class="scroll-menu-bar col-sm-9 <?php echo $impressive_div_class; ?>"> 
                                    <?php if (has_nav_menu('primary')) { ?>
                                        <div class="navbar-header res-nav-header toggle-respon">
                                            <button data-target="#example-navbar-collapse" data-toggle="collapse" class="navbar-toggle menu_toggle" type="button">
                                                <span class="sr-only"></span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                            </button>
                                        </div>
                                    <?php } ?> 

                                    <?php
                                    $impressive_defaults = array(
                                        'theme_location' => 'primary',
                                        'container' => 'div',
                                        'container_class' => 'collapse navbar-collapse main-menu-ul no-padding top-menu',
                                        'container_id' => 'example-navbar-collapse',
                                        'menu_class' => '',
                                        'menu_id' => '',
                                        'submenu_class' => '',
                                        'echo' => true,
                                        'before' => '',
                                        'after' => '',
                                        'link_before' => '',
                                        'link_after' => '',
                                        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                        'depth' => 0,
                                        'walker' => ''
                                    );
                                    if (has_nav_menu('primary')) {
                                        wp_nav_menu($impressive_defaults);
                                    }
                                    ?>      
                                </div>
                           
                                <?php if (empty($impressive_options['remove-header-socialicon'])): ?>
                                    <?php if (!empty($impressive_options['fburl']) || !empty($impressive_options['twitter']) || !empty($impressive_options['youtube']) || !empty($impressive_options['rss'])) { ?>
                                        <div class="col-md-3 col-sm-3 social-icon  no-padding">	
                                            <ul>
                                                <?php if (!empty($impressive_options['fburl'])) { ?>
                                                    <li> <a href="<?php echo esc_url($impressive_options['fburl']); ?>"> <span class="fa fa-facebook"></span> </a> </li>
                                                <?php } ?>
                                                <?php if (!empty($impressive_options['twitter'])) { ?>
                                                    <li> <a href="<?php echo esc_url($impressive_options['twitter']); ?>"> <span class="fa fa-twitter"></span> </a> </li>
                                                <?php } ?>
                                                <?php if (!empty($impressive_options['youtube'])) { ?>
                                                    <li> <a href="<?php echo esc_url($impressive_options['youtube']); ?>"> <span class="fa fa-youtube"></span> </a> </li>
                                                <?php } ?>
                                                <?php if (!empty($impressive_options['rss'])) { ?>
                                                    <li> <a href="<?php echo esc_url($impressive_options['rss']); ?>"> <span class="fa fa-rss"></span> </a> </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    <?php } ?>
                                <?php endif; ?> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>	
            <?php
            $header_image = get_header_image();
            if (!empty($header_image)) {
                ?>
                <div class="container">
                    <img src="<?php echo esc_url($header_image); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php _e('custom-header', 'impressive') ?>" />
                </div>
            <?php } ?>
        </header>
