<?php
// Load Redux extensions - MUST be loaded before your options are set
if ( MEDICPLUS_REDUX_ACTIVE && MEDICPLUS_CORE_IS_ACTIVE && file_exists( MEDICPLUS_THEME_CORE_URI.'/extensions/extensions-init.php')) {
	require_once MEDICPLUS_THEME_CORE_URI.'/extensions/extensions-init.php';
}

// Load the theme/plugin options
if ( MEDICPLUS_REDUX_ACTIVE && MEDICPLUS_CORE_IS_ACTIVE && file_exists( MEDICPLUS_THEME_DIR.'/admin/options-init.php')) {
	require_once MEDICPLUS_THEME_DIR.'/admin/options-init.php';
}