<?php
Medicplus_Core::load_class( 'models.Blog_Model' );

class Medicplus_Core_Block extends Medicplus_Core_Blog_Model {

	private $row_post_counter = 0;
	private $row_counter;
	private $post_counter = 0;
	private $block_atts;
	
	public $large_image_post = true;
	public $start_group = true;
	public $show_full_meta = true;
	public $show_widget_meta = false;
	public $html_format;

	public function init( $atts ) {
		// default
		$this->large_image_post = true;
		$this->start_group = true;
		$this->row_post_counter = 0;
		$this->row_counter = 1;
		$this->post_counter = 0;

		// set attributes
		$atts = $this->get_block_setting($atts);
		$this->block_atts = $atts;
		$this->set_attributes( $atts );
		$this->block_atts['block-class'] = $this->attributes['block-class'];

		$this->get_thumb_size();
		$this->set_responsive_class($atts);
		// add inline css
		$custom_css = $this->add_custom_css();
		if( $custom_css ) {
			do_action( SLZCORE_ADD_INLINE_CSS, $custom_css );
		}
	}
	public function set_post_options_defaults( $atts ) {
		$default = array(
			'large_post_format' => '',
			'small_post_format' => '',
			'open_group'        => '',
			'open_row'          => '',
			'close_row'         => '',
			'close_group'       => '',
			'content_length'    => '',
			'large_post_counter'=> 1,
			'show_related_post' => '',
			'new_row'           => '1',
			'thumb_href_class'  => '',
			'show_full_meta'    => '',
			'show_widget_meta'  => '',
			'meta_more_format'  => '',
			'html_format'       => '',
			'title_format'      => '<h3 class="recent-news-title"><a href="%2$s">%1$s</a></h3>',
			'excerpt_format'    => '<div class="recent-news-description">%1$s</div>',
			'meta_info_format'  => '<div class="recent-news-meta">
										<ul class="list-meta list-inline list-unstyled">
											<li>%1$s</li>
										</ul>
									</div>',
			'video_format'      => '<div class="post-image video-thumbnails">
										%1$s
										<div class="video-bg animated">
											%2$s
										</div>
										<div class="video-button-play animated">
											<i class="fa fa-youtube-play"></i>
										</div>
										<div class="video-button-close animated hide-video">
											<i class="fa fa-times"></i>
										</div>
									</div>',
			'no_thumbnails_image' => '',
			'bg_image' => '',
		);
		foreach($default as $key => $val ) {
			if( isset( $atts[$key] ) ) {
				$default[$key] = $atts[$key];
				unset( $atts[$key] );
			}
		}
		if( $atts ) {
			foreach($atts as $key => $val ) {
				$default[$key] = $atts[$key];
			}
		}
		return $default;
	}
	public function set_responsive_class($atts) {
		$class = '';
		$column = $this->attributes['column'];
		if( isset($atts['res_class']) ) {
			$class = $atts['res_class'];
		}
		$def = array(
			'1' => 'col-sm-12',
			'2' => 'col-sm-6 ' . $class,
			'3' => 'col-sm-4 col-xs-12',
			'4' => 'col-sm-3',
		);;
		
		if( $column && isset($def[$column])) {
			$this->attributes['responsive-class'] = $def[$column];
		} else {
			$this->attributes['responsive-class'] = $def['1'];
		}
	}
	/**
	 * Render html to shortcode
	 *
	 */
	public function render_carousel( $options = array() ) {
		$this->html_format = $this->set_post_options_defaults( $options );
		$custom_css = '';
		if( $this->query->have_posts() ) {
			while ( $this->query->have_posts() ) {
				$this->query->the_post();
				$this->loop_index();
				$this->post_counter ++;
				$html_format = $this->html_format['html_format'];
				if( isset( $this->html_format['bg_img_css'] ) ) {
					$url = $this->get_featured_url();
					$item_post_class = 'post-' . $this->post_id;
					$custom_css .= sprintf($this->html_format['bg_img_css'], $this->attributes['block-class'], $item_post_class, esc_url($url));
				}
				printf( $html_format,
						$this->get_featured_image('large', false, $this->html_format ),
						$this->get_title(false, false, $this->html_format ),
						$this->get_excerpt(),
						$this->get_post_date(),
						$this->get_meta_info_more(),
						$this->get_post_class()
				);
			}// end while
			// reset query
			wp_reset_postdata();
			if( $custom_css ) {
				do_action( SLZCORE_ADD_INLINE_CSS, $custom_css );
			}
		}
	}
	public function render_grid( $options = array() ) {
		$this->html_format = $this->set_post_options_defaults( $options );
		$custom_css = '';
		$number_post = $this->query->query_vars['posts_per_page'] * ( $this->query->query_vars['paged'] -1 );
		if( $this->query->have_posts() ) {
			while ( $this->query->have_posts() ) {
				$this->query->the_post();
				$this->loop_index();
				// the last page
				if( $this->query->query_vars['paged'] == $this->query->max_num_pages ){
					if( $number_post >= $this->query->found_posts ){
						break;
					}
					$number_post ++;
				}
				$this->post_counter ++;
				$html_format = $this->html_format['html_format'];
				if( isset( $this->html_format['bg_img_css'] ) ) {
					$url = $this->get_featured_url();
					$item_post_class = 'post-' . $this->post_id;
					$custom_css .= sprintf($this->html_format['bg_img_css'], $this->attributes['block-class'], $item_post_class, esc_url($url));
				}
				$this->html_format['no_thumbnails_image'] = '';
				$featured_image = $this->get_featured_by_format( 'large', $this->html_format );
				if( isset( $this->html_format['show_no_image'] ) ){
					$featured_image = $this->get_featured_image('large', false, $this->html_format );
				}
				printf( $html_format,
						$featured_image,
						$this->get_title(false, false, $this->html_format ),
						$this->get_excerpt(),
						$this->get_post_date(),
						$this->get_meta_info(),
						$this->get_post_class(),
						$this->html_format['no_thumbnails_image'],
						$this->post_id,
						$this->get_read_more_link()
				);
			}// end while
			
			// reset query
			wp_reset_postdata();
			
			if( $bg_image = $this->html_format['bg_image'] ) {
				foreach ( $bg_image as $id => $url ) {
					if( $url ){
						$post_class = 'post-' . $id;
						$custom_css .= sprintf($this->html_format['bg_img_css'], $this->attributes['block-class'], $post_class, esc_url($url));
					}
				}
			}
			if( $custom_css ) {
				do_action( SLZCORE_ADD_INLINE_CSS, $custom_css );
			}
		}
	}
	
