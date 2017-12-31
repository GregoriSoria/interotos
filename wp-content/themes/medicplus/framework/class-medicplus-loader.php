<?php
/**
 * Medicplus loader class.
 * 
 * @author Swlabs
 * @package MedicPlus
 * @since 1.0
 */
class Medicplus_Loader {
	public static function run(){
		add_action( 'widgets_init', array( MEDICPLUS_THEME_CLASS, '[widget.Widget_Init, load]') );
		// action inline css
		add_action( 'medicplus_add_inline_style',    array( MEDICPLUS_THEME_CLASS, '[theme.Theme_Init, add_inline_style]') );
		// get page options
		add_action( 'medicplus_page_options',        array( MEDICPLUS_THEME_CLASS, '[theme.Theme_Init, get_page_options]') );
		// show index content
		add_action( 'medicplus_show_index',          array( MEDICPLUS_THEME_CLASS, '[front.Top_Controller, show_post_index]') );
		// Frontend actions
		
		add_action( 'medicplus_show_header',         array( MEDICPLUS_THEME_CLASS, '[front.Top_Controller, header]') );
		add_action( 'medicplus_show_footer',         array( MEDICPLUS_THEME_CLASS, '[front.Top_Controller, footer_main]') );
		add_action( 'medicplus_show_footer_contact', array( MEDICPLUS_THEME_CLASS, '[front.Top_Controller, footer_contact]') );
		add_action( 'medicplus_show_breadcrumb',     array( MEDICPLUS_THEME_CLASS, '[front.Top_Controller, breadcrumb]') );
		add_action( 'medicplus_entry_thumbnail',     array( MEDICPLUS_THEME_CLASS, '[front.Top_Controller, show_post_entry_thumbnail]') );
		add_action( 'medicplus_entry_video',         array( MEDICPLUS_THEME_CLASS, '[front.Top_Controller, show_post_entry_video]') );
		add_action( 'medicplus_entry_meta',          array( MEDICPLUS_THEME_CLASS, '[front.Top_Controller, show_post_entry_meta]') );
		add_action( 'medicplus_tags_meta',           array( MEDICPLUS_THEME_CLASS, '[front.Top_Controller, show_post_tags_meta]') );
		add_action( 'medicplus_categories_meta',     array( MEDICPLUS_THEME_CLASS, '[front.Top_Controller, show_post_category_meta]') );
		add_action( 'medicplus_show_page_title',     array( MEDICPLUS_THEME_CLASS, '[front.Top_Controller, show_page_title]') );
		add_action( 'medicplus_show_slider',         array( MEDICPLUS_THEME_CLASS, '[front.Top_Controller, show_slider]') );
		add_action( 'medicplus_post_author',         array( MEDICPLUS_THEME_CLASS, '[front.Top_Controller, show_post_author]') );
		add_action( 'medicplus_show_frm_comment',       array( MEDICPLUS_THEME_CLASS, '[front.Top_Controller, show_frm_comment]') );
		add_action( 'medicplus_show_author_list',    array( MEDICPLUS_THEME_CLASS, '[front.Top_Controller, show_author_list]') );
		add_action( 'medicplus_show_help_link',      array( MEDICPLUS_THEME_CLASS, '[front.Top_Controller, show_help_link]') );
		
		// share post
		add_action( 'medicplus_share_link',          array( MEDICPLUS_THEME_CLASS, '[front.Top_Controller, get_share_link]') );
		
		// login
		add_action( 'medicplus_login_link',          array( MEDICPLUS_THEME_CLASS, '[front.Top_Controller, show_login_link]') );
	}
	
	/**
	 * Fires after WordPress has finished loading but before any headers are sent.
	 */
	public static function init(){
		// Regist Menu
		register_nav_menu( 'main-nav',     esc_html__( 'Main Navigation', 'medicplus' ) );
		register_nav_menu( 'footer-nav',   esc_html__( 'Footer Navigation', 'medicplus' ) );
		register_nav_menu( 'page-404-nav', esc_html__( '404 Navigation', 'medicplus' ) );
		
		// Ajax
		add_action( 'wp_ajax_medicplus',        array( MEDICPLUS_THEME_CLASS, '[Application, ajax]' ) );
		add_action( 'wp_ajax_nopriv_medicplus', array( MEDICPLUS_THEME_CLASS, '[Application, ajax]' ) );
		
		// Welcome page
		add_action( 'admin_menu', array( MEDICPLUS_THEME_CLASS, '[theme.Theme_Controller, add_welcome]' ) );
		add_action( 'admin_init', array( MEDICPLUS_THEME_CLASS, '[theme.Theme_Controller, call_tgm_plugin_action]' ) );
		
		// Add sidebar area
		add_action( 'admin_print_scripts',                     array( MEDICPLUS_THEME_CLASS, '[theme.Widget_Init, add_widget_field]' ) );
		add_action( 'load-widgets.php',                        array( MEDICPLUS_THEME_CLASS, '[widget.Widget_Init, add_sidebar_area]' ) );
		add_action( 'wp_ajax_medicplus_del_custom_sidebar', array( MEDICPLUS_THEME_CLASS, '[widget.Widget_Init, delete_custom_sidebar]' ) );
	}
	
	/**
	 * It is triggered before any other hook when a user accesses the admin area. 
	 */
	public static function admin(){
		// add action
		add_action( 'save_post',             array( MEDICPLUS_THEME_CLASS, '[Application, save]' ) );
		add_action( 'admin_enqueue_scripts', array( MEDICPLUS_THEME_CLASS, '[theme.Theme_Init, admin_enqueue]' ) );
		
		// init page options
		add_action( 'medicplus_init_page_setting',  array( MEDICPLUS_THEME_CLASS, '[theme.Theme_Init, init_page_setting]' ) );
		do_action(  'medicplus_init_page_setting');
		
		// save_page
		add_action( 'medicplus_save_page',          array( MEDICPLUS_THEME_CLASS, '[theme.Theme_Init, save_page]') );
		
		// add mbox page options
		add_action( 'medicplus_metabox_pageoption', array( MEDICPLUS_THEME_CLASS, '[theme.Theme_Init, add_page_options]' ) );
		do_action(  'medicplus_metabox_pageoption' );

		add_action( 'medicplus_get_theme_header',   array( MEDICPLUS_THEME_CLASS, '[theme.Theme_Controller, get_theme_header]') );
	}
}