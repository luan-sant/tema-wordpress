<?php
/**
 * Template: Blog (listagem de posts).
 * Usado automaticamente quando uma "Página de posts" é definida em
 * Configurações > Leitura (Frente do site: Uma página estática).
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

$blog_page_id    = get_option( 'page_for_posts' );
$blog_page_title = $blog_page_id ? get_the_title( $blog_page_id ) : __( 'Blog', 'brunalopes' );
?>

<main id="main">
	<header class="blog-header">
		<div class="container">
			<?php blb_breadcrumbs(); ?>
			<span class="eyebrow">Blog</span>
			<h1><?php echo esc_html( $blog_page_title ); ?></h1>
			<p class="lead" style="color:var(--c-muted);">
				Artigos e análises sobre comunicação executiva, posicionamento e reputação de líderes.
			</p>
		</div>
	</header>

	<div class="container section" style="padding-block: 3rem;">
		<?php if ( have_posts() ) : ?>
			<div class="post-grid">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'template-parts/content' ); ?>
				<?php endwhile; ?>
			</div>

			<?php the_posts_pagination( array(
				'mid_size'  => 1,
				'prev_text' => '←',
				'next_text' => '→',
			) ); ?>
		<?php else : ?>
			<?php get_template_part( 'template-parts/content', 'none' ); ?>
		<?php endif; ?>
	</div>
</main>

<?php get_footer(); ?>
