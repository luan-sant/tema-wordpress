<?php
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" style="display:flex;gap:.6rem;max-width:420px;margin-top:1.5rem;">
	<label class="screen-reader-text" for="blb-search-field"><?php esc_html_e( 'Buscar por:', 'brunalopes' ); ?></label>
	<input type="search" id="blb-search-field" name="s" placeholder="<?php esc_attr_e( 'Buscar artigos…', 'brunalopes' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>"
		style="flex:1;padding:.75em 1em;border:1px solid var(--c-line);border-radius:999px;">
	<button type="submit" class="btn"><?php esc_html_e( 'Buscar', 'brunalopes' ); ?></button>
</form>
