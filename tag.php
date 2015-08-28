<?php get_header(); ?>
<section role="main">
	<header>
		<h1><?php _e( 'Tag Archives: ', 'blankslate' ); single_tag_title(); ?>
		</h1>
	</header><?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?><?php get_template_part( 'entry' ); ?><?php endwhile; endif; ?><?php get_template_part( 'nav', 'below' ); ?>
</section><?php get_sidebar(); ?><?php get_footer(); ?>