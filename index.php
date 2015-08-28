<?php get_header(); ?>
<section role="main"><?php if ( have_posts() ) : ?><?php while ( have_posts() ) : ?><?php the_post(); ?><?php endwhile; ?><?php endif; ?>
</section><?php get_sidebar(); ?><?php get_footer(); ?>