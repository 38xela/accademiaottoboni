<?php 
/**
 * The category template file
**/
get_header(); 
?>
<section>
  <div class="impressive-container container">
      <div class="site-breadcumb">       
        <h1><?php printf( __( 'Category : %s', 'impressive' ), single_cat_title( '', false ) ); ?></h1>
        <ol class="breadcrumb breadcrumb-menubar">
           <?php if (function_exists('impressive_custom_breadcrumbs')) impressive_custom_breadcrumbs(); ?>
        </ol>        
      </div>
      <?php get_template_part( 'content', get_post_format() ); ?>
 </div>
</section>
<?php get_footer(); ?>
