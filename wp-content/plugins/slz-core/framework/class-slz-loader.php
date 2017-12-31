<?php
/**
 * Core Loader class.
 * 
 * @author Swlabs
 * @package MedicPlus
 * @since 1.0
 */
class Medicplus_Core_Loader {
	public static function run(){
	}
	
	/**
	 * Fires after WordPress has finished loading but before any headers are sent.
	 */
	public static function init(){
		add_action('wpcf7_before_send_mail',   array( SLZCORE_CLASS, '[top.Top_Controller, save_form_appointment]' ) );
		add_action('wp_ajax_medicplus_core', array( SLZCORE_CLASS, '[Application, ajax]' ) );
		add_action('wp_ajax_nopriv_medicplus_core', array( SLZCORE_CLASS, '[Application, ajax]' ) );
		self::register_post_taxonomy();
	}
	public static function register_post_taxonomy(){
		/*******************************************************************/
		// Appointments post type
		/*******************************************************************/
		register_post_type( 'medicplus_appoint', array(
				'public'                => false,
				'show_in_nav_menus'     => true,
				'show_ui'               => true,
				'has_archive'           => true,
				'exclude_from_search'   => true,
				'rewrite'               => array( 'slug' => 'appointment' ),
				'query_var'             => true,
				'menu_icon'             => 'dashicons-id',
				'supports'              => array( 'title' ),
				'labels'                => array(
					'name'                  => esc_html__( 'Appointments',           'slz-core' ),
					'singular_name'         => esc_html__( 'Appointments',           'slz-core' ),
					'menu_name'             => esc_html__( 'Appointments',           'slz-core' ),
					'add_new'               => esc_html__( 'Add New',                'slz-core' ),
					'add_new_item'          => esc_html__( 'Add New Appointment',    'slz-core' ),
					'edit_item'             => esc_html__( 'Edit Appointment',       'slz-core' ),
				),
			)
		);
		register_taxonomy( 'medicplus_appoint_cat', array( 'medicplus_appoint' ), array(
				'hierarchical'       => true,
				'rewrite'            => array( 'slug' => 'appointment-category' ),
				'query_var'          => true,
				'labels'             => array(
					'name'                  => esc_html__( 'Appointment Categories',      'slz-core' ),
					'singular_name'         => esc_html__( 'Appointment Categories',      'slz-core' ),
					'menu_name'             => esc_html__( 'Appointment Categories',      'slz-core' ),
					'add_new'               => esc_html__( 'Add New',                     'slz-core' ),
					'add_new_item'          => esc_html__( 'Add New Category',            'slz-core' ),
					'edit_item'             => esc_html__( 'Edit Category',               'slz-core' ),
					'parent_item'           => esc_html__( 'Parent Category',             'slz-core' ),
					'search_items'          => esc_html__( 'Search Categories',           'slz-core' ),
				),
			)
		);
		register_taxonomy( 'medicplus_appoint_status', array( 'medicplus_appoint' ), array(
				'hierarchical'       => false,
				'rewrite'            => array( 'slug' => 'appointment-status' ),
				'query_var'          => true,
				'labels'             => array(
					'name'                  => esc_html__( 'Appointment Status',        'slz-core' ),
					'singular_name'         => esc_html__( 'Appointment Status',        'slz-core' ),
					'menu_name'             => esc_html__( 'Appointment Status',        'slz-core' ),
					'add_new'               => esc_html__( 'Add New',                   'slz-core' ),
					'add_new_item'          => esc_html__( 'Add New Status',            'slz-core' ),
					'edit_item'             => esc_html__( 'Edit Status',               'slz-core' ),
					'search_items'          => esc_html__( 'Search Categories',         'slz-core' ),
				),
			)
		);
		
		/*******************************************************************/
		// Services post type
		/*******************************************************************/
		register_post_type('medicplus_service', array(
				'public'                => true,
				'has_archive'           => true,
				'menu_position'         => 22,
				'rewrite'               => array( 'slug' => 'service' ),
				'query_var'             => true,
				'menu_icon'             => 'dashicons-clipboard',
				'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
				'labels'                => array(
					'name'                  => esc_html__( 'Services',           'slz-core' ),
					'singular_name'         => esc_html__( 'Services',           'slz-core' ),
					'menu_name'             => esc_html__( 'Services',           'slz-core' ),
					'add_new'               => esc_html__( 'Add New',            'slz-core' ),
					'add_new_item'          => esc_html__( 'Add New Service',    'slz-core' ),
					'edit_item'             => esc_html__( 'Edit Service',       'slz-core' ),
				),
			)
		);
		register_taxonomy('medicplus_service_cat', array( 'medicplus_service' ), array(
				'hierarchical'       => true,
				'rewrite'            => array( 'slug' => 'service-category' ),
				'query_var'          => true,
				'labels'             => array(
					'name'                  => esc_html__( 'Service Categories',         'slz-core' ),
					'singular_name'         => esc_html__( 'Service Category',           'slz-core' ),
					'menu_name'             => esc_html__( 'Service Categories',         'slz-core' ),
					'add_new'               => esc_html__( 'Add New',                    'slz-core' ),
					'add_new_item'          => esc_html__( 'Add New Category',           'slz-core' ),
					'edit_item'             => esc_html__( 'Edit Category',              'slz-core' ),
					'parent_item'           => esc_html__( 'Parent Category',            'slz-core' ),
					'search_items'          => esc_html__( 'Search Categories',          'slz-core' ),
				),
			)
		);
		
		/*******************************************************************/
		// Departments post type
		/*******************************************************************/
		register_post_type('medicplus_dept', array(
				'public'                => true,
				'has_archive'           => true,
				'menu_position'         => 21,
				'rewrite'               => array( 'slug' => 'department' ),
				'query_var'             => true,
				'menu_icon'             => 'dashicons-networking',
				'supports'              => array( 'title', 'editor', 'thumbnail' ),
				'labels'                => array(
					'name'                  => esc_html__( 'Departments',           'slz-core' ),
					'singular_name'         => esc_html__( 'Departments',           'slz-core' ),
					'menu_name'             => esc_html__( 'Departments',           'slz-core' ),
					'add_new'               => esc_html__( 'Add New',               'slz-core' ),
					'add_new_item'          => esc_html__( 'Add New Department',    'slz-core' ),
					'edit_item'             => esc_html__( 'Edit Department',       'slz-core' ),
				),
			)
		);
		register_taxonomy('medicplus_dept_cat', array( 'medicplus_dept' ), array(
				'hierarchical'       => true,
				'rewrite'            => array( 'slug' => 'department-category' ),
				'query_var'          => true,
				'labels'             => array(
					'name'                  => esc_html__( 'Department Categories',       'slz-core' ),
					'singular_name'         => esc_html__( 'Department Category',         'slz-core' ),
					'menu_name'             => esc_html__( 'Department Categories',       'slz-core' ),
					'add_new'               => esc_html__( 'Add New',                     'slz-core' ),
					'add_new_item'          => esc_html__( 'Add New Category',            'slz-core' ),
					'edit_item'             => esc_html__( 'Edit Category',               'slz-core' ),
					'parent_item'           => esc_html__( 'Parent Category',             'slz-core' ),
					'search_items'          => esc_html__( 'Search Categories',           'slz-core' ),
				),
			)
		);
		
		/*******************************************************************/
		// Team post type
		/*******************************************************************/
		register_post_type('medicplus_team', array(
				'public'                => true,
				'has_archive'           => true,
				'menu_position'         => 23,
				'rewrite'               => array( 'slug' => 'team' ),
				'query_var'             => true,
				'menu_icon'             => 'dashicons-groups',
				'supports'              => array( 'title', 'editor', 'thumbnail' ),
				'labels'                => array(
					'name'                  => esc_html__( 'Teams',           'slz-core' ),
					'singular_name'         => esc_html__( 'Teams',           'slz-core' ),
					'menu_name'             => esc_html__( 'Teams',           'slz-core' ),
					'add_new'               => esc_html__( 'Add New',         'slz-core' ),
					'add_new_item'          => esc_html__( 'Add New Team',    'slz-core' ),
					'edit_item'             => esc_html__( 'Edit Team',       'slz-core' ),
				),
			)
		);
		register_taxonomy('medicplus_team_cat', array( 'medicplus_team' ), array(
				'hierarchical'       => true,
				'rewrite'            => array( 'slug' => 'team-category' ),
				'query_var'          => true,
				'labels'             => array(
					'name'                  => esc_html__( 'Team Categories',         'slz-core' ),
					'singular_name'         => esc_html__( 'Team Categories',         'slz-core' ),
					'menu_name'             => esc_html__( 'Team Categories',         'slz-core' ),
					'add_new'               => esc_html__( 'Add New',                 'slz-core' ),
					'add_new_item'          => esc_html__( 'Add New Category',        'slz-core' ),
					'edit_item'             => esc_html__( 'Edit Category',           'slz-core' ),
					'parent_item'           => esc_html__( 'Parent Category',         'slz-core' ),
					'search_items'          => esc_html__( 'Search Categories',       'slz-core' ),
				),
			)
		);
	
		/*******************************************************************/
		// Testimonial post type
		/*******************************************************************/
		register_post_type('medicplus_testi', array(
				'public'                => true,
				'has_archive'           => true,
				'rewrite'               => array( 'slug' => 'testimonial' ),
				'query_var'             => true,
				'menu_icon'             => 'dashicons-editor-quote',
				'supports'              => array( 'title', 'editor', 'thumbnail'),
				'labels'                => array(
					'name'                  => esc_html__( 'Testimonials',           'slz-core' ),
					'singular_name'         => esc_html__( 'Testimonials',           'slz-core' ),
					'menu_name'             => esc_html__( 'Testimonials',           'slz-core' ),
					'add_new'               => esc_html__( 'Add New',                'slz-core' ),
					'add_new_item'          => esc_html__( 'Add New Testimonial',    'slz-core' ),
					'edit_item'             => esc_html__( 'Edit Testimonial',       'slz-core' ),
				),
			)
		);
		register_taxonomy('medicplus_testi_cat', array( 'medicplus_testi' ), array(
				'hierarchical'       => true,
				'rewrite'            => array( 'slug' => 'testimonial-category' ),
				'query_var'          => true,
				'labels'             => array(
					'name'                  => esc_html__( 'Testimonial Categories',         'slz-core' ),
					'singular_name'         => esc_html__( 'Testimonial Categories',         'slz-core' ),
					'menu_name'             => esc_html__( 'Testimonial Categories',         'slz-core' ),
					'add_new'               => esc_html__( 'Add New',                 'slz-core' ),
					'add_new_item'          => esc_html__( 'Add New Category',        'slz-core' ),
					'edit_item'             => esc_html__( 'Edit Category',           'slz-core' ),
					'parent_item'           => esc_html__( 'Parent Category',         'slz-core' ),
					'search_items'          => esc_html__( 'Search Categories',       'slz-core' ),
				),
			)
		);
		
		/*******************************************************************/
		// FAQ's post type
		/*******************************************************************/
		register_post_type('medicplus_faq', array(
				'public'                => true,
				'has_archive'           => true,
				'rewrite'               => array( 'slug' => 'faq' ),
				'query_var'             => true,
				'menu_icon'             => 'dashicons-format-chat',
				'supports'              => array( 'title', 'editor' ),
				'labels'                => array(
					'name'                  => esc_html__( 'FAQs',           'slz-core' ),
					'singular_name'         => esc_html__( 'FAQs',           'slz-core' ),
					'menu_name'             => esc_html__( 'FAQs',           'slz-core' ),
					'add_new'               => esc_html__( 'Add New',        'slz-core' ),
					'add_new_item'          => esc_html__( 'Add New FAQ',    'slz-core' ),
					'edit_item'             => esc_html__( 'Edit FAQ',       'slz-core' ),
				),
			)
		);
		register_taxonomy('medicplus_faq_cat', array( 'medicplus_faq' ), array(
				'hierarchical'       => true,
				'rewrite'            => array( 'slug' => 'faq-category' ),
				'query_var'          => true,
				'labels'             => array(
					'name'                  => esc_html__( 'FAQ Categories',         'slz-core' ),
					'singular_name'         => esc_html__( 'FAQ Categories',         'slz-core' ),
					'menu_name'             => esc_html__( 'FAQ Categories',         'slz-core' ),
					'add_new'               => esc_html__( 'Add New',                'slz-core' ),
					'add_new_item'          => esc_html__( 'Add New Category',       'slz-core' ),
					'edit_item'             => esc_html__( 'Edit Category',          'slz-core' ),
					'parent_item'           => esc_html__( 'Parent Category',        'slz-core' ),
					'search_items'          => esc_html__( 'Search Categories',      'slz-core' ),
				),
			)
		);
		
		/*******************************************************************/
		// Gallery post type
		/*******************************************************************/
		register_post_type('medicplus_gallery', array(
				'public'                => true,
				'has_archive'           => true,
				'rewrite'               => array( 'slug' => 'gallery' ),
				'query_var'             => true,
				'menu_icon'             => 'dashicons-images-alt2',
				'supports'              => array( 'title', 'editor', 'thumbnail' ),
				'labels'                => array(
					'name'                  => esc_html__( 'Gallery',           'slz-core' ),
					'singular_name'         => esc_html__( 'Gallery',           'slz-core' ),
					'menu_name'             => esc_html__( 'Gallery',           'slz-core' ),
					'add_new'               => esc_html__( 'Add New',           'slz-core' ),
					'add_new_item'          => esc_html__( 'Add New Gallery',   'slz-core' ),
					'edit_item'             => esc_html__( 'Edit Gallery',      'slz-core' ),
				),
			)
		);
		register_taxonomy('medicplus_gallery_cat', array( 'medicplus_gallery' ), array(
				'hierarchical'       => true,
				'rewrite'            => array( 'slug' => 'gallery-category' ),
				'query_var'          => true,
				'labels'             => array(
					'name'                  => esc_html__( 'Gallery Categories',         'slz-core' ),
					'singular_name'         => esc_html__( 'Gallery Categories',         'slz-core' ),
					'menu_name'             => esc_html__( 'Gallery Categories',         'slz-core' ),
					'add_new'               => esc_html__( 'Add New',                 'slz-core' ),
					'add_new_item'          => esc_html__( 'Add New Category',        'slz-core' ),
					'edit_item'             => esc_html__( 'Edit Category',           'slz-core' ),
					'parent_item'           => esc_html__( 'Parent Category',         'slz-core' ),
					'search_items'          => esc_html__( 'Search Categories',       'slz-core' ),
				),
			)
		);
	
		/*******************************************************************/
		// Location post type
		/*******************************************************************/
		register_post_type('medicplus_locate', array(
				'public'                => true,
				'has_archive'           => true,
				'menu_position'         => 24,
				'rewrite'               => array( 'slug' => 'location' ),
				'query_var'             => true,
				'menu_icon'             => 'dashicons-location-alt',
				'supports'              => array( 'title', 'editor' ),
				'labels'                => array(
					'name'                  => esc_html__( 'Locations',				'slz-core' ),
					'singular_name'         => esc_html__( 'Locations',				'slz-core' ),
					'menu_name'             => esc_html__( 'Locations',				'slz-core' ),
					'add_new'               => esc_html__( 'Add New',				'slz-core' ),
					'add_new_item'          => esc_html__( 'Add New Location',		'slz-core' ),
					'edit_item'             => esc_html__( 'Edit Location',			'slz-core' ),
				),
			)
		);
		register_taxonomy('medicplus_locate_cat', array( 'medicplus_locate' ), array(
				'hierarchical'       => true,
				'rewrite'            => array( 'slug' => 'location-category' ),
				'query_var'          => true,
				'labels'             => array(
					'name'                  => esc_html__( 'Location Categories',         'slz-core' ),
					'singular_name'         => esc_html__( 'Location Categories',         'slz-core' ),
					'menu_name'             => esc_html__( 'Location Categories',         'slz-core' ),
					'add_new'               => esc_html__( 'Add New',                 'slz-core' ),
					'add_new_item'          => esc_html__( 'Add New Category',        'slz-core' ),
					'edit_item'             => esc_html__( 'Edit Category',           'slz-core' ),
					'parent_item'           => esc_html__( 'Parent Category',         'slz-core' ),
					'search_items'          => esc_html__( 'Search Categories',       'slz-core' ),
				),
			)
		);
	}
	
