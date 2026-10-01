<?php
/**
 * Template padrão (fallback) — usado quando nenhum template mais
 * específico se aplica.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

<main id="main">
	<header class="blog-header">
		<div class="container">
			<?php blb_breadcrumbs(); ?>
			<h1><?php is_home() ? esc_html_e( 'Blog', 'brunalopes' ) : bloginfo( 'name' ); ?></h1>
		</div>
	</header>

	<div class="container section" style="padding-block: 3rem;">
		<?php if ( have_posts() ) : ?>
			<div class="post-grid">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'template-parts/content' ); ?>
				<?php endwhile; ?>
			</div>

			<?php the_posts_pagination( array( 'mid_size' => 1, 'prev_text' => '←', 'next_text' => '→' ) ); ?>
		<?php else : ?>
			<?php get_template_part( 'template-parts/content', 'none' ); ?>
		<?php endif; ?>
	</div>
</main>

<?php get_footer(); ?>
