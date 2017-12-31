<?php
Medicplus::load_class( 'Abstract' );
class Medicplus_Theme_Controller extends Medicplus_Abstract {
	/**
	 * Add menu page
	 *
	 */
	public function call_tgm_plugin_action(){
		if( isset( $_GET['slz-deactivate'] ) && $_GET['slz-deactivate'] == 'deactivate-plugin' ) {
			check_admin_referer( 'slz-deactivate', 'slz-nonce' );
	
			$plugins = TGM_Plugin_Activation::$instance->plugins;
	
			foreach( $plugins as $plugin ) {
				if( $plugin['slug'] == $_GET['plugin'] ) {
					deactivate_plugins( $plugin['file_path'] );
				}
			}
		} if( isset( $_GET['slz-activate'] ) && $_GET['slz-activate'] == 'activate-plugin' ) {
			check_admin_referer( 'slz-activate', 'slz-nonce' );
	
			$plugins = TGM_Plugin_Activation::$instance->plugins;
	
			foreach( $plugins as $plugin ) {
				if( $plugin['slug'] == $_GET['plugin'] ) {
					activate_plugin( $plugin['file_path'] );
				}
			}
		}
	}

	public function add_welcome(){
		$menu_slug = 'medicplus_welcome';
		$page_title = $menu_title = esc_html__( 'MedicPlus', 'medicplus' );
		$require_ptitle = esc_html__( 'Requirements & Recommendations', 'medicplus' );
		$plugin_ptitle  = esc_html__( 'Plugins', 'medicplus' );
		$icon_ptitle    = esc_html__( 'MedicPlus Icons', 'medicplus' );
		$log_ptitle     = esc_html__( 'Changes Log', 'medicplus' );
		$theme_ptitle   = esc_html__( 'Theme Options', 'medicplus' );
		$import_ptitle  = esc_html__( 'Install Demos', 'medicplus' );
		
		if( MEDICPLUS_CORE_IS_ACTIVE && function_exists( 'medicplus_core_add_menu_page' )) {
			medicplus_core_add_menu_page( $page_title, $menu_title, 'manage_options', $menu_slug, array(&$this, 'show_requirement_submenu'), '', 3);
			medicplus_core_add_submenu_page( $menu_slug, $require_ptitle, $require_ptitle, 'manage_options', 'medicplus_requirement', array(&$this, 'show_requirement_submenu') );
			medicplus_core_add_submenu_page( $menu_slug, $plugin_ptitle, $plugin_ptitle, 'manage_options', 'medicplus_plugin', array(&$this, 'show_plugin_submenu') );
			if(MEDICPLUS_CORE_IS_ACTIVE) {
				medicplus_core_add_submenu_page( $menu_slug, $icon_ptitle, $icon_ptitle, 'manage_options', 'medicplus_icon', array(&$this, 'show_icon_submenu') );
			}
			medicplus_core_add_submenu_page( $menu_slug, $log_ptitle, $log_ptitle, 'manage_options', 'medicplus_changelog', array(&$this, 'show_changelog_submenu') );
			if( MEDICPLUS_REDUX_ACTIVE ) {
				medicplus_core_add_submenu_page( $menu_slug, $theme_ptitle, $theme_ptitle, 'manage_options', "MedicPlus_options" );
			}
			if ( MEDICPLUS_CORE_IS_ACTIVE && class_exists('Medicplus_Core_DemoImporterPlugin')) {
				$plugin = new Medicplus_Core_DemoImporterPlugin;
				medicplus_core_add_submenu_page( $menu_slug, $import_ptitle, $import_ptitle, 'manage_options', 'medicplus_importer', array($plugin, 'form') );
			}
		} else {
			get_admin_page_title();
		}

		global $submenu; // this is a global from WordPress
		if( isset($submenu[$menu_slug]) ) {
			$submenu[$menu_slug][0][0] = esc_html__( 'Welcome', 'medicplus' );
		}
	}
	function plugin_link( $item ) {
		$menu_slug = 'medicplus_welcome';
		$return_url = 'medicplus_plugin';
		$installed_plugins = get_plugins();
	
		$item['sanitized_plugin'] = $item['name'];
	
		/** We need to display the 'Install' hover link */
		if ( ! isset( $installed_plugins[$item['file_path']] ) ) {
			$actions = array(
				'install' => sprintf(
						'<a href="%1$s" class="button button-primary" title="'.esc_html__( 'Install %2$s', 'medicplus' ).'">'.esc_html__( 'Install', 'medicplus' ).'</a>',
						wp_nonce_url(
								add_query_arg(
										array(
											'page'          => TGM_Plugin_Activation::$instance->menu,
											'plugin'        => $item['slug'],
											'plugin_name'   => $item['sanitized_plugin'],
											'plugin_source' => $item['source'],
											'tgmpa-install' => 'install-plugin',
											'tgmpa-nonce'   => wp_create_nonce( 'tgmpa-install' ),
											'return_url'    => $return_url
										),
										esc_url(admin_url( TGM_Plugin_Activation::$instance->parent_slug ))
								),
								'tgmpa-install'
						),
						$item['sanitized_plugin']
				),
			);
		}
		/** We need to display the 'Activate' hover link */
		elseif ( is_plugin_inactive( $item['file_path'] ) ) {
			$actions = array(
				'activate' => sprintf(
						'<a href="%1$s" class="button button-primary" title="'.esc_html__( 'Activate %2$s', 'medicplus' ).'">'.esc_html__( 'Activate', 'medicplus' ).'</a>',
						add_query_arg(
								array(
									'plugin'         => $item['slug'],
									'plugin_name'    => $item['sanitized_plugin'],
									'plugin_source'  => $item['source'],
									'slz-activate'   => 'activate-plugin',
									'slz-nonce'      => wp_create_nonce( 'slz-activate' ),
								),
								esc_url(admin_url( 'admin.php?page=' . $return_url))
						),
						$item['sanitized_plugin']
				),
			);
		}
		/** We need to display the 'Update' hover link */
		elseif ( version_compare( $installed_plugins[$item['file_path']]['Version'], $item['version'], '<' ) ) {
			$actions = array(
				'update' => sprintf(
						'<a href="%1$s" class="button button-primary" title="'.esc_html__( 'Update %2$s', 'medicplus' ).'">'.esc_html__( 'Update', 'medicplus' ).'</a>',
						wp_nonce_url(
								add_query_arg(
										array(
											'page'          => TGM_Plugin_Activation::$instance->menu,
											'plugin'        => $item['slug'],
											'plugin_name'   => $item['sanitized_plugin'],
											'plugin_source' => $item['source'],
											'tgmpa-update'  => 'update-plugin',
											'version'       => $item['version'],
											'tgmpa-nonce'   => wp_create_nonce( 'tgmpa-update' ),
											'return_url'    => $return_url
										),
										esc_url(admin_url( TGM_Plugin_Activation::$instance->parent_slug ))
								),
								'tgmpa-install'
						),
						$item['sanitized_plugin']
				),
			);
		} elseif ( is_plugin_active( $item['file_path'] ) ) {
			$actions = array(
				'deactivate' => sprintf(
						'<a href="%1$s" class="button button-primary" title="'.esc_html__( 'Deactivate %2$s', 'medicplus' ).'">'.esc_html__( 'Deactivate', 'medicplus' ).'</a>',
						add_query_arg(
								array(
									'plugin'         => $item['slug'],
									'plugin_name'    => $item['sanitized_plugin'],
									'plugin_source'  => $item['source'],
									'slz-deactivate' => 'deactivate-plugin',
									'slz-nonce'      => wp_create_nonce( 'slz-deactivate' ),
								),
								esc_url(admin_url( 'admin.php?page=' . $return_url ))
						),
						$item['sanitized_plugin']
				),
			);
		}
	
		return $actions;
	}
	/**
	 * let_to_num function.
	 *
	 * This function transforms the php.ini notation for numbers (like '2M') to an integer.
	 *
	 * @param $size
	 * @return int
	 */
	function let_to_num( $size ) {
		$l   = substr( $size, -1 );
		$ret = substr( $size, 0, -1 );
		switch ( strtoupper( $l ) ) {
			case 'P':
				$ret *= 1024;
			case 'T':
				$ret *= 1024;
			case 'G':
				$ret *= 1024;
			case 'M':
				$ret *= 1024;
			case 'K':
				$ret *= 1024;
		}
		return $ret;
	}
	function get_theme_header(){
		$this->render( 'theme-header');
	}
	function show_plugin_submenu(){
		$this->render( 'plugin');
	}
	
	function show_requirement_submenu(){
		$this->render( 'requirement');
	}
	
	function show_icon_submenu(){
		wp_enqueue_style( 'medicplus-font-medic',  MEDICPLUS_PUBLIC_URI . '/font/font-icon/font-medic/font-medic.css', array(), MEDICPLUS_THEME_VER );
		$this->render( 'icon');
	}
	
	function show_changelog_submenu(){
		$this->render( 'changelog');
	}
}