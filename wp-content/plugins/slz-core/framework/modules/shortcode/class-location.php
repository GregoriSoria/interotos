<?php
Medicplus_Core::load_class( 'models.Custom_Post_Model' );
class Medicplus_Core_Location extends Medicplus_Core_Custom_Post_Model {
	private $post_type = 'medicplus_locate';
	private $post_taxonomy = 'medicplus_locate_cat';
	private $html_format;

	public function __construct() {
		$this->meta_attributes();
		$this->set_meta_attributes();
		$this->post_meta_prefix = $this->post_type . '_';
		$this->taxonomy_cat = $this->post_taxonomy;
	}

	public function meta_attributes() {
		$meta_atts = array(
			'position'			=> esc_html__('Position', 'slz-core'),
			'address'			=> esc_html__('Address', 'slz-core'),
			'address_icon'		=> esc_html__('Address Icon', 'slz-core'),
			'direction'			=> esc_html__('Direction', 'slz-core'),
			'direction_icon'	=> esc_html__('Direction Icon', 'slz-core'),
			'go_to_map'			=> esc_html__('Go To Map', 'slz-core'),
			'go_to_map_icon'	=> esc_html__('Go To Map Icon', 'slz-core'),
			'phone'				=> esc_html__('Phone', 'slz-core'),
			'features'			=> esc_html__('Features', 'slz-core'),
			'features_icon'		=> esc_html__('Features Icon', 'slz-core'),
		);
		$this->post_meta_atts = $meta_atts;
	}

	public function set_meta_attributes() {
		$meta_arr = array();
		$meta_label_arr = array();
		foreach( $this->post_meta_atts as $att => $name ){
			$key = $att;
			$meta_arr[$key] = '';
			$meta_label_arr[$key] = $name;
		}
		$this->post_meta_def = $meta_arr;
		$this->post_meta = $meta_arr;
		$this->post_meta_label = $meta_label_arr;
	}

	public function reset(){
		wp_reset_postdata();
	}

	public function init( $atts = array(), $query_args = array() ) {
		// set attributes
		$default_atts = array(
			'layout'				=> '',
			'method'          		=> '',
			'limit_post'			=> '-1',
			'offset_post'			=> '',
			'sort_by'              	=> 'post__in',
		);
		$atts = array_merge( $default_atts, $atts );

		if ( empty($atts['method']) && !empty($atts['location_list']) ) {
			$atts['post_id'] = $this->parse_list_to_array( 'location', $atts['location_list'] );
		}

		if( $atts['method'] == 'cat' ) {
			$atts['post_id'] = $this->parse_cat_slug_to_post_id(
										$this->taxonomy_cat,
										$atts['category_list'],
										$this->post_type
									);
		} elseif( $atts['method'] == 'location' ) {
			$atts['post_id'] = $this->parse_list_to_array( 'location', $atts['location_list'] );
		}

		$this->attributes = $atts;

		// query
		$default_args = array(
			'post_type' => $this->post_type,
		);
		$query_args = array_merge( $default_args, $query_args );
		// setting
		$this->setting( $query_args);
	}

	public function setting( $query_args ){
		if( !isset( $this->attributes['uniq_id'] ) ) {
			$this->attributes['uniq_id'] = $this->post_type . '-' .Medicplus_Core::make_id();
		}
		// query
		$this->query = $this->get_query( $query_args, $this->attributes );
		$this->post_count = 0;
		if( $this->query->have_posts() ) {
			$this->post_count = $this->query->post_count;
		}
		$custom_css = $this->add_custom_css();
		if( $custom_css ) {
			do_action( SLZCORE_ADD_INLINE_CSS, $custom_css );
		}
	}

	public function set_responsive_class( $atts = array() ) {
		$class = '';
		$column = $this->attributes['column'];
		$def = array(
			'1' => 'col-xs-12',
			'2' => 'col-sm-6',
			'3' => 'col-md-4 col-sm-6',
			'4' => 'col-lg-3 col-md-4 col-sm-6',
		);
		
		if( $column && isset($def[$column])) {
			return $this->attributes['responsive-class'] = $def[$column];
		} else {
			return $this->attributes['responsive-class'] = $def['2'];
		}
	}

