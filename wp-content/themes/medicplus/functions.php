<?php
/**
 * MedicPlus functions and definitions
 *
 * @author Swlabs
 * @package MedicPlus
 * @since 1.0
 * */
clearstatcache();

function medicplus_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'medicplus_content_width', 1024 );
}
add_action( 'after_setup_theme', 'medicplus_content_width', 0 );
// load constants
require_once (get_template_directory() . '/framework/constants.php');

// load textdomain
load_theme_textdomain( 'medicplus', MEDICPLUS_THEME_DIR . '/languages' );

/* Theme Initialization */
require_once (MEDICPLUS_FRAMEWORK_DIR . '/slz-init.php');

$medicplus_app = Medicplus::new_object('Application');
$medicplus_app->run();