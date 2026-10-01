<?php
/**
 * SEO técnico + indexação por IAs (Google e LLMs: GPTBot, ClaudeBot,
 * PerplexityBot, Google-Extended etc).
 *
 * Sem plugin de SEO: meta description, Open Graph, Twitter Card,
 * canonical e JSON-LD (Person / Organization / Article / Breadcrumb)
 * são gerados diretamente pelo tema, com HTML semântico correspondente
 * (H1 único, H2/H3 hierárquicos) para ficar claro tanto para
 * rastreadores tradicionais quanto para modelos de linguagem.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/* -----------------------------------------------------------
 * 1. Meta description + canonical + Open Graph + Twitter Card
 * --------------------------------------------------------- */
function blb_meta_description() {
	if ( is_front_page() ) {
		return get_bloginfo( 'description' ) ?: 'Bruna Lopes de Barros é especialista em comunicação executiva, posicionamento e reputação de líderes. Fundadora da Crayon Comunicação e colunista da HSM Management.';
	}
	if ( is_singular() ) {
		global $post;
		$excerpt = has_excerpt( $post ) ? get_the_excerpt( $post ) : wp_trim_words( wp_strip_all_tags( $post->post_content ), 32 );
		return wp_strip_all_tags( $excerpt );
	}
	if ( is_category() || is_tag() || is_tax() ) {
		$desc = term_description();
		return $desc ? wp_trim_words( wp_strip_all_tags( $desc ), 32 ) : sprintf( 'Artigos sobre %s no blog de Bruna Lopes de Barros.', single_term_title( '', false ) );
	}
	if ( is_home() ) {
		return 'Artigos e análises sobre comunicação executiva, posicionamento e reputação de líderes, por Bruna Lopes de Barros.';
	}
	return get_bloginfo( 'description' );
}

function blb_canonical_url() {
	global $wp;
	if ( is_front_page() ) return home_url( '/' );
	if ( is_singular() ) return get_permalink();
	if ( is_home() && ! is_front_page() ) {
		$posts_page = get_option( 'page_for_posts' );
		return $posts_page ? get_permalink( $posts_page ) : home_url( '/' );
	}
	if ( is_category() || is_tag() || is_tax() ) return get_term_link( get_queried_object() );
	return home_url( add_query_arg( array(), $wp->request ) );
}

function blb_head_meta() {
	$description = blb_meta_description();
	$canonical   = blb_canonical_url();
	$site_name   = get_bloginfo( 'name' );
	$is_singular = is_singular( 'post' );

	echo "\n" . '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";
	echo '<link rel="canonical" href="' . esc_url( $canonical ) . '">' . "\n";

	// robots
	if ( is_search() || is_404() ) {
		echo '<meta name="robots" content="noindex, follow">' . "\n";
	} else {
		echo '<meta name="robots" content="index, follow, max-image-preview:large">' . "\n";
	}

	// Open Graph
	$og_title = is_front_page() ? get_bloginfo( 'name' ) . ' | ' . get_bloginfo( 'description' ) : wp_get_document_title();
	$og_image = BLB_URI . '/assets/images/hero-bruna@2x.webp';
	if ( is_singular() && has_post_thumbnail() ) {
		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'blb-single' );
		if ( $thumb ) $og_image = $thumb[0];
	}

	echo '<meta property="og:locale" content="pt_BR">' . "\n";
	echo '<meta property="og:type" content="' . ( $is_singular ? 'article' : 'website' ) . '">' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( $og_title ) . '">' . "\n";
	echo '<meta property="og:description" content="' . esc_attr( $description ) . '">' . "\n";
	echo '<meta property="og:url" content="' . esc_url( $canonical ) . '">' . "\n";
	echo '<meta property="og:site_name" content="' . esc_attr( $site_name ) . '">' . "\n";
	echo '<meta property="og:image" content="' . esc_url( $og_image ) . '">' . "\n";

	echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
	echo '<meta name="twitter:title" content="' . esc_attr( $og_title ) . '">' . "\n";
	echo '<meta name="twitter:description" content="' . esc_attr( $description ) . '">' . "\n";
	echo '<meta name="twitter:image" content="' . esc_url( $og_image ) . '">' . "\n";

	if ( $is_singular ) {
		echo '<meta property="article:published_time" content="' . esc_attr( get_the_date( 'c' ) ) . '">' . "\n";
		echo '<meta property="article:modified_time" content="' . esc_attr( get_the_modified_date( 'c' ) ) . '">' . "\n";
	}
}
add_action( 'wp_head', 'blb_head_meta', 2 );

