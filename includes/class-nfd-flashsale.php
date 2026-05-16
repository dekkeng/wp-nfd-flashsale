<?php

/**
 * The core plugin class.
 */
class NFD_Flashsale {

	/**
	 * The unique identifier of this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 */
	public function __construct() {
		$this->plugin_name = 'nfd-flashsale';
		$this->version = NFD_FLASHSALE_VERSION;

		$this->load_dependencies();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 */
	private function load_dependencies() {
		require_once NFD_FLASHSALE_DIR . 'includes/class-nfd-admin.php';
		require_once NFD_FLASHSALE_DIR . 'includes/class-nfd-frontend.php';
	}

	/**
	 * Register all of the hooks related to the admin area functionality.
	 */
	private function define_admin_hooks() {
		$plugin_admin = new NFD_Admin( $this->plugin_name, $this->version );

		add_action( 'init', array( $plugin_admin, 'register_post_type' ) );
		add_action( 'add_meta_boxes', array( $plugin_admin, 'add_meta_boxes' ) );
		add_action( 'save_post', array( $plugin_admin, 'save_meta_boxes' ) );
		add_action( 'admin_enqueue_scripts', array( $plugin_admin, 'enqueue_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $plugin_admin, 'enqueue_scripts' ) );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality.
	 */
	private function define_public_hooks() {
		$plugin_public = new NFD_Frontend( $this->plugin_name, $this->version );

		add_action( 'wp_enqueue_scripts', array( $plugin_public, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $plugin_public, 'enqueue_scripts' ) );
		add_action( 'wp_footer', array( $plugin_public, 'render_flashsale_banner' ) );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 */
	public function run() {
		// Hooks are added in define_*_hooks methods which run during instantiation.
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
