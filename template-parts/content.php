<?php
/**
 * Card de post — usado em home.php, archive.php, category.php, search.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?>>
	<a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="post-thumb">
				<?php blb_post_thumbnail( 'blb-card' ); ?>
			</div>
		<?php endif; ?>
	</a>

	<div class="post-meta"><?php blb_post_meta(); ?></div>

	<?php the_title( sprintf( '<h2><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

	<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?></p>
</article>
