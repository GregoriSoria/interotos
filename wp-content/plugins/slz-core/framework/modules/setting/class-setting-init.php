<?php
/**
 * Setting_Init class.
 * 
 * @since 1.0
 */

class Medicplus_Core_Setting_Init {
	/**
	 * Regist scripts - admin
	 * 
	 */
	public function enqueue(){
		$uri = SLZCORE_ASSET_URI;
		$protocol = is_ssl() ? 'https' : 'http';
		// css
		wp_enqueue_style( 'medicplus-core-admin',        $uri . '/css/medicplus-core-admin.css', false, SLZCORE_VERSION, 'all' );
		wp_enqueue_style( 'font-awesome.min',               $uri . '/libs/font-awesome/css/font-awesome.min.css', false, '4.4.0', 'all' )
		;
		// js
		wp_enqueue_media();

		//-----------------enqueue script to run ajax-------------------------- 
		wp_enqueue_script( 'medicplus-core-form', $uri . '/js/medicplus-core-form.js', array('jquery'), SLZCORE_VERSION, true );
		wp_localize_script(
				'medicplus-core-form',
				'ajaxurl',
				esc_url(admin_url( 'admin-ajax.php' ))
		);
		wp_enqueue_script( 'jquery.datetimepicker.min',   $uri . '/libs/datetimepicker/jquery.datetimepicker.min.js', array(), SLZCORE_VERSION, false );
		wp_enqueue_script( 'medicplus-core-common',    $uri . '/js/medicplus-core-common.js', array('jquery'), SLZCORE_VERSION, false );
		wp_enqueue_script( 'medicplus-core-admin',     $uri . '/js/medicplus-core-admin.js', array('jquery'), SLZCORE_VERSION, false );

		wp_enqueue_script( 'medicplus-core-metabox',   $uri . '/js/medicplus-core-metabox.js', array('jquery'), SLZCORE_VERSION, false );
		wp_enqueue_script( 'medicplus-core-datepicker',$uri . '/js/medicplus-core-datetimepicker.js', array('jquery'), SLZCORE_VERSION, false );
		wp_enqueue_script( 'medicplus-core-image',     $uri . '/js/medicplus-core-image.js', array('jquery'), SLZCORE_VERSION, false );

		
		wp_localize_script( 'medicplus-core-image', 'slz_meta_image',
				array(
					'title' => esc_html__( 'Choose or Upload an Image', 'slz-core' ),
					'button' => esc_html__( 'Use this image', 'slz-core' ),
				)
		);

		

		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'medicplus-core-metacolor', $uri . '/js/medicplus-core-metacolor.js', array( 'wp-color-picker' ) );
		
		wp_enqueue_script( 'jquery.tooltipster.min', $uri . '/libs/tooltipster/jquery.tooltipster.min.js', array(), SLZCORE_VERSION, true );
		
		// css for shortcode 
		wp_enqueue_style( 'jquery.datetimepicker', $uri . '/libs/datetimepicker/jquery.datetimepicker.css', array(), SLZCORE_VERSION );

