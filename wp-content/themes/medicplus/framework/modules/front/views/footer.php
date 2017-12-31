<?php
/**
 * Footer Main
 */

$footer_css     = 'dark';
$footer_c1_css  = '';
$footer_c2_css  = '';
$footer_c3_css  = '';
$footer_c4_css  = '';
$footer_bt      = '';

$footer_stt = '1';
$footer_stt = Medicplus::get_option('slz-footer');

$footer_css = Medicplus::get_option('slz-footer-style');
if( empty( $footer_css ) ) {
	$footer_css = 'dark';
}
$footer_main_stt    = Medicplus::get_option('slz-footerbt-main-info');
$footerbt_stt       = Medicplus::get_option('slz-footerbt-show');
$footer_bottom_text = Medicplus::get_option('slz-footerbt-text');
$menu_location = 'footer-nav' ;
$footerbt_nav  = '';
if( has_nav_menu( $menu_location ) ) {
	$walker = new  Medicplus_Nav_Walker;
	$footerbt_nav = wp_nav_menu( array(
		'theme_location'	=> $menu_location,
		'echo'				=> '0',
		'walker'			=> $walker
	));
}

$footer_col = Medicplus::get_option('slz-footer-col');
if( empty( $footer_col ) ) {
	$footer_col = '4';
}

if ( $footer_col == '11' ) {
	$footer_c1_css = 'col-md-12 col-sm-12 text-center';
	$footer_c2_css = 'hide';
	$footer_c3_css = 'hide';
	$footer_c4_css = 'hide';
}
if ( $footer_col == '1' ) {
	$footer_c1_css = 'col-md-12 col-sm-12';
	$footer_c2_css = 'hide';
	$footer_c3_css = 'hide';
	$footer_c4_css = 'hide';
}
if ( $footer_col == '2' ) {
	$footer_c1_css = 'col-md-6 col-sm-6';
	$footer_c2_css = 'col-md-6 col-sm-6';
	$footer_c3_css = 'hide';
	$footer_c4_css = 'hide';
}
if ( $footer_col == '3' ) {
	$footer_c1_css = 'col-md-4 col-sm-4';
	$footer_c2_css = 'col-md-4 col-sm-4';
	$footer_c3_css = 'col-md-4 col-sm-4';
	$footer_c4_css = 'hide';
}
if ( $footer_col == '4' ) {
	$footer_c1_css = 'col-md-3 prl col-sm-6';
	$footer_c2_css = 'col-md-3 pll prl col-sm-6';
	$footer_c3_css = 'col-md-3 pll col-sm-6';
	$footer_c4_css = 'col-md-3 prl col-sm-6';
}

/**
 * Footer Bottom
 */
// Content
$copyright = '<span>' . Medicplus::get_option('slz-footerbt-text') . '</span>';
$footerbt_style = Medicplus::get_option('slz-footerbt-style');
$footerbt_style_class = '';
if ( $footerbt_style == 'dark') {
	$footerbt_style_class = 'footer-base-style-2';
}

$menu_location = 'footer-nav' ;
$footerbt_nav = '';
if( has_nav_menu( $menu_location ) ) {
	$walker = new Medicplus_Nav_Walker;
	$footerbt_nav = wp_nav_menu( array(
		'theme_location'	=> $menu_location,
		'container'			=> 'ul',
		'menu_class'		=> 'list-footer list-unstyled list-inline',
		'echo'				=> '0',
		'walker'			=> $walker
	));
}

$footer_sidebar_arr = array();
for( $i= 1; $i<=4; $i++){
	$footer_sidebar_id = 'medicplus-sidebar-footer-' . $i;
	$select_sidebar = Medicplus::get_option('slz-sidebar-footer-id-' . $i);
	if( !empty( $select_sidebar ) ) {
		$footer_sidebar_id = $select_sidebar;
	}
	$footer_sidebar_arr['sidebar_footer_'.$i] = $footer_sidebar_id;
}

extract($footer_sidebar_arr);
?>
<?php if ( $footer_stt == '1' ) {?>
	<?php if ( $footer_css == 'dark' ) { ?>
		<div class="footer-widget footer-widget-dark">
			<?php if( $footer_main_stt == '1'):?>
			<div class="footer-main footer-background padding-top padding-bottom">
				<div class="container">
					<div class="footer-main-wrapper padding-top-2 padding-bottom row">
						<div id="footer_c1" class="footer-area <?php echo esc_attr( $footer_c1_css ); ?>">
							<?php dynamic_sidebar( $sidebar_footer_1 ); ?>
						</div>
						<div id="footer_c2" class="footer-area <?php echo esc_attr( $footer_c2_css ); ?>">
							<?php dynamic_sidebar( $sidebar_footer_2 ); ?>
						</div>
						<div id="footer_c3" class="footer-area <?php echo esc_attr( $footer_c3_css ); ?>">
							<?php dynamic_sidebar( $sidebar_footer_3 ); ?>
						</div>
						<div id="footer_c4" class="footer-area <?php echo esc_attr( $footer_c4_css ); ?>">
							<?php dynamic_sidebar( $sidebar_footer_4 ); ?>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<?php endif;?>
		</div>
	<?php } else { ?>
		<div class="footer-widget footer-widget-light">
			<?php if( $footer_main_stt == '1'):?>
			<div class="footer-main footer-background  padding-top padding-bottom ">
				<div class="container">
					<div class="footer-main-wrapper padding-top-2 padding-bottom row">
						<div id="footer_c1" class="footer-area <?php echo esc_attr( $footer_c1_css ); ?>">
							<?php dynamic_sidebar( $sidebar_footer_1 ); ?>
						</div>
						<div id="footer_c2" class="footer-area <?php echo esc_attr( $footer_c2_css ); ?>">
							<?php dynamic_sidebar( $sidebar_footer_2 ); ?>
						</div>
						<div id="footer_c3" class="footer-area <?php echo esc_attr( $footer_c3_css ); ?>">
							<?php dynamic_sidebar( $sidebar_footer_3 ); ?>
						</div>
						<div id="footer_c4" class="footer-area <?php echo esc_attr( $footer_c4_css ); ?>">
							<?php dynamic_sidebar( $sidebar_footer_4 ); ?>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<?php endif;?>
		</div>
	<?php } ?>
	<?php if ( $footerbt_stt == '1' ) { ?>
		<div class="footer-base <?php echo esc_attr( $footerbt_style_class ); ?>">
			<div class="container">
				<div class="footer-base-left">
					<?php echo wp_kses_post($footer_bottom_text);?>
				</div>
				<div class="footer-base-right">
					<?php echo wp_kses_post($footerbt_nav); ?>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<?php } ?>
<?php } ?>