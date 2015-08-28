<?php get_header(); ?>
<section class="main"><?php if ( have_posts() ) : ?>
	<header>
		<h1><?php printf( __( 'Search Results for: %s', 'blankslate' ), get_search_query() ); ?>
		</h1>
	</header><?php while ( have_posts() ) : the_post(); ?><?php get_template_part( 'entry' ); ?><?php endwhile; ?><?php get_template_part( 'nav', 'below' ); ?><?php else: ?>
	<article id="post-0" class="post no-results not-found">
		<header>
			<h2><?php _e( 'Nothing Found', 'blankslate' ); ?>
			</h2>
		</header>
		<section class="entry content">
			<p><?php _e( 'Sorry, nothing matched your search. Please try again.', 'blankslate' ); ?>
			</p><?php get_search_form(); ?>
		</section>
	</article><?php endif; ?>
</section><?php get_sidebar(); ?><?php get_footer(); ?>