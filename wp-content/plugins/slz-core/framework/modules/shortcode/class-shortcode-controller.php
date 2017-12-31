<?php
/**
 * Controller Shortcode class.
 *
 * @since 1.0
 */

Medicplus_Core::load_class('Abstract');

class Medicplus_Core_Shortcode_Controller extends Medicplus_Core_Abstract {

	//[slz_module cl="shortcode.Shortcode_Controller" mt="shortcode_test" atr1="test" atr2="tesatres"]content[/slz_module]
	public function module( $atts, $content = null ) {
		if( ! empty( $atts['cl'] ) && ! empty( $atts['mt'] ) ) {
			if( Medicplus_Core::load_class( $atts['cl'] ) ) {
				return Medicplus_Core::new_object( $atts['cl'] )->{$atts['mt']}( $atts, $content );
			}
		}
	}

	/**
	 * Service
	 */
	public function service( $atts, $content = null ) {
		$default = array(
			'style' 				=> '1',
			'column' 				=> '4',
			'align' 				=> 'left', //style 2
			'align_2' 				=> 'left', //style 3
			'btn_readmore' 			=> 'Read more', //style 3
			'offset_post'         	=> '',
			'limit_post'          	=> '',
			'sort_by'             	=> '',
			'method' 				=> 'cat',
			'category' 				=> '',
			'list_service' 			=> '',
			'color_icon' 			=> '', // style 1
			'color_icon_multi' 		=> '', // style 2
			'color_line' 			=> '', // style 1
			'color_title' 			=> '',
			'color_title_hv' 			=> '', // style 1
			'color_text' 			=> '', 
			'color_text_hv' 		=> '', // style 1
			'color_readmore' 		=> '', // style 3
			'color_readmore_hv' 	=> '', // style 3
			'color_border' 			=> '', // style 1,3
			'color_border_hv' 		=> '', // style 3
			'color_background' 		=> '', // style 1
			'extra_class' 			=> '',
		);
		$data = Medicplus_Core::set_shortcode_defaults( $default, $atts);
		if(isset($atts['list_service'])){
			$list_service = (array) vc_param_group_parse_atts( $atts['list_service'] );
			$data['list_service'] = $list_service;
		}
		if(isset($atts['color_icon_multi'])){
			$color_icon_multi = (array) vc_param_group_parse_atts( $atts['color_icon_multi'] );
			$data['color_icon_multi'] = $color_icon_multi;
		}
		if( empty( $data['category_slug'] ) ) {
			list( $data['category_list_parse'], $data['category_slug'] ) = Medicplus_Core_Util::get_list_vc_param_group( $data, 'category', 'category_slug' );
		}
		return $this->render( 'service', array( 'atts' => $data ), true );
	}

	/**
	 * Testimonial
	 */
	public function testimonial( $atts, $content = null ) {
		$default = array(
			'layout'              	=> 'testimonial',
			'offset_post'         	=> '',
			'limit_post'          	=> '',
			'sort_by'             	=> '',
			'category_list'      	=> '',
			'style'         		=> '1',
			'image_circle'         	=> '',
			'column'         		=> '', //style 2
			'icon_color'         	=> '',
			'icon_background'       => '', //style 2
			'nav_color'       		=> '', //style 2
			'line_color'         	=> '',
			'border_color'         	=> '', //style 2
			'name_color'      		=> '',
			'text_color'      		=> '',
			'auto_speed'           	=> '5000',
			'speed'           		=> '',
			'extra_class'         	=> '',
		);
		$data = Medicplus_Core::set_shortcode_defaults( $default, $atts);
		if( empty( $data['category_slug'] ) ) {
			list( $data['category_list_parse'], $data['category_slug'] ) = Medicplus_Core_Util::get_list_vc_param_group( $data, 'category_list', 'category_slug' );
		}
		return $this->render( 'testimonial', array( 'atts' => $data ), true );
	}

