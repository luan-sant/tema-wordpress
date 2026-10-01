<?php
/**
 * Template: Página inicial (institucional, uma página só, seções âncora).
 *
 * O conteúdo segue a estrutura definida no briefing: H1 único na dobra
 * principal, seções H2 e subseções H3 hierárquicas — bom para leitura
 * humana, rastreamento do Google e sumarização por IAs.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

<main id="main">

	<!-- HERO -->
	<section class="hero">
		<div class="container grid-2">
			<div>
				<span class="eyebrow">Comunicação Executiva &amp; Reputação</span>
				<h1>Bruna Lopes de Barros | Comunicação Executiva, Posicionamento e Reputação</h1>
				<p class="lead">
					Bruna Lopes de Barros é especialista em comunicação executiva, posicionamento e reputação
					de líderes. Fundadora da Crayon Comunicação e colunista da HSM Management, atua na
					construção de autoridade para CEOs, conselheiros e executivos, transformando experiência
					e conhecimento em presença estratégica, conteúdo autoral e reconhecimento de mercado.
				</p>
				<div class="hero-actions">
					<a href="#contato" class="btn">Vamos conversar</a>
					<a href="#crayon" class="btn btn-outline" style="border-color:var(--c-black);color:var(--c-black);">Conheça a Crayon</a>
				</div>
			</div>
			<figure class="hero-figure">
				<img
					src="<?php echo esc_url( BLB_URI . '/assets/images/hero-bruna.webp' ); ?>"
					srcset="<?php echo esc_url( BLB_URI . '/assets/images/hero-bruna.webp' ); ?> 700w, <?php echo esc_url( BLB_URI . '/assets/images/hero-bruna@2x.webp' ); ?> 1400w"
					sizes="(min-width: 860px) 45vw, 90vw"
					width="700" height="1050"
					alt="Bruna Lopes de Barros, especialista em comunicação executiva"
					fetchpriority="high"
					decoding="async"
				>
			</figure>
		</div>
	</section>

	<!-- QUEM É BRUNA LOPES -->
	<section class="section bg-white" id="quem-e">
		<div class="container grid-2">
			<figure class="content-figure">
				<img
					src="<?php echo esc_url( BLB_URI . '/assets/images/quem-e-bruna.webp' ); ?>"
					srcset="<?php echo esc_url( BLB_URI . '/assets/images/quem-e-bruna.webp' ); ?> 700w, <?php echo esc_url( BLB_URI . '/assets/images/quem-e-bruna@2x.webp' ); ?> 1400w"
					sizes="(min-width: 860px) 45vw, 90vw"
					width="700" height="1050"
					alt="Bruna Lopes de Barros em seu ambiente de trabalho"
					loading="lazy" decoding="async"
				>
			</figure>
			<div>
				<span class="eyebrow">Sobre</span>
				<h2>Quem é Bruna Lopes</h2>
				<p>
					Bruna Lopes de Barros, também conhecida como Bruna Lopes, é especialista em comunicação
					executiva, posicionamento e reputação de líderes. Formada em Marketing, atua no mercado
					digital desde 2010 e construiu sua trajetória entre grandes agências, empresas de
					tecnologia, empreendedorismo e comunicação corporativa.
				</p>
				<p>
					Ao longo desse percurso, desenvolveu experiência na construção de posicionamento para
					executivos e empresas, especialmente no LinkedIn e em estratégias de Thought Leadership.
					É fundadora da Crayon Comunicação, boutique de comunicação voltada a executivos, e
					colunista da HSM Management.
				</p>
			</div>
		</div>
	</section>

	<!-- EXPERIÊNCIA ESTRATÉGICA -->
	<section class="section bg-mint" id="experiencia">
		<div class="container grid-2">
			<div>
				<span class="eyebrow">Trajetória</span>
				<h2>Experiência Estratégica em Comunicação Corporativa</h2>
				<p>
					A trajetória de Bruna Lopes de Barros foi construída em diferentes perspectivas da
					comunicação corporativa: grandes agências, empresas de tecnologia, liderança de equipes
					e empreendedorismo. Essa experiência permite compreender não apenas a comunicação, mas
					também os desafios, objetivos e dinâmicas de negócio que estão por trás das decisões de
					empresas e executivos.
				</p>

				<div class="subsection">
					<h3>Da agência ao lado do cliente</h3>
					<p>
						No início da carreira, Bruna Lopes de Barros atuou em grandes agências de comunicação,
						atendendo marcas como Unilever, Samsung, TIM, Sky e Fiat, incluindo a operação da
						Samsung durante os Jogos Olímpicos de 2016. A experiência em agências tradicionais
						proporcionou contato com diferentes setores, grandes operações e desafios de
						comunicação corporativa.
					</p>
					<p>
						Posteriormente, Bruna passou a atuar do lado do cliente, dentro de uma empresa de
						tecnologia. Essa mudança ampliou sua visão sobre a comunicação: além de desenvolver
						estratégias, passou a acompanhar de perto as demandas internas, os objetivos de
						negócio e os desafios enfrentados pelas lideranças.
					</p>
				</div>

				<div class="subsection">
					<h3>Posicionamento Executivo em empresas de tecnologia</h3>
					<p>
						Foi nesse contexto que Bruna liderou um dos primeiros projetos de posicionamento
						executivo no LinkedIn para o board da empresa. A experiência marcou uma mudança
						importante em sua trajetória: a comunicação dos executivos deixou de ser tratada
						apenas como presença digital e passou a ser trabalhada como instrumento de
						autoridade, relacionamento e posicionamento institucional.
					</p>
					<p>
						A empresa foi posteriormente adquirida pela TOTVS, em 2019/2020. A experiência
						contribuiu para consolidar a atuação de Bruna na interseção entre comunicação
						corporativa, posicionamento executivo e ambiente digital — combinação que se tornou
						central em seu trabalho à frente da Crayon Comunicação.
					</p>
				</div>
			</div>

			<figure class="content-figure">
				<img
					src="<?php echo esc_url( BLB_URI . '/assets/images/bruna-assessoria-executivos.webp' ); ?>"
					srcset="<?php echo esc_url( BLB_URI . '/assets/images/bruna-assessoria-executivos.webp' ); ?> 700w, <?php echo esc_url( BLB_URI . '/assets/images/bruna-assessoria-executivos@2x.webp' ); ?> 1400w"
					sizes="(min-width: 860px) 45vw, 90vw"
					width="700" height="1049"
					alt="Bruna Lopes de Barros assessora executivos"
					loading="lazy" decoding="async"
				>
			</figure>
		</div>
	</section>

	<!-- CRAYON COMUNICAÇÃO -->
	<section class="section bg-ink" id="crayon">
		<div class="container">
			<div class="section-head center" style="max-width:70ch;">
				<img
					src="<?php echo esc_url( BLB_URI . '/assets/images/logo-crayon.webp' ); ?>"
					srcset="<?php echo esc_url( BLB_URI . '/assets/images/logo-crayon.webp' ); ?> 340w, <?php echo esc_url( BLB_URI . '/assets/images/logo-crayon@2x.webp' ); ?> 680w"
					width="170" height="44"
					alt="Crayon Comunicação"
					loading="lazy" decoding="async"
					style="margin-inline:auto;margin-bottom:1.5rem;"
				>
				<h2>Crayon Comunicação: Boutique de Comunicação para Executivos</h2>
				<p>
					A Crayon Comunicação é uma boutique especializada em comunicação, posicionamento e
					reputação de executivos. Seu modelo combina atendimento próximo e sênior com estratégias
					personalizadas para transformar experiência, conhecimento e visão de negócio em
					autoridade de mercado. A atuação é voltada a líderes e empresas que buscam uma
					comunicação consistente, estratégica e alinhada aos objetivos do negócio.
				</p>
			</div>

			<div class="service-grid">
				<div class="service-card">
					<span class="num">01</span>
					<h3>Comunicação e reputação para executivos</h3>
					<p>
						A comunicação executiva envolve mais do que divulgar o trabalho de um líder. Ela
						organiza a forma como sua experiência, suas ideias e sua visão de negócio são
						apresentadas aos diferentes públicos com os quais se relaciona. A Crayon trabalha
						essa comunicação de maneira integrada à reputação do executivo e da empresa, buscando
						construir uma presença coerente, relevante e alinhada ao posicionamento institucional.
					</p>
				</div>
				<div class="service-card">
					<span class="num">02</span>
					<h3>Programas de Thought Leadership</h3>
					<p>
						Thought Leadership é a construção de autoridade a partir do conhecimento e da
						experiência de um profissional. A estratégia identifica os temas nos quais o
						executivo possui repertório e perspectiva próprios e os transforma em análises,
						artigos, opiniões e outros formatos de conteúdo autoral, associando o conhecimento do
						líder ao seu nome e ao seu mercado de atuação.
					</p>
				</div>
				<div class="service-card">
					<span class="num">03</span>
					<h3>Posicionamento de lideranças no LinkedIn</h3>
					<p>
						Consiste em construir uma presença estratégica para o líder na principal plataforma
						profissional do ambiente digital: definir temas, narrativas e formatos que reflitam
						sua experiência e seus objetivos, além de uma rotina de conteúdo capaz de fortalecer
						relacionamentos e autoridade — usando o LinkedIn como extensão da atuação
						profissional e institucional.
					</p>
				</div>
				<div class="service-card">
					<span class="num">04</span>
					<h3>Ghostwriter</h3>
					<p>
						Ghostwriting é a produção de conteúdo em nome de outra pessoa, preservando sua voz,
						suas ideias e sua perspectiva. No contexto executivo, exige compreender o repertório
						e a forma de pensar do líder para transformar esse conhecimento em conteúdos que
						soem genuinamente autorais, mesmo quando o executivo não dispõe de tempo para
						escrever.
					</p>
				</div>
			</div>
		</div>
	</section>

	<!-- MÍDIA -->
	<section class="section bg-white" id="midia">
		<div class="container">
			<div class="section-head center" style="margin-inline:auto;">
				<span class="eyebrow">Repercussão</span>
				<h2>Bruna Lopes de Barros na mídia</h2>
			</div>
			<div class="logo-strip">
				<?php
				// Substitua os placeholders abaixo pelas logos reais de veículos que
				// citaram Bruna, com link para a matéria (ex.: <a href="URL"><img ...></a>).
				$placeholders = array( 'Veículo 1', 'Veículo 2', 'Veículo 3', 'Veículo 4' );
				foreach ( $placeholders as $p ) {
					echo '<span class="placeholder">' . esc_html( $p ) . '</span>';
				}
				?>
			</div>
		</div>
	</section>

	<!-- HSM MANAGEMENT -->
	<section class="section bg-cream" id="hsm">
		<div class="container">
			<div class="section-head center" style="margin-inline:auto;">
				<span class="eyebrow">Coluna</span>
				<h2>Colunista da HSM Management</h2>
				<p>
					Bruna Lopes de Barros é colunista da HSM Management, onde publica análises e reflexões
					sobre comunicação, liderança, posicionamento e o universo corporativo. A experiência
					editorial amplia sua atuação para além da prestação de serviços, permitindo compartilhar
					uma visão própria sobre os desafios enfrentados por líderes e organizações.
				</p>
				<p>
					Sua produção na HSM Management reúne conhecimento profissional e análise autoral,
					abordando temas relacionados à comunicação executiva, comportamento e posicionamento de
					lideranças. Os artigos publicados também representam parte do repertório que orienta seu
					trabalho à frente da Crayon Comunicação.
				</p>
				<p style="margin-top:1.5rem;">
					<!-- Atualize o link abaixo para a página oficial dos artigos de Bruna na HSM Management -->
					<a href="https://www.hsmmanagement.com.br/" class="link-underline" target="_blank" rel="noopener">
						Confira os artigos de Bruna Lopes de Barros na HSM Management
					</a>
				</p>
			</div>
		</div>
	</section>

	<!-- CONTATO -->
	<section class="section contact-section" id="contato">
		<div class="container">
			<div class="section-head center" style="margin-inline:auto;">
				<span class="eyebrow" style="color:var(--c-green);">Contato</span>
				<h2>Vamos conversar sobre o posicionamento da sua liderança?</h2>
				<p>Preencha o formulário abaixo e retornaremos em breve.</p>
			</div>

			<form class="contact-form" id="blb-contact-form" novalidate>
				<div id="blb-form-feedback" role="status" aria-live="polite"></div>

				<p class="hp-field" aria-hidden="true">
					<label for="blb_website">Deixe este campo em branco</label>
					<input type="text" id="blb_website" name="blb_website" tabindex="-1" autocomplete="off">
				</p>

				<div class="row2">
					<div>
						<label for="blb_name">Nome*</label>
						<input type="text" id="blb_name" name="blb_name" required autocomplete="name">
					</div>
					<div>
						<label for="blb_email">E-mail*</label>
						<input type="email" id="blb_email" name="blb_email" required autocomplete="email">
					</div>
				</div>
				<div>
					<label for="blb_company">Empresa</label>
					<input type="text" id="blb_company" name="blb_company" autocomplete="organization">
				</div>
				<div>
					<label for="blb_message">Mensagem*</label>
					<textarea id="blb_message" name="blb_message" required></textarea>
				</div>

				<button type="submit" class="btn" style="justify-self:start;">Enviar mensagem</button>
				<p class="form-note">Seus dados são utilizados apenas para retorno de contato e não são compartilhados com terceiros.</p>
			</form>
		</div>
	</section>

</main>

<?php get_footer(); ?>
