<?php
/**
 * Template: Post individual do blog.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

while ( have_posts() ) : the_post();

	$cats = get_the_category();

	// Processa o conteúdo uma única vez: injeta âncoras nos títulos
	// e monta o índice a partir deles.
	$raw_content = apply_filters( 'the_content', get_the_content() );
	$toc = blb_generate_toc( $raw_content );
?>

<main id="main">
	<article <?php post_class(); ?> itemscope itemtype="https://schema.org/Article">
		<header class="single-post-header">
			<div class="container container-narrow">
				<?php blb_breadcrumbs(); ?>
				<?php if ( $cats ) : ?>
					<span class="eyebrow"><a href="<?php echo esc_url( get_category_link( $cats[0]->term_id ) ); ?>" style="color:inherit;"><?php echo esc_html( $cats[0]->name ); ?></a></span>
				<?php endif; ?>

				<h1 itemprop="headline"><?php the_title(); ?></h1>

				<div class="post-meta">
					Por <span itemprop="author" itemscope itemtype="https://schema.org/Person"><span itemprop="name">Bruna Lopes de Barros</span></span>
					· <time itemprop="datePublished" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
					· <?php blb_post_meta(); ?>
				</div>
			</div>
		</header>

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="container container-narrow">
				<figure class="single-post-thumb">
					<?php the_post_thumbnail( 'blb-single', array( 'loading' => 'eager', 'fetchpriority' => 'high', 'decoding' => 'async', 'itemprop' => 'image' ) ); ?>
				</figure>
			</div>
		<?php endif; ?>

		<div class="container container-narrow entry-wrap">
			<?php blb_render_share_buttons(); ?>

			<?php blb_render_toc( $toc['items'] ); ?>

			<div class="entry-content" itemprop="articleBody">
				<?php echo $toc['content']; // phpcs:ignore -- já sanitizado pelos filtros de the_content ?>
			</div>

			<?php
			$tags = get_the_tags();
			if ( $tags ) :
				?>
				<div class="entry-tags">
					<?php foreach ( $tags as $tag ) : ?>
						<a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>"><?php echo esc_html( $tag->name ); ?></a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<?php blb_render_author_card(); ?>
		</div>
	</article>

	<?php
	// Artigos relacionados (mesma categoria), sem JS, sem query pesada.
	if ( $cats ) :
		$related = new WP_Query( array(
			'category__in'   => wp_list_pluck( $cats, 'term_id' ),
			'post__not_in'   => array( get_the_ID() ),
			'posts_per_page' => 3,
			'ignore_sticky_posts' => true,
		) );
		if ( $related->have_posts() ) :
			?>
			<section class="section bg-cream related-posts">
				<div class="container">
					<div class="section-head">
						<span class="eyebrow">Continue lendo</span>
						<h2>Artigos relacionados</h2>
					</div>
					<div class="post-grid post-grid-related">
						<?php while ( $related->have_posts() ) : $related->the_post(); ?>
							<?php get_template_part( 'template-parts/content' ); ?>
						<?php endwhile; wp_reset_postdata(); ?>
					</div>
				</div>
			</section>
			<?php
		endif;
	endif;
	?>
</main>

<?php
endwhile;
get_footer();
