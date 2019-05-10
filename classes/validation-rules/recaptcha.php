<?php

class MW_WP_G_Rule_reCAPTCHA extends MW_WP_Form_Abstract_Validation_Rule {
	protected $name = "recaptcha";

	public function rule( $name, array $options = array() ) {
		$post_condition = $this->Data->get_post_condition();
		$view_flg = $this->Data->get_view_flg();
		if( $post_condition != 'confirm' || !is_null( $view_flg ) ) {
			// Not Confirmation
			return;
		}

		// Get reCAPTURE Auth code
		$value = $this->Data->get( "g-recaptcha-response" );
		if( MWF_Functions::is_empty( $value ) ) {
			// Empty
			$defaults = array(
				'message' => __( 'Please enter.', 'mw-wp-form' ),
			);
			$options = array_merge( $defaults, $options );
			return $options['message'];
		}

		// TODO: Verify auth code to Google

		$defaults = array(
			'message' => "value = $value",
		);
		$options = array_merge( $defaults, $options );
		return $options['message'];
	}

	public function admin( $key, $value ) {
?>
<label>
	<input type="checkbox" <?php checked( $value[ $this->getName() ], 1 ); ?> name="<?php echo MWF_Config::NAME; ?>[validation][<?php echo $key; ?>][<?php echo esc_attr( $this->getName() ); ?>]" value="1">
	<?php esc_html_e( 'Google reCAPTCHA', 'mw-wp-form' ); ?>
</label><?php
	}
}

?>
