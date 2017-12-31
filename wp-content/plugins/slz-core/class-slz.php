<?php
/**
 * Medicplus_Core class.
 * 
 * @author Swlabs
 * @package Slz-Core
 * @since 1.0
 */
class Medicplus_Core {

	/**
	 * Load classes that store in framework directory
	 *
	 * @param string $class The class name to initialize.
	 * @param string $module optional Load the class in framework/modules directory.
	 * @return bool Whether or not the given class has been defined.
	 */
	public static function load_class( $class , $module = null ) {
		if( preg_match( '/^(?P<module>\w+)\.(?P<class>\w+)$/', $class, $matches ) ) {
			$class   = $matches['class'];
			$module  = $matches['module'];
		}

		if( !class_exists( $class ) ) {
			$path = SLZCORE_DIR . '/framework';
			$class_file = 'class-' . str_replace( '_', '-', strtolower( $class ) ) . '.php';

			if( ! empty( $module ) ) {
				$path .= "/modules/{$module}/";
			} else {
				$path .= '/includes/';
			}
			if( file_exists( $path . $class_file ) ) {
				require_once( $path . $class_file );
			}
		}

		return class_exists( 'Medicplus_Core_' . $class );
	}

	/**
	 * Creates a new class instance.
	 *
	 * @param string $class The class name.
	 * @param array $attr optional attributes assigned to the object after initialization.
	 * @return object.
	 */
	public static function new_object( $class, $attr = array() ) {
		static $o = array();

		$module  = NULL;
		if( preg_match( '/^(?P<module>\w+)\.(?P<class>\w+)$/', $class, $matches ) ) {
			$class   = $matches['class'];
			$module  = $matches['module'];
		}

		if( empty( $o[ $class ] ) ) {
			if ( self::load_class( $class, $module ) ) {
				$class_name = 'Medicplus_Core_' . $class;
				$o[ $class ] = new $class_name();

				if( ! empty($attr) ) {
					foreach( $attr as $key => $val ) {
						$o[ $class ]->{$key}	= $val;
					}
				}

			} else {
				exit( 'Can\'t not load class '.$class );
			}
		}

		return $o[ $class ];
	}

	/**
	 * Overwrite.
	 */
	public static function __callStatic( $name, $args ) {
		if( preg_match( '/^\[(?P<class>[a-zA-Z0-9\_\.]+)\,\ *(?P<method>\w+)\]$/', $name, $match ) ) {
			if( ! empty( $match[ 'class' ] ) && ! empty( $match[ 'method' ] ) ) {
				if( self::load_class ( $match[ 'class' ] ) ) {
					$obj = self::new_object( $match[ 'class' ] );
					return call_user_func_array( array( $obj, $match['method'] ), $args );
				}
			}
		}
	}

	/**
	 * Retrieve value from $_GET/$_POST.
	 *
	 * @param string $name Key.
	 * @param mixed $default_value The default value to return if no result is found.
	 * @return mixed.
	 */
	public static function get_request_param( $name, $default_value = null ) {
		return isset( $_GET[ $name ] ) ? $_GET[ $name ] : ( isset( $_POST[ $name ] ) ? $_POST[ $name ] : $default_value );
	}

	/**
	 * Get the default shortcode param values applied.
	 *
	 * @param  array  $args  Array with user set param values
	 * @return array  $defaults  Array with default param values
	 */
	public static function set_shortcode_defaults( $defaults, $args ) {
		if( ! $args ) {
			$args = array();
		}

		$args = shortcode_atts( $defaults, $args );

		return $args;
	}
	public static function set_meta_defaults( $defaults, $args ) {
		if( ! $args ) {
			$args = array();
		}
		$args = (array)$args;
		$out = array();
		foreach( $defaults as $name => $default) {
			if ( array_key_exists($name, $args) )
				$out[$name] = $args[$name];
			else
				$out[$name] = $default;
		}
	
		return $out;
	}
	/**
	 * Create unique id
	 * @return string
	 */
	public static function make_id() {
		return uniqid(rand());
	}
	
