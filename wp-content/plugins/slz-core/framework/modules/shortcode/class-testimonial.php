<?php
class Medicplus_Core_Testimonial extends Medicplus_Core_Custom_Post_Model {

	private $post_type = 'medicplus_testi';
	private $post_taxonomy = 'medicplus_testi_cat';
	
	public function __construct() {
		$this->meta_attributes();
		$this->set_meta_attributes();
		$this->post_meta_prefix = $this->post_type . '_';
		$this->taxonomy_cat = $this->post_taxonomy;
	}
	public function meta_attributes() {
		$meta_atts = array(
			'position'      => '',
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
			'layout'               	=> 'testimonial',
			'limit_post'           	=> '',
			'offset_post'          	=> '',
			'sort_by'              	=> '',
			'post_id'              	=> '',
			'auto_speed'           	=> '5000',
			'speed'              	=> '',
		);
		$atts = array_merge( $default_atts, $atts );

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
		// image size
		$this->get_thumb_size();
	}
	public function reset(){
		wp_reset_postdata();
	}
	public function render_sc( $html_options = array() ) {
		$this->html_format = $this->set_default_options( $html_options );
		$add_back_to_dot = '';
		$count_post = 0;
		if( $this->query->have_posts() ) {
			while ( $this->query->have_posts() ) {
				$this->query->the_post();
				$this->loop_index();
				$count_post++;
				if ( $this->attributes['style'] == 1 ) {
					$add_back_to_dot .= sprintf('.%s .slider-testimonials .owl-dot:nth-child('.$count_post.'):before { background-image: url("%s");}',
										$this->attributes['uniq_id'], $this->get_image_url()
									);
				}
				$html_options = $this->html_format;
				printf( $html_options['html_format'],
					$this->get_title( $html_options ),
					$this->get_content( $html_options ),
					$this->get_post_class()
				);
			}
			$this->reset();
			if ($add_back_to_dot) {
				do_action( SLZCORE_ADD_INLINE_CSS, $add_back_to_dot );
			}
		}
	}
	public function add_custom_css() {
		$css = '';
		if ( $this->attributes['style'] == 1 ) {
			if( $this->attributes['icon_color'] ) {
				$css .= sprintf('.%s .testimonials .close-bracket-wrapper .close-bracket { color: %s;}',
									$this->attributes['uniq_id'], $this->attributes['icon_color']
								);
			}
			if( $this->attributes['line_color'] ) {
				$css .= sprintf('.%s .typo-line:after { background-color: %s;}',
									$this->attributes['uniq_id'], $this->attributes['line_color']
								);
			}
			if( $this->attributes['text_color'] ) {
				$css .= sprintf('.%s .testimonials .slider-testimonials .testimonial-graph { color: %s;}',
									$this->attributes['uniq_id'], $this->attributes['text_color']
								);
			}
			if( $this->attributes['name_color'] ) {
				$css .= sprintf('.%s .testimonials .slider-testimonials .sub-header { color: %s;}',
									$this->attributes['uniq_id'], $this->attributes['name_color']
								);
			}
		} elseif ( $this->attributes['style'] == 2 ) {
			if( $this->attributes['icon_color'] ) {
				$css .= sprintf('.%s .testimonials.testimonials-style-2 .close-bracket-wrapper i { color: %s;}',
									$this->attributes['uniq_id'], $this->attributes['icon_color']
								);
			}
			if( $this->attributes['border_color'] ) {
				$css .= sprintf('.%s .testimonials.testimonials-style-2 .slider-testimonials-inner { border-color: %s;}',
									$this->attributes['uniq_id'], $this->attributes['border_color']
								);
				$css .= sprintf('.%1$s .testimonials.testimonials-style-2 .close-bracket-wrapper .line-top { background-color: %2$s;}',
									$this->attributes['uniq_id'], $this->attributes['border_color']
								);
			}
			if( $this->attributes['nav_color'] ) {
				$css .= sprintf('.%1$s .testimonials.testimonials-style-2 .nav-testimonial .nav-testimonial-inner-left, .%1$s .testimonials.testimonials-style-2 .nav-testimonial .nav-testimonial-inner-right { border-color: %2$s; color:  %2$s; }',
									$this->attributes['uniq_id'], $this->attributes['nav_color']
								);
			}
			if( $this->attributes['text_color'] ) {
				$css .= sprintf('.%s .testimonials.testimonials-style-2 .description { color: %s;}',
									$this->attributes['uniq_id'], $this->attributes['text_color']
								);
			}
			if( $this->attributes['name_color'] ) {
				$css .= sprintf('.%s .testimonials.testimonials-style-2 .sub-header { color: %s;}',
									$this->attributes['uniq_id'], $this->attributes['name_color']
								);
			}
		}
		return $css;
	}
	public function get_position() {
		$format = $this->html_format['position_format'];
		$val = $this->post_meta['position'];
	
		$out = '';
		if( !empty($val) ) {
			$out = sprintf( $format, esc_html( $val ) );
		}
		return $out;
	}
	public function set_default_options( $html_options = array() ) {
		$defaults = array(
			'title_format'       => '%1$s',
			'excerpt_format'    =>'<div class="testimonial-graph">%1$s</div>',
		);
		$html_options = array_merge( $defaults, $html_options );
		return $html_options;
	}
	public function get_thumb_size() {
		$params = Medicplus_Core_Params::get( 'block-image-size', $this->attributes['layout'] );
		$this->attributes['thumb-size'] = Medicplus_Core_Util::get_thumb_size( $params, $this->attributes );
	}
	public function get_image_url( $idThumb = '', $thumb_type = 'large', $echo = false, $options = array() ) {
		$out = $thumb_img = '';
		$thumb_size = 'full';
		if ($thumb_type != 'full') {
			$thumb_size = $this->attributes['thumb-size'][$thumb_type];
		}
		if (empty($idThumb)) {
			$idThumb = get_post_thumbnail_id( $this->post_id );
		}
		if( !empty($idThumb) ) {
			$thumb_img = wp_get_attachment_image_src( $idThumb, $thumb_type );
			$thumb_img = $thumb_img[0];
		}
		$out = $thumb_img;

		if( !$echo ) {
			return $out;
		}
		echo wp_kses_post( $out );
	}
}