	/**
	 * It is triggered before any other hook when a user accesses the admin area. 
	 */
	public static function admin(){
		// add action
		add_action( 'save_post', array( SLZCORE_CLASS, '[Application, save]' ) );
		add_action( 'admin_enqueue_scripts', array( SLZCORE_CLASS, '[setting.Setting_Init, enqueue]' ) );
		
		add_action( 'medicplus_custom_colums', array( SLZCORE_CLASS, '[setting.Setting_Init, manage_custom_columns]' ) );
		add_action( 'medicplus_add_feature_video', array( SLZCORE_CLASS, '[setting.Setting_Init, add_metabox_feature_video]' ) );
		
		do_action( 'medicplus_add_feature_video');
		do_action( 'medicplus_custom_colums');
		
		// save feature video
		add_action( 'medicplus_save_feature_video', array( SLZCORE_CLASS, '[setting.Setting_Init, save_feature_video]' ) );
		//Appointments - metaboxs
		add_meta_box( 'medicplus_metabox_appointment_options', 'Appointment Options', array( SLZCORE_CLASS, '[posttype.Appointment_Controller, metabox_appointment_options]' ), 'medicplus_appoint', 'normal' );
		// Service - metaboxs
		add_meta_box( 'medicplus_metabox_service_options', 'Service Options', array( SLZCORE_CLASS, '[posttype.Service_Controller, metabox_service_options]' ), 'medicplus_service', 'normal' );
		// Department - metaboxs
		add_meta_box( 'medicplus_metabox_department_options', 'Department Options', array( SLZCORE_CLASS, '[posttype.Department_Controller, metabox_department_options]' ), 'medicplus_dept', 'normal' );
		// Team - metaboxs
		add_meta_box( 'medicplus_metabox_team_options', 'Team Options', array( SLZCORE_CLASS, '[posttype.Team_Controller, metabox_team_options]' ), 'medicplus_team', 'normal' );
		//Testimonial - metaboxs
		add_meta_box( 'medicplus_metabox_testimonial_option', 'Testimonial Options', array( SLZCORE_CLASS, '[posttype.Testimonial_Controller, metabox_testimonial_option]' ), 'medicplus_testi', 'normal' );
		//Gallery - metaboxs
		add_meta_box( 'medicplus_metabox_gallery_options', 'Gallery Options', array( SLZCORE_CLASS, '[posttype.Gallery_Controller, metabox_gallery_options]' ), 'medicplus_gallery', 'normal' );
		//Location - metaboxs
		add_meta_box( 'medicplus_metabox_location_options', 'Location Options', array( SLZCORE_CLASS, '[posttype.Location_Controller, metabox_location_options]' ), 'medicplus_locate', 'normal' );
	}
}