	/**
	 * Department
	 */
	public function department( $atts, $content = null ) {
		$default = array(
			'layout'              	=> 'department',
			'offset_post'         	=> '0',
			'limit_post'          	=> '5',
			'sort_by'             	=> '',
			'pagination'      		=> 'yes',
			'category_list'       	=> '',
			'show_dep_head'  		=> 'yes',
			'show_dep_head_info'  	=> 'yes',
			'button_text'  			=> '',
			'main_color'  			=> '',
			'line_color'  			=> '',
			'extra_class'         	=> '',
		);
		$data = Medicplus_Core::set_shortcode_defaults( $default, $atts);
		if( empty( $data['category_slug'] ) ) {
			list( $data['category_list_parse'], $data['category_slug'] ) = Medicplus_Core_Util::get_list_vc_param_group( $data, 'category_list', 'category_slug' );
		}
		return $this->render( 'department', array( 'atts' => $data, 'content' => $content ), true );
	}
	
	/**
	 * Team Simple
	 */
	public function team_simple( $atts, $content = null ) {
		$default = array(
			'layout'              	=> 'team',
			'style'         		=> '1',
			'is_container'         	=> '',
			'team_id' 				=> '',
			'title_color'  			=> '',
			'position_color'  		=> '',
			'icon_color'  			=> '',
			'text_color'  			=> '',
			'hover_color'  			=> '',
			'background_color'  	=> '',
			'extra_class'         	=> '',
		);
		$data = Medicplus_Core::set_shortcode_defaults( $default, $atts);
		return $this->render( 'team_simple', array( 'atts' => $data, 'content' => $content ), true );
	}
	
	/**
	 * Team Grid
	 */
	public function team_grid( $atts, $content = null ) {
		$default = array(
			'layout'              	=> 'team',
			'column' 				=> '4',
			'offset_post'           => '0',
			'sort_by'             	=> '',
			'limit_post'            => '',
			'method' 				=> 'cat',
			'category_list' 		=> '',
			'team_list' 			=> '',
			'title_color'  			=> '',
			'title_hv_color'  		=> '',
			'position_color'  		=> '',
			'icon_hv_color'  		=> '',
			'border_color'  		=> '',
			'border_hv_color'  		=> '',
			'panel_color'  			=> '',
			'panel_hv_color'  		=> '',
			'extra_class'         	=> '',
		);
		$data = Medicplus_Core::set_shortcode_defaults( $default, $atts);
		if(isset($atts['team_list'])){
			$team_list = (array) vc_param_group_parse_atts( $atts['team_list'] );
			$data['team_list'] = $team_list;
		}
		if( empty( $data['category_slug'] ) ) {
			list( $data['category_list_parse'], $data['category_slug'] ) = Medicplus_Core_Util::get_list_vc_param_group( $data, 'category_list', 'category_slug' );
		}
		return $this->render( 'team_grid', array( 'atts' => $data, 'content' => $content ), true );
	}

	/**
	 * Team Carousel
	 */
	public function team_carousel( $atts, $content = null ) {
		$default = array(
			'layout'              	=> 'team',
			'column' 				=> '4',
			'offset_post'           => '0',
			'sort_by'             	=> '',
			'limit_post'            => '',
			'method' 				=> 'cat',
			'category_list' 		=> '',
			'team_list' 			=> '',
			'title_color'  			=> '',
			'title_hv_color'  		=> '',
			'position_color'  		=> '',
			'icon_hv_color'  		=> '',
			'border_color'  		=> '',
			'border_hv_color'  		=> '',
			'panel_color'  			=> '',
			'panel_hv_color'  		=> '',
			'auto_speed'           	=> '3000',
			'speed'           		=> '1000',
			'extra_class'         	=> '',
		);
		$data = Medicplus_Core::set_shortcode_defaults( $default, $atts);
		if(isset($atts['team_list'])){
			$team_list = (array) vc_param_group_parse_atts( $atts['team_list'] );
			$data['team_list'] = $team_list;
		}
		if( empty( $data['category_slug'] ) ) {
			list( $data['category_list_parse'], $data['category_slug'] ) = Medicplus_Core_Util::get_list_vc_param_group( $data, 'category_list', 'category_slug' );
		}
		return $this->render( 'team_carousel', array( 'atts' => $data, 'content' => $content ), true );
	}
	