	public function add_custom_css() {
		$css = '';
		/* Location List */
		if( !empty($this->attributes['color_title_group']) ) {
			$css .= sprintf('.%s.sc_location .location-header { color: %s;}',
								$this->attributes['uniq_id'], $this->attributes['color_title_group']
							);
		}
		if( !empty($this->attributes['color_title']) ) {
			$css .= sprintf('.%s.sc_location .location-address-with-border .location-text { color: %s;}',
								$this->attributes['uniq_id'], $this->attributes['color_title']
							);
		}
		if( !empty($this->attributes['color_bg_title']) ) {
			$css .= sprintf('.%s.sc_location .location-address-with-border .location-text { background-color: %s;}',
								$this->attributes['uniq_id'], $this->attributes['color_bg_title']
							);
		}
		if( !empty($this->attributes['color_text']) ) {
			$css .= sprintf('.%1$s.sc_location .location-info-with-icon, .%1$s.sc_location .description, .%1$s.sc_location .list-location-info .location-info-with-icon { color: %2$s;}',
								$this->attributes['uniq_id'], $this->attributes['color_text']
							);
		}
		if( !empty($this->attributes['color_phone']) ) {
			$css .= sprintf('.%1$s.sc_location .location-tele-info { color: %2$s;}',
								$this->attributes['uniq_id'], $this->attributes['color_phone']
							);
		}
		if( !empty($this->attributes['style']) && $this->attributes['style'] == 2 && !empty($this->attributes['color_border']) ) {
			$css .= sprintf('.%1$s.sc_location .location-address-with-border { border-color: %2$s;}',
								$this->attributes['uniq_id'], $this->attributes['color_border']
							);
		}
		if( !empty($this->attributes['color_icon']) ) {
			$css .= sprintf('.%1$s.sc_location .location-info-with-icon i { color: %2$s;}',
								$this->attributes['uniq_id'], $this->attributes['color_icon']
							);
		}
		if( !empty($this->attributes['color_link']) ) {
			$css .= sprintf('.%1$s.sc_location .location-info-with-icon .location-link { color: %2$s;}',
								$this->attributes['uniq_id'], $this->attributes['color_link']
							);
		}
		if( !empty($this->attributes['color_link_hv']) ) {
			$css .= sprintf('.%1$s.sc_location .location-info-with-icon .location-link:hover { color: %2$s;}',
								$this->attributes['uniq_id'], $this->attributes['color_link_hv']
							);
		}
		if( !empty($this->attributes['color_bg_phonebox']) ) {
			$css .= sprintf('.%1$s.sc_location .location-address-with-highlight { background-color: %2$s;}',
								$this->attributes['uniq_id'], $this->attributes['color_bg_phonebox']
							);
		}
		return $css;
	}

