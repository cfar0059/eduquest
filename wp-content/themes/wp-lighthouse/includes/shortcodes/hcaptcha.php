<?php

function wp_lighthouse_hcaptcha_shortcode( $attr, $content = null ) {


	$redirect = ( !empty( $_GET['redir'] ) ? trim( $_GET['redir'] ) : home_url( '/' ) );

	$output = '<script src="https://hcaptcha.com/1/api.js?hl=en" async defer></script><script>
	function av_hcaptcha_error( res ) { jQuery(\'.h-status\').removeClass(\'text-success\'); jQuery(\'.h-status\').addClass(\'text-danger\'); jQuery(\'.h-status\').html(\'' . __( 'Invalid captcha response. Please try again!<br>Reloading page in 5 seconds...', 'wp-lighthouse' ) . '\'); setTimeout( function(){ location.reload(); }, 4000 ); } function av_hcaptcha_success( res ) {jQuery.ajax({type : "post",dataType : "json",url : ajax_object.ajaxurl,data : {action: \'wp_lighthouse_hcaptcha_verify\',response: res,key: ajax_object.ajax_nonce,},success: function(res) {if(res.status) {jQuery(\'.h-status\').removeClass(\'text-danger\'); jQuery(\'.h-status\').addClass(\'text-success\'); jQuery(\'.h-status\').html(\'' . __( 'Success!<br>Redirecting in 5 seconds...', 'wp-lighthouse' ) . '\'); setTimeout( function(){ location.reload(); }, 3000 );}}});}</script>';

	$output .= '<div class="h-captcha" data-sitekey="9b0abba0-a553-44d0-b110-969bdc536bf6" data-theme="dark" data-size="normal" data-callback="av_hcaptcha_success" data-expired-callback="av_hcaptcha_error" data-close-callback="av_hcaptcha_error" data-chalexpired-callback="av_hcaptcha_error" data-error-callback="av_hcaptcha_error"></div><div class="h-status"></div>';

  	return $output;
}