	/**
	 * FAQS
	 */
	public function faqs( $atts, $content = null ) {
		$default = array(
			'limit_post'            => '',
			'offset_post'         	=> '',
			'sort_by'             	=> '',
			'list_faq'      		=> '',
			'extra_class' 			=> '',
			'method'				=> 'cat',
			'list_cat'				=> '',
			'active_color'			=> ''
		);
		$data = Medicplus_Core::set_shortcode_defaults( $default, $atts);

		if( empty( $data['category_slug'] ) ) {
			list( $data['category_list_parse'], $data['category_slug'] ) = Medicplus_Core_Util::get_list_vc_param_group( $data, 'list_cat', 'faq_category' );
		}

		if( $data['method'] == 'faq' && !empty($data['list_faq'])){
			$list_faq = (array) vc_param_group_parse_atts( $data['list_faq'] );
			$data['list_faq'] = $list_faq;
		}

		$data['id'] = Medicplus_Core::make_id();
		return $this->render( 'faqs', array( 'atts' => $data ), true );
	}


	/**
	 * Banners
	 */
	public function banner( $atts, $content = null ) {
		$default = array(
			'style'            		=> '1',
			'title'            		=> '',
			'title_color'         	=> '',
			'image'             	=> '',
			'image_height'          => '',
			'background'      		=> '',
			'array_button'      	=> '',
			'btn_url'      			=> '',
			'btn_text'      		=> '',
			'text_color'            => '',
			'border_color'          => '',
			'bg_color'              => '',
			'text_hov_color'        => '',
			'border_hov_color'      => '',
			'bg_hov_color'          => '',
			'extra_class' 			=> '',
			'background_color' 		=> '',
			'full_width' 			=> 'false',
			'description_color'	    => '',
			'bg_transparent'        => '',
		);
		$data = Medicplus_Core::set_shortcode_defaults( $default, $atts);
		if(!empty($atts['array_button'])){
			$array_button = (array) vc_param_group_parse_atts( $atts['array_button'] );
			if(!empty($array_button) && !empty($array_button[0])){
				$data['array_button'] = $array_button;
			}
		}
		$data['id'] = Medicplus_Core::make_id();
		$data['content'] = $content;
		return $this->render( 'banner', array( 'atts' => $data ), true );
	}

	/**
	 * Block Title
	 */
	public function block_title( $atts, $content = null ) {
		$default = array(
			'title'					=> '',
			'title_color'			=> '',
			'txt_content'           => '',
			'content_color'			=> '',
			'use_description'		=> '',
			'description'			=> '',
			'description_color'		=> '',
			'alignment'				=> 'left',
			'separator_line'		=> 'false',
			'separator_color'		=> '',
			'extra_class' 			=> ''
		);
		$data = Medicplus_Core::set_shortcode_defaults( $default, $atts);
		$data['id'] = Medicplus_Core::make_id();
		return $this->render( 'block_title', $data, true );
	}

	/**
	 * Counter Factor
	 */
	public function number_factor( $atts, $content = null ) {
		$default = array(
			'title'					=> '',
			'counter'				=> '0',
			'title_color'			=> '',
			'number_color'			=> '',
			'extra_class' 			=> ''
		);
		$data = Medicplus_Core::set_shortcode_defaults( $default, $atts);
		$data['counter'] = intval ( $data['counter'] );
		$data['id'] = Medicplus_Core::make_id();
		return $this->render( 'number_factor', $data, true );
	}

	/**
	 * Toggle Box
	 */
	public function toggle_box( $atts, $content = null ) {
		$default = array(
			'extra_class'        => '',
			'active_color'       => '',
			'inactive_color'     => '',
			'title_color'        => '',
			'content_color'      => '',
			'title_color_hover'  => '',
			'toggle_content'     => '',
		);
		$data = Medicplus_Core::set_shortcode_defaults( $default, $atts);
		if( !empty( $data['toggle_content'] ) ){
			$toggle_content = vc_param_group_parse_atts( $data['toggle_content'] );
			$data['values'] = $toggle_content;
		}
		$data['id'] = Medicplus_Core::make_id();
		return $this->render( 'toggle_box', $data, true );
	}
	
