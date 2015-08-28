<?php get_header(); ?>
<section role="main">
	<header>
		<h1><?php if ( is_day() ) { printf( __( 'Daily Archives: %s', 'template' ), get_the_time( get_option( 'date_format' ) ) ); } ?><?php elseif ( is_month() ) { printf( __( 'Monthly Archives: %s', 'template' ), get_the_time( 'F Y' ) ); } ?><?php elseif ( is_year() ) { printf( __( 'Yearly Archives: %s', 'template' ), get_the_time( 'Y' ) ); } ?><?php else { _e( 'Archives', 'template' ); } ?>
		</h1>
	</header><?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?><?php get_template_part( 'entry' ); ?><?php endwhile; endif; ?>
</section><?php get_sidebar(); ?><?php get_footer(); ?>