
<section class="comments">
	<section class="comments-list"><?php if ( 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) return; ?><?php if ( have_comments() ) :  ?><?php global $comments_by_type; ?><?php $comments_by_type = &separate_comments( $comments ); ?><?php if ( ! empty( $comments_by_type['comment'] ) ) : ?>
		<h3><?php comments_number(); ?>
		</h3><?php if ( get_comment_pages_count() > 1 ) : ?>
		<nav role="navigation" class="comments-navigation above">
			<div><?php paginate_comments_links(); ?>
			</div>
		</nav><?php endif; ?>
		<ul><?php wp_list_comments( 'type=comment' ); ?>
		</ul><?php if ( get_comment_pages_count() > 1 ) : ?>
		<nav role="navigation" class="comments-navigation below">
			<div><?php paginate_comments_links(); ?>
			</div>
		</nav><?php endif; ?><?php endif; ?>
	</section><?php if ( ! empty( $comments_by_type['pings'] ) ) :  ?><?php $ping_count = count( $comments_by_type['pings'] ); ?>
	<section class="trackbacks-list">
		<h3><?php echo '<span class="ping-count">' . $ping_count . '</span> ' . ( $ping_count > 1 ? __( 'Trackbacks', 'template' ) : __( 'Trackback', 'template' ) ); ?>
		</h3>
		<ul><?php wp_list_comments( 'type=pings&callback=blankslate_custom_pings' ); ?>
		</ul>
	</section><?php endif; ?><?php endif; ?><?php if ( comments_open() ) comment_form(); ?>
</section>