	/**
	 * Button
	 */
	public function button( $atts, $content = null ) {
		$default = array(
			'title'					=> '',
			'alignment'				=> '',
			'url'					=> '',
			'open_form'				=> '',
			'contact_form'			=> '',
			'button_color'			=> '',
			'button_color_hover'	=> '',
			'text_color'			=> '',
			'text_color_hover'		=> '',
			'border_color'			=> '',
			'border_color_hover'	=> '',
			'extra_class'			=> '',
			'bg_transparent'		=> '',
		);
		$data = Medicplus_Core::set_shortcode_defaults( $default, $atts);
		$data['id'] = Medicplus_Core::make_id();
		if ( !empty($data['url']) ) {
			$data['url'] = Medicplus_Core_Util::get_link($data['url']);
		}
		return $this->render( 'button', $data, true );
	}

	/**
	 * Item List
	 */
	public function item_list( $atts, $content = null ) {
		$default = array(
			'text_color'			=> '',
			'icon_color'			=> '',
			'extra_class'			=> ''
		);
		$data = Medicplus_Core::set_shortcode_defaults( $default, $atts);
		if( !empty( $atts['array_content'] ) ){
			$content = vc_param_group_parse_atts( $atts['array_content'] );
			$data['values'] = $content;
		}
		$data['id'] = Medicplus_Core::make_id();
		return $this->render( 'item_list', $data, true );
	}
	/**
	 * Contact
	 */
	public function contact( $atts, $content = null ) {
		$default = array(
			'header'                => '',
			'title'                 => '',
			'description'           => '',
			'contact_form'          => '',
			'height'                => '400',
			'width'                 => '500',
			'address'               => '',
			'phone'                 => '',
			'zoom'                  => '10',
			'extra_class'           => ''
		);
		$data = Medicplus_Core::set_shortcode_defaults( $default, $atts);
		$data['id'] = Medicplus_Core::make_id();
		return $this->render( 'contact', $data, true );
	}
	public function news_carousel( $atts ,$content = null) {
		$default = array(
			'layout'              => 'carousel',
			'style'               => 'news_carousel_1',
			'limit_post'          => '',
			'excerpt_length'      => '15',
			'offset_post'         => '0',
			'sort_by'             => '',
			'extra_class'         => '',
			'category_list'       => '',
			'tag_list'            => '',
			'author_list'         => '',
			'post_filter_by'      => '',
		);
		$data = Medicplus_Core::set_shortcode_defaults( $default, $atts);
		$data['content'] = $content;
		return $this->render( 'news_carousel', array( 'atts' => $data ), true );
	}
	public function news_block( $atts ,$content = null) {
		$default = array(
			'layout'              => 'block_news',
			'limit_post'          => '',
			'excerpt_length'      => '15',
			'offset_post'         => '0',
			'sort_by'             => '',
			'extra_class'         => '',
			'category_list'       => '',
			'tag_list'            => '',
			'author_list'         => '',
			'post_filter_by'      => '',
		);
		$data = Medicplus_Core::set_shortcode_defaults( $default, $atts);
		$data['content'] = $content;
		return $this->render( 'news_block', array( 'atts' => $data ), true );
	}
	public function news_grid( $atts ,$content = null) {
		$default = array(
			'layout'              => 'grid_news',
			'style'               => '1',
			'column'              => '1',
			'col'                 => '1',
			'read_more_link'      => '',
			'limit_post'          => '',
			'excerpt_length'      => '',
			'offset_post'         => '0',
			'sort_by'             => '',
			'pagination'          => 'yes',
			'max_post'            => '',
			'extra_class'         => '',
			'category_list'       => '',
			'tag_list'            => '',
			'author_list'         => '',
		);
		$data = Medicplus_Core::set_shortcode_defaults( $default, $atts);
		$data['content'] = $content;
		return $this->render( 'news_grid', array( 'atts' => $data ), true );
	}
	/**
	 * Icon Box
	 */
	public function icon_box( $atts, $content = null ){
		$default = array(
			'style_icon'     => '',
			'color'          => '',
			'icon_type'      => '',
			'icon_fw'        => '',
			'icon_ex'        => '',
			'title'          => '',
			'description'    => '',
			'extra_class'    => '',
			'color_icon'     => '',
			'color_hover'	 => '',
			'alignment'	 	 => 'left',
			'title_color'	 => '',
			'description_color'	 => '',
		);
		$data = Medicplus_Core::set_shortcode_defaults( $default, $atts);
		$data['id'] = Medicplus_Core::make_id();
		return $this->render( 'icon_box', $data, true );
	}
	/**
	 * Appointment
	 */
	public function appointment( $atts ,$content = null) {
		$default = array(
			'style'						=> '1',
			'is_container'				=> '', // style 4 
			'title_box'					=> '',
			'title'						=> '', // style 3
			'description'				=> '', // style 3
			'contact_form'				=> '',
			'color_error'				=> '',
			'background_box'			=> '',
			'border_box'				=> '', // style 3
			'background_head'			=> '', // style 1,2,3
			'color_text_head'			=> '',
			'color_line_head'			=> '', // style 3
			'color_title'				=> '', // style 3
			'color_input'				=> '',
			'color_input_line'			=> '',
			'color_text_button'			=> '',
			'color_text_button_hv'		=> '',
			'background_button'			=> '',
			'background_button_hv'		=> '',
			'border_button'				=> '',
			'border_button_hv'			=> '',
			'extra_class'				=> '',
		);
		$data_arr =  Medicplus_Core::set_shortcode_defaults( $default, $atts);
		$data_arr['id'] = Medicplus_Core::make_id();
		$data_arr['content'] = $content;
		return $this->render( 'appointment', $data_arr, true );
	}

