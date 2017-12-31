<?php

// Add custom type
if( function_exists("vc_add_shortcode_param") ) {
	/*
	 * Dropdown multiple
	 * 
	 * Using: array(
				"type" => "slz_dropdownmultiple",
				"class" => "",
				"heading" => esc_html__("Services", 'slz-core'),
				"param_name" => "services",
				"value" => $categories
		),
	 */
	vc_add_shortcode_param( 'slz_dropdownmultiple' , 'medicplus_core_dropdownmultiple_settings_field' );
	function medicplus_core_dropdownmultiple_settings_field( $settings, $value ) {
		$dependency = vc_generate_dependencies_attributes( $settings );
		$value = explode( ",", $value );
		$output = '<select name="' . esc_attr( $settings['param_name'] ).'" class="wpb_vc_param_value wpb-input wpb-select ' .
					esc_attr( $settings['param_name'] ) . ' ' .
					esc_attr( $settings['type'] ) . '"' . $dependency . ' multiple>';
		foreach( $settings['value'] as $text_val => $val ) {
			if( is_numeric($text_val) && is_string($val) || is_numeric($text_val) && is_numeric($val) ) {
				$text_val = $val;
			}
			$selected = '';
			if ( in_array( $val, $value ) ) {
				$selected = ' selected="selected" ';
			}
			$output .= '<option class="' . $val. '" value="' . $val . '"' . $selected . '>' . $text_val . '</option>';
		}
		$output .= '</select>';
		return $output;
	}

	//hidden
	vc_add_shortcode_param( 'slz_hidden', 'medicplus_core_hidden_settings_field' );
	function medicplus_core_hidden_settings_field( $settings, $value ) {
		$dependency = vc_generate_dependencies_attributes( $settings );
		$output = '<input name="' . $settings['param_name'] . '" ';
		$output .= 'class="wpb_vc_param_value wpb-textinput ' . $settings['param_name'] . ' ' . $settings['type'].'_field" ';
		$output .= 'type="hidden" value="' . $value . '" ' . $dependency . '/>';
		return $output;
	}

	// date time picker
	vc_add_shortcode_param( 'slz_datetime_picker' , 'medicplus_core_datetime_picker_field' , SLZCORE_ASSET_URI . '/js/medicplus-core-datetimepicker.js');
	
	function medicplus_core_datetime_picker_field( $settings, $value ) {
		$dependency = vc_generate_dependencies_attributes( $settings );
		$output = '<input name="' . $settings['param_name'] . '" ';
		$output .= 'class="wpb_vc_param_value wpb-textinput ' . $settings['param_name'] . ' ' . $settings['type'].'_field" ';
		$output .= 'type="text" value="' . $value . '" ' . $dependency . ' id="datetimepicker"/>';
		return $output;
	}
}

if( SLZCORE_VC_ACTIVE ) {
	// Map Shortcodes
	// =============================================================================
	if( ! function_exists( 'medicplus_core_vc_map_shortcodes' ) ) {
		function medicplus_core_vc_map_shortcodes() {
			$list_shortcodes = Medicplus_Core_Config::get( 'shortcode' );
			foreach( $list_shortcodes as $shortcode => $func ) {
				$sc_file = SLZCORE_SHORTCODE_DIR . '/inc/' . $func . '.php';
				if( file_exists( $sc_file ) ) {
					require_once( $sc_file );
				}
			}
		}
	}
	add_action('vc_before_init', 'medicplus_core_vc_map_shortcodes');
}

//Add Shortcode
// =============================================================================
if( ! function_exists( 'medicplus_core_add_shortcodes' ) ) {
	function medicplus_core_add_shortcodes() {
		$list_shortcodes = Medicplus_Core_Config::get( 'shortcode' );
		foreach( $list_shortcodes as $shortcode => $func ) {
			if ( ! SLZCORE_WOOCOMMERCE_ACTIVE && in_array( $func, array( 'product_tab', 'product_slide', 'product_category_tab', 'product_countdown' ) ) ) {
				continue;
			}
			add_shortcode( $shortcode, array( 'Medicplus_Core', '[shortcode.Shortcode_Controller, ' . $func . ']' ) );
		}
	}
}
add_action('init', 'medicplus_core_add_shortcodes');