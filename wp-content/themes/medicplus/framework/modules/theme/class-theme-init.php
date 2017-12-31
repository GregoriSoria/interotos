<?php
/**
 * Theme class.
 * 
 * @author Swlabs
 * @package MedicPlus
 * @since 1.0
 */
Medicplus::load_class( 'Abstract' );
class Medicplus_Theme_Init extends Medicplus_Abstract {
	/**
	 * Register style/script in admin
	 * 
	 */
	public function admin_enqueue(){
		$uri = get_template_directory_uri() . '/assets/admin';
		// css
		wp_enqueue_style( 'medicplus-admin-style', $uri . '/css/medicplus-admin-style.css', false, MEDICPLUS_THEME_VER, 'all' );
		wp_enqueue_style( 'font-awesome.min',         MEDICPLUS_PUBLIC_URI . '/font/font-icon/font-awesome/css/font-awesome.min.css', array(), false );
		wp_enqueue_style( 'medicplus-font-medic',  MEDICPLUS_PUBLIC_URI . '/font/font-icon/font-medic/font-medic.css', array(), MEDICPLUS_THEME_VER );
		// js
		wp_enqueue_media();
		
		wp_enqueue_script( 'medicplus-widget',      $uri . '/js/medicplus-widget.js', array('jquery'), MEDICPLUS_THEME_VER, true );
		//menu
		wp_enqueue_script( 'medicplus-menu',        $uri . '/js/medicplus-menu.js', array('jquery'), MEDICPLUS_THEME_VER, true );
	}

