=== Bruna Lopes de Barros ===
Tema institucional (home + blog) para seudominio.com.br

== 1. Instalação ==
1. Compacte a pasta "brunalopes" (se ainda não estiver em .zip) e envie em
   Aparência > Temas > Adicionar novo > Enviar tema. Ou envie a pasta via
   FTP/SFTP para /wp-content/themes/.
2. Ative o tema em Aparência > Temas.
3. Vá em Configurações > Leitura:
   - "A página inicial exibe": Uma página estática
   - Página inicial: crie/selecione uma página (ex.: "Início") — o
     conteúdo dela não é usado, pois a home é 100% renderizada pelo
     template front-page.php, mas o WordPress exige uma página
     estática atribuída.
   - Página de posts: crie uma página chamada "Blog" e selecione-a
     aqui. É nela que o template home.php vai renderizar a listagem
     de artigos.
4. Vá em Configurações > Links Permanentes e clique em "Salvar" (isso
   ativa a rota do /llms.txt e as URLs amigáveis).
5. Em Aparência > Menus, crie o menu principal e associe ao local
   "Menu Principal" (opcional — sem menu configurado, o tema usa um
   menu-âncora padrão apontando para as seções da home).
6. Em Aparência > Personalizar > Identidade do site, envie a logo da
   Crayon (upload de logo em SVG ou PNG com fundo transparente).

== 2. Pontos para revisar/editar ==
- front-page.php: textos institucionais já estão preenchidos conforme
  o briefing. Edite diretamente no arquivo (ou peça para o
  desenvolvedor transformar em campos do Personalizador, se preferir
  edição via painel).
- Seção "Bruna Lopes de Barros na mídia": os placeholders de logos
  devem ser substituídos por <a href="URL"><img src="logo.svg"
  alt="Nome do veículo" loading="lazy"></a> reais.
- Seção "HSM Management": atualize o link para a página oficial dos
  artigos de Bruna assim que definido.
- E-mail de destino do formulário de contato: usa o e-mail de admin
  do WordPress (Configurações > Geral > Endereço de e-mail).
  Para e-mails confiáveis (evitar cair em spam), recomenda-se instalar
  um plugin de SMTP (ex.: WP Mail SMTP) configurado com o domínio.

== 3. Performance (Core Web Vitals / PageSpeed) ==
Já implementado no tema:
- Zero fontes externas: pilha de fontes de sistema (sem requisição de
  rede, sem CLS por troca de fonte).
- Uma única folha de estilo (style.css) e um único JS (defer, sem
  jQuery) no front-end.
- Imagens em WebP, comprimidas e com srcset 1x/2x, width/height
  explícitos (evita layout shift) e loading="lazy" em tudo que não é
  a imagem principal (hero com fetchpriority="high" + preload).
- Limpeza de <head> (remoção de emoji scripts, RSD, WLW manifest,
  shortlink, oEmbed discovery, dashicons para visitantes, XML-RPC
  desativado, Heartbeat limitado ao editor).
Recomendado no servidor/hospedagem (fora do escopo do tema):
- Ativar cache de página (ex.: plugin de cache ou cache no
  servidor/CDN).
- Ativar compressão Gzip/Brotli e cabeçalhos de cache para estáticos
  (imagens, CSS, JS) — normalmente configurável no painel da
  hospedagem ou via .htaccess/Nginx.
- Servir o site via HTTP/2 ou HTTP/3 e TLS (HTTPS).
- Usar hospedagem com PHP 8.x e objeto de cache (Redis/Memcached) se o
  tráfego crescer.
- Ao publicar novos posts, sempre enviar imagens já otimizadas (o WP
  não reduz automaticamente para WebP nem comprime tanto quanto o
  ideal — plugins como ShortPixel/Imagify ajudam nisso).

== 4. SEO e indexação por IAs ==
- H1 único por página, hierarquia H2/H3 semântica (sem pular níveis).
- Meta description, canonical, Open Graph e Twitter Card gerados
  automaticamente por página/post.
- JSON-LD (schema.org): Person, Organization, WebSite, ProfilePage na
  home; Article + Breadcrumb nos posts.
- robots.txt virtual liberando explicitamente rastreadores de IA
  (GPTBot, ClaudeBot, PerplexityBot, Google-Extended, CCBot) e
  apontando o sitemap nativo do WordPress (/wp-sitemap.xml, ativo por
  padrão desde o WP 5.5).
- /llms.txt gerado dinamicamente (formato proposto em llmstxt.org)
  com um resumo do site e lista dos artigos mais recentes, pensado
  para orientar assistentes de IA sobre o conteúdo do site.
- Para controle avançado de SEO (títulos por página, sitemap
  customizado, redirecionamentos), pode-se somar um plugin como Yoast
  SEO ou Rank Math sem conflito — o tema não duplica funcionalidades
  se um plugin desses assumir o head; recomenda-se, nesse caso,
  desativar o bloco de meta/JSON-LD do tema (inc/seo.php) para evitar
  tags duplicadas.

== 5. Estrutura de arquivos ==
brunalopes/
├── style.css              (CSS completo do tema + cabeçalho obrigatório do WP)
├── functions.php
├── header.php / footer.php
├── front-page.php         (Home institucional — seções da página inicial)
├── home.php               (Listagem do Blog — "Página de posts")
├── index.php               (fallback)
├── archive.php             (categorias/tags)
├── single.php               (post individual)
├── page.php                 (páginas genéricas)
├── search.php / searchform.php / 404.php
├── inc/
│   ├── setup.php            (theme supports, menus, tamanhos de imagem)
│   ├── enqueue.php          (CSS/JS, preload da imagem LCP)
│   ├── cleanup.php          (remoção de bloat do <head>)
│   ├── seo.php               (meta tags, JSON-LD, robots.txt, /llms.txt)
│   ├── contact-form.php      (formulário nativo via wp_mail + AJAX)
│   └── template-tags.php
├── template-parts/
│   ├── content.php           (card de post)
│   └── content-none.php
└── assets/
    ├── css/ (reservado para uso futuro — hoje tudo está em style.css)
    ├── js/main.js             (menu mobile + envio AJAX do formulário)
    └── images/                (fotos e logo já otimizadas em WebP)
