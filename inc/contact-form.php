<?php
/**
 * Formulário de contato nativo (sem plugins) — envia via wp_mail(),
 * com proteção honeypot + nonce, e progressive enhancement via AJAX
 * (funciona também com JavaScript desabilitado, através de um
 * redirecionamento simples).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function blb_handle_contact_form() {
	check_ajax_referer( 'blb_contact_form', 'blb_nonce' );

	// Honeypot: campo invisível que só bots preenchem.
	if ( ! empty( $_POST['blb_website'] ) ) {
		wp_send_json_success( array( 'message' => 'Obrigado pelo contato!' ) ); // falha silenciosa
	}

	$name    = isset( $_POST['blb_name'] ) ? sanitize_text_field( wp_unslash( $_POST['blb_name'] ) ) : '';
	$email   = isset( $_POST['blb_email'] ) ? sanitize_email( wp_unslash( $_POST['blb_email'] ) ) : '';
	$company = isset( $_POST['blb_company'] ) ? sanitize_text_field( wp_unslash( $_POST['blb_company'] ) ) : '';
	$message = isset( $_POST['blb_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['blb_message'] ) ) : '';

	if ( empty( $name ) || empty( $message ) || ! is_email( $email ) ) {
		wp_send_json_error( array( 'message' => 'Por favor, preencha nome, e-mail válido e mensagem.' ) );
	}

	$to      = get_option( 'admin_email' );
	$subject = sprintf( '[%s] Novo contato de %s', get_bloginfo( 'name' ), $name );
	$body    = "Nome: {$name}\nE-mail: {$email}\nEmpresa: {$company}\n\nMensagem:\n{$message}";
	$headers = array( 'Content-Type: text/plain; charset=UTF-8', "Reply-To: {$name} <{$email}>" );

	$sent = wp_mail( $to, $subject, $body, $headers );

	if ( $sent ) {
		wp_send_json_success( array( 'message' => 'Mensagem enviada com sucesso! Responderemos em breve.' ) );
	} else {
		wp_send_json_error( array( 'message' => 'Não foi possível enviar agora. Tente novamente em instantes.' ) );
	}
}
add_action( 'wp_ajax_blb_contact_form', 'blb_handle_contact_form' );
add_action( 'wp_ajax_nopriv_blb_contact_form', 'blb_handle_contact_form' );

/**
 * Disponibiliza ajaxurl + nonce para o JS do tema, sem inline-script
 * grande — apenas um pequeno objeto de config.
 */
function blb_contact_form_data() {
	wp_localize_script( 'brunalopes-main', 'blbContact', array(
		'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		'nonce'   => wp_create_nonce( 'blb_contact_form' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'blb_contact_form_data', 20 );
