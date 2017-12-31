<?php
class Medicplus_Core_Faq extends Medicplus_Core_Custom_Post_Model {

	private $post_type = 'medicplus_faq';
	private $post_taxonomy = 'medicplus_faq_cat';
	private $html_format;

	public function __construct() {
		$this->meta_attributes();
		$this->set_meta_attributes();
		$this->post_meta_prefix = $this->post_type . '_';
		$this->taxonomy_cat = $this->post_taxonomy;
	}
	public function meta_attributes() {
		$meta_atts = array(
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
			'limit_post'            => '',
			'offset_post'         	=> '',
			'sort_by'             	=> '',
			'list_faq'      		=> '',
			'extra_class' 			=> '',
			'method'				=> 'cat',
			'list_cat'				=> ''
		);

		$atts = array_merge( $default_atts, $atts );

		if( $atts['method'] == 'cat' ) {
			$atts['post_id'] = $this->parse_cat_slug_to_post_id( 
										'medicplus_faq_cat',
										$atts['list_cat'],
										'medicplus_faq'
									);
		} else {
			$atts['post_id'] = $this->parse_list_to_array( 'faq', $atts['list_faq'] );
		}

		$atts['offset_post'] = absint( $atts['offset_post'] );
		
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
	}
	public function reset(){
		wp_reset_postdata();
	}
	/****************/
	/**** RENDER ****/
	/****************/
	public function render_sc( $html_options = array() ) {
		$this->html_format = $this->set_default_options( $html_options );
		$count_post = 0;
		if( $this->query->have_posts() ) {
			while ( $this->query->have_posts() ) {
				$this->query->the_post();
				$this->loop_index();
				$active = '';
				$expanded = 'false';
				$collapsed = '';
				$in = '';
				if( $count_post == 0 ) {
					$active = ' active';
					$expanded = 'true';
					$in = ' in';
				} else {
					$collapsed = ' class="collapsed"';
				}
				$html_options = $this->html_format;
					printf( $html_options['html_format'], $count_post, $this->attributes['uniq_id'], $active, $expanded, $collapsed, $in, $this->get_title( ), $this->get_content( )
				);
				$count_post++;
			}
			$this->reset();
		}
	}

	/*******************/
	/* FUNCTION CUSTOM */
	/*******************/

	public function set_default_options( $html_options = array() ) {
		$defaults = array(
			'title_format'             => '<a href="%2$s" class="title">%1$s</a>',
			'excerpt_format'                         => '<div class="agent-des">%1$s</div>',
			'category_format'          => '<p class="job">%1$s</p>',
			'image_format'             => '<a class="%3$s" href="%2$s">%1$s</a>',
			'description_format'             => '%1$s',
			'position_format'             => '%1$s',
			'address_format'             => '%1$s',
			'phone_format'             => '<div class="agent-phone"><p class="text">%1$s</p><i class="sh-icon fa fa-mobile-phone"></i></div>',
			'email_format'             => '<div class="info"><div class="email"><i class="fa fa-envelope-o"></i><span>%1$s</span></div></div>',
			'skype_format'             => '<a href="#" class="agent-skype"><p class="text">%1$s</p><i class="sh-icon fa fa-skype"></i></a>',
			'phone_single_format'      => '<div class="col-md-4 col-xs-6 agent-single-info"><i class="sh-icon fa fa-mobile-phone"></i><span class="text">%1$s</span></div>',
			'skype_single_format'      => '<div class="col-md-4 col-xs-6 agent-single-info skype"><i class="sh-icon fa fa-skype"></i><a href="#" class="text">%1$s</a></div>',
			'social_format'            => '<li><a href="%2$s" class="social-expert"><i class="expert-icon fa fa-%1$s"></i></a></li>',
			'properties_format'        => '<div><a href="%2$s" class="agent-property"><p class="text">%1$s</p><i class="sh-icon fa fa-angle-right"></i></a></div>',
			'thumb_href_class'         => ''
		);
		$html_options = array_merge( $defaults, $html_options );
		return $html_options;
	}
}