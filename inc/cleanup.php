<?php
/**
 * Limpeza de <head> e de requisições desnecessárias — cada item removido
 * aqui é uma requisição/bytes a menos, ajudando LCP, TBT e o PageSpeed.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function blb_head_cleanup() {
	remove_action( 'wp_head', 'wp_generator' );                     // versão do WP exposta
	remove_action( 'wp_head', 'rsd_link' );                         // really simple discovery
	remove_action( 'wp_head', 'wlwmanifest_link' );                 // windows live writer
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );              // shortlink
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );     // oEmbed <link>
	remove_action( 'wp_head', 'wp_oembed_add_host_js' );             // oEmbed host js
	remove_action( 'wp_head', 'rest_output_link_wp_head' );          // link para REST API
	remove_action( 'wp_head', 'wp_resource_hints', 2 );              // dns-prefetch para s.w.org
	remove_action( 'wp_head', 'feed_links_extra', 3 );               // feeds de categoria/tag extras
}
add_action( 'init', 'blb_head_cleanup' );

/**
 * Remove scripts/estilos de emoji (arquivo JS + CSS inline em toda página).
 */
function blb_disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', function ( $plugins ) {
		return is_array( $plugins ) ? array_diff( $plugins, array( 'wpemoji' ) ) : array();
	} );
	add_filter( 'wp_resource_hints', function ( $urls, $relation_type ) {
		if ( 'dns-prefetch' === $relation_type ) {
			$urls = array_filter( $urls, function ( $url ) {
				return false === strpos( $url, 'gmpg.org' ) && false === strpos( $url, 's.w.org' );
			} );
		}
		return $urls;
	}, 10, 2 );
}
add_action( 'init', 'blb_disable_emojis' );

/**
 * Dashicons só são necessários para usuários logados (admin bar).
 */
function blb_dequeue_dashicons() {
	if ( ! is_user_logged_in() ) {
		wp_deregister_style( 'dashicons' );
	}
}
add_action( 'wp_enqueue_scripts', 'blb_dequeue_dashicons', 100 );

/**
 * Desativa XML-RPC (não utilizado) — reduz superfície de ataque e
 * elimina uma rota processada a cada carga desnecessária.
 */
add_filter( 'xmlrpc_enabled', '__return_false' );

/**
 * Heartbeat API apenas na tela de edição de posts (evita polling
 * contínuo em outras telas do wp-admin).
 */
function blb_heartbeat_settings( $settings ) {
	global $pagenow;
	if ( 'post.php' !== $pagenow && 'post-new.php' !== $pagenow ) {
		wp_deregister_script( 'heartbeat' );
	}
	return $settings;
}
add_action( 'init', function () {
	global $pagenow;
	if ( is_admin() && 'post.php' !== $pagenow && 'post-new.php' !== $pagenow ) {
		wp_deregister_script( 'heartbeat' );
	}
}, 1 );

/**
 * Nota: propositalmente NÃO removemos o parâmetro ?ver= das URLs de
 * CSS/JS. Ele é o mecanismo de cache-busting do WordPress — sem ele,
 * navegadores e CDNs podem servir uma versão desatualizada do CSS
 * indefinidamente após qualquer edição no tema.
 */

/**
 * Desativa emojis e embeds de arquivos JS desnecessários (wp-embed.min.js)
 * no front-end para visitantes.
 */
function blb_deregister_embed_script() {
	if ( ! is_admin() ) {
		wp_deregister_script( 'wp-embed' );
	}
}
add_action( 'wp_footer', 'blb_deregister_embed_script' );
