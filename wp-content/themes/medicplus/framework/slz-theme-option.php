<?php
/**
 * Dynamic css from theme options - Output will be included into end of head tag
 *
 * @author Swlabs
 * @package MedicPlus
 * @since 1.0
 */
function medicplus_dynamic_css() {

	// page options
	do_action('medicplus_page_options');

	$content = "";
	$content_desktop = "";

	$content_ptop = Medicplus::get_option('slz-content-padding-top');
	$content_pbottom = Medicplus::get_option('slz-content-padding-bottom');
	$content_pbottom = str_replace('px', '', $content_pbottom);
	$content_ptop = str_replace('px', '', $content_ptop);
	if( is_numeric( $content_ptop ) ) {
		$content_ptop = 'padding-top:'.$content_ptop.'px;';
	} else {
		$content_ptop = '';
	}
	if( is_numeric( $content_pbottom ) ) {
		$content_pbottom = 'padding-bottom:'.$content_pbottom.'px;';
	} else {
		$content_pbottom = '';
	}
	
	$content .= '#page-wrapper .page-detail{'.esc_attr($content_ptop).esc_attr($content_pbottom).'}';

	/*General*/
	$boxed_layout  = Medicplus::get_option('slz-layout');
	$boxed_bg      = Medicplus::get_option('slz-layout-boxed-bg');
	$back_to_top   = Medicplus::get_option('slz-backtotop');
	$btt_color     = Medicplus::get_option('slz-backtotop-color');

	if ($back_to_top == '0'){
		$content .= '.slz-back-to-top{display:none;}';
	}else{
		if( $btt_color ) {
			$content .= '.btn-wrapper.slz-back-to-top a.btn{color:'.esc_attr($btt_color).';border-color: '.esc_attr($btt_color).';}';
			$content .= '.btn-wrapper.slz-back-to-top a.btn:hover{background-color:'.esc_attr($btt_color).';}';
		}
		
	}
	if ( !empty($boxed_bg) ) {
		$bg_image = '';
		if( $boxed_bg['background-image'] ) {
			$bg_image = 'background-image: url("' .esc_url($boxed_bg['background-image']). '");';
		}
		$content .= 'body {background-color: ' .esc_attr($boxed_bg['background-color']). ';'. esc_attr($bg_image) .'background-repeat: ' .esc_attr($boxed_bg['background-repeat']). ';background-attachment: ' .esc_attr($boxed_bg['background-attachment']). ';background-position:'.esc_attr($boxed_bg['background-position']).';background-size:'.esc_attr($boxed_bg['background-size']).';}';
	}
	/*header*/
	$header_icon_color = Medicplus::get_option('slz-topbar-icon-color');
	if(!empty($header_icon_color)){
		$content.='.header-topbar .information-toppar .icons{color: '.esc_attr($header_icon_color).';}';
	}

	/* Menu */
	$menu_text        = Medicplus::get_option('slz-menu-item-text');
	$menu_height      = Medicplus::get_option('slz-menu-height');
	$submenu_bg       = Medicplus::get_option('slz-submenu-bg');
	$submenu_width    = Medicplus::get_option('slz-submenu-width');
	$submenu_border   = Medicplus::get_option('slz-submenu-border');
	$submenu_color    = Medicplus::get_option('slz-submenu-color');
	$submenu_padding  = Medicplus::get_option('slz-submenu-padding');

	if ( Medicplus::get_option('slz-menu-custom') == '1' ) {
		if($menu_text){
			$content .= '.navigation .nav-links .main-menu,.header-main.header-3 .navigation .nav-links .main-menu {color:'.esc_attr($menu_text['regular']).';}';
			$content .= '.navigation .nav-links li.active:hover .main-menu,
					.navigation .nav-links li:hover .main-menu,
					.header-main.header-3 .navigation .nav-links li.active .main-menu,
					.header-main.header-3 .navigation .nav-links li:hover .main-menu {color:'.esc_attr($menu_text['hover']).'}';
			$content .= '.navigation .nav-links li.active .main-menu{color:'.esc_attr($menu_text['active']).';border-color:'.esc_attr($menu_text['active']).'}';
			$content .= '.navigation .nav-links .main-menu:after, .navigation .nav-links .main-menu:before{background-color:'.esc_attr($menu_text['active']).';}';
			$content .= '.navigation .nav-links li:hover .main-menu .icons-dropdown i{color:'.esc_attr($menu_text['hover']).';}';
		}
		if($menu_height){
			$content .= '.navigation .nav-links .main-menu,.header-main.header-3 .navigation .nav-links .main-menu {line-height:'.esc_attr($menu_height['height']) .';}';
			$content .= '.header-main .logo,.navigation .nav-links .main-menu .icons-dropdown{line-height:'.esc_attr($menu_height['height']) .';}';
		}
	}

	if ( Medicplus::get_option('slz-submenu-custom') == '1') {
		if( !empty($submenu_bg['rgba'])){
			$content .= 'header .header-main .medicplus-dropdown-menu-1, header .header-main .medicplus-dropdown-menu-2{background-color:'.esc_attr($submenu_bg['rgba']).';}';
		}
		if( !empty($submenu_width['width'])){
			$content .= 'header .header-main .medicplus-dropdown-menu-1, header .header-main .medicplus-dropdown-menu-2{width:'.esc_attr($submenu_width['width']).';}';
		}
		if( $submenu_border ){
			$content .= 'header .header-main .medicplus-dropdown-menu-1, header .header-main .medicplus-dropdown-menu-2{border-bottom:'.esc_attr($submenu_border['border-bottom']).' '.esc_attr($submenu_border['border-style']).' '.esc_attr($submenu_border['border-color']).'}';
		}
		if( $submenu_color ) {
			$content .= 'header .header-main .medicplus-dropdown-menu-1 li .link-page, header .header-main .medicplus-dropdown-menu-2 li .link-page{color:'.esc_attr($submenu_color['regular']).';}';
			$content .= 'header .header-main .medicplus-dropdown-menu-1 li:hover .link-page, header .header-main .medicplus-dropdown-menu-2 li:hover .link-page,header .header-main .medicplus-dropdown-menu-1 li.active:hover .link-page, header .header-main .medicplus-dropdown-menu-2 li.active:hover .link-page{color:'.esc_attr($submenu_color['hover']).'}';
			$content .= 'header .header-main .medicplus-dropdown-menu-1 li.active .link-page,header .header-main .medicplus-dropdown-menu-2 li.active .link-page{color: '.esc_attr($submenu_color['active']).';}';
		}

		if( $submenu_padding ) {
			$content .= 'header .header-main .medicplus-dropdown-menu-1 li .link-page, header .header-main .medicplus-dropdown-menu-2 li .link-page{'
					.'padding-right:'.esc_attr($submenu_padding['padding-right'])
					.';padding-left:'.esc_attr($submenu_padding['padding-left']).';'
					.'padding-top:'.esc_attr($submenu_padding['padding-top'])
					.';padding-bottom:'.esc_attr($submenu_padding['padding-bottom']).';}';
		}

		$content .= 'header .header-main .medicplus-dropdown-menu-1 li:hover, header .header-main .medicplus-dropdown-menu-2 li:hover{background-color: rgba(0, 0, 0, 0.04)}';
	}

	/* Page Title */
	$page_title_bg          = Medicplus::get_option('slz-page-title-bg');
	$page_title_height      = Medicplus::get_option('slz-page-title-height');
	$page_title_overlay_bg  = Medicplus::get_option('slz-pagetitle-overlay-bg');
	$page_title_align       = Medicplus::get_option('slz-pagetitle-align');
	$bc_typo                = Medicplus::get_option('slz-breadcrumb-path');
	$bc_typo2               = Medicplus::get_option('slz-breadcrumb-path2');
	$title_typo             = Medicplus::get_option('slz-pagetitle-title');

	if( !empty($page_title_height['height'])){
		$content .= '.breadcrumb .breadcrumb-wrapper{padding: '.esc_attr($page_title_height['height']).' 0;}';
	}
	if ( Medicplus::get_option('slz-page-title-show') == '1' ) {
		if( $page_title_bg ) {
			$bg_image = '';
			if( !empty( $page_title_bg['background-image'] ) ) {
				$bg_image = 'background-image: url("' .esc_url($page_title_bg['background-image']). '");';
			}
			$content .= '.breadcrumb{background-color: ' .esc_attr($page_title_bg['background-color']). ';' . $bg_image . 'background-repeat: ' .esc_attr($page_title_bg['background-repeat']). ';background-attachment: ' .esc_attr($page_title_bg['background-attachment']). ';background-position:'.esc_attr($page_title_bg['background-position']).';background-size:'.esc_attr($page_title_bg['background-size']).';}';
		}
		if( !empty($page_title_align)){
			$content .= '.breadcrumb{text-align:'.esc_attr($page_title_align).';}';
		}
		if( !empty($page_title_overlay_bg['rgba'])){
			$content .= '.breadcrumb:before{content:"";position: absolute;width: 100%;height: 100%;left: 0;top: 0;background-color:'.esc_attr($page_title_overlay_bg['rgba']).'}';
		}

		//$bc_typo
		if( !empty($bc_typo['color']) ) {
			$content .= '.breadcrumb .breadcrumb-wrapper .breadcrumb-content > li .breadcrumb-link{color:'.esc_attr($bc_typo['color']).';}';
			$content_desktop .= '.breadcrumb .breadcrumb-wrapper .breadcrumb-content >.breadcrumb-list:before {color:'.esc_attr($bc_typo['color']).';}';
		}
		if( !empty($bc_typo['font-weight']) ) {
			$content .= '.breadcrumb .breadcrumb-wrapper .breadcrumb-content > li .breadcrumb-link{font-weight:'.esc_attr($bc_typo['font-weight']).';}';
		}
		if( !empty($bc_typo['text-transform']) ) {
			$content .= '.breadcrumb .breadcrumb-wrapper .breadcrumb-content > li .breadcrumb-link{text-transform:'.esc_attr($bc_typo['text-transform']).';}';
		}
		if( !empty($bc_typo['font-size']) ) {
			$content_desktop .= '.breadcrumb .breadcrumb-wrapper .breadcrumb-content > li .breadcrumb-link{font-size:'.esc_attr($bc_typo['font-size']).';}';
		}
		//$bc_typo2
		if( !empty($bc_typo2['color']) ) {
			$content .= '.breadcrumb .breadcrumb-wrapper .breadcrumb-content > li.active{color:'.esc_attr($bc_typo2['color']).';}';
		}
		if( !empty($bc_typo2['font-weight']) ) {
			$content .= '.breadcrumb .breadcrumb-wrapper .breadcrumb-content > li.active{font-weight:'.esc_attr($bc_typo2['font-weight']).';}';
		}
		if( !empty($bc_typo2['text-transform']) ) {
			$content .= '.breadcrumb .breadcrumb-wrapper .breadcrumb-content > li.active{;text-transform:'.esc_attr($bc_typo2['text-transform']).';}';
		}
		if( !empty($bc_typo2['font-size']) ) {
			$content_desktop .= '.breadcrumb .breadcrumb-wrapper .breadcrumb-content > li.active{font-size:'.esc_attr($bc_typo2['font-size']).';}';
		}

		$content .= '.breadcrumb .breadcrumb-wrapper .breadcrumb > li a{opacity: 0.8}';
		//$title_typo
		if( !empty($title_typo['color']) ) {
			$content .= '.breadcrumb .breadcrumb-text{color:'.esc_attr($title_typo['color']).';}';
		}
		if( !empty($title_typo['font-weight']) ) {
			$content .= '.breadcrumb .breadcrumb-text{font-weight:'.esc_attr($title_typo['font-weight']).';}';
		}
		if( !empty($title_typo['text-transform']) ) {
			$content .= '.breadcrumb .breadcrumb-text{text-transform:'.esc_attr($title_typo['text-transform']).';}';
		}
		if( !empty($title_typo['font-size']) ) {
			$content_desktop .= '.breadcrumb .breadcrumb-text{font-size:'.esc_attr($title_typo['font-size']).';}';
		}
	}
	if (Medicplus::get_option('slz-show-breadcrumb') == "0") {
		$content .= '.breadcrumb .breadcrumb-wrapper .breadcrumb{display:none}';
	}
	if (Medicplus::get_option('slz-show-title') == "0") {
		if (is_page()){
			$content .= '.breadcrumb .breadcrumb-wrapper .captions{visibility: hidden;}';
		}
	}

	/* Footer general*/
	$footer_show            = Medicplus::get_option('slz-footer');
	$footer_style           = Medicplus::get_option('slz-footer-style');
	
	/*contact*/
	$footer_contact_color   = Medicplus::get_option('slz-footer-contact-color');
	$contact_bg             = Medicplus::get_option('slz-footer-ci-dark-bg');
	$contact_mask           = Medicplus::get_option('slz-footer-ci-dark-mask-bg');

	$contact_light_bg       = Medicplus::get_option('slz-footer-ci-light-bg');
	$contact_light_mask     = Medicplus::get_option('slz-footer-ci-light-mask-bg');
	$contact_default_mask   = Medicplus::get_option('slz-footer-ci-default-mask-bg');
	
	/*footer main*/
	$footer_bg              = Medicplus::get_option('slz-footer-bg');
	$footer_light_bg        = Medicplus::get_option('slz-footer-light-bg');

	/*map*/
	$map_style =  Medicplus::get_option( 'slz-footer-map-style' );
	$footer_map_color       = Medicplus::get_option('slz-footer-map-color');
	$footer_map_bd_color    = Medicplus::get_option('slz-footer-map-bd-color');
	$footer_map_text_color  = Medicplus::get_option('slz-footer-map-text-color');
	
	if($footer_show == '0'){
		$content .= 'footer{display:none;}';
	}
	/*color*/
	if( isset($footer_contact_color['rgba']) && $footer_contact_color['rgba'] ) {
		$content .= 'footer .footer-content .icon1{color:'.esc_attr($footer_contact_color['rgba']).';}';
	}
	if( isset($footer_map_color['rgba']) && $footer_map_color['rgba'] ) {
		$content .= 'footer .footer-map,footer .footer-map .contact-form-wrapper .contact-form-content.right {background-color:'.esc_attr($footer_map_color['rgba']).';}';
		if ($map_style == 'three'){
			$content .= 'footer .footer-map.footer-content-style-8.new-footer-map .contact-form-wrapper .contact-form-content.right{background-color:'.esc_attr($footer_map_color['rgba']).';}';
		}else if ($map_style == 'two'){
			$content .= 'footer .footer-map.footer-content-style-15.new-footer-map .contact-form-wrapper .contact-form-content.right{background-color:'.esc_attr($footer_map_color['rgba']).';}';
		}
	}
	if( isset($footer_map_bd_color['rgba']) && $footer_map_bd_color['rgba'] ) {
		$content .= 'footer .footer-map .contact-form-wrapper .contact-form-inner .working-hours-inner + .working-hours-inner{border-color:'.esc_attr($footer_map_bd_color['rgba']).';}';
		if ($map_style == 'three'){
			$content .= 'footer .footer-map.footer-content-style-8.new-footer-map .contact-form-wrapper .contact-form-inner .working-hours-inner + .working-hours-inner{border-color:'.esc_attr($footer_map_bd_color['rgba']).';}';
		
		}else if ($map_style == 'two'){
			$content .= 'footer .footer-map.footer-content-style-15.new-footer-map .contact-form-wrapper .contact-form-inner .working-hours-inner + .working-hours-inner{border-color:'.esc_attr($footer_map_bd_color['rgba']).';}';
		}
	}
	if( isset($footer_map_text_color['rgba']) && $footer_map_text_color['rgba'] ) {
		if($map_style == 'two'){
			$content .= 'footer .footer-map.footer-content-style-15.new-footer-map .contact-form-wrapper .contact-form-inner .date-working,footer .footer-map.footer-content-style-15.new-footer-map .contact-form-wrapper .contact-form-inner .contact-information-inner .info-left{color:'.esc_attr($footer_map_text_color['rgba']).';}';
		}else{
			$content .= '.footer-map .contact-form-wrapper.footer-contact-form-wrapper .contact-form-inner .date-working, 
			.footer-map .contact-form-wrapper.footer-contact-form-wrapper .contact-form-inner .contact-information-inner .info-left{color:'.esc_attr($footer_map_text_color['rgba']).';}';
		}
	}
	if ( $footer_style == 'dark' ) {
		/*footer contact*/

		if($contact_bg){
			$contact_bg_image = '';
			if(!empty($contact_bg['background-image']) ) {
				$contact_bg_image = 'background-image: url("' .esc_url($contact_bg['background-image']). '");';
			}
			if ( !empty($contact_bg['background-color']) || $contact_bg_image) {
				$content .= 'footer .footer-content-style-3{background-color: ' .esc_attr($contact_bg['background-color']). ';' . $contact_bg_image . 'background-repeat: ' .esc_attr($contact_bg['background-repeat']). ';background-attachment: ' .esc_attr($contact_bg['background-attachment']). ';background-position:'.esc_attr($contact_bg['background-position']).';background-size:'.esc_attr($contact_bg['background-size']).';}';
			}
		}

		/*footer main*/

		if( $footer_bg ){
			$footer_bg_image = '';
			if( !empty($footer_bg['background-image']) ) {
				$footer_bg_image = 'background-image: url("' .esc_url($footer_bg['background-image']). '");';
			}
			if ( !empty($footer_bg['background-color']) || $footer_bg_image) {
				$content .= '.footer-main.footer-background{background-color: ' .esc_attr($footer_bg['background-color']). ';' . $footer_bg_image . 'background-repeat: ' .esc_attr($footer_bg['background-repeat']). ';background-attachment: ' .esc_attr($footer_bg['background-attachment']). ';background-position:'.esc_attr($footer_bg['background-position']).';background-size:'.esc_attr($footer_bg['background-size']).';}';
			}
		}

	} else {
		/*contact*/

		$contact_light_bg_image = '';
		if( !empty($contact_light_bg['background-image']) ) {
			$contact_light_bg_image = 'background-image: url("' .esc_url($contact_light_bg['background-image']). '");';
		}
		if ( !empty($contact_light_bg['background-color']) || $contact_light_bg_image) {
			$content .= 'footer .footer-content-style-2 ,footer .footer-content-style-1{background-color: ' .esc_attr($contact_light_bg['background-color']). ';' . $contact_light_bg_image . 'background-repeat: ' .esc_attr($footer_light_bg['background-repeat']). ';background-attachment: ' .esc_attr($contact_light_bg['background-attachment']). ';background-position:'.esc_attr($contact_light_bg['background-position']).';background-size:'.esc_attr($contact_light_bg['background-size']).';}';
			if ($footer_style == 'light'){
				if ( !empty($contact_light_mask['rgba']) ) {
					$content .= '.footer-content.footer-content-style-2:after{background-color:'.esc_attr($contact_light_mask['rgba']).';}';
				} else {
					$content .= '.footer-content.footer-content-style-2:after{background-color:transparent;';
				}
			}else{
				if ( !empty($contact_default_mask['rgba']) ) {
					$content .= '.footer-content.footer-content-style-1:after{background-color:'.esc_attr($contact_default_mask['rgba']).';}';
				} else {
					$content .= '.footer-content.footer-content-style-1:after{background-color:transparent;';
				}
			}
		}
		/*footer main*/
		if( $footer_light_bg ){
			$footer_light_bg_image = '';
			if( !empty($footer_light_bg['background-image']) ) {
				$footer_light_bg_image = 'background-image: url("' .esc_url($footer_light_bg['background-image']). '");';
			}
			if ( !empty($footer_light_bg['background-color']) || $footer_light_bg_image) {
				$content .= '.footer-main.footer-background{background-color: ' .esc_attr($footer_light_bg['background-color']). ';' . $footer_light_bg_image . 'background-repeat: ' .esc_attr($footer_light_bg['background-repeat']). ';background-attachment: ' .esc_attr($footer_light_bg['background-attachment']). ';background-position:'.esc_attr($footer_light_bg['background-position']).';background-size:'.esc_attr($footer_light_bg['background-size']).';}';
			}
		}
	}

	/* Blog Display */
	$bloginfo       = Medicplus::get_option('slz-bloginfo', 'disabled');
	$social_share   = Medicplus::get_option('slz-blog-share');
	
	$authorbox      = Medicplus::get_option('slz-blog-author');
	$commentbox     = Medicplus::get_option('slz-commentbox');
	$taginfo        = Medicplus::get_option('slz-blog-tag');
	$catinfo        = Medicplus::get_option('slz-blog-cat');
	$show_related   = Medicplus::get_option('slz-blog-related-post');
	if ($social_share == '0'){
		$content .= '.post-detail .share{display:none;}';
	}
	if ( $bloginfo ) {
		foreach ($bloginfo as $key => $value) {
			switch ( $key ) {
				case 'author':
					$content .= '.post-detail .list-meta li:nth-child(2){display:none;}';
					break;

				case 'view':
					$content .= '.post-detail .list-meta li:nth-child(4){display:none;}';
					break;

				case 'comment':
					$content .= '.post-detail .list-meta li:nth-child(3){display:none;}';
					break;

				case 'date':
					$content .= '.post-meta .post-date{display:none;}';
					break;

				default:
					# code...
					break;
			}
		}
	}

	if ( $authorbox == '0' ) {
		$content .= '.post-single-content .panel-default{display:none;}';
	}
	
	if ( $commentbox == '0' ) {
		$content .= '.blog-detail-wrapper .comments{display:none;}';
	}

	if ( $taginfo == '0' ) {
		$content .= '.post-single-content .tag-post-wrapper{display:none;}';
	}

	if ( $catinfo == '0' ) {
		$content .= '.post-single-content .cat-post-wrapper{display:none;}';
	}

	/* Typography */
	$body_typo      = Medicplus::get_option('slz-typo-body');
	$para_typo      = Medicplus::get_option('slz-typo-p');
	$h1_typo        = Medicplus::get_option('slz-typo-h1');
	$h2_typo        = Medicplus::get_option('slz-typo-h2');
	$h3_typo        = Medicplus::get_option('slz-typo-h3');
	$h4_typo        = Medicplus::get_option('slz-typo-h4');
	$h5_typo        = Medicplus::get_option('slz-typo-h5');
	$h6_typo        = Medicplus::get_option('slz-typo-h6');
	$text_selection = Medicplus::get_option('slz-typo-selection');
	$link_color     = Medicplus::get_option('slz-link-color');

	$body_typo_css = '';
	if( $body_typo ) {
		if ( !empty($body_typo['font-family']) ) {
			$body_typo_css .= 'font-family:'.esc_attr($body_typo['font-family']).';';
		}
		if ( !empty($body_typo['color']) ) {
			$body_typo_css .= 'color:'.esc_attr($body_typo['color']).';';
		}
		if ( !empty($body_typo['font-size']) ) {
			$body_typo_css .= 'font-size:'.esc_attr($body_typo['font-size']).';';
		}
		if ( !empty($body_typo['font-weight']) ) {
			$body_typo_css .= 'font-weight:'.esc_attr($body_typo['font-weight']).';';
		}
		if ( !empty($body_typo['font-style']) ) {
			$body_typo_css .= 'font-style:'.esc_attr($body_typo['font-style']).';';
		}
		if ( !empty($body_typo['text-align']) ) {
			$body_typo_css .= 'text-align:'.esc_attr($body_typo['text-align']).';';
		}
		if ( isset($body_typo['line-height']) && $body_typo['line-height'] !== '' ) {
			$body_typo_css .= 'line-height:'.esc_attr($body_typo['line-height']).';';
		}
	}

	$para_typo_css = '';
	if( $para_typo ){
		if ( !empty($para_typo['font-family']) ) {
			$para_typo_css .= 'font-family:'.esc_attr($para_typo['font-family']).';';
		}
		if ( !empty($para_typo['color']) ) {
			$para_typo_css .= 'color:'.esc_attr($para_typo['color']).';';
		}
		if ( !empty($para_typo['font-size']) ) {
			$para_typo_css .= 'font-size:'.esc_attr($para_typo['font-size']).';';
		}
		if ( !empty($para_typo['font-weight']) ) {
			$para_typo_css .= 'font-weight:'.esc_attr($para_typo['font-weight']).';';
		}
		if ( !empty($para_typo['font-style']) ) {
			$para_typo_css .= 'font-style:'.esc_attr($para_typo['font-style']).';';
		}
		if ( !empty($para_typo['text-align']) ) {
			$para_typo_css .= 'text-align:'.esc_attr($para_typo['text-align']).';';
		}
		if ( isset($para_typo['line-height']) && $para_typo['line-height'] !== '' ) {
			$para_typo_css .= 'line-height:'.esc_attr($para_typo['line-height']).';';
		}
	}

	$h1_typo_css = '';
	if($h1_typo){
		if ( !empty($h1_typo['font-family']) ) {
			$h1_typo_css .= 'font-family:'.esc_attr($h1_typo['font-family']).';';
		}
		if ( !empty($h1_typo['color']) ) {
			$h1_typo_css .= 'color:'.esc_attr($h1_typo['color']).';';
		}
		if ( !empty($h1_typo['font-size']) ) {
			$h1_typo_css .= 'font-size:'.esc_attr($h1_typo['font-size']).';';
		}
		if ( !empty($h1_typo['font-weight']) ) {
			$h1_typo_css .= 'font-weight:'.esc_attr($h1_typo['font-weight']).';';
		}
		if ( !empty($h1_typo['font-style']) ) {
			$h1_typo_css .= 'font-style:'.esc_attr($h1_typo['font-style']).';';
		}
		if ( !empty($h1_typo['text-align']) ) {
			$h1_typo_css .= 'text-align:'.esc_attr($h1_typo['text-align']).';';
		}
		if ( isset($h1_typo['line-height']) && $h1_typo['line-height'] !== '' ) {
			$h1_typo_css .= 'line-height:'.esc_attr($h1_typo['line-height']).';';
		}
	}
	//h2
	$h2_typo_css = '';
	if($h2_typo){
		if ( !empty($h2_typo['font-family']) ) {
			$h2_typo_css .= 'font-family:'.esc_attr($h2_typo['font-family']).';';
		}
		if ( !empty($h2_typo['color']) ) {
			$h2_typo_css .= 'color:'.esc_attr($h2_typo['color']).';';
		}
		if ( !empty($h2_typo['font-size']) ) {
			$h2_typo_css .= 'font-size:'.esc_attr($h2_typo['font-size']).';';
		}
		if ( !empty($h2_typo['font-weight']) ) {
			$h2_typo_css .= 'font-weight:'.esc_attr($h2_typo['font-weight']).';';
		}
		if ( !empty($h2_typo['font-style']) ) {
			$h2_typo_css .= 'font-style:'.esc_attr($h2_typo['font-style']).';';
		}
		if ( !empty($h2_typo['text-align']) ) {
			$h2_typo_css .= 'text-align:'.esc_attr($h2_typo['text-align']).';';
		}
		if ( isset($h2_typo['line-height']) && $h2_typo['line-height'] !== '' ) {
			$h2_typo_css .= 'line-height:'.esc_attr($h2_typo['line-height']).';';
		}
	}
	//h3
	$h3_typo_css = '';
	if($h3_typo){
		if ( !empty($h3_typo['font-family']) ) {
			$h3_typo_css .= 'font-family:'.esc_attr($h3_typo['font-family']).';';
		}
		if ( !empty($h3_typo['color']) ) {
			$h3_typo_css .= 'color:'.esc_attr($h3_typo['color']).';';
		}
		if ( !empty($h3_typo['font-size']) ) {
			$h3_typo_css .= 'font-size:'.esc_attr($h3_typo['font-size']).';';
		}
		if ( !empty($h3_typo['font-weight']) ) {
			$h3_typo_css .= 'font-weight:'.esc_attr($h3_typo['font-weight']).';';
		}
		if ( !empty($h3_typo['font-style']) ) {
			$h3_typo_css .= 'font-style:'.esc_attr($h3_typo['font-style']).';';
		}
		if ( !empty($h3_typo['text-align']) ) {
			$h3_typo_css .= 'text-align:'.esc_attr($h3_typo['text-align']).';';
		}
		if ( isset($h3_typo['line-height']) && $h3_typo['line-height'] !== '' ) {
			$h3_typo_css .= 'line-height:'.esc_attr($h3_typo['line-height']).';';
		}
	}
	//h4
	$h4_typo_css = '';
	if($h4_typo){
		if ( !empty($h4_typo['font-family']) ) {
			$h4_typo_css .= 'font-family:'.esc_attr($h4_typo['font-family']).';';
		}
		if ( !empty($h4_typo['color']) ) {
			$h4_typo_css .= 'color:'.esc_attr($h4_typo['color']).';';
		}
		if ( !empty($h4_typo['font-size']) ) {
			$h4_typo_css .= 'font-size:'.esc_attr($h4_typo['font-size']).';';
		}
		if ( !empty($h4_typo['font-weight']) ) {
			$h4_typo_css .= 'font-weight:'.esc_attr($h4_typo['font-weight']).';';
		}
		if ( !empty($h4_typo['font-style']) ) {
			$h4_typo_css .= 'font-style:'.esc_attr($h4_typo['font-style']).';';
		}
		if ( !empty($h4_typo['text-align']) ) {
			$h4_typo_css .= 'text-align:'.esc_attr($h4_typo['text-align']).';';
		}
		if ( isset($h4_typo['line-height']) && $h4_typo['line-height'] !== '' ) {
			$h4_typo_css .= 'line-height:'.esc_attr($h4_typo['line-height']).';';
		}
	}
	//h5
	$h5_typo_css = '';
	if($h5_typo){
		if ( !empty($h5_typo['font-family']) ) {
			$h5_typo_css .= 'font-family:'.esc_attr($h5_typo['font-family']).';';
		}
		if ( !empty($h5_typo['color']) ) {
			$h5_typo_css .= 'color:'.esc_attr($h5_typo['color']).';';
		}
		if ( !empty($h5_typo['font-size']) ) {
			$h5_typo_css .= 'font-size:'.esc_attr($h5_typo['font-size']).';';
		}
		if ( !empty($h5_typo['font-weight']) ) {
			$h5_typo_css .= 'font-weight:'.esc_attr($h5_typo['font-weight']).';';
		}
		if ( !empty($h5_typo['font-style']) ) {
			$h5_typo_css .= 'font-style:'.esc_attr($h5_typo['font-style']).';';
		}
		if ( !empty($h5_typo['text-align']) ) {
			$h5_typo_css .= 'text-align:'.esc_attr($h5_typo['text-align']).';';
		}
		if ( isset($h5_typo['line-height']) && $h5_typo['line-height'] !== '' ) {
			$h5_typo_css .= 'line-height:'.esc_attr($h5_typo['line-height']).';';
		}
	}
	//h6
	$h6_typo_css = '';
	if($h6_typo){
		if ( !empty($h6_typo['font-family']) ) {
			$h6_typo_css .= 'font-family:'.esc_attr($h6_typo['font-family']).';';
		}
		if ( !empty($h6_typo['color']) ) {
			$h6_typo_css .= 'color:'.esc_attr($h6_typo['color']).';';
		}
		if ( !empty($h6_typo['font-size']) ) {
			$h6_typo_css .= 'font-size:'.esc_attr($h6_typo['font-size']).';';
		}
		if ( !empty($h6_typo['font-weight']) ) {
			$h6_typo_css .= 'font-weight:'.esc_attr($h6_typo['font-weight']).';';
		}
		if ( !empty($h6_typo['font-style']) ) {
			$h6_typo_css .= 'font-style:'.esc_attr($h6_typo['font-style']).';';
		}
		if ( !empty($h6_typo['text-align']) ) {
			$h6_typo_css .= 'text-align:'.esc_attr($h6_typo['text-align']).';';
		}
		if ( isset($h6_typo['line-height']) && $h6_typo['line-height'] !== '' ) {
			$h6_typo_css .= 'line-height:'.esc_attr($h6_typo['line-height']).';';
		}
	}

	if( $body_typo_css ){
		$content .= 'body{'.$body_typo_css.'}';
	}
	if( $para_typo_css ) {
		$content .= 'p{'.$para_typo_css.'}';
	}
	if( $h1_typo_css ) {
		$content .= 'h1{'.$h1_typo_css.'}';
	}
	if( $h2_typo_css ) {
		$content .= 'h2{'.$h2_typo_css.'}';
	}
	if( $h3_typo_css ) {
		$content .= 'h3{'.$h3_typo_css.'}';
	}
	if( $h4_typo_css ) {
		$content .= 'h4{'.$h4_typo_css.'}';
	}
	if( $h5_typo_css ) {
		$content .= 'h5{'.$h5_typo_css.'}';
	}
	if( $h6_typo_css ) {
		$content .= 'h6{'.$h6_typo_css.'}';
	}

	if ( $link_color ) {
		$content .= 'a{color:'.esc_attr($link_color['regular']).'}';
		$content .= 'a:hover{color:'.esc_attr($link_color['hover']).'}';
		$content .= 'a:active{color:'.esc_attr($link_color['active']).'}';
	}

	/* End of dynamic CSS */
	echo "<!-- Start Dynamic Styling -->\n<style type=\"text/css\">\n@media screen {" . $content . "}</style> <!-- End Dynamic Styling -->\n";
	echo "<!-- Start Dynamic Styling only for desktop -->\n<style type=\"text/css\">\n@media screen and (min-width: 769px) {" . $content_desktop . "}</style> <!-- End Dynamic Styling only for desktop -->\n";

	/* Custom CSS */
	$custom_css = Medicplus::get_option('slz-custom-css');

	if ($custom_css != '') {
		echo "<!-- Custom Styling -->\n<style type=\"text/css\">\n" . esc_html( $custom_css ) . "</style>\n";
	}

	/* Custom JS */
	$custom_js = Medicplus::get_option('slz-custom-js');

	if ($custom_js != '') {
		echo "<!-- Custom JS -->\n<script type=\"text/javascript\">\n" . $custom_js . "</script>\n";
	}
	

}

