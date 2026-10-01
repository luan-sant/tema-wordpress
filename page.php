<?php
/**
 * Template: Página genérica.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

while ( have_posts() ) : the_post();
?>

<main id="main">
	<header class="blog-header">
		<div class="container container-narrow">
			<?php blb_breadcrumbs(); ?>
			<h1><?php the_title(); ?></h1>
		</div>
	</header>

	<div class="container container-narrow section" style="padding-block: 3rem;">
		<?php if ( has_post_thumbnail() ) : ?>
			<figure class="single-post-thumb">
				<?php the_post_thumbnail( 'blb-single', array( 'loading' => 'eager', 'decoding' => 'async' ) ); ?>
			</figure>
		<?php endif; ?>

		<div class="entry-content">
			<?php the_content(); ?>
		</div>
	</div>
</main>

<?php
endwhile;
get_footer();
