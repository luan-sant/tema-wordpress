<?php
/**
 * Template: Arquivos (categoria, tag, data, autor).
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

<main id="main">
	<header class="blog-header">
		<div class="container">
			<?php blb_breadcrumbs(); ?>
			<span class="eyebrow">Blog</span>
			<h1><?php the_archive_title(); ?></h1>
			<?php if ( term_description() ) : ?>
				<div class="lead" style="color:var(--c-muted); max-width:65ch;"><?php echo wp_kses_post( term_description() ); ?></div>
			<?php endif; ?>
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
