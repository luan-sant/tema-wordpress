<?php
/**
 * Cabeçalho do site.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="theme-color" content="#0B0B0C">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#main"><?php esc_html_e( 'Pular para o conteúdo', 'brunalopes' ); ?></a>

<header class="site-header">
	<div class="container header-inner">
		<p class="site-branding">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></span>
			<?php endif; ?>
		</p>

		<button class="menu-toggle" aria-expanded="false" aria-controls="primary-menu" aria-label="<?php esc_attr_e( 'Abrir menu', 'brunalopes' ); ?>">
			<span></span><span></span><span></span>
		</button>

		<nav class="primary-nav" id="primary-menu" aria-label="<?php esc_attr_e( 'Menu principal', 'brunalopes' ); ?>">
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'container'      => false,
					'items_wrap'     => '<ul>%3$s</ul>',
					'fallback_cb'    => false,
				) );
			} else {
				?>
				<ul>
					<li><a href="<?php echo esc_url( home_url( '/#quem-e' ) ); ?>">Quem é</a></li>
					<li><a href="<?php echo esc_url( home_url( '/#crayon' ) ); ?>">Crayon Comunicação</a></li>
					<li><a href="<?php echo esc_url( home_url( '/#hsm' ) ); ?>">HSM Management</a></li>
					<li><a href="<?php echo esc_url( get_option( 'page_for_posts' ) ? get_permalink( get_option( 'page_for_posts' ) ) : home_url( '/blog/' ) ); ?>">Blog</a></li>
					<li><a href="<?php echo esc_url( home_url( '/#contato' ) ); ?>" class="btn" style="padding:.5em 1.2em;">Fale comigo</a></li>
				</ul>
				<?php
			}
			?>
		</nav>
	</div>
</header>
