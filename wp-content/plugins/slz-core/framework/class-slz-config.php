<?php
/**
 * Core config class.
 * 
 * @author Swlabs
 * @package MedicPlus
 * @since 1.0
 */
class Medicplus_Core_Config {
	private static $setting = array(
		'save_post' => array(
			'medicplus_appoint'  => array( 'posttype.Appointment_Controller', 'save' ),
			'medicplus_service'  => array( 'posttype.Service_Controller', 'save' ),
			'medicplus_dept'     => array( 'posttype.Department_Controller', 'save' ),
			'medicplus_team'     => array( 'posttype.Team_Controller', 'save' ),
			'medicplus_testi'    => array( 'posttype.Testimonial_Controller', 'save' ),
			'medicplus_gallery'  => array( 'posttype.Gallery_Controller', 'save' ),
			'medicplus_locate'   => array( 'posttype.Location_Controller', 'save' ),
			'post'                  => array( 'posttype.Post_Controller', 'save' ),
		),
		'shortcode' => array(
			'slzcore_appointment_sc'    => 'appointment',
			'slzcore_banner_sc'         => 'banner',
			'slzcore_block_title_sc'    => 'block_title',
			'slzcore_button_sc'         => 'button',
			'slzcore_carousel_sc'       => 'carousel',
			'slzcore_contact_sc'        => 'contact',
			'slzcore_count_down_sc'     => 'count_down',
			'slzcore_department_sc'     => 'department',
			'slzcore_faqs_sc'           => 'faqs',
			'slzcore_feature_item_sc'   => 'feature_item',
			'slzcore_gallery_sc'        => 'gallery',
			'slzcore_icon_box_sc'       => 'icon_box',
			'slzcore_image_box_sc'      => 'image_box',
			'slzcore_image_list_sc'     => 'image_list',
			'slzcore_item_list_sc'      => 'item_list',
			'slzcore_location_sc'       => 'location',
			'slzcore_location_map_sc'   => 'location_map',
			'slzcore_number_factor_sc'  => 'number_factor',
			'slzcore_news_block_sc'     => 'news_block',
			'slzcore_news_carousel_sc'  => 'news_carousel',
			'slzcore_news_grid_sc'      => 'news_grid',
			'slzcore_service_sc'        => 'service',
			'slzcore_team_carousel_sc'  => 'team_carousel',
			'slzcore_team_grid_sc'      => 'team_grid',
			'slzcore_team_simple_sc'    => 'team_simple',
			'slzcore_testimonial_sc'    => 'testimonial',
			'slzcore_toggle_box_sc'     => 'toggle_box',
			'slzcore_video_sc'          => 'video',
		),
		'post_type' => array(
			'custom_column' => array( 
				'medicplus_appoint',
				'medicplus_service',
				'medicplus_dept',
				'medicplus_team',
				'medicplus_faq',
				'medicplus_testi',
				'medicplus_gallery',
				'medicplus_locate',
				),
			'feature_video' => array( 'post' ),
		)
	);
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