	public function get_meta_info( $seperate = '' ) {
		$meta_array = array(
			'author'   => $this->get_author(),
			'comment'  => $this->get_comments(),
			'view'     => $this->get_views(),
		);
		foreach( $meta_array as $key => $val ) {
			if( empty( $val ) ) {
				unset($meta_array[$key]);
			}
		}
		if( isset($this->html_format['meta_seperate'])) {
			$seperate = $this->html_format['meta_seperate'];
		}
		$output = implode( $seperate, $meta_array );
		$format = $this->html_format['meta_info_format'];
		if( $output ) {
			$output = sprintf( $format, $output );
		}
		return $output;
	}
	
	public function get_meta_info_more( $seperate = '' ) {
		$meta_array = array(
			'comment'  => $this->get_comments(),
			'view'     => $this->get_views(),
		);
		foreach( $meta_array as $key => $val ) {
			if( empty( $val ) ) {
				unset($meta_array[$key]);
			}
		}
		if( isset($this->html_format['meta_seperate'])) {
			$seperate = $this->html_format['meta_seperate'];
		}
		$output = implode( $seperate, $meta_array );
		$format = $this->html_format['meta_info_format'];
		if( $output ) {
			$output = sprintf( $format, $output );
		}
		return $output;
	}
	
	public function get_meta( $seperate = '') {
		$output = '';
		if( $this->attributes['show_meta'] == 'hide' ) {
			return '';
		}
		if ( !$this->show_full_meta ){
			$output = $this->get_meta_info().$this->get_meta_info_more();
			return $output;
		}else{
			$meta_array = array(
				'category' => $this->get_category(),
				'date'     => $this->get_date(),
				'author'   => $this->get_author(),
				'view'     => $this->get_views(),
				'comment'  => $this->get_comments(),
				);
				foreach( $meta_array as $key => $val ) {
					if( empty( $val ) ) {
						unset($meta_array[$key]);
					}
				}
				$format = $this->html_format['meta_info_format'];
			if( $this->show_widget_meta ){
				$output = sprintf( $format, $this->get_date(), $this->get_comments(), $this->get_views());
				return $output;
			}else{
				if( isset($this->html_format['meta_seperate'])) {
					$seperate = $this->html_format['meta_seperate'];
				}
				$output= implode( $seperate, $meta_array );
				if( $output ) {
					$output = sprintf( $format, $output );
				}
				return $output;
			}
		}
	}
	
