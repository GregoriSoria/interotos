<?php
if ( file_exists( MEDICPLUS_EXTERNAL_DIR . '/class-tgm-plugin-activation.php' ) ) {

	// include file
	require_once MEDICPLUS_EXTERNAL_DIR . '/class-tgm-plugin-activation.php';

	// hook function
	add_action('tgmpa_register', 'medicplus_register_required_plugins');
	function medicplus_register_required_plugins () {
		// Required keys are name and slug.
		$plugins = array(
			array(
				'name'					=> 'Slz Core',
				'slug'					=> 'slz-core',
				'source'				=> MEDICPLUS_PLUGINS_DIR . '/slz-core.zip',
				'required'				=> true,
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'image_url'				=> MEDICPLUS_PLUGIN_IMG_URI . '/slz_core.png',
			),
			// Redux Framework
			array(
				'name'					=> 'Redux Framework',
				'slug'					=> 'redux-framework',
				'required'				=> true,
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'image_url'				=> MEDICPLUS_PLUGIN_IMG_URI . '/redux-framework.jpg',
			),
			// Include Visual Composer plugin.
			array(
				'name'					=> 'WPBakery Visual Composer',
				'slug'					=> 'js_composer',
				'source'				=> MEDICPLUS_PLUGINS_DIR . '/js_composer.zip',
				'required'				=> true,
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'image_url'				=> MEDICPLUS_PLUGIN_IMG_URI . '/js_composer.jpg',
			),
			// Include Revolution plugin.
			array(
				'name'					=> 'Revolution Slider',
				'slug'					=> 'revslider',
				'source'				=> MEDICPLUS_PLUGINS_DIR . '/revslider.zip',
				'required'				=> true,
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'image_url'				=> MEDICPLUS_PLUGIN_IMG_URI . '/revslider.jpg',
			),
			// Include Contact Form 7 plugin.
			array(
				'name'					=> 'Contact Form 7',
				'slug'					=> 'contact-form-7',
				'required'				=> true,
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'image_url'				=> MEDICPLUS_PLUGIN_IMG_URI . '/contact_form_7.jpg',
			),
			// Include Contact Form 7 - Dynamic Text Extension plugin.
			array(
				'name'					=> 'Contact Form 7 - Dynamic Text Extension',
				'slug'					=> 'contact-form-7-dynamic-text-extension',
				'required'				=> true,
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'image_url'				=> MEDICPLUS_PLUGIN_IMG_URI . '/cf7_dynamic_text_extension.jpg',
			),
			// Include Contact Form 7 - Really Simple CAPTCHA.
			array(
				'name'					=> 'Contact Form 7 - Really Simple CAPTCHA',
				'slug'					=> 'really-simple-captcha',
				'required'				=> true,
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'image_url'				=> MEDICPLUS_PLUGIN_IMG_URI . '/cf7_really-simple-captcha.jpg',
			),
			
			// WP User Avatar
			array(
				'name'					=> 'WP User Avatar',
				'slug'					=> 'wp-user-avatar',
				'required'				=> false,
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'image_url'				=> MEDICPLUS_PLUGIN_IMG_URI . '/user_avatar.jpg',
			),
			// Include WooCommerce plugin.
			array(
				'name'					=> 'WooCommerce',
				'slug'					=> 'woocommerce',
				'required'				=> false,
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'image_url'				=> MEDICPLUS_PLUGIN_IMG_URI . '/woocommerce.png',
			),
			// Include YITH WooCommerce Zoom Magnifier plugin
			array(
				'name'					=> 'YITH WooCommerce Zoom Magnifier',
				'slug'					=> 'yith-woocommerce-zoom-magnifier',
				'required'				=> false,
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'image_url'				=> MEDICPLUS_PLUGIN_IMG_URI . '/yith_magnifier.jpg',
			),
			// Include YITH WooCommerce Wishlist plugin
			array(
				'name'					=> 'YITH WooCommerce Wishlist',
				'slug'					=> 'yith-woocommerce-wishlist',
				'required'				=> false,
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'image_url'				=> MEDICPLUS_PLUGIN_IMG_URI . '/yith_woo_wishlist.jpg',
			),
		);
		/**
		 * Array of configuration settings. Amend each line as needed.
		 * If you want the default strings to be available under your own theme domain,
		 * leave the strings uncommented.
		 * Some of the strings are added into a sprintf, so see the comments at the
		 * end of each line for what each argument will be.
		*/
		$config = array(
			'id'               => 'tgmpa',
			'domain'           => 'medicplus',
			'default_path'     => '',
			'parent_slug'      => 'themes.php',
			'menu'             => 'tgmpa-install-plugins',
			'has_notices'      => true,
			'is_automatic'     => true, // Automatically activate plugins after installation or not
			'message'          => '',
			'strings'          => array(
				'page_title'                       => esc_html__('Install Required Plugins', 'medicplus'),
				'menu_title'                       => esc_html__('Install Plugins', 'medicplus'),
				'installing'                       => esc_html__('Installing Plugin: %s', 'medicplus'), // %1$s = plugin name
				'oops'                             => esc_html__('Something went wrong with the plugin API.', 'medicplus'),
				'notice_can_install_required'      => _n_noop('This theme requires the following plugin installed or update: %1$s.', 'This theme requires the following plugins installed or updated: %1$s.', 'medicplus' ), // %1$s = plugin name(s)
				'notice_can_install_recommended'   => _n_noop('This theme recommends the following plugin installed or updated: %1$s.', 'This theme recommends the following plugins installed or updated: %1$s.', 'medicplus' ), // %1$s = plugin name(s)
				'notice_cannot_install'            => _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'medicplus' ), // %1$s = plugin name(s)
				'notice_can_activate_required'     => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'medicplus' ), // %1$s = plugin name(s)
				'notice_can_activate_recommended'  => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'medicplus' ), // %1$s = plugin name(s)
				'notice_cannot_activate'           => _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'medicplus' ), // %1$s = plugin name(s)
				'notice_ask_to_update'             => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'medicplus' ), // %1$s = plugin name(s)
				'notice_cannot_update'             => _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'medicplus' ), // %1$s = plugin name(s)
				'install_link'                     => _n_noop('Begin installing plugin', 'Begin installing plugins', 'medicplus' ),
				'activate_link'                    => _n_noop('Activate installed plugin', 'Activate installed plugins', 'medicplus' ),
				'return'                           => esc_html__('Return to Required Plugins Installer', 'medicplus'),
				'plugin_activated'                 => esc_html__('Plugin activated successfully.', 'medicplus'),
				'complete'                         => esc_html__('All plugins installed and activated successfully. %s', 'medicplus'), // %1$s = dashboard link
				'nag_type'                         => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
			)
		);
		tgmpa($plugins, $config);
	}
}