<?php
/**
 * Rodapé do site.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
	<footer class="site-footer">
		<div class="container">
			<div class="footer-grid">
				<div class="footer-col footer-col-brand">
					<div class="footer-logo">
						<?php if ( has_custom_logo() ) : ?>
							<?php the_custom_logo(); ?>
						<?php else : ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-brand"><?php bloginfo( 'name' ); ?></a>
						<?php endif; ?>
					</div>
					<p class="footer-tagline">
						Comunicação executiva, posicionamento e reputação de líderes.
					</p>
				</div>

				<div class="footer-col">
					<p class="footer-col-title">Menu</p>
					<nav aria-label="<?php esc_attr_e( 'Menu do rodapé', 'brunalopes' ); ?>">
						<?php
						if ( has_nav_menu( 'footer' ) ) {
							wp_nav_menu( array(
								'theme_location' => 'footer',
								'container'      => false,
								'items_wrap'     => '<ul>%3$s</ul>',
								'fallback_cb'    => false,
							) );
						} else {
							?>
							<ul>
								<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Início</a></li>
								<li><a href="<?php echo esc_url( get_option( 'page_for_posts' ) ? get_permalink( get_option( 'page_for_posts' ) ) : home_url( '/blog/' ) ); ?>">Blog</a></li>
								<li><a href="<?php echo esc_url( home_url( '/#contato' ) ); ?>">Contato</a></li>
							</ul>
							<?php
						}
						?>
					</nav>
				</div>

				<div class="footer-col">
					<p class="footer-col-title">Últimos posts</p>
					<?php
					$footer_recent = get_posts( array(
						'numberposts'         => 3,
						'post_status'         => 'publish',
						'ignore_sticky_posts' => true,
					) );
					if ( $footer_recent ) :
						?>
						<ul class="footer-posts">
							<?php foreach ( $footer_recent as $fp ) : ?>
								<li>
									<a href="<?php echo esc_url( get_permalink( $fp ) ); ?>"><?php echo esc_html( get_the_title( $fp ) ); ?></a>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php else : ?>
						<p class="footer-tagline">Em breve, novos artigos.</p>
					<?php endif; ?>
				</div>
			</div>

			<p class="footer-meta">
				&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?> — Crayon Comunicação. Todos os direitos reservados.
			</p>
		</div>
	</footer>

<?php wp_footer(); ?>
</body>
</html>