	/**
	 * Carousel
	 */
	public function carousel( $atts, $content = null ) {
		$default = array(
			'style'           => '1',
			'images'          => '',
			'height'          => '',
			'background'      => '',
			'extra_class'     => ''
		);
		$data = Medicplus_Core::set_shortcode_defaults( $default, $atts);
		$data['id'] = Medicplus_Core::make_id();
		return $this->render( 'carousel', $data, true );
	}
	/**
	 * Gallery
	 */
	public function gallery( $atts, $content = null ) {
		$default = array(
			'style'					=> '1',
			'layout'				=> 'gallery',
			'column'				=> '2', // style 1
			'offset_post'			=> '',
			'limit_post'			=> '',
			'sort_by'				=> '',
			'category_list'			=> '',
			'show_filter'			=> 'yes',
			'title_all'				=> '',
			'title_button'			=> '',
			'color_filter'			=> '',
			'color_filter_hv'		=> '',
			'color_filter_line'		=> '',
			'background_item'		=> '',
			'color_item_text'		=> '',
			'background_button'		=> '',
			'background_button_hv'	=> '',
			'color_button'			=> '',
			'color_button_hv'		=> '',
			'extra_class'			=> '',
		);
		$data = Medicplus_Core::set_shortcode_defaults( $default, $atts);
		if( empty( $data['category_slug'] ) ) {
			list( $data['category_list_parse'], $data['category_slug'] ) = Medicplus_Core_Util::get_list_vc_param_group( $data, 'category_list', 'category_slug' );
		}
		return $this->render( 'gallery', array( 'atts' => $data ), true );
	}
	/**
	 * Feature Item
	 */
	public function feature_item( $atts, $content = null ) {
		$default = array(
			'style'              => '1',
			'number_item'        => '4',
			'feature_list'       => '',
			'extra_class'        => '',
			'line_color'         => '',
			'line_hover_color'   => '',
		);
		$data = Medicplus_Core::set_shortcode_defaults( $default, $atts);
		$data['feature_list'] = (array) vc_param_group_parse_atts( $atts['feature_list'] );
		$data['id'] = Medicplus_Core::make_id();
		return $this->render( 'feature_item', $data, true );
	}
	/**
	 * Image_List
	 */
	public function image_list( $atts, $content = null ) {
		$default = array(
			'style_image'     => '1',
			'url'             => '',
			'images'          => '',
			'image_link'      => '',
			'title'           => '',
			'array_image'     => '',
			'extra_class'     => '',
			'array_image_list' => '',
		);
		$data = Medicplus_Core::set_shortcode_defaults( $default, $atts);
		if( !empty($data['array_image']) ) {
			$data['array_image_list'] = (array) vc_param_group_parse_atts( $data['array_image'] );
		}
		$data['id'] = Medicplus_Core::make_id();
		return $this->render( 'image_list', $data, true );
	}
	/**
	 * Video
	 */
	public function video( $atts, $content = null ) {
		$default = array(
			'image_bg'      => '',
			'extra_class'   => '',
			'image_video'  	=> '',
			'video_type'    => '',
			'id_youtube'	=> '',
			'id_vimeo'     	=> '',
			'height'         => '',
		);
		$data = Medicplus_Core::set_shortcode_defaults( $default, $atts);
		$data['id'] = Medicplus_Core::make_id();
		return $this->render( 'video', $data, true );
	}
	/**
	 * Image Box
	 */
	public function image_box( $atts, $content = null ){
		$default = array(
			'array_image'    => '',
			'title'          => '',
			'description'    => '',
			'extra_class'    => '',
			'color_hover'	 => '',
			'title_color'	 => '',
			'button_txt'	 => '',
			'image'	 		 => '',
			'color_buttom'	 => '',
			'url_btn'	     => '',
			'color_buttom_hover' => '',
			'description_color'	 => '',
		);
		$data = Medicplus_Core::set_shortcode_defaults( $default, $atts);
		$data['id'] = Medicplus_Core::make_id();
		if ( !empty($data['url_btn']) ) {
			$data['url_btn'] = Medicplus_Core_Util::get_link($data['url_btn']);
		}
		return $this->render( 'image_box', $data, true );
	}
	/**
	 * Count Down
	 */
	public function count_down( $atts, $content = null ){
		$default = array(
			'date'           => '',
			'align'          => 'left',
			'show_colon'     => '',
			'text_color'     => '',
			'line_color'     => '',
			'extra_class'	 => '',
		);
		$data = Medicplus_Core::set_shortcode_defaults( $default, $atts);
		$data['id'] = Medicplus_Core::make_id();
		return $this->render( 'count_down', $data, true );
	}