		// select2
		wp_enqueue_style( 'select2.min', $uri . '/libs/select2/css/select2.min.css', array(), SLZCORE_VERSION );
		wp_enqueue_script( 'select2.full.min', $uri . '/libs/select2/js/select2.full.min.js', array( 'jquery' ), SLZCORE_VERSION );
	}

	/**
	 * Scripts & Css - frondend
	 */
	public function dev_enqueue_scripts(){
		$uri = SLZCORE_ASSET_URI;
		$protocol = is_ssl() ? 'https' : 'http';
		// css
		wp_enqueue_style( 'owl.carousel',             $uri . '/libs/owl-carousel/assets/owl.carousel.css');
		wp_enqueue_style( 'jquery.fancybox',          $uri . '/libs/fancybox/source/jquery.fancybox.css');
		wp_enqueue_style( 'jquery.fancybox-buttons',  $uri . '/libs/fancybox/source/helpers/jquery.fancybox-buttons.css');
		wp_enqueue_style( 'jquery.fancybox-thumbs',   $uri . '/libs/fancybox/source/helpers/jquery.fancybox-thumbs.css');
		
		wp_enqueue_style( 'slick',                    $uri . '/libs/slick-slider/slick.css');
		wp_enqueue_style( 'slick-theme',              $uri . '/libs/slick-slider/slick-theme.css');
		wp_enqueue_style( 'jquery.selectbox',         $uri . '/libs/selectbox/css/jquery.selectbox.css' );
		wp_enqueue_style( 'jquery.datetimepicker',    $uri . '/libs/datetimepicker/jquery.datetimepicker.css');

		// js
		//datetime picker
		wp_enqueue_script( 'jquery.datetimepicker.min',   $uri . '/libs/datetimepicker/jquery.datetimepicker.min.js', array(), false, true );
		
		//fancybox
		wp_enqueue_script( 'jquery.fancybox',             $uri . '/libs/fancybox/source/jquery.fancybox.js', array(), false, true );
		wp_enqueue_script( 'jquery.fancybox-pack',        $uri . '/libs/fancybox/source/jquery.fancybox.pack.js', array(), false, true );
		wp_enqueue_script( 'jquery.fancybox-buttons',     $uri . '/libs/fancybox/source/helpers/jquery.fancybox-buttons.js', array(), false, true );
		wp_enqueue_script( 'jquery.fancybox-media',       $uri . '/libs/fancybox/source/helpers/jquery.fancybox-media.js', array(), false, true );
		wp_enqueue_script( 'jquery.fancybox-thumbs',      $uri . '/libs/fancybox/source/helpers/jquery.fancybox-thumbs.js', array(), false, true );
		wp_enqueue_script( 'jquery.countdown_plugin',     $uri . '/libs/countdown/jquery.plugin.js', array(), false, true );
		wp_enqueue_script( 'jquery.countdown',            $uri . '/libs/countdown/jquery.countdown.js', array(), false, true );


		
		
		//wow
		wp_enqueue_script( 'wow.min',                     $uri . '/libs/wow-js/wow.min.js', array(), false, true );
		//slick
		wp_enqueue_script( 'slick.min',                   $uri . '/libs/slick-slider/slick.min.js', array(), false, true );
		//owl.carousel
		wp_enqueue_script( 'owl.carousel.min',            $uri . '/libs/owl-carousel/owl.carousel.min.js', array(), false, true );
		//appear
		wp_enqueue_script( 'jquery.appear',               $uri . '/libs/appear/jquery.appear.js', array(), false, true );
		//countTo
		wp_enqueue_script( 'jquery.countTo',              $uri . '/libs/count-to/jquery.countTo.js', array(), false, true );
		//isotope
		wp_enqueue_script( 'isotope.min',                 $uri . '/libs/isotope/isotope.min.js', array(), false, true );
		
		wp_enqueue_script( 'jquery.hoverdir',             $uri . '/libs/hoverdir/jquery.hoverdir.js', array(), false, true );
		wp_enqueue_script( 'modernizr',                   $uri . '/libs/hoverdir/modernizr.custom.js', array(), false, true );

		$keyMapAPI = '';
		$keyMapAPIOption = Medicplus_Core::get_theme_option('slz-map-key-api');
		if ( !empty($keyMapAPIOption) ) {
			$keyMapAPI = 'key='.trim($keyMapAPIOption).'&';
		}
		wp_enqueue_script( 'googleapis', $protocol . '://maps.googleapis.com/maps/api/js?'.$keyMapAPI.'sensor=false&amp;libraries=places', array(), false, true );
		
		//-----------------enqueue script to run ajax-------------------------- 
		wp_enqueue_script( 'medicplus-core-form', $uri . '/js/medicplus-core-form.js', array('jquery'), SLZCORE_VERSION, true );
		wp_localize_script(
				'medicplus-core-form',
				'ajaxurl',
				esc_url(admin_url( 'admin-ajax.php' ))
		);
		wp_enqueue_script( 'medicplus-core-shortcode', $uri . '/js/medicplus-core-shortcode.js', array('jquery'), SLZCORE_VERSION, true );
		
		wp_enqueue_script( 'medicplus-core-map',        $uri . '/js/medicplus-core-map.js', array('jquery'), SLZCORE_VERSION, true );
	}
	/**
	 * action using generate inline css
	 * @param string $custom_css
	 */
	public function add_inline_style( $custom_css ) {
		wp_enqueue_style('medicplus-core-custom', SLZCORE_ASSET_URI . '/css/medicplus-core-custom.css', array(), SLZCORE_VERSION);
		wp_add_inline_style( 'medicplus-core-custom', $custom_css );
	}
	//********************* Post << *********************
	/**
	 * Add columns to post type list screen.
	 *
	 * @param array $columns Existing columns.
	 * @return array Amended columns.
	 */
	public function add_medicplus_faq_columns( $columns ) {
		$defaults = array(
			'cb'               => '',
			'title'            => '',
			'slzcore-category' => esc_html__( 'Categories', 'slz-core' ),
			'date'             => '',
		);
		$columns = array_merge( $defaults, $columns );
		return $columns;
	}
	public function add_medicplus_team_columns( $columns ) {
		$defaults = array(
			'cb'                 => '',
			'slzcore-thumbs'     => esc_html__( 'Thumbnail', 'slz-core' ),
			'title'              => '',
			'slzcore-category'   => esc_html__( 'Categories', 'slz-core' ),
			'slzcore-department' => esc_html__( 'Departments', 'slz-core' ),
			'date'               => '',
		);
		$columns = array_merge( $defaults, $columns );
		return $columns;
	}
	public function add_medicplus_service_columns( $columns ) {
		$defaults = array(
			'cb'                 => '',
			'slzcore-thumbs'     => esc_html__( 'Thumbnail', 'slz-core' ),
			'title'              => '',
			'slzcore-category'   => esc_html__( 'Categories', 'slz-core' ),
			'slzcore-icons'       => esc_html__( 'Service Icon', 'slz-core' ),
			'date'               => '',
		);
		$columns = array_merge( $defaults, $columns );
		return $columns;
	}
	public function add_medicplus_dept_columns( $columns ) {
		$defaults = array(
			'cb'                 => '',
			'slzcore-thumbs'     => esc_html__( 'Thumbnail', 'slz-core' ),
			'title'              => '',
			'slzcore-category'   => esc_html__( 'Categories', 'slz-core' ),
			'slzcore-dept-head'  => esc_html__( 'Department Head', 'slz-core' ),
			'date'               => '',
		);
		$columns = array_merge( $defaults, $columns );
		return $columns;
	}
	public function add_medicplus_appoint_columns( $columns ) {
		$defaults = array(
			'cb'                 => '',
			'title'              => '',
			'slzcore-category'   => esc_html__( 'Categories', 'slz-core' ),
			'slzcore-status'     => esc_html__( 'Status', 'slz-core' ),
			'date'               => '',
		);
		$columns = array_merge( $defaults, $columns );
		return $columns;
	}
	public function add_medicplus_locate_columns( $columns ) {
		$defaults = array(
			'cb'                 => '',
			'title'              => '',
			'slzcore-category'   => esc_html__( 'Categories', 'slz-core' ),
			'date'               => '',
		);
		$columns = array_merge( $defaults, $columns );
		return $columns;
	}
	public function add_custom_columns( $columns ) {
		global $post;

		$defaults = array(
			'cb'               => '',
			'slzcore-thumbs'   => esc_html__( 'Thumbnail', 'slz-core' ),
			'title'            => '',
			'slzcore-category' => esc_html__( 'Categories', 'slz-core' ),
			'date'             => '',
		);
		$columns = array_merge( $defaults, $columns );
		return $columns;
	}
	
	/**
	 * Custom column callback
	 *
	 * @param string $column Column ID.
	 */
	public function display_custom_columns( $column ){
		global $post;
		if ( ! $post ) return '';
		$post_id = $post->ID;
		$post_type = get_post_type();
		$method_name = $post_type . '_columns';
		if ( method_exists( $this, $method_name ) ) {
			$this->$method_name( $column, $post_id, $post_type );
		}
		switch ( $column ) {
			case 'slzcore-thumbs':
				$opts = array(
					'post_id'    => $post_id,
					'size'       => array( 100, 100 ),
					'post_title' => $post->post_title,
				);
				echo Medicplus_Core_Util::get_thumb_image( $opts );
				break;
			case 'slzcore-category':
				$taxonomy_cat = $post_type . '_cat';
				$term = $this->get_taxonomy_column( $taxonomy_cat, $post_id, $post_type );
				echo wp_kses_post($term);
				break;
			case 'slzcore-status':
				$taxonomy_cat = $post_type . '_status';
				$term = $this->get_taxonomy_column( $taxonomy_cat, $post_id, $post_type );
				echo wp_kses_post($term);
				break;
			case 'slzcore-dept-head':
				$val = absint(get_post_meta( $post_id, $post_type . '_department_head', true));
				if( $val ) {
					$model = new Medicplus_Core_Team();
					$model->get_custom_post($val);
					if( $model->title ) {
						echo '<a href="'.esc_url( get_edit_post_link($val) ).'" >'.esc_html($model->title).'</a>';
					}
				}
				break;
			case 'slzcore-department':
				$val = get_post_meta( $post_id, $post_type . '_department', true);
				$dept_arr = array();
				if( $val ) {
					if(! is_array($val) ) {
						$dept_arr[] = $val;
					} else {
						$dept_arr = $val;
					}
					$links = array();
					foreach($dept_arr as $dept){
						if( $dept ) {
							$model = new Medicplus_Core_Department();
							$model->get_custom_post($dept);
							if( $model->title ) {
								$links[] = '<a href="'.esc_url( get_edit_post_link($dept) ).'" >'.esc_html($model->title).'</a>';
							}
						}
					}
					if( $links ) {
						echo implode(', ', $links);
					}
					
				}
				break;
			case 'slzcore-icons':
				$val = get_post_meta( $post_id, $post_type . '_icon', true);
				if( $val ) {
					echo '<div class="glyph"><span class="'.esc_attr($val).'"></span><span class="mls">'.esc_attr($val).'</span></div>';
				}
				break;
		}
	}
	private function get_taxonomy_column( $taxonomy, $post_id, $post_type ) {
		$term = '';
		if( taxonomy_exists( $taxonomy ) ) {
			// add separator for two or more terms
			$separtor = ', ';
			// get lists of term associated in the current post type
			$terms = get_the_terms( $post_id, $taxonomy );
			$links = array();
			if( $terms ) {
				foreach ( $terms as $term ) {
					// get link
					$term_link = esc_url(home_url('/')).'/wp-admin/edit.php?post_type='.$post_type.'&'.$taxonomy.'='.$term->slug;
					// the function explain its purpose
					if( is_wp_error( $term_link ) )
						continue;
					$links[] = '<a href="'.$term_link.'">'.$term->name.'</a>';
				}
			}
			$term = implode( $separtor, $links );
		}
		return $term;
	}
	/**
	 * Add columns to post type list
	 */
	public function manage_custom_columns(){
		$post_types = Medicplus_Core_Config::get( 'post_type', 'custom_column' );
		if( $post_types ) {
			foreach( $post_types as $pt ) {
				$method_name = 'add_'.$pt.'_columns';
				if( method_exists( $this, $method_name)) {
					add_filter( 'manage_edit-'. $pt .'_columns', array( 'Medicplus_Core', '[setting.Setting_Init, add_'. $pt .'_columns]' ) );
				} else {
					add_filter( 'manage_edit-'. $pt .'_columns', array( 'Medicplus_Core', '[setting.Setting_Init, add_custom_columns]' ) );
				}
				add_action( 'manage_'. $pt .'_posts_custom_column', array( 'Medicplus_Core', '[setting.Setting_Init, display_custom_columns]' ) );
			}
		}
	}
	/**
	 * Add meta box feature video to post type
	 */
	public function add_metabox_feature_video() {
		$post_types = Medicplus_Core_Config::get( 'post_type', 'feature_video' );
		if( $post_types ) {
			foreach( $post_types as $post_type ) {
				add_meta_box( 'slzcore_mbox_feature_video', 'Featured Video', array( 'Medicplus_Core', '[posttype.Post_Controller, metabox_feature_video]' ), $post_type, 'normal', 'high' );
			}
		}
	}
	/**
	 * Save feature video to post type
	 */
	public function save_feature_video( $post_id ) {
		$metakey = SLZCORE_THEME_PREFIX .'_feature_video';
		if( isset( $_POST[$metakey] ) ) {
			if( !isset($_POST[$metakey]['generate_thumnail']) ) {
				$_POST[$metakey]['generate_thumnail'] = '';
			}
			update_post_meta( $post_id, $metakey, $_POST[$metakey] );
			if( $_POST[$metakey]['generate_thumnail'] ) {
				$model = new Medicplus_Core_Video_Model();
				$model->get_video_thumb( $post_id, $metakey );
			}
		}
	}
	//********************* Post >> *********************
}