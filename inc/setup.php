<?php
/**
 * Theme setup — supports, menus, sidebars, image sizes.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function blb_setup() {
	load_theme_textdomain( 'brunalopes', BLB_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'custom-logo', array(
		'height'      => 90,
		'width'       => 340,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script',
	) );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Imagens de post otimizadas (usadas no blog / cards)
	set_post_thumbnail_size( 900, 560, true );
	add_image_size( 'blb-card', 700, 460, true );
	add_image_size( 'blb-single', 1400, 788, true );

	register_nav_menus( array(
		'primary' => __( 'Menu Principal', 'brunalopes' ),
		'footer'  => __( 'Menu Rodapé', 'brunalopes' ),
	) );

	// Largura de conteúdo para embeds
	if ( ! isset( $content_width ) ) {
		$content_width = 1180;
	}
}
add_action( 'after_setup_theme', 'blb_setup' );

/**
 * Blog é o único widget-area necessário; institucional (home) não usa sidebar.
 */
function blb_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Barra Lateral do Blog', 'brunalopes' ),
		'id'            => 'sidebar-blog',
		'description'   => __( 'Exibida em páginas de blog, se utilizada nos templates.', 'brunalopes' ),
		'before_widget' => '<div class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'blb_widgets_init' );

/**
 * Comentários desativados por padrão — não fazem parte do escopo institucional
 * e reduzem consultas/scripts desnecessários (melhora performance).
 * Pode ser reativado normalmente pelo admin em Configurações > Discussão.
 */
function blb_disable_comments_admin() {
	remove_menu_page( 'edit-comments.php' );
}
// Comentado por padrão: descomente as linhas abaixo caso queira remover
// completamente a UI de comentários do admin.
// add_action( 'admin_menu', 'blb_disable_comments_admin' );

function blb_body_classes( $classes ) {
	if ( ! is_singular() ) {
		$classes[] = 'is-archive';
	}
	return $classes;
}
add_filter( 'body_class', 'blb_body_classes' );

/**
 * Grid do blog: sempre 4 cards por linha / 16 por página, independente
 * do que estiver configurado em Ajustes > Leitura.
 */
function blb_posts_per_page( $query ) {
	if ( ! is_admin() && $query->is_main_query() && is_home() ) {
		$query->set( 'posts_per_page', 16 );
	}
}
add_action( 'pre_get_posts', 'blb_posts_per_page' );
