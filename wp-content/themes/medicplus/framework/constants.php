<?php
/**
 * Constants.
 * 
 * @package MedicPlus
 * @since 1.0
 */
defined( 'MEDICPLUS_THEME_VER' )      || define( 'MEDICPLUS_THEME_VER', '1.0.0' );
defined( 'MEDICPLUS_THEME_NAME' )     || define( 'MEDICPLUS_THEME_NAME', 'medicplus' );
defined( 'MEDICPLUS_THEME_CLASS' )    || define( 'MEDICPLUS_THEME_CLASS', 'Medicplus' );
defined( 'MEDICPLUS_THEME_OPTIONS' )  || define( 'MEDICPLUS_THEME_OPTIONS', 'medicplus_options' );


defined( 'MEDICPLUS_THEME_DIR' )      || define( 'MEDICPLUS_THEME_DIR', get_template_directory() );
defined( 'MEDICPLUS_THEME_URI' )      || define( 'MEDICPLUS_THEME_URI', get_template_directory_uri() );
defined( 'MEDICPLUS_FRAMEWORK_DIR' )  || define( 'MEDICPLUS_FRAMEWORK_DIR', MEDICPLUS_THEME_DIR . '/framework' );
defined( 'MEDICPLUS_REDUX_EXT_DIR' )  || define( 'MEDICPLUS_REDUX_EXT_DIR', get_template_directory() . '/admin/redux-extensions' );

defined( 'MEDICPLUS_MODULES_DIR' )    || define( 'MEDICPLUS_MODULES_DIR', MEDICPLUS_FRAMEWORK_DIR . '/modules' );
defined( 'MEDICPLUS_FRONT_DIR' )      || define( 'MEDICPLUS_FRONT_DIR', MEDICPLUS_FRAMEWORK_DIR . '/modules/front' );
defined( 'MEDICPLUS_PLUGINS_DIR' )    || define( 'MEDICPLUS_PLUGINS_DIR', MEDICPLUS_FRAMEWORK_DIR . '/plugins' );
defined( 'MEDICPLUS_EXTERNAL_DIR' )   || define( 'MEDICPLUS_EXTERNAL_DIR', MEDICPLUS_FRAMEWORK_DIR . '/external' );

defined( 'MEDICPLUS_ADMIN_URI' )      || define( 'MEDICPLUS_ADMIN_URI', MEDICPLUS_THEME_URI . '/assets/admin' );
defined( 'MEDICPLUS_PUBLIC_URI' )     || define( 'MEDICPLUS_PUBLIC_URI', MEDICPLUS_THEME_URI . '/assets/public' );
defined( 'MEDICPLUS_PLUGIN_IMG_URI' ) || define( 'MEDICPLUS_PLUGIN_IMG_URI', MEDICPLUS_THEME_URI . '/assets/admin/images/plugin' );
defined( 'MEDICPLUS_THEME_CORE_URI' ) || define( 'MEDICPLUS_THEME_CORE_URI', WP_PLUGIN_DIR . '/slz-core/' );

defined( 'MEDICPLUS_COPYRIGHT' )      || define( 'MEDICPLUS_COPYRIGHT', '&#169; 2016 SWLABS' );
defined( 'MEDICPLUS_LOGO' )           || define( 'MEDICPLUS_LOGO', MEDICPLUS_PUBLIC_URI . '/images/logo/logo-default.png' );

defined( 'MEDICPLUS_NO_IMG' )         || define( 'MEDICPLUS_NO_IMG', MEDICPLUS_PUBLIC_URI.'/images/thumb-no-image.gif' );
defined( 'MEDICPLUS_NO_IMG_URI' )     || define( 'MEDICPLUS_NO_IMG_URI', MEDICPLUS_PUBLIC_URI.'/images/no-image/' );
defined( 'MEDICPLUS_MAP_MAKER' )      || define( 'MEDICPLUS_MAP_MAKER', MEDICPLUS_PUBLIC_URI.'/images/map-maker.png' );

//*********************Plugin***************************
//Active slz-core Plugin - SLZCORE_VERSION
if( defined( 'SLZCORE_VERSION' ) ) {
	define( 'MEDICPLUS_CORE_IS_ACTIVE', defined( 'SLZCORE_VERSION' ) );
}
else {
	define( 'MEDICPLUS_CORE_IS_ACTIVE', '' );
}
//ReduxFrameworkPlugin
defined( 'MEDICPLUS_REDUX_ACTIVE' )     || define( 'MEDICPLUS_REDUX_ACTIVE', class_exists( 'ReduxFrameworkPlugin' ) );

//Active RS
if( defined( 'RS_PLUGIN_PATH' ) ) {
	define( 'MEDICPLUS_REVSLIDER_ACTIVE', defined( 'RS_PLUGIN_PATH' ) );
}
else {
	define( 'MEDICPLUS_REVSLIDER_ACTIVE', '' );
}

//Active ContactForm7 Plugin
if( defined( 'WPCF7_LOAD_JS' ) ) {
	define( 'MEDICPLUS_WPCF7_ACTIVE', defined( 'WPCF7_LOAD_JS' ) );
}
else {
	define( 'MEDICPLUS_WPCF7_ACTIVE', '' );
}
//Active Woocommerce Plugin
defined( 'MEDICPLUS_WOOCOMMERCE_ACTIVE' )     || define( 'MEDICPLUS_WOOCOMMERCE_ACTIVE', class_exists( 'WooCommerce' ) );

defined( 'MEDICPLUS_WOOCOMMERCE_WISHLIST' )   || define( 'MEDICPLUS_WOOCOMMERCE_WISHLIST', class_exists( 'YITH_WCWL_Shortcode' ) );
// Active Events Calendar Plugin 
defined( 'MEDICPLUS_EVENTS_CALENDAR_ACTIVE' )           || define( 'MEDICPLUS_EVENTS_CALENDAR_ACTIVE', class_exists( 'Tribe__Events__Main' ) );

defined( 'MEDICPLUS_CUSTOM_SIDEBAR_NAME' )   || define( 'MEDICPLUS_CUSTOM_SIDEBAR_NAME', 'medicplus_custom_sidebar' );