/* -----------------------------------------------------------
 * 2. JSON-LD (Schema.org) — Person, Organization, Article, Breadcrumb
 * --------------------------------------------------------- */
function blb_person_schema() {
	return array(
		'@type'    => 'Person',
		'@id'      => home_url( '/#person' ),
		'name'     => 'Bruna Lopes de Barros',
		'alternateName' => 'Bruna Lopes',
		'url'      => home_url( '/' ),
		'image'    => BLB_URI . '/assets/images/quem-e-bruna@2x.webp',
		'jobTitle' => 'Especialista em Comunicação Executiva, Posicionamento e Reputação',
		'description' => 'Fundadora da Crayon Comunicação e colunista da HSM Management. Especialista em comunicação executiva, posicionamento e reputação de líderes.',
		'worksFor' => array( '@id' => home_url( '/#organization' ) ),
		'knowsAbout' => array(
			'Comunicação Executiva', 'Posicionamento de Executivos', 'Thought Leadership',
			'LinkedIn para Lideranças', 'Reputação Corporativa', 'Ghostwriting Executivo',
		),
	);
}

function blb_organization_schema() {
	return array(
		'@type' => 'Organization',
		'@id'   => home_url( '/#organization' ),
		'name'  => 'Crayon Comunicação',
		'url'   => home_url( '/' ),
		'logo'  => BLB_URI . '/assets/images/logo-crayon@2x.webp',
		'description' => 'Boutique de comunicação especializada em posicionamento e reputação de executivos.',
		'founder' => array( '@id' => home_url( '/#person' ) ),
	);
}

function blb_jsonld() {
	$graph = array();

	if ( is_front_page() ) {
		$graph[] = array(
			'@type' => 'WebSite',
			'@id'   => home_url( '/#website' ),
			'url'   => home_url( '/' ),
			'name'  => get_bloginfo( 'name' ),
			'inLanguage' => 'pt-BR',
			'publisher' => array( '@id' => home_url( '/#organization' ) ),
		);
		$graph[] = array(
			'@type' => 'ProfilePage',
			'@id'   => home_url( '/#profilepage' ),
			'url'   => home_url( '/' ),
			'mainEntity' => array( '@id' => home_url( '/#person' ) ),
			'inLanguage' => 'pt-BR',
		);
		$graph[] = blb_person_schema();
		$graph[] = blb_organization_schema();
	} elseif ( is_singular( 'post' ) ) {
		global $post;
		$image = has_post_thumbnail() ? wp_get_attachment_image_url( get_post_thumbnail_id(), 'blb-single' ) : ( BLB_URI . '/assets/images/hero-bruna@2x.webp' );
		$graph[] = array(
			'@type'         => 'Article',
			'@id'           => get_permalink() . '#article',
			'headline'      => get_the_title(),
			'description'   => blb_meta_description(),
			'image'         => $image,
			'datePublished' => get_the_date( 'c' ),
			'dateModified'  => get_the_modified_date( 'c' ),
			'author'        => array( '@id' => home_url( '/#person' ) ),
			'publisher'     => array( '@id' => home_url( '/#organization' ) ),
			'mainEntityOfPage' => get_permalink(),
			'inLanguage'    => 'pt-BR',
		);
		$graph[] = blb_person_schema();
		$graph[] = blb_organization_schema();

		// Breadcrumb
		$graph[] = array(
			'@type' => 'BreadcrumbList',
			'itemListElement' => array(
				array( '@type' => 'ListItem', 'position' => 1, 'name' => 'Início', 'item' => home_url( '/' ) ),
				array( '@type' => 'ListItem', 'position' => 2, 'name' => 'Blog', 'item' => get_permalink( get_option( 'page_for_posts' ) ) ?: home_url( '/blog/' ) ),
				array( '@type' => 'ListItem', 'position' => 3, 'name' => get_the_title() ),
			),
		);
	} else {
		$graph[] = blb_organization_schema();
	}

	$schema = array(
		'@context' => 'https://schema.org',
		'@graph'   => $graph,
	);

	echo "\n" . '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
}
add_action( 'wp_head', 'blb_jsonld', 3 );