	public static function get_array_to_shortcode( $data ) {
		$result = array();
		foreach( $data as $key => $value ) {
			$result[$value] = $key;
		}
		return $result;
	}
	public static function is_empty( $value, $trim = false ) {
		return $value===null || $value===array() || $value==='' || $trim && is_scalar($value) && trim($value)==='';
	}
	public static function get_value( $obj, $field, $def = '' ) {
		if( isset( $obj[ $field ] ) && ! self::is_empty( $obj[ $field ] )) {
			return $obj[ $field ];
		}
		return $def;
	}
	public static function get_value_sc( $field, $def = '' ) {
		if( isset( $field ) && ! self::is_empty( $field  )) {
			return $field;
		}
		return $def;
	}
	public static function check_int( $number ) {
		if( !empty ( $number )){
			if ( preg_match('/^\d+$/', $number )){
				return true;
			}
			else{
				return false;
			}
		}
	}
	public static function parse_atts( $atts_string ) {
		$array = array();
		if( $atts_string ) {
			$array = json_decode( urldecode( $atts_string ), true );
		}
		return $array;
	}
	public static function set_link( $url, $title ) {
		$target = '_blank';
		if ( strpos( $url, $target ) ){
			$url = str_replace("_blank","",$url);
		}else{
			$target = '';
		}
		$data = array( 'url' => $url, 'title' => $title, 'target' => $target );
		$output = '<input name="url" class="wpb_slz_param_value  url slz-link_field" type="hidden" value="" data-json="'.htmlentities( json_encode( $data ), ENT_QUOTES, "utf-8" ).'">
					<a class="button slz-link-build url_button">Select URL</a>';
		return $output;
	}
	/**
	 * Get param from theme options.
	 *
	 * @param string $name
	 * @param string $field         Optional.
	 * @return string
	 */
	public static function get_theme_option( $name, $field = null ) {
		$theme_options = get_option(SLZCORE_THEME_PREFIX . '_options');
	
		if( $field ) {
			return ( isset( $theme_options[$name][$field] ) ) ? $theme_options[$name][$field] : '';
		}
		if( isset ($theme_options[$name] ) ) {
			return $theme_options[$name];
		}
		return '';
	}
	public static function get_theme_icons( $field ) {
		$defauls = array(
			'ontop'       => 'icon-house_1',
			'condition'   => 'fa-file-text-o',
			'description' => 'fa-comment-o',
			'location'    => 'fa-map-marker',
			'type'        => 'icon-house_1',
			'status'      => 'fa-align-justify',
			'price'       => 'fa-money',
			'area'        => 'fa-arrows-alt',
			'bedroom'     => 'icon-bed',
			'bathroom'    => 'icon-bath',
			'garage'      => 'icon-warehouse',
			'sc_area'     => 'icon-house_1',
			'sc_bedroom'  => 'icon-bed',
			'sc_bathroom' => 'icon-bath',
		);
		$mapping = array(
			'ontop'       => 'slz-icon-ontop',
			'condition'   => 'slz-icon-condition',
			'description' => 'slz-icon-description',
			'location'    => 'slz-icon-location',
			'type'        => 'slz-icon-type',
			'status'      => 'slz-icon-status',
			'price'       => 'slz-icon-price',
			'area'        => 'slz-icon-area',
			'bedroom'     => 'slz-icon-bedroom',
			'bathroom'    => 'slz-icon-bathroom',
			'garage'      => 'slz-icon-garage',
			'sc_area'     => 'slz-icon-sc-area',
			'sc_bedroom'  => 'slz-icon-sc-bedroom',
			'sc_bathroom' => 'slz-icon-sc-bathroom',
		);
		$val = Medicplus_Core::get_value( $defauls, $field );
		if( isset( $mapping[$field] ) ) {
			$val = self::get_theme_option($mapping[$field]);
		}
		if( strpos($val, 'fa-' ) !== FALSE ) {
			$val = 'fa ' . $val;
		}
		return $val;
	}
}