<?php
Medicplus::load_class( 'models.Blog_Model' );

class Medicplus_Blog extends Medicplus_Blog_Model {

	public $large_image_post = true;
	public $start_group = true;
	private $row_post_counter = 0;
	private $row_counter;
	private $post_counter = 0;
	private $block_atts;
	public $show_full_meta = true;
	public $show_widget_meta = false;
	public $show_author_meta = false;

	public function init( $atts, $content = null ) {
		// default
		$this->large_image_post = true;
		$this->start_group = true;
		$this->row_post_counter = 0;
		$this->row_counter = 1;
		$this->post_counter = 0;

		// set attributes
		$atts['content'] = $content;
		$atts = $this->get_block_setting($atts);
		$this->block_atts = $atts;
		$this->set_attributes( $atts );
		$this->block_atts['block-class'] = $this->attributes['block-class'];

		$this->get_thumb_size();
		$this->set_responsive_class($atts);
		
		// add inline css
		$custom_css = $this->add_custom_css();
		if( $custom_css ) {
			do_action( 'medicplus_add_inline_style', $custom_css );
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
			'large_post_counter'=> '',
			'show_related_post' => '',
			'new_row'           => '1',
			'thumb_href_class'  => '',
			'show_full_meta'    => '',
			'show_widget_meta'  => '',
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
										<div class="video-button-play animated"><i class="fa fa-youtube-play"></i></div>
										<div class="video-button-close animated hide-video"><i class="fa fa-times"></i></div>
									</div>',
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
	
	public function render_block( $options = array() ) {
		$exclude = array();
		$options = $this->set_post_options_defaults( $options );
		$this->html_format = $options;
		while ( $this->query->have_posts() ) {
			$this->query->the_post();
			$this->loop_index();
			$this->post_counter ++;
			$related_post = '';
			$limit_content = true;
			// render post
			$html_format = $options['small_post_format'];
			if( $this->large_image_post ) {
				// large image group
				if( empty($options['large_post_counter']) || 
					( !empty($options['large_post_counter']) && $options['large_post_counter'] == $this->post_counter ) ) {
						$this->large_image_post = false;
				}
				$type = 'large';
				$related_post = $this->get_related_post($this->attributes['related_post_count']);
				$html_format = $options['large_post_format'];
				$limit_content = false;
				if( isset($options['large_thumb_href_class'] ) ) {
					$options['thumb_href_class'] = $options['large_thumb_href_class'];
				}
				if( isset($options['large_title_class'])) {
					$options['title_class'] = $options['large_title_class'];
				}
			} else {
				if( isset($options['small_thumb_href_class'] ) ) {
					$options['thumb_href_class'] = $options['small_thumb_href_class'];
				}
				unset($options['title_class']);
				if( isset($options['small_title_class'])) {
					$options['title_class'] = $options['small_title_class'];
				}
				// small image group
				$type = 'small';
				if( $this->start_group ) {
					echo wp_kses_post( $options['open_group'] . $options['open_row'] );
					$this->start_group = false;
				}
				$this->row_post_counter ++;
			}
			if( $options['new_row'] && $this->attributes['column'] > 1 && $this->row_post_counter > $this->attributes['column'] ) {
				// add new row
				$this->row_counter ++;
				$this->row_post_counter = 1;
				echo wp_kses_post( $options['close_row'] . $options['open_row'] );
			}
			printf( $html_format,
					$this->get_featured_images( $type, false, $options ),
					$this->get_title(true, false, $options ),
					$this->get_meta_info(),
					''
			);
		}// end while
		echo wp_kses_post( $options['close_row'] . $options['close_group'] );

		//paging
		if( $this->attributes['pagination'] == 'yes' ) {
			printf('<div class="" >%s</div>', $this->paging_nav( $this->query->max_num_pages, 2, $this->query) );
		}
		// reset postdata
		wp_reset_postdata();
	}
	
	public function render_grid( $options = array() ) {
		$exclude = array();
		$options = $this->set_post_options_defaults( $options );
		while ( $this->query->have_posts() ) {
			$this->query->the_post();
			$this->loop_index();
			$this->post_counter ++;
			$limit_content = true;
			// small image group
			$this->row_post_counter ++;
			if( $options['open_row'] && $this->attributes['column'] > 1 && $this->row_post_counter > $this->attributes['column'] ) {
				// add new row
				$this->row_counter ++;
				$this->row_post_counter = 1;
				echo wp_kses_post( $options['close_row'] . $options['open_row'] );
			}
			printf( $options['small_post_format'],
					$this->get_featured_image( 'large', false, $options ),
					$this->get_date(),
					$this->get_author_meta( $options ),
					$this->get_title(true, false, $options ),
					$this->get_excerpt( $limit_content ),
					$this->attributes['responsive-class']
			);
		}// end while

		//paging
		if( $this->attributes['pagination'] == 'yes' ) {
			echo '<div class="clearfix"></div>';
			printf('<div class="" >%s</div>', $this->paging_nav( $this->query->max_num_pages, 2, $this->query) );
		}
		// reset postdata
		wp_reset_postdata();
	}
	
	public function render_author( $options = array() ) {
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
				$this->html_format['no_thumbnails_image'] = 'no-thumbnails-image';
				printf( $html_format,
						$this->get_featured_by_format('large', $this->html_format ),
						$this->get_title(false, false, $this->html_format ),
						$this->get_excerpt(),
						$this->get_post_date(),
						$this->get_meta_info(),
						$this->get_post_class(),
						$this->html_format['no_thumbnails_image'],
						$this->post_id
						
				);
			}// end while
			if( isset( $this->html_format['bg_img_css'] ) && isset($this->html_format['bg_image'])) {
				if( $bg_image = $this->html_format['bg_image'] ) {
					foreach ( $bg_image as $id => $url ) {
						if( $url ){
							$post_class = 'post-' . $id;
							$custom_css .= sprintf($this->html_format['bg_img_css'], $this->attributes['block-class'], $post_class, esc_url($url));
						}
					}
				}
			}
			if( $custom_css ) {
				do_action( 'medicplus_add_inline_style', $custom_css );
			}
			
			//paging
			if( $this->attributes['pagination'] == 'yes' ) {
				printf('<div class="clearfix"></div>%s', $this->paging_nav( $this->query->max_num_pages, 2, $this->query) );
			}
			// reset query
			wp_reset_postdata();
		}
	}
	public  function paging_nav( $pages = '', $range = 2, $current_query = '' ) {
		global $paged;
		if( $current_query == '' ) {
			if( empty( $paged ) ) $paged = 1;
		} else {
			$paged = $current_query->query_vars['paged'];
		}
		$prev = $paged - 1;
		$next = $paged + 1;
		$range = 1; // only edit this if you want to show more page-links
		$showitems = ($range * 2);
		
		if( $pages == '' ) {
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if( ! $pages ) {
				$pages = 1;
			}
		}
		$method = "get_pagenum_link";
		if(is_single()) {
			$method = self::theme_post_pagination_link;
		}
		$output = $output_page = $showpages = $disable = '';
		$page_format = '<li class="pagi-inner"><a href="%2$s" class="pagi-link" >%1$s</a></li>';
		if( 1 != $pages ) {
			$output_page .= '<ul class="pagination">';
			// prev
			if( $paged == 1 ) {
				$disable = ' hide';
			}
			$output_page .= '<li class="pagi-inner '.$disable.'"><a href="'.esc_url($method($prev)).'" rel="prev" class="pagi-link">'.esc_html__('Prev', 'medicplus').'</a></li>';
			// first pages
			if( $paged > $showitems ) {
				$output_page .= sprintf( $page_format, 1, $method(1) );
			}
			// show ...
			if( $paged - $range > $showitems && $paged - $range > 2 ) {
				$output_page .= sprintf( $page_format, '&bull;&bull;&bull;', $method($paged - $range - 1) );'<li><a href="'.esc_url($method($prev)).'">&bull;&bull;&bull;</a></li>';
			}
			for ($i=1; $i <= $pages; $i++) {
				if (1 != $pages &&( !($i >= $paged+$showitems || $i <= $paged-$showitems) || $pages <= $showitems )) {
					if( $paged == $i ) {
						$output_page .= '<li class="active pagi-inner"><span class="pagi-link">'.$i.'</span></li>';
					} else {
						$output_page .= sprintf( $page_format, $i, $method($i) );
					}
					$showpages = $i;
				}
			}
			// show ...
			if( $paged < $pages-1 && $showpages < $pages -1 ){
				$showpages = $showpages + 1;
				$output_page .= sprintf( $page_format, '...', $method($showpages) );
			}
			// end pages
			if( $paged < $pages && $showpages < $pages ) {
				$output_page .= sprintf( $page_format, $pages, $method($pages) );
			}
			//next
			$disable = '';
			if( $paged == $pages ) {
				$disable = ' hide';
			}
			$output_page .= '<li class="pagi-inner '.$disable.'"><a href="'.esc_url($method($next)).'" rel="next" class="pagi-link">'.esc_html__('Next', 'medicplus').'</a></li>';
			$output_page .= '</ul>'."\n";
			$output = sprintf('<nav class="pagination-wrapper text-center">%1$s</nav>', $output_page );
		}
		return $output;
	}
	private function get_post_date() {
		$out = '';
		$format = '<div class="post-date"><a href="%1$s"><span class="date">%2$s</span>%3$s %4$s</a></div>';
		$day = get_the_time('d');
		$month = get_the_time('M');
		$year = get_the_time('Y');
		$out  = sprintf( $format, esc_url($this->permalink), $day, $month, $year );
		return $out;
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
	
	public function get_meta_info_more( $html_options = array(), $seperate = '' ) {
		$meta_array = array(
			'view'     => $this->get_views(),
			'comment'  => $this->get_comments(),
		);
		foreach( $meta_array as $key => $val ) {
			if( empty( $val ) ) {
				unset($meta_array[$key]);
			}
		}
		$output = implode( $seperate, $meta_array );
		$format = $html_options['meta_more_format'];
		if( $output ) {
			$output = sprintf( $format, $output );
		}
		return $output;
	}
	
	public function get_author_meta( $html_options = array(), $seperate = '' ) {
		$meta_array = array(
			'category' => $this->get_category(),
			'comment'  => $this->get_comments(),
			'views'  => $this->get_views(),
		);
		foreach( $meta_array as $key => $val ) {
			if( empty( $val ) ) {
				unset($meta_array[$key]);
			}
		}
		$output = implode( $seperate, $meta_array );
		$format = $html_options['author_meta_format'];
		if( $output ) {
			$output = sprintf( $format, $output );
		}
		return $output;
	}
	
	public function get_meta( $html_options = array(),$seperate = '') {
		$output = '';
		if( $this->attributes['show_meta'] == 'hide' ) {
			return '';
		}
		if ( !$this->show_full_meta ){
			$output = $this->get_meta_info( $html_options ).$this->get_meta_info_more( $html_options );
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
				$format = $html_options['meta_info_format'];
			if( $this->show_widget_meta ){
				$not_div         = false;
				$prefix_category = "";
				if( isset($html_options["small_not_div"]) ){
					$not_div = $html_options["small_not_div"];
				}
				if( isset($html_options["small_prefix_category"]) ){
					$prefix_category = $html_options["small_prefix_category"];
				}
				$output  = sprintf( $format, $this->get_date( false, $not_div ), $this->get_comments(), $this->get_views(), $this->get_category( false, $prefix_category ), $this->get_author());
				return $output;
			}else{
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
		if( $this->attributes['block_title_color'] ) {
			$css .= sprintf('.%s .block-title { color: %s;}', $this->attributes['block-class'], $this->attributes['block_title_color']);
			$css .= sprintf('.%s .section-name { border-color: %s;}', $this->attributes['block-class'], $this->attributes['block_title_color']);
		}
		return $css;
	}
	private function get_thumb_size() {
		$params = Medicplus_Params::get( 'default-image-size', $this->attributes['layout'] );
		$this->attributes['thumb-size'] = $this->get_thumb_sizes( $params, $this->attributes );
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
}