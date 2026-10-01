<?php
/**
 * Funções auxiliares usadas nos templates.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Data + tempo estimado de leitura, exibidos nos cards e no post.
 */
function blb_post_meta() {
	$words = str_word_count( wp_strip_all_tags( get_the_content() ) );
	$read  = max( 1, round( $words / 200 ) );

	echo '<span class="post-date">' . esc_html( get_the_date() ) . '</span>';
	echo ' · <span class="post-reading-time">' . esc_html( $read ) . ' min de leitura</span>';
}

/**
 * Breadcrumb simples e semântico (também usado pelo schema JSON-LD).
 */
function blb_breadcrumbs() {
	if ( is_front_page() ) return;

	echo '<nav class="breadcrumbs" aria-label="breadcrumb"><ol>';
	echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">Início</a></li>';

	if ( is_singular( 'post' ) ) {
		$blog_url = get_option( 'page_for_posts' ) ? get_permalink( get_option( 'page_for_posts' ) ) : home_url( '/blog/' );
		echo '<li><a href="' . esc_url( $blog_url ) . '">Blog</a></li>';
		echo '<li aria-current="page">' . esc_html( get_the_title() ) . '</li>';
	} elseif ( is_home() ) {
		echo '<li aria-current="page">Blog</li>';
	} elseif ( is_category() || is_tag() || is_tax() ) {
		echo '<li aria-current="page">' . esc_html( single_term_title( '', false ) ) . '</li>';
	} elseif ( is_search() ) {
		echo '<li aria-current="page">Busca</li>';
	} elseif ( is_page() ) {
		echo '<li aria-current="page">' . esc_html( get_the_title() ) . '</li>';
	}

	echo '</ol></nav>';
}

/**
 * Imagem destacada responsiva (srcset nativo do WP) com dimensões
 * explícitas para evitar Cumulative Layout Shift.
 */
function blb_post_thumbnail( $size = 'blb-card' ) {
	if ( ! has_post_thumbnail() ) return;
	the_post_thumbnail( $size, array(
		'loading' => 'lazy',
		'decoding' => 'async',
		'alt' => esc_attr( get_the_title() ),
	) );
}

/**
 * Gera um índice (sumário) a partir dos H2/H3 do conteúdo do post,
 * injetando âncoras (id) nos próprios títulos. Retorna o HTML já
 * processado + a lista de itens do índice.
 *
 * @return array{content:string, items:array}
 */
function blb_generate_toc( $content ) {
	$items = array();
	$used_slugs = array();

	$processed = preg_replace_callback(
		'/<h([23])(.*?)>(.*?)<\/h\1>/is',
		function ( $matches ) use ( &$items, &$used_slugs ) {
			$level = (int) $matches[1];
			$text  = wp_strip_all_tags( $matches[3] );
			$slug  = sanitize_title( $text );

			if ( '' === $slug ) $slug = 'secao';
			$base = $slug;
			$i = 2;
			while ( in_array( $slug, $used_slugs, true ) ) {
				$slug = $base . '-' . $i;
				$i++;
			}
			$used_slugs[] = $slug;

			$items[] = array( 'level' => $level, 'text' => $text, 'slug' => $slug );

			return '<h' . $level . $matches[2] . ' id="' . esc_attr( $slug ) . '">' . $matches[3] . '</h' . $level . '>';
		},
		$content
	);

	return array( 'content' => $processed, 'items' => $items );
}

/**
 * Renderiza o bloco de índice de conteúdo, se houver ao menos 2 títulos.
 */
function blb_render_toc( $items ) {
	if ( count( $items ) < 2 ) return;
	?>
	<nav class="toc" aria-label="<?php esc_attr_e( 'Índice de conteúdo', 'brunalopes' ); ?>">
		<p class="toc-title">Índice</p>
		<ol>
			<?php foreach ( $items as $item ) : ?>
				<li class="toc-level-<?php echo esc_attr( $item['level'] ); ?>">
					<a href="#<?php echo esc_attr( $item['slug'] ); ?>"><?php echo esc_html( $item['text'] ); ?></a>
				</li>
			<?php endforeach; ?>
		</ol>
	</nav>
	<?php
}

/**
 * Botões de compartilhamento (links diretos, sem SDKs externos —
 * zero JS/CSS de terceiros, melhor para performance e privacidade).
 */
