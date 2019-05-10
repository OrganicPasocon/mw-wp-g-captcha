<?php
/**
 * Plugin Name: Yet Another MW WP Form G-reCAPTCHA
 * Description: MW WP FormにGoogle reCAPTCHAを追加します。って思ったんですけどまだ追加できてないです。
 * Version: 0.9.0
 * Author: Anotherlane Inc.
 * Author URI: https://www.alij.ne.jp
 * License: MIT License
 * Text Domain: mw-wp-grecaptcha
 */

include_once( plugin_dir_path( __FILE__ ) . 'classes/config.php' );

class MW_WP_G_Recaptcha {
	public function __construct() {
		add_action( 'plugins_loaded', array( $this, '_load_initialize_files' ), 9 );
		add_action( 'plugins_loaded', array( $this, '_initialize' ), 11 );
	}

	public function _load_initialize_files() {
		$dir = plugin_dir_path( __FILE__ );
		$includes = array(
			'classes/controllers',
			'classes/form-fields',
			'classes/validation-rules',
		);
		foreach( $includes as $inc ) {
			foreach( glob( $dir . $inc . "/*.php" ) as $file ) {
				require_once( $file );
			}
		}
	}

	public function _initialize() {
		if( current_user_can( MWGC_Config::CAPABILITY ) && is_admin() ) {
			add_action( 'admin_menu', array( $this, '_add_admin_menu' ), 9 );
			add_action( 'current_screen', array( $this, '_current_screen' ) );
		} else if( !is_admin() ) {
			$Controller = new MW_WP_G_MainController();
		}
	}

	public function _add_admin_menu() {
		add_menu_page(
			'MW WP Form G-reCAPTCHA',
			'MW WP Form G-reCAPTCHA',
			'manage_options',
			'mw-wp-g-recaptcha',
			array( $this, '_show_admin_page' ),
			'dashicons-admin-post',
			58
		);
	}

	public function _show_admin_page() {
		$Controller = new MW_WP_G_ConfigController();
	}

	public function _current_screen( $screen ) {
		if( $screen->id === MWF_Config::NAME ) {
			$Controller = new MW_WP_G_AdminController();
		} else if( $screen->id === MWGC_Config::NAME ) {
			$Controller = new MW_WP_G_ConfigController();
		}
	}
}

$mw_wp_g = new MW_WP_G_Recaptcha();

?>
