<?php
/**
 * Header template.
 * 
 * @author Swlabs
 * @since 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php endif; ?>
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
		<div class="body-wrapper <?php echo esc_attr(Medicplus::get_option('slz-body-extra-class'));?>">
		<!-- BODY WRAPPER-->
			<!-- MENU MOBILE-->
			<div class="wrapper-mobile-nav">
				<div class="header-topbar">
					<div class="topbar-search search-mobile">
						<?php get_search_form();?>
					</div>
				</div>
				<div class="header-main">
					<div class="menu-mobile">
						<?php medicplus_show_main_menu(); ?>
					</div>
				</div>
			</div>
			<div id="page" class="wrapper-content site <?php echo esc_attr( medicplus_get_page_class() );?>">
			<!-- PAGE-->
				<?php do_action('medicplus_show_header');?>
				<div class="clearfix"></div>
				<!-- WRAPPER-->
				<div id="wrapper-content">
					<!-- PAGE WRAPPER-->
					<div id="page-wrapper">
						<!-- MAIN CONTENT-->
						<div class="main-content">
							<!-- CONTENT-->
							<div class="content">
								<?php do_action('medicplus_show_slider');?>
								<?php if( medicplus_has_page_title() ) :?>
								<?php do_action('medicplus_show_page_title');?>
								<?php endif;?>
