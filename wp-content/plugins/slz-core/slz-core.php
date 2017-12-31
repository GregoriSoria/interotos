<?php
/*
Plugin Name: Slz Core
Plugin URI: http://themeforest.net/user/swlabs
Description: Slz Core Plugin for Swlabs Themes
Version: 1.0
Author: Swlabs
Author URI: http://themeforest.net/user/swlabs
Text Domain: slz-core
*/

clearstatcache();

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

// load constants
require_once( plugin_dir_path( __FILE__ ) . '/constants.php' );

/* Load plugin textdomain.*/
load_plugin_textdomain( 'slz-core', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );

/* Initialization */
require_once( SLZCORE_FRAMEWORK_DIR . '/class-slz-loader.php' );
require_once( SLZCORE_FRAMEWORK_DIR . '/class-slz-config.php' );
require_once( SLZCORE_FRAMEWORK_DIR . '/class-slz-params.php' );

require_once( plugin_dir_path( __FILE__ ) . '/class-slz.php' );
require_once( plugin_dir_path( __FILE__ ) . '/libs/class-format.php' );
require_once( plugin_dir_path( __FILE__ ) . '/libs/class-util.php' );
require_once( plugin_dir_path( __FILE__ ) . '/libs/class-com.php' );
require_once( plugin_dir_path( __FILE__ ) . '/custom-functions.php' );
require_once( plugin_dir_path( __FILE__ ) . '/framework/modules/importer/index.php' );

Medicplus_Core::load_class( 'Helper' );
Medicplus_Core::load_class( 'models.Custom_Post_Model' );
Medicplus_Core::load_class( 'models.Taxonomy_Model' );
Medicplus_Core::load_class( 'models.Video_Model' );
Medicplus_Core::load_class( 'models.Pagination' );
Medicplus_Core::load_class( 'shortcode.Block' );
Medicplus_Core::load_class( 'shortcode.Testimonial' );
Medicplus_Core::load_class( 'shortcode.Faq' );
Medicplus_Core::load_class( 'shortcode.Service' );
Medicplus_Core::load_class( 'shortcode.Appointment' );
Medicplus_Core::load_class( 'shortcode.Department' );
Medicplus_Core::load_class( 'shortcode.Team' );
Medicplus_Core::load_class( 'shortcode.Gallery' );
Medicplus_Core::load_class( 'shortcode.Location' );
Medicplus_Core::load_class( 'Social_Share' );

$app = Medicplus_Core::new_object('Application');
$app->run();
if(SLZCORE_IMPORT_TAXONOMY_ACTIVE) {
	$opt = Medicplus_Core::new_object('Options_Importer');
	$opt->instance();
}

Medicplus_Core::load_class( 'setting.Taxonomies_Controller' );
require_once( plugin_dir_path( __FILE__ ) . '/shortcode/shortcode_function.php' );

if( ! is_admin() ) {
	add_action( 'wp_enqueue_scripts', array( 'Medicplus_Core', '[setting.Setting_Init, dev_enqueue_scripts]' ) );
}