	public function add_custom_css() {
		$css = '';
		if( $this->attributes['button_text_color'] ) {
			$css .= sprintf('.blog.%s .about-house .btn-blue { color: %s;}', $this->attributes['block-class'], $this->attributes['button_text_color']);
		}
		if( $this->attributes['button_color'] ) {
			$css .= sprintf('.blog.%s .about-house .btn-blue { background-color: %s;}', $this->attributes['block-class'], $this->attributes['button_color']);
		}
		if( $this->attributes['button_text_hv_color'] ) {
			$css .= sprintf('.blog.%s .about-house .btn-blue:hover { color: %s;}', $this->attributes['block-class'], $this->attributes['button_text_hv_color']);
		}
		if( $this->attributes['button_hv_color'] ) {
			$css .= sprintf('.blog.%s .about-house .btn-blue:hover { background-color: %s;}', $this->attributes['block-class'], $this->attributes['button_hv_color']);
		}
		return $css;
	}
	private function get_thumb_size() {
		$params = Medicplus_Core_Params::get( 'block-image-size', $this->attributes['layout'] );
		$this->attributes['thumb-size'] = Medicplus_Core_Util::get_thumb_size( $params, $this->attributes );
	}
	private function get_block_setting( $atts ) {
		$displays = array(
			'show_category'        => '',
			'show_tag'             => '',
			'show_comment'         => '',
			'show_views'           => '',
			'show_date'            => '',
			'show_author'          => '',
			'show_excerpt'         => '',
			'show_meta'            => '',
			'content_length'       => '',
			'title_length'         => '',
		);
		$displays['layout'] = $atts['layout'];
		if( function_exists('medicplus_get_block_options')){
			medicplus_get_block_options( $displays );
		}
		foreach( $displays as $key => $val ) {
			if( ! isset($atts[$key]) ) {
				$atts[$key] = $displays[$key];
			} else if( ($atts[$key] == 'no' || $atts[$key] == 'hide') ) {
				$atts[$key] = 'hide';
			}
		}
		return $atts;
	}
	private function get_post_date() {
		$out = '';
		$format = '<div class="post-date"><a href="%1$s"><span class="date">%2$s</span>%3$s %4$s</a></div>';
		$day = get_the_time('d');
		$month = get_the_time('M');
		$year = get_the_time('Y');
		$out  = sprintf( $format, $this->permalink, $day, $month, $year );
		return $out;
	}
	public function get_read_more_link() {
		$format = '<a href="%1$s" class="read-more">%2$s<i class="fa fa-angle-right"></i></a>';
		if( isset($this->attributes['read_more_link']) && $this->attributes['read_more_link'] ) {
			return sprintf($format, $this->permalink, $this->attributes['read_more_link'] );
		}
	}
}