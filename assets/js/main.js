/**
 * JS mínimo, sem dependências (sem jQuery), carregado com defer.
 * Responsável por: menu mobile e envio do formulário de contato via AJAX.
 */
( function () {
	'use strict';

	/* Menu mobile */
	var toggle = document.querySelector( '.menu-toggle' );
	var nav = document.getElementById( 'primary-menu' );

	if ( toggle && nav ) {
		toggle.addEventListener( 'click', function () {
			var isOpen = nav.classList.toggle( 'is-open' );
			toggle.classList.toggle( 'is-active', isOpen );
			toggle.setAttribute( 'aria-expanded', isOpen ? 'true' : 'false' );
		} );

		nav.querySelectorAll( 'a' ).forEach( function ( link ) {
			link.addEventListener( 'click', function () {
				nav.classList.remove( 'is-open' );
				toggle.classList.remove( 'is-active' );
				toggle.setAttribute( 'aria-expanded', 'false' );
			} );
		} );
	}

	/* Botão "copiar link" (compartilhamento do post) */
	document.querySelectorAll( '.js-copy-link' ).forEach( function ( btn ) {
		btn.addEventListener( 'click', function () {
			var url = btn.getAttribute( 'data-url' ) || window.location.href;
			var done = function () {
				btn.classList.add( 'is-copied' );
				var prevLabel = btn.getAttribute( 'aria-label' );
				btn.setAttribute( 'aria-label', 'Link copiado!' );
				setTimeout( function () {
					btn.classList.remove( 'is-copied' );
					btn.setAttribute( 'aria-label', prevLabel );
				}, 1800 );
			};
			if ( navigator.clipboard && window.isSecureContext ) {
				navigator.clipboard.writeText( url ).then( done ).catch( function () {} );
			} else {
				var tmp = document.createElement( 'textarea' );
				tmp.value = url;
				tmp.style.position = 'fixed';
				tmp.style.left = '-9999px';
				document.body.appendChild( tmp );
				tmp.select();
				try { document.execCommand( 'copy' ); done(); } catch ( e ) {}
				document.body.removeChild( tmp );
			}
		} );
	} );

	/* Formulário de contato (progressive enhancement via AJAX) */
	var form = document.getElementById( 'blb-contact-form' );
	if ( ! form || typeof blbContact === 'undefined' ) return;

	var feedback = document.getElementById( 'blb-form-feedback' );

	form.addEventListener( 'submit', function ( e ) {
		e.preventDefault();

		var submitBtn = form.querySelector( 'button[type="submit"]' );
		var originalText = submitBtn.textContent;
		submitBtn.disabled = true;
		submitBtn.textContent = 'Enviando…';
		feedback.innerHTML = '';

		var data = new FormData( form );
		data.append( 'action', 'blb_contact_form' );
		data.append( 'blb_nonce', blbContact.nonce );

		fetch( blbContact.ajaxUrl, { method: 'POST', body: data, credentials: 'same-origin' } )
			.then( function ( res ) { return res.json(); } )
			.then( function ( json ) {
				var ok = json && json.success;
				var msg = ( json && json.data && json.data.message ) || ( ok ? 'Mensagem enviada!' : 'Não foi possível enviar. Tente novamente.' );
				feedback.innerHTML = '<div class="' + ( ok ? 'form-success' : 'form-error' ) + '">' + msg + '</div>';
				if ( ok ) form.reset();
			} )
			.catch( function () {
				feedback.innerHTML = '<div class="form-error">Erro de conexão. Tente novamente em instantes.</div>';
			} )
			.finally( function () {
				submitBtn.disabled = false;
				submitBtn.textContent = originalText;
			} );
	} );
} )();