	/**
	 * Register style/script in public
	 */
	public function public_enqueue() {
		$dir_uri = get_template_directory_uri();
		$uri = MEDICPLUS_PUBLIC_URI;

		wp_enqueue_style( 'medicplus-style', get_stylesheet_uri(), array(), MEDICPLUS_THEME_VER );
		//font
		wp_enqueue_style( 'medicplus-fonts',        $this->add_fonts_url(), array(), null );
		wp_enqueue_style( 'font-awesome.min',          $uri . '/font/font-icon/font-awesome/css/font-awesome.min.css', array(), false );
		wp_enqueue_style( 'medicplus-font-medic',   $uri . '/font/font-icon/font-medic/font-medic.css', array(), MEDICPLUS_THEME_VER );

		//libs
		wp_enqueue_style( 'bootstrap.min',             $uri . '/libs/bootstrap/css/bootstrap.min.css', array(), false );
		wp_enqueue_style( 'animate',                   $uri . '/libs/animate/animate.css', array(), false );
		
		wp_enqueue_style( 'bootstrap-datepicker.min',  $uri . '/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css', array(), false );
		wp_enqueue_style( 'mediaelementplayer.min',    $uri . '/libs/video-control/build/mediaelementplayer.min.css', array(), false );

		wp_enqueue_style( 'medicplus-layout',       $uri . '/css/medicplus-layout.css', array(), MEDICPLUS_THEME_VER );
		wp_enqueue_style( 'medicplus-components',   $uri . '/css/medicplus-components.css', array(), MEDICPLUS_THEME_VER );
		wp_enqueue_style( 'medicplus-custom-theme', $uri . '/css/medicplus-custom-theme.css', array(), MEDICPLUS_THEME_VER );
		//------ COMPLILE COLOR--------//
		$seleted_color = Medicplus::get_option('slz-palette-color');;

		switch ($seleted_color) {
			case 'red_blue':
				wp_enqueue_style( 'medicplus-themecolor',	$uri . '/css/theme-color/medicplus-cancer-center.css', array(), MEDICPLUS_THEME_VER );
				break;
			case 'lightgreen_blue':
				wp_enqueue_style( 'medicplus-themecolor',	$uri . '/css/theme-color/medicplus-pediatric.css', array(), MEDICPLUS_THEME_VER );
				break;
			case 'pink_violet_blue':
				wp_enqueue_style( 'medicplus-themecolor',	$uri . '/css/theme-color/medicplus-vet-clinic.css', array(), MEDICPLUS_THEME_VER );
				break;
			case 'orange_blue':
				wp_enqueue_style( 'medicplus-themecolor',	$uri . '/css/theme-color/medicplus-dental-care.css', array(), MEDICPLUS_THEME_VER );
				break;
			case 'lightpink_lightblue_blue':
				wp_enqueue_style( 'medicplus-themecolor',	$uri . '/css/theme-color/medicplus-dermatology.css', array(), MEDICPLUS_THEME_VER );
				break;
			case 'lightgreen_brown':
				wp_enqueue_style( 'medicplus-themecolor',	$uri . '/css/theme-color/medicplus-dr-nutrition.css', array(), MEDICPLUS_THEME_VER );
				break;
			case 'lightblue_orange':
				wp_enqueue_style( 'medicplus-themecolor',	$uri . '/css/theme-color/medicplus-ent-center.css', array(), MEDICPLUS_THEME_VER );
				break;
			case 'lightorange_blue':
				wp_enqueue_style( 'medicplus-themecolor',	$uri . '/css/theme-color/medicplus-orthopedic.css', array(), MEDICPLUS_THEME_VER );
				break;
			case 'lightviolet_blue':
				wp_enqueue_style( 'medicplus-themecolor',	$uri . '/css/theme-color/medicplus-ophthalmology.css', array(), MEDICPLUS_THEME_VER );
				break;
			case 'lightblue_blue':
				wp_enqueue_style( 'medicplus-themecolor',	$uri . '/css/theme-color/medicplus-prenancy.css', array(), MEDICPLUS_THEME_VER );
				break;
			case 'darkviolet_blue':
				wp_enqueue_style( 'medicplus-themecolor',	$uri . '/css/theme-color/medicplus-psychology.css', array(), MEDICPLUS_THEME_VER );
				break;
			default:
				# code...
				break;
		}

		wp_enqueue_style( 'medicplus-responsive',          $uri . '/css/medicplus-responsive.css', array(), MEDICPLUS_THEME_VER );
		wp_enqueue_style( 'medicplus-custom-editor',       $uri . '/css/medicplus-custom-editor.css', array(), MEDICPLUS_THEME_VER );
		

		// js
		wp_enqueue_script( 'medicplus-skip-link-focus-fix', $dir_uri . '/js/skip-link-focus-fix.js', array(), '20130115', true );

		// comment
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		wp_enqueue_script( 'bootstrap.min',              $uri . '/libs/bootstrap/js/bootstrap.min.js', array('jquery'), false, true );
		wp_enqueue_script( 'bootstrap-datepicker.min',   $uri . '/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js', array('jquery'), false, true );
		wp_enqueue_script( 'browser',                    $uri . '/libs/detect-browser/browser.js', array('jquery'), false, true );
		wp_enqueue_script( 'jquery.vticker',             $uri . '/libs/jquery.vticker.js', array('jquery'), false, true );

		// theme js
		wp_enqueue_script( 'medicplus-main',          $uri . '/js/medicplus-main.js', array(), MEDICPLUS_THEME_VER, true );
		wp_enqueue_script( 'medicplus-custom',        $uri . '/js/medicplus-custom.js', array(), MEDICPLUS_THEME_VER, true );
		
		//for contact form 7 plugin
		if ( MEDICPLUS_WPCF7_ACTIVE ) {
			wp_localize_script(
					'medicplus-form',
					'ajaxurl',
					esc_url(admin_url( 'admin-ajax.php' ))
			);
			wp_enqueue_script( 'medicplus-cf7-jquery', plugins_url() . '/contact-form-7/includes/js/jquery.form.min.js', array(), false, true );
			wp_enqueue_script( 'medicplus-cf7-scripts', plugins_url() . '/contact-form-7/includes/js/scripts.js', array(), false, true );
		}
		// Woocommerce plugin
		if ( MEDICPLUS_CORE_IS_ACTIVE && MEDICPLUS_WOOCOMMERCE_ACTIVE ) {
			wp_enqueue_style( 'medicplus-woocommerce',       $uri . '/css/medicplus-woocommerce.css', array(), MEDICPLUS_THEME_VER );
			wp_enqueue_script( 'medicplus-woocommerce',      $uri . '/js/medicplus-woocommerce.js', array('jquery'), MEDICPLUS_THEME_VER, true );
		}
	}
	/**
	 * Google fonts
	 */
	function add_fonts_url() {
		$fonts_url    = '';
		$family_fonts = array();
		$subsets      = 'latin,latin-ext';

		/* Translators: If there are characters in your language that are not supported
			by chosen font(s), translate this to 'off'. Do not translate into your own language.
		*/
		if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'medicplus' ) ) {
			$family_fonts[] = 'Roboto:300,400,500,700,900';
		}
	
		/* Translators: If there are characters in your language that are not supported
			by chosen font(s), translate this to 'off'. Do not translate into your own language.
		*/
		if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'medicplus' ) ) {
			$family_fonts[] = 'Montserrat:400,700';
		}
	
		if ( $family_fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $family_fonts ) ),
				'subset' => urlencode( $subsets ),
			), 'https://fonts.googleapis.com/css' );
		}
	
		return $fonts_url;
	}
	/**
	 * General setting
	 * 
	 */
	public function theme_setup() {
		// Editor
		$this->add_theme_supports();
		$this->add_image_sizes();
	}
	/**
	 * Add theme_supports
	 * 
	 */
	public function add_theme_supports() {
	
		// Add RSS feed links to <head> for posts and comments.
		add_theme_support( 'automatic-feed-links' );
		// Default custom header
		add_theme_support( 'custom-header' );
		// Default custom backgrounds
		add_theme_support( 'custom-background' );
		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
		) );

		/*
		* Enable support for Post Formats.
		*/
		// Post Formats
		add_theme_support( 'post-formats', array( 'image', 'video','gallery' ) );
		// Add post thumbnail functionality
		add_theme_support('post-thumbnails');
		set_post_thumbnail_size(1200, 750, true);
		//
		add_theme_support( 'title-tag' );
		// woocommerce support
		add_theme_support( 'woocommerce' );
	}
	
	/**
	 * Add image sizes
	 * 
	 */
	public function add_image_sizes() {
		$image_sizes = Medicplus_Config::get('image_sizes');
		foreach($image_sizes as $key => $sizes ) {
			$crop = true;
			if( isset( $sizes['crop'] ) ) {
				$crop = $sizes['crop'];
			}
			add_image_size( $key, $sizes['width'], $sizes['height'], $crop );
		}
	}
	/**
	 * action using generate inline css
	 * @param string $custom_css
	 */
	public function add_inline_style( $custom_css ) {
		wp_enqueue_style('medicplus-custom-inline', MEDICPLUS_PUBLIC_URI . '/css/medicplus-custom-inline.css');
		wp_add_inline_style( 'medicplus-custom-inline', $custom_css );
	}

	//************************* Front Page << ***********************
	/**
	 * Get page options, apply to theme options.(front page)
	 *
	 */
	public function get_page_options() {
		global $medicplus_options;
		global $medicplus_page_options;
	
		if( is_search() || is_archive() || is_category() || is_tag() ){
			return;
		}
		$post_id = get_the_ID();
		if( ! $post_id ) {
			return;
		}
		$post_type = get_post_type($post_id);
		//
		$medicplus_page_options = get_post_meta( $post_id, 'medicplus_page_options', true );
		if( empty( $medicplus_page_options ) ) {
			return;
		}
		$image_id_keys = array('background_image_id', 'pt_background_image_id');
		$maps = Medicplus_Config::get( 'mapping', 'options' );
	
		$no_default = Medicplus_Config::get( 'mapping', 'no-default-options' );
		foreach($maps as $option_type => $page_options ) {
			$is_theme_default = $option_type .'_default';
			if( ( ! in_array($option_type, $no_default) ) &&
					(!isset( $medicplus_page_options[$is_theme_default] ) || isset( $medicplus_page_options[$is_theme_default] ) && ! empty( $medicplus_page_options[$is_theme_default] ) ) )
			{
				// no get page options
				continue;
			} else {
				foreach( $page_options as $key => $option) {
					$default = '';
					$bg_img = '';
					$bg_array = array(
						'background_transparent'       => 'background_color',
						'pt_background_transparent'    => 'pt_background_color'
					);
					foreach($bg_array as $bg_key=>$bg_val ) {
						if( isset($medicplus_page_options[$bg_key]) && !empty($medicplus_page_options[$bg_key])) {
							$medicplus_page_options[$bg_val] = $medicplus_page_options[$bg_key];
							unset($page_options[$bg_key]);
						}
					}
					if( isset( $medicplus_page_options[$key] ) ) {
						$option_val = $medicplus_page_options[$key];
						if( in_array( $key, $image_id_keys ) && ! empty( $option_val ) ) {
							$attachment_image = wp_get_attachment_image_src($option_val, 'full');
							$bg_img = $attachment_image[0];
							$default = $option_val;
						} else {
							$default = $option_val;
						}
					}
					if( $option ) {
						if( is_array( $option ) ) {
							if( count( $option ) == 3 ) {
								if( $default ) {
									$medicplus_options[$option[0]][$option[1]][$option[2]] = $default;
									if( !empty( $bg_img ) ) {
										$medicplus_options[$option[0]]['background-image'] = $bg_img;
									}
								}
							}
							else {
								$medicplus_options[$option[0]][$option[1]] = $default;
							}
						} else {
							$medicplus_options[$option] = $default;
						}
					}
				}
			}
		}
		
	}
	//************************* Front Page >> ***********************
	//************************* Admin Page << ***********************
	/**
	 * Get theme options to init page options. (admin page)
	 */
	public function init_page_setting() {
		global $medicplus_default_options;
		global $medicplus_options;

		$maps = Medicplus_Config::get( 'mapping', 'options' );
		$special_keys = array( 'pt_padding_top', 'pt_padding_bottom', 'header_padding_top', 'header_padding_bottom' );
		$transparent_keys = array( 'background_transparent', 'pt_background_transparent' );
		
		foreach( $maps as $option_type => $options ) {
			foreach( $options as $key => $option) {
				$default = '';
				if( $option ) {
					if( is_array( $option ) ) {
						if(count($option) == 3) {
							if( isset( $medicplus_options[$option[0]][$option[1]][$option[2]] ) ) {
								$default = $medicplus_options[$option[0]][$option[1]][$option[2]];
							}
						}
						else if( isset( $medicplus_options[$option[0]][$option[1]] ) ) {
							$default = $medicplus_options[$option[0]][$option[1]];
						}
					} else if( isset( $medicplus_options[$option] ) ) {
						$default = $medicplus_options[$option];
					}
					if( in_array( $key, $special_keys ) ) {
						$default = str_replace( 'px', '', $default );
					} else if( in_array( $key, $transparent_keys ) ) {
						if( $default =='transparent' ) {
							$default = 1;
						} else {
							$default = '';
						}
					}
					$medicplus_default_options[$key] = $default;
				}
			}
		}
	}
	/**
	 * Add meta box page setting to page or post type.
	 */
	public function add_page_options() {
		if( MEDICPLUS_CORE_IS_ACTIVE ) {
			$post_types = Medicplus_Config::get( 'page_options', 'post_types');
			foreach( $post_types as $post_type ) {
				add_meta_box( 'slz_mbox_page_setting', 'Page Setting', array( MEDICPLUS_THEME_CLASS, '[theme.Page_Controller, meta_box_setting]' ), $post_type, 'normal', 'low' );
			}
		}
	}
	/**
	 * Save page
	 */
	public function save_page( $post_id = '' ) {
		if( empty( $post_id ) ) {
			global $post;
			$post_id = $post->ID;
			parent::save();
		}
		// save page options start
		$maps = Medicplus_Config::get( 'mapping', 'options' );
		$no_default = Medicplus_Config::get( 'mapping', 'no-default-options' );
		foreach($maps as $k=>$v) {
			$is_default = $k .'_default';
			if( ( !isset($_POST['medicplus_page_options'][$is_default]) ) ){
				$_POST['medicplus_page_options'][$is_default] = '';
			}
		}
		update_post_meta( $post_id, 'medicplus_page_options', isset( $_POST['medicplus_page_options'] ) ? $_POST['medicplus_page_options'] : '' );
	}
	/**
	 * Save post
	 */
	public function save_post() {
		global $post;
		$post_id = $post->ID;
		parent::save();
		// save page options
		$this->save_page( $post_id );
		if( MEDICPLUS_CORE_IS_ACTIVE ) {
			do_action( 'medicplus_save_feature_video', $post_id );
		}
	}
	/**
	 * Save product
	 */
	public function save_product() {
		global $post;
		$post_id = $post->ID;
		parent::save();
		// save page options
		$this->save_page( $post_id );
	}
}