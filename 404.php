<?php
/**
 * Template: 404 — Página não encontrada.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

<main id="main">
	<div class="container container-narrow center section">
		<span class="eyebrow">Erro 404</span>
		<h1>Página não encontrada</h1>
		<p style="margin-inline:auto;">O conteúdo que você procura não existe ou foi movido. Que tal voltar para o início ou dar uma olhada nos artigos do blog?</p>
		<div class="hero-actions" style="justify-content:center;margin-top:2rem;">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn">Voltar ao início</a>
			<a href="<?php echo esc_url( get_option( 'page_for_posts' ) ? get_permalink( get_option( 'page_for_posts' ) ) : home_url( '/blog/' ) ); ?>" class="btn btn-outline" style="border-color:var(--c-black);color:var(--c-black);">Ver blog</a>
		</div>
		<?php get_search_form(); ?>
	</div>
</main>

<?php get_footer(); ?>