	/****************/
	/**** RENDER HTML ****/
	/****************/
	public function render_location_sc( $html_options = array(), $query = array() ) {
		$output = '';

		if ( !empty($query['category_slug']) ) {
			$default_args = array(
				'post_type' => $this->post_type,
			);
			$this->attributes['post_id'] = '';
			$this->attributes['category_slug'] = $query['category_slug'];
			$this->query = $this->get_query( $default_args, $this->attributes );
		}

		$this->html_format = $this->set_default_options( $html_options );
		if( $this->query->have_posts() ) {
			while ( $this->query->have_posts() ) {
				$this->query->the_post();
				$this->loop_index();

				$addressContent = $addressAttr = '';
				$address = $this->get_meta_address();
				if ( !empty($address) ) {
					$address_icon = $this->get_meta_address_icon();
					if ( empty($address_icon) ) {
						$address_icon = 'fa-map-marker';
					}
					$addressContent = sprintf( '<div class="location-info-with-icon get_map_address" data-address="%1$s"><i class="fa fa-fw %2$s"></i>%1$s</div>', esc_html( $address ), esc_attr( $address_icon ) );
					$addressAttr = sprintf( 'data-address="%1$s"', esc_attr( $address ) );
				}

				$positionLatAttr = $positionLngAttr = '';
				$position = $this->get_meta_position();
				if ( !empty($position) ) {
					$position = explode(',', $position);
					$positionLatAttr = sprintf( 'data-position-lat="%1$s"', esc_attr( $position[0] ) );
					$positionLngAttr = sprintf( 'data-position-lng="%1$s"', esc_attr( $position[1] ) );
				}

				$goToMapContent = '';
				$is_marker_map = $this->attributes['is_marker_map'];
				if ( !empty($address) && !empty($is_marker_map) && $is_marker_map == 'yes' ) {
					$goToMap = $this->get_meta_gotomap();
					if ( empty($goToMap) ) {
						$goToMap = esc_html__( 'Go to map', 'slz-core' );
					}
					$goToMap_icon = $this->get_meta_gotomap_icon();
					if ( empty($goToMap_icon) ) {
						$goToMap_icon = 'fa-location-arrow';
					}
					$goToMapContent = sprintf( '<div class="location-info-with-icon hide marker_%3$s"><i class="fa fa-fw %2$s"></i><a href="javascript:void(0);" class="location-link get_location">%1$s</a></div>', esc_html( $goToMap ), esc_attr( $goToMap_icon ), esc_attr( $this->post_id ) );
				}

				$directionContent = '';
				$is_direction = $this->attributes['is_direction'];
				if ( !empty($address) && !empty($is_direction) && $is_direction == 'yes' ) {
					$direction = $this->get_meta_direction();
					if ( empty($direction) ) {
						$direction = esc_html__( 'Direction', 'slz-core' );
					}
					$direction_icon = $this->get_meta_direction_icon();
					if ( empty($direction_icon) ) {
						$direction_icon = 'fa-map-signs';
					}
					$directionContent = sprintf( '<div class="location-info-with-icon hide marker_%3$s"><i class="fa fa-fw %2$s"></i><a href="javascript:void(0);" class="location-link get_direction">%1$s</a></div>', esc_html( $direction ), esc_attr( $direction_icon ) , esc_attr( $this->post_id ) );
				}
				$postIDAttr = sprintf( 'data-item-id="%1$s"', esc_attr( $this->post_id ) );

				$output .= sprintf( $html_options['html_format'],
					$this->get_title(),
					$addressContent,
					$goToMapContent,
					$directionContent,
					$this->get_meta_phone(),
					$this->get_meta_feature(),
					$this->get_content(),
					$this->set_responsive_class(),
					$postIDAttr,
					$addressAttr,
					$positionLatAttr,
					$positionLngAttr
				);
			}
			$this->reset();
		}
		return $output;
	}

	public function render_location_cat_sc( $html_format = '' ) {
		$render_location_sc = $output = $title_cat = $classStyle_1 = '';

		$style = $this->attributes['style'];
		if ( $style == 1 ) {
			$classStyle_1 = 'location-address-no-border-inner';
		}
		$wrapperOpen = '<div class="location-wrapper '.esc_attr( $classStyle_1 ).'">';
		$format_title_cat = '<h3 class="location-header">%1$s</h3>';
		$rowOpen = '<div class="row">';
		$wrapperClose = '</div></div><div class="clearfix"></div>';

		$method = $this->attributes['method'];
		$category_slug = $this->attributes['category_slug'];
		$location_list = $this->attributes['location_list'];
		$title_group = $this->attributes['title_group'];

		if ( !empty($method) ) {
			if ( $method == 'location' && !empty($title_group) ) {
				$title_cat = sprintf( $format_title_cat, esc_html($title_group) );
				$render_location_sc = $this->render_location_sc( array('html_format' => $html_format) );
				$output = sprintf( '%1$s %2$s %3$s %4$s %5$s', $wrapperOpen, $title_cat, $rowOpen, $render_location_sc, $wrapperClose );
			} elseif ( $method == 'cat' && !empty($category_slug) ) {
				foreach ($category_slug as $cat) {
					$get_term_by_slug = get_term_by( 'slug', $cat, $this->taxonomy_cat, 'object' );
					$title_cat = sprintf( $format_title_cat, esc_html($get_term_by_slug->name) );
					$render_location_sc = $this->render_location_sc( array('html_format' => $html_format), array('category_slug' => $cat) );
					$output .= sprintf( '%1$s %2$s %3$s %4$s %5$s', $wrapperOpen, $title_cat, $rowOpen, $render_location_sc, $wrapperClose );
				}
			} else {
				$render_location_sc = $this->render_location_sc( array('html_format' => $html_format) );
				$output = sprintf( '%1$s %2$s %3$s %4$s', $wrapperOpen, $rowOpen, $render_location_sc, $wrapperClose );
			}
		}
		echo $output;
	}

