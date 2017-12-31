<?php
class Medicplus_Core_Team extends Medicplus_Core_Custom_Post_Model {

	private $post_type = 'medicplus_team';
	private $post_taxonomy = 'medicplus_team_cat';
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
			'information'       => esc_html__('Information', 'slz-core'),
			'department'      	=> esc_html__('Department', 'slz-core'),
			'position'         	=> esc_html__('Position', 'slz-core'),
			'phone'            	=> esc_html__('Phone', 'slz-core'),
			'email'            	=> esc_html__('Email', 'slz-core'),
			'skype'            	=> esc_html__('Skype', 'slz-core'),
			'signature'			=> esc_html__('Transparent Signature', 'slz-core'),
			'signature2'		=> esc_html__('Signature', 'slz-core'),
		);
		$this->post_meta_atts = array_merge($meta_atts,Medicplus_Core_Params::get( 'teammbox-social'));
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
			'layout'               	=> 'team',
			'is_container'			=> '',
			'column' 				=> '4',
			'method'          		=> '',
			'offset_post'          	=> '0',
			'column'              	=> '',
			'limit_post'   			=> '-1',
			'sort_by'              	=> 'post__in',
			'post_id'              	=> '',
			'team_id'				=> ''
		);
		$atts = array_merge( $default_atts, $atts );

		if ( $atts['team_id'] ) {
			$atts['post_id'][0] = $atts['team_id'];
		} else {
			if( $atts['method'] == 'cat' ) {
				$atts['post_id'] = $this->parse_cat_slug_to_post_id(
											$this->taxonomy_cat,
											$atts['category_list'],
											$this->post_type
										);
			} elseif( $atts['method'] == 'team' ) {
				$atts['post_id'] = $this->parse_list_to_array( 'team', $atts['team_list'] );
			}			
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
		$this->get_thumb_size();
		$this->set_responsive_class();
	}
	public function reset(){
		wp_reset_postdata();
	}
	public function set_responsive_class( $atts = array() ) {
		$class = '';
		$column = $this->attributes['column'];
		$def = array(
			'1' => 'col-md-12',
			'2' => 'col-sm-6',
			'3' => 'col-lg-4 col-md-4 col-sm-6',
			'4' => 'col-lg-3 col-md-4 col-sm-6',
		);
		
		if( $column && isset($def[$column])) {
			return $this->attributes['responsive-class'] = $def[$column];
		} else {
			return $this->attributes['responsive-class'] = $def['4'];
		}
	}
	/****************/
	/**** RENDER HTML ****/
	/****************/
	public function render_simple( $html_options = array() ) {
		$this->html_format = $this->set_default_options( $html_options );
		if( $this->query->have_posts() ) {
			while ( $this->query->have_posts() ) {
				$this->query->the_post();
				$this->loop_index();

				$style = $this->attributes['style'];
				$is_container = $this->attributes['is_container'];
				$row_container_open = !empty($is_container) ? '<div class="container">' : '';
				$row_container_close = !empty($is_container) ? '</div>' : '';

				$html_options = $this->html_format;
				$html_options['title_format'] = '<a href="%2$s" class="doctor-title">%1$s</a>';
				$html_options['image_format'] = '<a href="%2$s">%1$s</a>';
				if ( !empty($style) && $style == 1 ) {
					$thumb_meta = 'signature';
					$html_options['thumb_class'] = 'img-responsive wow fadeInLeft';
					$html_options['row_open'] = '<div class="department-detail-wrapper style1"><div class="doctor-wrapper">'. $row_container_open . '<div class="row">';
					$html_options['row_close'] = '</div>'. $row_container_close .'</div></div>';
				} elseif ( !empty($style) && $style == 2 ) {
					$thumb_meta = 'signature2';
					$html_options['thumb_class'] = 'img-responsive wow bounceInLeft';
					$html_options['thumb_attr'] = array('data-wow-delay' => '0.3s');
					$html_options['row_open'] = '<div class="doctor-wrapper style2">'. $row_container_open .'<div class="row">';
					$html_options['row_close'] = '</div>'. $row_container_close .'</div>';
				}

				printf( $html_options['html_format'],
						$this->get_featured_image( $html_options ),
						$this->get_title( $html_options ),
						$this->get_meta_position(),
						$this->get_meta_phone(),
						$this->get_meta_email(),
						$this->get_social(),
						$this->get_meta_information(),
						$this->get_meta_thumbnail($thumb_meta),
						$html_options['row_open'],
						$html_options['row_close']
				);
			}
			$this->reset();
		}
	}

	public function render_grid( $html_options = array() ) {
		$this->html_format = $this->set_default_options( $html_options );
		if( $this->query->have_posts() ) {
			while ( $this->query->have_posts() ) {
				$this->query->the_post();
				$this->loop_index();

				$html_options = $this->html_format;
				$html_options['thumb_class'] = 'img-responsive';
				$html_options['title_format'] = '<a href="%2$s" class="team-title">%1$s</a>';
				printf( $html_options['html_format'],
						$this->get_featured_image( $html_options, 'small' ),
						$this->get_title(),
						$this->get_title( $html_options ),
						$this->get_meta_position(),
						$this->get_social(),
						$this->set_responsive_class()
				);
			}
			$this->reset();
		}
	}

	public function render_carousel( $html_options = array() ) {
		$this->html_format = $this->set_default_options( $html_options );

		if( $this->query->have_posts() ) {
			while ( $this->query->have_posts() ) {
				$this->query->the_post();
				$this->loop_index();

				$html_options = $this->html_format;
				$html_options['thumb_class'] = 'img-responsive';
				$html_options['title_format'] = '<a href="%2$s" class="team-title">%1$s</a>';
				printf( $html_options['html_format'],
					$this->get_featured_image( $html_options, 'small' ),
					$this->get_title(),
					$this->get_title( $html_options ),
					$this->get_meta_position(),
					$this->get_social()
				);
			}
			$this->reset();
		}
	}

	public function render_widget( $html_options = array() ) {
		$this->html_format = $this->set_default_options( $html_options );
		if( $this->query->have_posts() ) {
			while ( $this->query->have_posts() ) {
				$this->query->the_post();
				$this->loop_index();
				printf( $html_options['html_format'],
						$this->get_featured_image( $html_options, 'small' ),
						$this->get_title(),
						$this->get_meta_position(),
						$this->permalink
				);
			}
			$this->reset();
		}
	}

	/* team list front-end - style 2 */
	public function render_team_list_fe( $html_options = array() ) {
		$this->html_format = $this->set_default_options( $html_options );
		if( $this->query->have_posts() ) {
			while ( $this->query->have_posts() ) {
				$this->query->the_post();
				$this->loop_index();

				$html_options = $this->html_format;
				$html_options['title_format'] = '<a href="%2$s" class="doctor-title">%1$s</a>';
				$html_options['image_format'] = '<a href="%2$s">%1$s</a>';

				$html_options['thumb_class'] = 'img-responsive wow bounceInLeft';
				$html_options['thumb_attr'] = array('data-wow-delay' => '0.3s');
				$html_options['row_open'] = '<div class="doctor-head-wrapper">';
				$html_options['row_close'] = '</div>';

				$btn_readmore = '';
				if ( !empty($this->attributes['button_text'] ) ) {
					$btn_readmore = sprintf('<div class="btn-wrapper"><a class="btn view-all" href="%s">%s</a></div>', $this->permalink, $this->attributes['button_text'] );
				}

				printf( $html_options['html_format'],
						$this->get_featured_image( $html_options ),
						$this->get_title( $html_options ),
						$this->get_meta_position(),
						$this->get_meta_phone(),
						$this->get_meta_email(),
						$this->get_social(),
						$this->get_meta_information(30),
						$btn_readmore,
						$html_options['row_open'],
						$html_options['row_close']
				);
			}
			$this->reset();
		}
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
	public function get_meta_position() {
		$out = $this->post_meta['position'];
		if( empty( $out ) ) {
			return '';
		}
		return $out;
	}
	public function get_meta_phone() {
		$format = $this->html_format['phone_format'];
		$phone = $this->post_meta['phone'];
		if( empty( $phone ) ) {
			return '';
		}
		$phoneRe = str_replace(' ', '', $phone);
		$out = sprintf( $format, esc_html($phone), esc_html($phoneRe) );
		return $out;
	}
	public function get_meta_email() {
		$format = $this->html_format['email_format'];
		$email = $this->post_meta['email'];
		if( empty( $email ) ) {
			return '';
		}
		$emailRe = str_replace(' ', '', $email);
		$out = sprintf( $format, esc_html($email), esc_attr($emailRe) );
		return $out;
	}
	public function get_meta_information( $trimWordNum = '' ) {
		$format = $this->html_format['description_format'];
		$out = $this->post_meta['information'];
		if ( $trimWordNum ) {
			$out = wp_trim_words( $out, $trimWordNum, '...' );
		}
		if( empty( $out ) ) {
			return '';
		}
		$out = sprintf( $format, esc_html($out) );
		return $out;
	}
	public function get_meta_thumbnail($thumb_meta = '') {
		if ( !empty($thumb_meta) ) {
			$thumb_id = $this->post_meta[$thumb_meta];
		} else {
			return;
		}

		$format = $this->html_format['signature_format'];
		if ( empty($format) ) {
			$format = '<a href="%2$s">%1$s</a>';
		}
		
		$thumb_class = Medicplus_Core::get_value( $this->html_format, 'signature_class', 'img-responsive' );
		$thumb_size = $this->attributes['thumb-size']['large'];
		$thumb_size = 'full';
		$helper = new Medicplus_Core_Helper();
		$helper->regenerate_attachment_sizes($thumb_id, $thumb_size);
		$thumb_img = wp_get_attachment_image( $thumb_id, $thumb_size, false, array('class' => $thumb_class ) );

		$output = sprintf( $format, $thumb_img, $this->permalink );
		return $output;
	}

	public function get_social() {
		$out ='';
		$format = $this->html_format['social_format'];
		$social_group = Medicplus_Core_Params::get( 'teammbox-social');
		foreach( $social_group as $social => $social_text ){
			$item = $this->post_meta[$social];
			if( !empty($item) ) {
				$href = $this->post_meta[$social];
				$out.= sprintf( $format, esc_attr( $social ), esc_url( $href ) );
			}
		}
		return $out;
	}

	public function set_default_options( $html_options = array() ) {
		$defaults = array(
			'title_format'         	=> '',
			'image_format'         	=> '%1$s',
			'description_format'   	=> '<div class="description">%1$s</div>',
			'position_format'      	=> '%1$s',
			'address_format'       	=> '%1$s',
			'phone_format'         	=> '<a href="tel:%2$s" class="info-inner info-phone"><i class="fa fa-phone"></i>%1$s</a>',
			'email_format'         	=> '<a href="mailto:%2$s" class="info-inner info-mail"><i class="fa fa-envelope"></i>%2$s</a>',
			'social_format'        	=> '<li><a href="%2$s" title="%1$s" class="socials-link"><i class="fa fa-%1$s"></i></a></li>',
			'thumb_href_class'     	=> '',
			'thumb_class'      		=> '',
			'signature_format'      => '%1$s',
			'signature_class'      	=> '',
		);

		$html_options = array_merge( $defaults, $html_options );
		return $html_options;
	}
	public function get_thumb_size() {
		$params = Medicplus_Core_Params::get( 'block-image-size', $this->attributes['layout'] );
		$this->attributes['thumb-size'] = Medicplus_Core_Util::get_thumb_size( $params, $this->attributes );
	}
}