<?php

class MW_WP_G_ConfigController {
	public function __construct() {
		$this->show_admin_page();
	}

	private function show_admin_page() {
?>
<div class="wrap">
<h2>MW WP Form G-reCAPTCHA</h2>
<?php settings_errors(); ?>
</div>
<?php
	}
}

?>