add_action('wp_head', 'medicplus_dynamic_css');

/*
 * Extras Options Not use CSS
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
if ( get_option('medicplus_options') ) {
	function medicplus_sticky_class( $classes ) {
		if ( Medicplus::get_option('slz-sticky') == '1') {
			$classes[] = 'sticky-enable';
		}
		if ( Medicplus::get_option('slz-header-search-type') == 'two') {
			$classes[] = ' searchbar-type-1';
		}else{
			$classes[] = ' searchbar-type-2';
		}
		return $classes;
	}
	add_filter( 'body_class', 'medicplus_sticky_class' );
}

/* Custom Styles to WordPress Visual Editor */
function medicplus_mce_buttons_2($buttons) {
	array_unshift($buttons, 'styleselect');
	return $buttons;
}
add_filter('mce_buttons_2', 'medicplus_mce_buttons_2');

// Callback function to filter the MCE settings
function medicplus_mce_before_init_insert_formats( $init_array ) {
	$init_array['style_formats'] = json_encode( Medicplus_Params::get('style_formats') );
	return $init_array;
}
// Attach callback to 'tiny_mce_before_init'
add_filter( 'tiny_mce_before_init', 'medicplus_mce_before_init_insert_formats' );

/* add editor style */
function medicplus_add_editor_styles() {
	add_editor_style( get_template_directory_uri() . '/assets/public/css/custom-editor.css' );
	add_editor_style( get_template_directory_uri() . '/assets/public/libs/bootstrap/css/bootstrap.min.css' );
	add_editor_style( get_template_directory_uri() . '/assets/public/font/font-icon/font-awesome/css/font-awesome.min.css' );
}
add_action( 'init', 'medicplus_add_editor_styles' );

/* Custom comment_reply_link */
function medicplus_comment_reply($link, $args, $comment) {
	$reply_link_text = $args['reply_text'];
	$link = str_replace($reply_link_text, '<i class="fa fa-reply"></i>' . esc_html__('Reply', 'medicplus'), $link);
	$link = str_replace("class='comment-reply-link", "class='info", $link);
	return $link;
}
add_filter('comment_reply_link', 'medicplus_comment_reply', 10, 3);

// change default avatar
add_filter( 'get_avatar' , 'medicplus_custom_avatar' , get_current_user_id(), 5 );
function medicplus_custom_avatar( $avatar, $user_id, $size, $default, $alt ) {
	$avatar_url = '';
	$avatar_id = get_user_meta($user_id, 'profile_image_id', true);
	if( $avatar_id ) {
		$avatar_url = wp_get_attachment_url( $avatar_id );
	}
	else {
		$avatar_url = get_avatar_url( $user_id );
	}
	$avatar = "<img alt='{}' src='{$avatar_url}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}'/>";
	return $avatar;
}