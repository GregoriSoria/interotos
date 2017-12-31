<?php
class Medicplus_Core_Service extends Medicplus_Core_Custom_Post_Model {

	private $post_type = 'medicplus_service';
	private $post_taxonomy = 'medicplus_service_cat';
	private $html_format;

	public function __construct() {
		$this->meta_attributes();
		$this->set_meta_attributes();
		$this->post_meta_prefix = $this->post_type . '_';
		$this->taxonomy_cat = $this->post_taxonomy;
		$this->html_format = $this->set_default_options();
	}
	public function meta_attributes() {
		$meta_atts = array( 
			'icon'             	=> esc_html__( 'Icon', 'slz-core' ),
			'gallery_image'    	=> esc_html__( 'Gallery Images', 'slz-core' ),
			'small_image'    	=> esc_html__( 'Small Images', 'slz-core' ),
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
	public function init( $atts = array(), $query_args = array() ) {
		// set attributes
		$default_atts = array(
			'style'      		=> '1',
			'column'      		=> '4',
			'limit_post'   		=> '-1',
			'offset_post'  		=> '0',
			'sort_by'      		=> '',
			'post_id'      		=> '',
			'color_icon'        => '',
			'color_background'  => '',
			'limit'       		=> '',
		);
		$atts = array_merge( $default_atts, $atts );

		if( $atts['method'] == 'cat' ) {
			$atts['post_id'] = $this->parse_cat_slug_to_post_id( 
										'medicplus_service_cat',
										$atts['category'],
										'medicplus_service'
									);
		} else {
			$atts['post_id'] = $this->parse_list_to_array( 'service', $atts['list_service'] );
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
		// image size
		// $this->get_thumb_size();
		$this->set_responsive_class();
		// add inline css
		$custom_css = $this->add_custom_css();
		if( $custom_css ) {
			do_action( SLZCORE_ADD_INLINE_CSS, $custom_css );
		}
	}
	public function reset(){
		wp_reset_postdata();
	}
	public function set_responsive_class( $atts = array() ) {
		$class = '';
		$column = $this->attributes['column'];
		$def = array(
			'1' => 'col-md-12',
			'2' => 'col-lg-6 col-md-6 col-xs-12',
			'3' => 'col-lg-4 col-md-4 col-sm-6 col-xs-12',
			'4' => 'col-lg-3 col-md-4 col-sm-6 col-xs-12',
		);;
		
		if( $column && isset($def[$column])) {
			$this->attributes['responsive-class'] = $def[$column];
		} else {
			$this->attributes['responsive-class'] = $def['4'];
		}
	}
	public function add_custom_css() {
		$css = '';
		if( !empty($this->attributes['color_title']) ) {
			$css .= sprintf('.%1$s .services-content .services-title, .%1$s .whatwedo-nutrition .nutrition-services-content .services-title { color: %2$s;}',
								$this->attributes['uniq_id'], $this->attributes['color_title']
							);
		}
		if( !empty($this->attributes['color_text']) ) {
			$css .= sprintf('.%1$s .services-content .description, .%1$s .whatwedo-nutrition .nutrition-services-content .description { color: %2$s;}',
								$this->attributes['uniq_id'], $this->attributes['color_text']
							);
		}
		if ( $this->attributes['style'] == '1' ) {
			if( !empty($this->attributes['color_icon']) ) {
				$css .= sprintf('.%s .services-content .btn-for-icon i.icon1 { color: %s;}',
									$this->attributes['uniq_id'], $this->attributes['color_icon']
								);	
				$css .= sprintf('.%s .services-content .btn-for-icon i.icon2 { background-color: %s;}',
									$this->attributes['uniq_id'], $this->attributes['color_icon']
								);	
			}
			if( !empty($this->attributes['color_line']) ) {
				$css .= sprintf('.%s .services-content .line { background-color: %s;}',
									$this->attributes['uniq_id'], $this->attributes['color_line']
								);
			}
			if( !empty($this->attributes['color_border']) ) {
				$css .= sprintf('.%s .services-content:before { border-color: %s;}',
									$this->attributes['uniq_id'], $this->attributes['color_border']
								);
			}
			if( !empty($this->attributes['color_title_hv']) ) {
				$css .= sprintf('.%s .services-content:hover .services-title { color: %s;}',
									$this->attributes['uniq_id'], $this->attributes['color_title_hv']
								);
			}
			if( !empty($this->attributes['color_text_hv']) ) {
				$css .= sprintf('.%s .services-content:hover .description { color: %s;}',
									$this->attributes['uniq_id'], $this->attributes['color_text_hv']
								);
			}
			if( !empty($this->attributes['color_background']) ) {	
				$css .= sprintf('.%s .services-content:after { background-color: %s;}',
									$this->attributes['uniq_id'], $this->attributes['color_background']
								);		
			}
		} elseif ( $this->attributes['style'] == '3' ) {
			if( !empty($this->attributes['color_readmore']) ) {
				$css .= sprintf('.%1$s .whatwedo-nutrition .nutrition-services-content .nutrition-btn { color: %2$s;}',
									$this->attributes['uniq_id'], $this->attributes['color_readmore']
								);
				$css .= sprintf('.%1$s .whatwedo-nutrition .nutrition-services-content .nutrition-btn:before:hover { background-color: %2$s;}',
									$this->attributes['uniq_id'], $this->attributes['color_readmore']
								);
			}
			if( !empty($this->attributes['color_readmore_hv']) ) {
				$css .= sprintf('.%1$s .whatwedo-nutrition .nutrition-services-content .nutrition-btn:hover, .%1$s .whatwedo-nutrition .nutrition-services-content .nutrition-btn:focus { color: %2$s;}',
									$this->attributes['uniq_id'], $this->attributes['color_readmore_hv']
								);
				$css .= sprintf('.%1$s .nutrition-services-content .nutrition-btn:hover:before, .%1$s .nutrition-services-content .nutrition-btn:focus:before { background-color: %2$s;}',
									$this->attributes['uniq_id'], $this->attributes['color_readmore_hv']
								);
			}
			if( !empty($this->attributes['color_border']) ) {
				$css .= sprintf('.%1$s .whatwedo-nutrition .nutrition-services-content, .%1$s .whatwedo-nutrition .nutrition-services-content:after { border-color: %2$s;}',
									$this->attributes['uniq_id'], $this->attributes['color_border']
								);
			}
			if( !empty($this->attributes['color_border_hv']) ) {
				$css .= sprintf('.%1$s .whatwedo-nutrition .nutrition-services-content:before { border-top-color: %2$s; border-bottom-color: %2$s;}',
									$this->attributes['uniq_id'], $this->attributes['color_border_hv']
								);
				$css .= sprintf(' .%1$s .whatwedo-nutrition .nutrition-services-content { border-left-color: %2$s; border-right-color: %2$s;}',
									$this->attributes['uniq_id'], $this->attributes['color_border_hv']
								);
			}
		}
		return $css;
	}
	/*-------------------- >> Render Html << -------------------------*/
	/**
	 * Render html by grid.
	 *
	 * @param array $html_options
	 * Format: 1$ - icon, 2$ - title, 3$ - excerpt, 4$ - responsive class
	 */
	public function render_grid( $html_options = array() ) {
		$this->html_format = $this->set_default_options( $html_options );
		$count = $row_count = $count_color_icon_multi = 0;
		$custom_css = $classColorIcon = $html_line = '';
		if( $this->query->have_posts() ) {
			while ( $this->query->have_posts() ) {
				$this->query->the_post();
				$this->loop_index();
				$row_count++;

				$color_icon_multi = $this->attributes['color_icon_multi'];
				if ( $this->attributes['style'] == 2 && !empty($color_icon_multi) ) {
					$count_color_icon_multi = count($color_icon_multi);
					$classColorIcon = 'color-icon-' . $row_count;
					if ( !empty($color_icon_multi[$row_count-1]['color_multi']) ) {
						$custom_css .= sprintf('.%s .pediatric.whatwehelp .services-item .btn-for-icon i.%s { color: %s;}',
										$this->attributes['uniq_id'], $classColorIcon, $color_icon_multi[$row_count-1]['color_multi']
									);
					}
					if ( $count_color_icon_multi == $row_count ) {
						$row_count = 0;
					}
				}

				$get_icon = $this->get_icon();
				if ( !empty($get_icon) ) {
					$html_line = '<div class="line"></div>';
				}
				$html_options = $this->html_format;
				printf( $html_options['html_format'],
						$get_icon,
						$this->get_title( $html_options ),
						$this->get_excerpt( $html_options ),
						$this->attributes['responsive-class'],
						$this->permalink,
						$html_line,
						$classColorIcon,
						$this->get_meta_thumbnail( 'small_image', 'medium' )
				);
			}
			$this->reset();
		}
		if ( $custom_css ) {
			do_action( SLZCORE_ADD_INLINE_CSS, $custom_css );
		}
	}
	public function render_widget( $html_options = array() ) {
		$this->set_default_options( $html_options );
		while ( $this->query->have_posts() ) {
			$this->query->the_post();
			$this->loop_index();
			printf( $html_options['html_format'],
					$this->get_title(),
					$this->permalink,
					$this->get_icon()
			);
		}
		$this->reset();
	}
	public function get_icon() {
		$icon = $this->post_meta['icon'];
		if( empty( $icon ) ) {
			return '';
		}
		$format = $this->html_format['icon_format'];
 		$out = sprintf($format, $icon );
 		return $out;
	}
	public function get_service_title( $format ) {
		if( empty($format) ){
			$format = "%1$s";
		}
		$output = sprintf( $format,
							esc_html( $this->title )
						);
		return $output;
	}
	public function get_meta_thumbnail($thumb_meta = '', $thumb_size = '') {
		if ( !empty($thumb_meta) ) {
			$thumb_id = $this->post_meta[$thumb_meta];
		} else {
			return;
		}

		$format = $this->html_format['small_image'];
		if ( empty($format) ) {
			$format = '<a href="%2$s">%1$s</a>';
		}
		
		$thumb_class = Medicplus_Core::get_value( $this->html_format, '','img-responsive' );
		if ( empty($thumb_size) ) {
			$thumb_size = $this->attributes['thumb-size']['large'];
		}
		$helper = new Medicplus_Core_Helper();
		$helper->regenerate_attachment_sizes($thumb_id, $thumb_size);
		$thumb_img = wp_get_attachment_image( $thumb_id, $thumb_size, false, array('class' => $thumb_class ) );

		$output = sprintf( $format, $thumb_img, $this->permalink );
		return $output;
	}
	//------------------- Post Infomations >> -------------------

	public function set_default_options( $html_options = array() ) {
		$defaults = array(
			'icon_format'			=> '%1$s',
			'title_format'			=> '%1$s',
			'excerpt_format'		=> '%1$s',
			'small_image'			=> '%1$s',
		);
		$html_options = array_merge( $defaults, $html_options );
		return $html_options;
	}
	private function get_thumb_size() {
		$params = Medicplus_Core_Params::get( 'block-image-size', 'service' );
		$this->attributes['thumb-size'] = Medicplus_Core_Util::get_thumb_size( $params, $this->attributes );
	}
}