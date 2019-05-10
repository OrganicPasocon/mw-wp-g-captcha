<?php

class MW_WP_G_MainController {
	public function __construct() {
		$this->create_form_fields();
		$this->create_validation_rules();
	}

	private function create_form_fields() {
		new MW_WP_G_Field_reCAPTCHA();
	}

	private function create_validation_rules() {
		new MW_WP_G_Rule_reCAPTCHA();
	}
}

?>
