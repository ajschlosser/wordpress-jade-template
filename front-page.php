<?php get_header(); ?><?php get_template_part( "" ); ?>
<section role="main" class="content"><?php if ( have_posts() ) : ?><?php while ( have_posts() ) : ?><?php the_post(); ?><?php $more; $more = FALSE; ?>
	<div class="content fixed-width-centered"><?php if ($content = get_the_content("Read More", true)) echo $content; ?>
	</div><?php endwhile; ?><?php endif; ?>
</section><?php get_template_part( "" ); ?><?php get_footer(); ?>