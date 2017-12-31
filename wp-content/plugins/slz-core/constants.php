<?php
/**
 * Constants.
 * 
 * @author Swlabs
 * @package Slz-Core
 * @since 1.0
 */

defined( 'SLZCORE_VERSION' )        || define( 'SLZCORE_VERSION', '1.0' );
defined( 'SLZCORE_SC_CATEGORY' )    || define( 'SLZCORE_SC_CATEGORY', 'Medicplus_Core' );
defined( 'SLZCORE_CLASS' )          || define( 'SLZCORE_CLASS', 'Medicplus_Core' );

defined( 'SLZCORE_URI' )            || define( 'SLZCORE_URI', plugin_dir_url( __FILE__ ) );
defined( 'SLZCORE_DIR' )            || define( 'SLZCORE_DIR', dirname( __FILE__ ) );

defined( 'SLZCORE_ASSET_URI' )      || define( 'SLZCORE_ASSET_URI', SLZCORE_URI . 'assets' );

defined( 'SLZCORE_FRAMEWORK_DIR' )  || define( 'SLZCORE_FRAMEWORK_DIR', SLZCORE_DIR . '/framework' );
defined( 'SLZCORE_SHORTCODE_DIR' )  || define( 'SLZCORE_SHORTCODE_DIR', SLZCORE_DIR . '/shortcode' );
defined( 'SLZCORE_VENDOR_SUPPORT' ) || define( 'SLZCORE_VENDOR_SUPPORT', SLZCORE_DIR . '/extensions/vendor_support/' );


// Active ContactForm7 Plugin 
defined( 'SLZCORE_WPCF7_ACTIVE' )           || define( 'SLZCORE_WPCF7_ACTIVE', is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) );
//Active VC Plugin
defined( 'SLZCORE_VC_ACTIVE' )              || define( 'SLZCORE_VC_ACTIVE', is_plugin_active( 'js_composer/js_composer.php' ) );
//Active Woocommerce Plugin
defined( 'SLZCORE_WOOCOMMERCE_ACTIVE' )     || define( 'SLZCORE_WOOCOMMERCE_ACTIVE', is_plugin_active( 'woocommerce/woocommerce.php' ) );
defined( 'SLZCORE_REVSLIDER_ACTIVE' )       || define( 'SLZCORE_REVSLIDER_ACTIVE', is_plugin_active( 'revslider/revslider.php' ) );

// Default Image
defined( 'SLZCORE_NO_IMG_REC' )         || define( 'SLZCORE_NO_IMG_REC', SLZCORE_ASSET_URI.'/images/no-image/thumb-rectangle.gif' );
defined( 'SLZCORE_NO_IMG_SQUARE' )      || define( 'SLZCORE_NO_IMG_SQUARE', SLZCORE_ASSET_URI.'/images/no-image/thumb-square.gif' );
defined( 'SLZCORE_NO_IMG_URI' )         || define( 'SLZCORE_NO_IMG_URI', SLZCORE_ASSET_URI.'/images/no-image/' );
defined( 'SLZCORE_NO_IMG_DIR' )         || define( 'SLZCORE_NO_IMG_DIR', SLZCORE_DIR.'/assets/images/no-image/' );
defined( 'SLZCORE_MAP_MAKER' )          || define( 'SLZCORE_MAP_MAKER', SLZCORE_ASSET_URI.'/images/map-maker.png' );

// Options
defined( 'SLZCORE_THEME_CLASS' )        || define( 'SLZCORE_THEME_CLASS', 'Medicplus' );
defined( 'SLZCORE_THEME_PREFIX' )       || define( 'SLZCORE_THEME_PREFIX', 'medicplus' );
defined( 'SLZCORE_THEME_OPTIONS' )      || define( 'SLZCORE_THEME_OPTIONS', 'medicplus_options' );
defined( 'SLZCORE_POST_VIEWS' )         || define( 'SLZCORE_POST_VIEWS', SLZCORE_THEME_PREFIX . '_postview_number' );
defined( 'SLZCORE_POST_RATES' )         || define( 'SLZCORE_POST_RATES', SLZCORE_THEME_PREFIX . '_postrate_number' );
defined( 'SLZCORE_ADD_INLINE_CSS' )     || define( 'SLZCORE_ADD_INLINE_CSS', SLZCORE_THEME_PREFIX . '_add_inline_style' );
defined( 'SLZCORE_TAXONOMY_CUS' )       || define( 'SLZCORE_TAXONOMY_CUS', 'medicplus_taxonomy_cus' );
defined( 'SLZCORE_IMPORT_TAXONOMY_ACTIVE' ) || define( 'SLZCORE_IMPORT_TAXONOMY_ACTIVE', false );
defined( 'SLZCORE_CUSTOM_SIDEBAR_NAME' )    || define( 'SLZCORE_CUSTOM_SIDEBAR_NAME', 'medicplus_custom_sidebar' );

// Importer
defined( 'SLZCORE_SAMPLE_DATA_DIR' )    || define( 'SLZCORE_SAMPLE_DATA_DIR', SLZCORE_DIR . '/sample-data/' );
defined( 'SLZCORE_SAMPLE_DATA_URL' )    || define( 'SLZCORE_SAMPLE_DATA_URL', SLZCORE_URI . '/sample-data/' );