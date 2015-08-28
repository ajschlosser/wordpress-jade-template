<?php get_header(); ?>
<section role="main" class="entry"><?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<article id="post-<?php the_ID(); ?>" class="<?php post_class(); ?>">
		<header class="header">
			<div class="row">
				<div class="large-12 columns">
					<h1><?php the_title(); ?>
					</h1>
				</div>
			</div>
		</header>
		<section class="content"><?php if (is_page("")) { ?>
			<div class="some-container">
				<div class="row">
					<div class="large-6 columns"></div>
					<div class="large-6 columns"></div>
				</div>
			</div><?php } else { ?>
			<div class="article-container">
				<div class="row">
					<div class="large-3 columns nav"><?php get_template_part("sidenav"); ?>
					</div>
					<div class="large-9 columns art left-justify"><?php the_content(); ?>
					</div>
				</div>
			</div><?php } ?>
		</section>
	</article><?php endwhile; endif; ?>
</section><?php get_template_part(""); ?><?php get_sidebar(); ?><?php get_footer(); ?>