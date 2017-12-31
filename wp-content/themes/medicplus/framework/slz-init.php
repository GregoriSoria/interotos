<?php
/**
 * Theme init
 *
 * @author Swlabs
 * @package MedicPlus
 * @since 1.0
 */
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Theme setup
add_action('after_setup_theme', array( 'Medicplus', '[theme.Theme_Init, theme_setup]' ) );

require_once MEDICPLUS_FRAMEWORK_DIR . '/class-medicplus-loader.php';
require_once MEDICPLUS_FRAMEWORK_DIR . '/class-medicplus-config.php';
require_once MEDICPLUS_FRAMEWORK_DIR . '/class-medicplus-params.php';
require_once MEDICPLUS_FRAMEWORK_DIR . '/class-medicplus.php';
require_once MEDICPLUS_THEME_DIR . '/admin/admin-init.php';

/**
 * Theme option function
 */
require_once MEDICPLUS_FRAMEWORK_DIR . '/slz-theme-option.php';

// Setup plugins
require_once MEDICPLUS_FRAMEWORK_DIR . '/slz-tgm.php';

// Load class
Medicplus::load_class( 'Breadcrumb' );


/**
 * Register sidebars
 */
add_action( 'widgets_init', array('Medicplus', '[widget.Widget_Init, widgets_init]') );

/**
 * Add scripts && css front-end
 */
if( ! is_admin() ) {
	add_action( 'wp_enqueue_scripts', array( 'Medicplus', '[theme.Theme_Init, public_enqueue]' ) );
}

require_once MEDICPLUS_FRAMEWORK_DIR . '/slz-functions.php';
require_once MEDICPLUS_FRAMEWORK_DIR . '/slz-menu.php';
// default
/**
 * Customizer additions.
 */
require_once MEDICPLUS_THEME_DIR . '/inc/customizer.php';