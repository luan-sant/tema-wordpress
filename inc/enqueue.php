<?php
/**
 * Assets — carregamento enxuto, sem dependências externas.
 * Nenhuma fonte é baixada da web (pilha de fontes de sistema),
 * então não há requisições bloqueando o LCP além do próprio CSS.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function blb_assets() {
	// style.css é o único CSS do front-end: uma única requisição, sem build step.
	wp_enqueue_style( 'brunalopes-style', get_stylesheet_uri(), array(), BLB_VERSION );

	wp_enqueue_script( 'brunalopes-main', BLB_URI . '/assets/js/main.js', array(), BLB_VERSION, true );
	wp_script_add_data( 'brunalopes-main', 'strategy', 'defer' );

	if ( is_singular() && comments_open() ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'blb_assets' );

/**
 * Garante que scripts marcados com wp_script_add_data( 'strategy', 'defer' )
 * de fato recebam o atributo defer na tag <script>.
 */
function blb_defer_scripts( $tag, $handle ) {
	if ( wp_scripts()->get_data( $handle, 'strategy' ) === 'defer' ) {
		if ( false === strpos( $tag, 'defer' ) ) {
			$tag = str_replace( ' src', ' defer src', $tag );
		}
	}
	return $tag;
}
add_filter( 'script_loader_tag', 'blb_defer_scripts', 10, 2 );

/**
 * Pré-carrega a imagem principal (LCP) da home para reduzir o tempo até
 * o maior elemento visível ser renderizado.
 */
function blb_preload_lcp_image() {
	if ( is_front_page() ) {
		$src = BLB_URI . '/assets/images/hero-bruna.webp';
		$src2x = BLB_URI . '/assets/images/hero-bruna@2x.webp';
		echo '<link rel="preload" as="image" href="' . esc_url( $src ) . '" imagesrcset="' . esc_url( $src ) . ' 700w, ' . esc_url( $src2x ) . ' 1400w" fetchpriority="high">' . "\n";
	}
}
add_action( 'wp_head', 'blb_preload_lcp_image', 1 );