function blb_render_share_buttons() {
	$url   = rawurlencode( get_permalink() );
	$title = rawurlencode( get_the_title() );
	?>
	<div class="share-buttons">
		<span class="share-label">Compartilhar</span>

		<a class="share-btn" target="_blank" rel="noopener" aria-label="Compartilhar no WhatsApp"
			href="https://wa.me/?text=<?php echo $title; ?>%20<?php echo $url; ?>">
			<svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor" aria-hidden="true"><path d="M12 2C6.48 2 2 6.48 2 12c0 1.85.5 3.58 1.38 5.07L2 22l5.06-1.33A9.94 9.94 0 0012 22c5.52 0 10-4.48 10-10S17.52 2 12 2zm0 18a7.9 7.9 0 01-4.06-1.11l-.29-.17-2.75.72.73-2.68-.19-.28A7.95 7.95 0 014 12c0-4.42 3.58-8 8-8s8 3.58 8 8-3.58 8-8 8z"/></svg>
		</a>

		<a class="share-btn" target="_blank" rel="noopener" aria-label="Compartilhar no LinkedIn"
			href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $url; ?>">
			<svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" aria-hidden="true"><path d="M4.98 3.5C4.98 4.88 3.87 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1s2.48 1.12 2.48 2.5zM.5 8h4V23h-4V8zm7.5 0h3.8v2.05h.05c.53-1 1.83-2.05 3.77-2.05C19.6 8 21 10.2 21 14.02V23h-4v-8.3c0-1.98-.04-4.53-2.76-4.53-2.77 0-3.19 2.16-3.19 4.39V23h-4V8z"/></svg>
		</a>

		<a class="share-btn" target="_blank" rel="noopener" aria-label="Compartilhar no X"
			href="https://twitter.com/intent/tweet?text=<?php echo $title; ?>&amp;url=<?php echo $url; ?>">
			<svg viewBox="0 0 24 24" width="15" height="15" fill="currentColor" aria-hidden="true"><path d="M18.9 2H22l-7.6 8.68L23.5 22h-6.9l-5.4-6.6L4.9 22H1.8l8.1-9.26L.9 2h7l4.9 6.02L18.9 2zm-1.2 18h1.9L7.4 4H5.4l12.3 16z"/></svg>
		</a>

		<a class="share-btn" aria-label="Compartilhar por e-mail"
			href="mailto:?subject=<?php echo $title; ?>&amp;body=<?php echo $url; ?>">
			<svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor" aria-hidden="true"><path d="M2 4h20v16H2V4zm2 2v.01L12 13l8-6.99V6H4zm16 2.24l-7.4 6.48a1 1 0 01-1.2 0L4 8.24V18h16V8.24z"/></svg>
		</a>

		<button type="button" class="share-btn js-copy-link" aria-label="Copiar link" data-url="<?php echo esc_url( get_permalink() ); ?>">
			<svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor" aria-hidden="true"><path d="M3.9 12a5 5 0 015-5h3v2h-3a3 3 0 000 6h3v2h-3a5 5 0 01-5-5zm7-1h4v2h-4v-2zm3-4h3a5 5 0 010 10h-3v-2h3a3 3 0 000-6h-3V7z"/></svg>
		</button>
	</div>
	<?php
}

/**
 * Card do autor, exibido ao final do post.
 */
function blb_render_author_card() {
	?>
	<div class="author-card">
		<img
			src="<?php echo esc_url( BLB_URI . '/assets/images/hero-bruna.webp' ); ?>"
			srcset="<?php echo esc_url( BLB_URI . '/assets/images/hero-bruna.webp' ); ?> 700w, <?php echo esc_url( BLB_URI . '/assets/images/hero-bruna@2x.webp' ); ?> 1400w"
			sizes="72px"
			width="72" height="72"
			alt="Bruna Lopes de Barros"
			loading="lazy" decoding="async"
			class="author-avatar"
		>
		<div>
			<p class="author-name">Bruna Lopes de Barros</p>
			<p class="author-bio">
				Especialista em comunicação executiva, posicionamento e reputação de líderes.
				Fundadora da Crayon Comunicação e colunista da HSM Management.
			</p>
			<a href="<?php echo esc_url( home_url( '/#quem-e' ) ); ?>" class="link-underline" style="font-size:var(--fs-small);">Conheça a trajetória de Bruna</a>
		</div>
	</div>
	<?php
}
