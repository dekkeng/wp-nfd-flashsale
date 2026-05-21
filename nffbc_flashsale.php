<?php
/**
 * Plugin Name: Newfolder Flashsale Banner with Counter
 * Description: Plugin for displaying a Flash Sale banner with a countdown timer at the bottom of the screen.
 * Version:     1.0.13
 * Author:      Newfolder
 * Author URI:  https://newfolder.co.th
 * License:     GPL-2.0+
 * Text Domain: nffbc-flashsale
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define plugin constants
define( 'NFFBC_FLASHSALE_VERSION', '1.0.13' );
define( 'NFFBC_FLASHSALE_DIR', plugin_dir_path( __FILE__ ) );
define( 'NFFBC_FLASHSALE_URL', plugin_dir_url( __FILE__ ) );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-nffbc-flashsale.php';

/**
 * Begins execution of the plugin.
 */
function nfd_flash_sale_run_nffbc_flashsale() {
	$plugin = new NFFBC_Flashsale();
	$plugin->run();
}
nfd_flash_sale_run_nffbc_flashsale();
