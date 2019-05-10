<?php

class MW_WP_G_Field_reCAPTCHA extends MW_WP_Form_Abstract_Form_Field {
	public function __construct() {
		parent::__construct();
		add_action( 'wp_head', array( $this, '_add_head_script' ) );
	}

	protected function set_names() {
		return array(
			'shortcode_name' => 'mwform_recaptcha',
			'display_name' => 'Google reCAPTCHA',
		);
	}

	protected function set_defaults() {
		return array(
			'name' => '',
			'value' => '',
			'echo' => false,
		);
	}

	protected function input_page() {
		$v = '<div class="g-recaptcha" data-callback="syncerRecaptchaCallback" data-expired-callback="syncerRecaptchaExpired" data-sitekey="' . MWGC_Config::get_site_key() . '"></div>';
		$v .= "\n";
		return $v;
	}

	protected function confirm_page() {
		return "";
	}

	public function _add_head_script() {
		echo <<<EOT
<script src="https://www.google.com/recaptcha/api.js"></script>
<script type="text/javascript">
jQuery(function() {
	//jQuery( '.mw_wp_form_input button, .mw_wp_form_input input[type="submit"]' ).attr( "disabled", "disabled" );
});
function syncerRecaptchaCallback( code ) {
	if( code != "" ) {
		jQuery( '.mw_wp_form_input button, .mw_wp_form_input input[type="submit"]' ).removeAttr( "disabled" );
	}
}
function syncerRecaptchaExpired() {
	jQuery( '.mw_wp_form_input button, .mw_wp_form_input input[type="submit"]' ).attr( "disabled", "disabled" );
}
</script>
EOT;
	}
}

?>