	public function list_location_map_sc() {
		$output = array();

		if( $this->query->have_posts() ) {
			while ( $this->query->have_posts() ) {
				$this->query->the_post();
				$this->loop_index();

				$positionLat = $positionLng = '';
				$position = $this->get_meta_position();
				if ( !empty($position) ) {
					$position = explode(',', $position);
					$positionLat = esc_attr( $position[0] );
					$positionLng = esc_attr( $position[1] );
				}

				$output[] = array(
					$this->get_meta_address(),
					$this->get_title(),
					$this->get_meta_phone(),
					$this->post_id,
					$positionLat,
					$positionLng
				);
			}
			$this->reset();
		}
		return json_encode($output);
	}
	/*******************/
	/* FUNCTION CUSTOM */
	/*******************/

	public function get_current_category() {
		$term = $this->get_current_taxonomy( $this->taxonomy_cat );
		$format = $this->html_format['category_format'];
		
		$out = '';
		if( $term ) {
			$out = sprintf( $format, esc_html( $term['name'] ) );
		}
		return $out;
	}

	public function get_meta_position($object = false) {
		$out = $this->post_meta['position'];
		if ($object) {
			$out = explode(',', $out);
			$out = json_encode($out);
		}
		if( empty( $out ) ) {
			return '';
		}
		return $out;
	}

	public function get_meta_address() {
		$out = $this->post_meta['address'];
		if( empty( $out ) ) {
			return '';
		}
		return $out;
	}

	public function get_meta_address_icon() {
		$out = $this->post_meta['address_icon'];
		if( empty( $out ) ) {
			return '';
		}
		return $out;
	}

	public function get_meta_gotomap() {
		$out = $this->post_meta['go_to_map'];
		if( empty( $out ) ) {
			return '';
		}
		return $out;
	}

	public function get_meta_gotomap_icon() {
		$out = $this->post_meta['go_to_map_icon'];
		if( empty( $out ) ) {
			return '';
		}
		return $out;
	}

	public function get_meta_direction() {
		$out = $this->post_meta['direction'];
		if( empty( $out ) ) {
			return '';
		}
		return $out;
	}

	public function get_meta_direction_icon() {
		$out = $this->post_meta['direction_icon'];
		if( empty( $out ) ) {
			return '';
		}
		return $out;
	}

	public function get_meta_phone() {
		$out = $this->post_meta['phone'];
		if( empty( $out ) ) {
			return '';
		}
		return $out;
	}

	public function get_meta_feature() {
		$out = $format = '';
		$format = $this->html_format['feature_list_format'];
		$features = $this->post_meta['features'];
		$features_icon = $this->post_meta['features_icon'];

		if( $features ) {
			$features = array_filter($features);
			foreach ($features as $key => $feature) {
				$out.= sprintf( $format, esc_html( $feature ), esc_attr( $features_icon[$key] ) );
			}
		}

		return $out;
	}

	public function set_default_options( $html_options = array() ) {
		$defaults = array(
			'feature_list_format'		=> '<li class="location-info-with-icon"><i class="fa fa-fw %2$s"></i>%1$s</li>'
		);
		$html_options = array_merge( $defaults, $html_options );
		return $html_options;
	}
}