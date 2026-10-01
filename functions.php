<?php
/**
 * Bruna Lopes de Barros — funções do tema
 *
 * Tema construído com foco em performance (Core Web Vitals), semântica
 * e indexação por buscadores e IAs (Google, GPTBot, ClaudeBot, PerplexityBot etc).
 *
 * @package BrunaLopes
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'BLB_VERSION', '1.0.2' );
define( 'BLB_DIR', get_template_directory() );
define( 'BLB_URI', get_template_directory_uri() );

require BLB_DIR . '/inc/setup.php';
require BLB_DIR . '/inc/enqueue.php';
require BLB_DIR . '/inc/cleanup.php';
require BLB_DIR . '/inc/seo.php';
require BLB_DIR . '/inc/contact-form.php';
require BLB_DIR . '/inc/template-tags.php';