	/**
	 * Location
	 */
	public function location( $atts, $content = null ) {
		$default = array(
			'style' 				=> '1',
			'column' 				=> '2', // style 2
			'is_direction' 			=> 'yes',
			'is_marker_map' 		=> 'yes',
			'offset_post'           => '',
			'sort_by'             	=> '',
			'limit_post'            => '-1',
			'method' 				=> 'cat',
			'category_list' 		=> '',
			'location_list' 		=> '',
			'title_group' 			=> '', // method location
			'color_title_group'  	=> '', // method cat
			'color_title'  			=> '',
			'color_bg_title'  		=> '',
			'color_phone'  			=> '',
			'color_text'  			=> '',
			'color_border'  		=> '', // style 2
			'color_icon'  			=> '',
			'color_link'  			=> '',
			'color_link_hv'  		=> '',
			'color_bg_phonebox'  	=> '',
			'extra_class'         	=> '',
		);
		$data = Medicplus_Core::set_shortcode_defaults( $default, $atts);
		if(isset($atts['location_list'])){
			$location_list = (array) vc_param_group_parse_atts( $atts['location_list'] );
			$data['location_list'] = $location_list;
		}
		if( empty( $data['category_slug'] ) ) {
			list( $data['category_list_parse'], $data['category_slug'] ) = Medicplus_Core_Util::get_list_vc_param_group( $data, 'category_list', 'category_slug' );
		}
		return $this->render( 'location', array( 'atts' => $data, 'content' => $content ), true );
	}
	/**
	 * Location Map
	 */
	public function location_map( $atts, $content = null ) {
		$default = array(
			'function' 				=> '1',
			'offset_post'           => '',
			'sort_by'             	=> 'post__in',
			'limit_post'            => '',
			'location_list' 		=> '',
			'image_icon_marker_big' => '',
			'image_icon_marker' 	=> '',
			'zoom_map'  			=> '',
			'height_map'  			=> '',
			'extra_class'         	=> '',
		);
		$data = Medicplus_Core::set_shortcode_defaults( $default, $atts);
		if(isset($atts['location_list'])){
			$location_list = (array) vc_param_group_parse_atts( $atts['location_list'] );
			$data['location_list'] = $location_list;
		}
		return $this->render( 'location_map', array( 'atts' => $data, 'content' => $content ), true );
	}
}