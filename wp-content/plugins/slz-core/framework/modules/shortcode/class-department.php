<?php
class Medicplus_Core_Department extends Medicplus_Core_Custom_Post_Model {

	private $post_type = 'medicplus_dept';
	private $post_taxonomy = 'medicplus_dept_cat';
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
			'department_info'          	=> esc_html__( 'Department Information', 'slz-core' ),
			'department_head'    		=> esc_html__( 'Department Head', 'slz-core' ),
			'department_head_info'    	=> esc_html__( 'Department Head Information', 'slz-core' ),
			'show_member_box'    		=> esc_html__( 'Show member box?', 'slz-core' ),
			'box_title'    				=> esc_html__( 'Box title', 'slz-core' ),
			'information_member'    	=> esc_html__( 'Information', 'slz-core' ),
			'show_gallery'    			=> esc_html__( 'Show gallery', 'slz-core' ),
			'gallery_image'    			=> esc_html__( 'Gallery images', 'slz-core' ),
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
			'layout'              	=> 'department',
			'offset_post'         	=> '0',
			'limit_post'          	=> '',
			'sort_by'             	=> '',
			'pagination'      		=> 'yes',
			'category_list'       	=> '',
			'post_id'        		=> '',
			'show_dep_head'  		=> 'yes',
			'show_dep_head_info'  	=> 'yes',
			'button_text'  			=> '',
			'main_color'  			=> '',
			'line_color'  			=> '',
			'extra_class'         	=> '',
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
		// image size
		$this->get_thumb_size();
		// $this->set_responsive_class(); // not use
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
		/*$class = '';
		$column = $this->attributes['columns'];
		if( isset($atts['res_class']) ) {
			$class = $atts['res_class'];
		}
		$def = array(
			'1' => 'col-md-12',
			'2' => 'col-md-6' . $class,
			'3' => 'col-md-4 col-xs-6',
			'4' => 'col-md-3',
		);;
		
		if( $column && isset($def[$column])) {
			$this->attributes['responsive-class'] = $def[$column];
		} else {
			$this->attributes['responsive-class'] = $def['1'];
		}*/
	}
	public function add_custom_css() {
		$css = '';
		if( !empty($this->attributes['main_color']) ) {
			$css .= sprintf('.%s .sub-header { color: %s;}',
								$this->attributes['uniq_id'], $this->attributes['main_color']
							);
			$css .= sprintf('.%s.department-wrapper .department-head .head-name:hover { color: %s;}',
								$this->attributes['uniq_id'], $this->attributes['main_color']
							);
			$css .= sprintf('.%s.department-wrapper .department-head .list-socials .socials-link i { color: %s;}',
								$this->attributes['uniq_id'], $this->attributes['main_color']
							);
			$css .= sprintf('.%s.department-wrapper .department-inner.text-right .department-body:before { border-left-color: %s; }',
								$this->attributes['uniq_id'], $this->attributes['main_color']
							);
			$css .= sprintf('.%1$s.department-wrapper .department-inner.text-right .department-body:after { border-top-color: %2$s; border-bottom-color: %2$s;  }',
								$this->attributes['uniq_id'], $this->attributes['main_color']
							);
			$css .= sprintf('.%1$s .btn-wrapper .btn { background-color: %2$s; border-color: %2$s;  }',
								$this->attributes['uniq_id'], $this->attributes['main_color']
							);
			$css .= sprintf('.%1$s .btn-wrapper .btn:hover { color: %2$s; background-color: #FFF; }',
								$this->attributes['uniq_id'], $this->attributes['main_color']
							);
		}
		if( !empty($this->attributes['line_color']) ) {
			$css .= sprintf('.%s .typo-line:after { background-color: %s;}',
								$this->attributes['uniq_id'], $this->attributes['line_color']
							);
		}
		return $css;
	}
	/*-------------------- >> Render Html << -------------------------*/
	/**
	 * Render html by list department.
	 *
	 * @param array $html_options
	 * Format: 1$ - icon, 2$ - title, 3$ - excerpt, 4$ - button content, 5$ - responsive class
	 */
	public function render_list_post( $html_options = array() ) {
		$this->html_format = $this->set_default_options( $html_options );
		$row_count = 0;
		$class_img_right = '';

		if( $this->query->have_posts() ) {
			while ( $this->query->have_posts() ) {
				$this->query->the_post();
				$this->loop_index();
				$row_count ++;
				$html_options = $this->html_format;
				$class_text = $row_count % 2 == true ? 'text-right' : '';
				$class_img = $row_count % 2 == true ? 'department-img-right' : 'department-img-left';
				$class_avt = $row_count % 2 == true ? 'head-avatar-right' : 'head-avatar-left';
				printf( $html_options['html_format'],
						$this->get_department_cat( $html_options['cat_format'] ),
						$this->get_department_title( $html_options['title_format'] ),
						$this->get_department_info(),
						$this->get_department_head(),
						$this->get_department_head_info(),
						$this->get_department_btn_more( $html_options ),
						$this->get_featured_image( $html_options ),
						$class_text,
						$class_img,
						$class_avt
				);
			}
			if( $this->attributes['pagination'] == 'yes' ) {
				printf('<div class="hide pagination-json" data-json="%s"></div>',
									esc_attr(json_encode($this->attributes))
								);
				printf('<div class="clearfix"></div>%s', Medicplus_Core_Pagination::paging_ajax( $this->query->max_num_pages, 2, $this->query) );
			}
			$this->reset();
		}
	}
	public function render_widget( $html_options = array() ) {
		$this->set_default_options( $html_options );
		while ( $this->query->have_posts() ) {
			$this->query->the_post();
			$this->loop_index();
			printf( $html_options['html_format'],
					$this->get_title(),
					$this->permalink
			);
		}
		$this->reset();
	}
	public function get_department_title( $format ) {
		if( empty($format) ){
			$format = "%1$s";
		}

		$output = sprintf( $format,
							esc_attr( $this->title )
						);
		return $output;
	}
	public function get_department_cat( $format ) {
		$output = '';
		if( empty($format) ){
			$format = "%1$s";
		}
		
		$terms = $this->get_current_taxonomy( $this->post_taxonomy );
		if (!empty($terms)) {
			$term_link = get_term_link($terms['term_id'], $this->post_taxonomy);
			$output = sprintf( $format, esc_html( $terms['name'] ), esc_url( $term_link ) );
		}
		return $output;
	}
	public function get_department_head( $class_img = '' ) {
		$output = $html_image = '';
		// 1 - head name, 2 - permalink, 3 - title, 4 - social, 5 - html_image
		$format = '
                <div class="department-head-wrapper">
                    <div class="head-title">%1$s</div>
                    <div class="department-head">
                        <div class="head-avatar">
                        	%5$s
                       	</div>
                       	<div class="head-body">
                       		<a href="%2$s" class="head-name">%3$s</a>
                            <ul class="list-inline list-unstyled list-socials">
                                %4$s
                            </ul>
                        </div>
                		<div class="clearfix"></div>
                    </div>
                </div>';
		if ( !empty($this->attributes['show_dep_head']) && $this->attributes['show_dep_head'] == 'yes') {
			$head_id = $this->post_meta['department_head'];
			if ( !empty($head_id) ) {
				$permalink = esc_url( get_permalink( $head_id ) );
				$title = esc_attr( get_the_title( $head_id ) );
				$image = get_the_post_thumbnail( $head_id, 'thumbnail', array( 'class'	=> "img-responsive", 'alt' => $title , 'title' => $title ) );
				if ( !empty($image) ) {
					$html_image = sprintf( '<a href="%2$s">%1$s</a>', $image, $permalink );
				}
				$output = sprintf( $format,
									esc_html__( 'Department Head', 'slz-core' ),
									$permalink,
									$title,
									$this->get_social_team( $head_id ),
									$html_image
								);

			}
		}
		return $output;
	}

	public function get_department_info( ) {
		$output = '';
		$format = '<div class="description">%1$s</div>';
        $info = $this->post_meta['department_info'];
		if ( !empty($info) ) {
			$output = sprintf( $format, $info );
		}
		return $output;
	}
	public function get_department_head_info( ) {
		$output = '';
		$format = '<div class="list-unstyled department-list-check">
                        %1$s
                    </div>';
        $info = $this->post_meta['department_head_info'];
		if ( !empty($this->attributes['show_dep_head_info']) && $this->attributes['show_dep_head_info'] == 'yes' && !empty($info) ) {
			$output = sprintf( $format, $info );
		}
		return $output;
	}

	public function get_social_team( $post_id = '' ) {
		$out ='';
		$format = $this->html_format['social_format'];
		$social_group = Medicplus_Core_Params::get( 'teammbox-social');
		if ( !empty($post_id) ) {
			
		}
		foreach( $social_group as $social => $social_text ){
			$item = get_post_meta( $post_id, 'medicplus_team_'.$social, true );
			if( !empty($item) ) {
				$href = $item;
				$out.= sprintf( $format, esc_attr( $social ), esc_url( $href ) );
			}
		}
		return $out;
	}
	public function get_department_btn_more( $html_options = array() ) {
		$output = '';
		$button_text = Medicplus_Core::get_value( $this->attributes, 'button_text', esc_html__('More', 'slz-core') );
		$format = '<a href="%2$s">%1$s</a>';
		if( isset( $html_options['btn_more_format'] ) ) {
			$format = $html_options['btn_more_format'];
		}
		if ( !empty($button_text) ) {
			// format : 1: text, 2:url
			$output = sprintf( $format,
								esc_html( $button_text ),
								$this->permalink
							);
		}
		return $output;
	}
	//------------------- Post Infomations >> -------------------

	public function set_default_options( $html_options = array() ) {
		$defaults = array(
			'title_format'        	=> '<h2 class="header">%1$s</h2>',
			'cat_format'        	=> '<div class="typo-line"><a href="%2$s"><h4 class="sub-header">%1$s</h4></a></div>',
			'excerpt_format'      	=> '',
			'btn_more_format'     	=> '<div class="btn-wrapper"><a href="%2$s" class="btn">%1$s</a></div>',
			'image_format'     		=> '<a href="%2$s">%1$s</a>',
			'social_format'            => '<li><a href="%2$s" title="Twitter" class="socials-link" target="_blank"><i class="fa fa-%1$s"></i></a></li>',
		);
		$html_options = array_merge( $defaults, $html_options );
		return $html_options;
	}
	private function get_thumb_size() {
		$params = Medicplus_Core_Params::get( 'block-image-size', 'department' );
		$this->attributes['thumb-size'] = Medicplus_Core_Util::get_thumb_size( $params, $this->attributes );
	}
}