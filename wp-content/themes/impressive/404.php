<?php
/**
 * 404 pages (not found)
*/
get_header(); ?>
<section>
  <div class="impressive-container container">
	<div id="primary" class="content-area-404">
			<section>
				<header>
					<h1 class="page-title-404"><?php _e( 'Oops! That page can&rsquo;t be found.', 'impressive' ); ?></h1>
				</header><!-- .page-header -->
				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'impressive' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->
	</div><!-- .content-area -->
 </div>
</section>
<?php get_footer(); ?>
