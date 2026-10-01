<?php
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<div class="container-narrow center" style="padding-block:3rem;">
	<h2>Nada encontrado</h2>
	<?php if ( is_search() ) : ?>
		<p>Nenhum resultado para a busca realizada. Tente outros termos.</p>
		<?php get_search_form(); ?>
	<?php else : ?>
		<p>Ainda não há conteúdo publicado nesta seção.</p>
	<?php endif; ?>
</div>
