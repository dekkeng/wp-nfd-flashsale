<?php
/**
 * Plugin Name: NFD Flash Sale
 * Description: Plugin สำหรับแสดง Flash Sale banner พร้อม countdown timer ที่ด้านล่างหน้าจอ
 * Version:     1.0.12
 * Author:      Newfolder
 * Author URI:  https://newfolder.co.th
 * License:     GPL-2.0+
 * Text Domain: nfd-flashsale
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Define plugin constants
define( 'NFD_FLASHSALE_VERSION', '1.0.12' );
define( 'NFD_FLASHSALE_DIR', plugin_dir_path( __FILE__ ) );
define( 'NFD_FLASHSALE_URL', plugin_dir_url( __FILE__ ) );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-nfd-flashsale.php';

/**
 * Begins execution of the plugin.
 */
function run_nfd_flashsale() {
	$plugin = new NFD_Flashsale();
	$plugin->run();
}
run_nfd_flashsale();