/* -----------------------------------------------------------
 * 3. robots.txt — libera explicitamente os principais rastreadores
 *    de IA e aponta o sitemap nativo do WordPress.
 * --------------------------------------------------------- */
function blb_virtual_robots( $output, $public ) {
	if ( ! $public ) return $output;

	$output  = "User-agent: *\n";
	$output .= "Allow: /\n\n";
	$output .= "User-agent: GPTBot\nAllow: /\n\n";
	$output .= "User-agent: ChatGPT-User\nAllow: /\n\n";
	$output .= "User-agent: ClaudeBot\nAllow: /\n\n";
	$output .= "User-agent: Claude-Web\nAllow: /\n\n";
	$output .= "User-agent: PerplexityBot\nAllow: /\n\n";
	$output .= "User-agent: Google-Extended\nAllow: /\n\n";
	$output .= "User-agent: CCBot\nAllow: /\n\n";
	$output .= "Sitemap: " . home_url( '/wp-sitemap.xml' ) . "\n";

	return $output;
}
add_filter( 'robots_txt', 'blb_virtual_robots', 10, 2 );

/* -----------------------------------------------------------
 * 4. /llms.txt — resumo estruturado do site em texto puro, formato
 *    proposto para orientar assistentes de IA sobre o conteúdo do
 *    site (https://llmstxt.org). Gerado dinamicamente a partir do
 *    conteúdo publicado, sem necessidade de manutenção manual.
 * --------------------------------------------------------- */
function blb_llms_txt_rewrite() {
	add_rewrite_rule( '^llms\.txt$', 'index.php?blb_llms_txt=1', 'top' );
}
add_action( 'init', 'blb_llms_txt_rewrite' );

function blb_llms_txt_query_var( $vars ) {
	$vars[] = 'blb_llms_txt';
	return $vars;
}
add_filter( 'query_vars', 'blb_llms_txt_query_var' );

function blb_llms_txt_render() {
	if ( ! get_query_var( 'blb_llms_txt' ) ) return;

	header( 'Content-Type: text/plain; charset=utf-8' );

	echo "# " . get_bloginfo( 'name' ) . "\n\n";
	echo "> " . ( get_bloginfo( 'description' ) ?: 'Comunicação executiva, posicionamento e reputação de líderes.' ) . "\n\n";
	echo "Bruna Lopes de Barros é especialista em comunicação executiva, posicionamento e reputação de líderes, fundadora da Crayon Comunicação (boutique de comunicação para executivos) e colunista da HSM Management.\n\n";

	echo "## Páginas\n\n";
	echo "- [Início](" . home_url( '/' ) . "): apresentação, trajetória e atuação de Bruna Lopes de Barros.\n";
	$blog_url = get_option( 'page_for_posts' ) ? get_permalink( get_option( 'page_for_posts' ) ) : home_url( '/blog/' );
	echo "- [Blog](" . esc_url( $blog_url ) . "): artigos sobre comunicação executiva, posicionamento e liderança.\n\n";

	$recent = get_posts( array( 'numberposts' => 20, 'post_status' => 'publish' ) );
	if ( $recent ) {
		echo "## Artigos recentes\n\n";
		foreach ( $recent as $p ) {
			$excerpt = wp_strip_all_tags( has_excerpt( $p ) ? get_the_excerpt( $p ) : wp_trim_words( $p->post_content, 24 ) );
			echo "- [" . get_the_title( $p ) . "](" . get_permalink( $p ) . "): " . $excerpt . "\n";
		}
	}
	exit;
}
add_action( 'template_redirect', 'blb_llms_txt_render' );

/**
 * Lembrete de ativação: ao salvar permalinks (ou na ativação do tema),
 * o WordPress recria as rewrite rules automaticamente. Forçamos um
 * flush na ativação do tema para o /llms.txt funcionar de imediato.
 */
function blb_flush_rewrites_on_switch() {
	blb_llms_txt_rewrite();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'blb_flush_rewrites_on_switch' );
