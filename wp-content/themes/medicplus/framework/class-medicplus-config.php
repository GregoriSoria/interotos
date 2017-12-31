<?php
/**
 * Medicplus config class.
 * 
 * @author Swlabs
 * @package MedicPlus
 * @since 1.0
 */
class Medicplus_Config {
	private static $setting = array(
		'save_post' => array(
			'page'     => array( 'theme.Theme_Init', 'save_page' ),
			'post'     => array( 'theme.Theme_Init', 'save_post' ),
			'product'  => array( 'theme.Theme_Init', 'save_product' ),
		),
		'page_options' => array(
			'post_types' => array( 'post', 'page', 'medicplus_dept', 'medicplus_service', 'medicplus_team', 'product' ),
		),
		'mapping' => array(
			'special_options' => array(
				'header_layout', 'header_top_show', 'header_logo_show', 'header_sticky_enable',
				'footer_show', 'footer_bt_main_show', 'footer_bottom_show', 'footer_contact_show', 'footer_contact_map_show',
				'page_title_show', 'breadcrumb_show', 'title_show'
			),
			'no-default-options' => array( 'no_default' ),
			'options' => array(
				'header' => array(
					'header_layout'              => 'slz-header-layout',
					'header_sticky_enable'       => 'slz-sticky',
				),
				'general' => array(
					'background_transparent'   => array( 'slz-layout-boxed-bg', 'background-color' ),
					'background_color'         => array( 'slz-layout-boxed-bg', 'background-color' ),
					'background_repeat'        => array( 'slz-layout-boxed-bg', 'background-repeat' ),
					'background_attachment'    => array( 'slz-layout-boxed-bg', 'background-attachment' ),
					'background_position'      => array( 'slz-layout-boxed-bg', 'background-position' ),
					'background_size'          => array( 'slz-layout-boxed-bg', 'background-size' ),
					'background_image'         => array( 'slz-layout-boxed-bg', 'background-image' ),
					'background_image_id'      => array( 'slz-layout-boxed-bg', 'media', 'id' ),
				),
				'page_title' => array(
					'page_title_show'         => 'slz-page-title-show',
					'breadcrumb_show'         => 'slz-show-breadcrumb',
					'title_show'              => 'slz-show-title',
					'page_title_type_display' => '',
					'title_custom_content'    => '',
					'title_color'             => array( 'slz-pagetitle-title', 'color' ),
					'breadcrumb_text_color'   => array( 'slz-breadcrumb-path2', 'color' ),
					'breadcrumb_color'        => array( 'slz-breadcrumb-path', 'color' ),
					'pt_background_color'     => array( 'slz-page-title-bg', 'background-color' ),
					'pt_background_repeat'    => array( 'slz-page-title-bg', 'background-repeat' ),
					'pt_background_attachment' => array( 'slz-page-title-bg', 'background-attachment' ),
					'pt_background_position'   => array( 'slz-page-title-bg', 'background-position' ),
					'pt_background_size'       => array( 'slz-page-title-bg', 'background-size' ),
					'pt_background_image'      => array( 'slz-page-title-bg', 'background-image' ),
					'pt_background_image_id'   => array( 'slz-page-title-bg', 'media', 'id' ),
					'pt_height'                => array( 'slz-page-title-height', 'height' ),
				),
				'footer' => array(
					'footer_show'             => 'slz-footer',
					'footer_style'            => 'slz-footer-style',
					'footer_bt_main_show'     => 'slz-footerbt-main-info',
					'footer_bottom_show'      => 'slz-footerbt-show',
					'footer_contact_show'     => 'slz-footerbt-contact-info',
					'footer_contact_map_show' => 'slz-footerbt-map-info',
				),
				'sidebar' => array(
					'sidebar_layout'            => 'slz-sidebar-layout',
					'sidebar_id'                => 'slz-sidebar',
					'sidebar_post_layout'       => 'slz-blog-sidebar-layout',
					'sidebar_post_id'           => 'slz-blog-sidebar',
					'sidebar_department_layout' => 'slz-department-sidebar-layout',
					'sidebar_department_id'     => 'slz-department-sidebar',
					'sidebar_service_layout'    => 'slz-service-sidebar-layout',
					'sidebar_service_id'        => 'slz-service-sidebar',
					'sidebar_shop_layout'       => 'slz-shop-sidebar-layout',
					'sidebar_shop_id'           => 'slz-shop-sidebar',
				),
				'no_default' => array(
					'body_extra_class'         => 'slz-body-extra-class',
					'ct_padding_top'           => 'slz-content-padding-top',
					'ct_padding_bottom'        => 'slz-content-padding-bottom',
					'show_page_contact'        => 'slz-contact-section-1',
					'slider-header-fixed'      => 'slz-header-hide',
					'sc_appointment'           => 'slz-sc-appointment',
				),
			),
		),
		
		'image_sizes' => array(
			'medicplus-thumb-300x200'  => array( 'width' => 300,  'height' => 200 ), // testimonial
			'medicplus-thumb-555x392'  => array( 'width' => 555,  'height' => 392 ), // department
			'medicplus-thumb-650x382'  => array( 'width' => 650,  'height' => 382 ), // department gallery, gallery
			'medicplus-thumb-450x600'  => array( 'width' => 450,  'height' => 600 ), // team large
			'medicplus-thumb-200x280'  => array( 'width' => 200,  'height' => 280 ), // team small
			'medicplus-thumb-750x500'  => array( 'width' => 750,  'height' => 500 ), // detail, service gallery
			'medicplus-thumb-100x69'   => array( 'width' => 100,  'height' => 69 ),  // widget
			'medicplus-thumb-1200x750' => array( 'width' => 1200, 'height' =>750 ), // post-thumbnail
			'medicplus-thumb-165x116'  => array( 'width' => 165,  'height' =>116 ), // image-list
			'medicplus-thumb-175x181'  => array( 'width' => 175,  'height' =>181 ), // image-box
			'medicplus-thumb-310x235'  => array( 'width' => 310,  'height' =>235 ), // image-box
		),
	);
	public static function theme_options_init() {
		$params = array(
			// default theme options
			'slz-page-title-show'     => '1',
			'slz-show-title'          => '1',
			'slz-show-breadcrumb'     => '1',
			'slz-footer'              => '1',
			'slz-footerbt-show'       => '1',
			'slz-footerbt-text'       => esc_html__('&copy; 2016 BY SWLABS. ALL RIGHT RESERVE.', 'medicplus' ),
			'slz-sidebar-layout'      => 'left',
			'slz-blog-sidebar-layout' => 'right',
			'slz-404-title'           => esc_html__('Page not found', 'medicplus' ),
			'slz-404-desc'            => esc_html__('Please go back to home and try to find out once again.', 'medicplus' ),
			'slz-404-backhome'        => esc_html__('Go Back', 'medicplus' ),
			'slz-404-button-02'       => esc_html__('Get Help', 'medicplus' ),
		);
		return $params;
	}
	/**
	 * Retrieve value from the config variable.
	 *
	 * @param string $name The key name of first level.
	 * @param string $field optional The key name of second level.
	 * @return mixed.
	 */
	public static function get( $name, $field = NULL ) {
		if( isset( self::$setting[ $name ] ) ) {
			if( $field ) {
				return ( isset( self::$setting[ $name ][ $field ] ) ) ? self::$setting[ $name ][ $field ] : null;
			} else {
				return self::$setting[ $name ];
			}
		}
		
		return array();
	}
}