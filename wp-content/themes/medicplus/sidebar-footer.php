<?php
/**
 * The Content Sidebar
 * 
 * @author Swlabs
 * @package MedicPlus
 * @since 1.0
 */
$medicplus_footer_css = medicplus_get_footer_class();
if ( ! is_active_sidebar( 'medicplus-sidebar-footer-1' ) &&
	 ! is_active_sidebar( 'medicplus-sidebar-footer-2' ) &&
	 ! is_active_sidebar( 'medicplus-sidebar-footer-3' ) &&
	 ! is_active_sidebar( 'medicplus-sidebar-footer-4' )) {
	return;
}
?>
<div id="footer" class="content-sidebar widget-area"
	role="complementary">
	<div id="section-footer" class="section">
		<div class="container">
		<!--	<div class="section-content">
				<div class=row>
					<div class="<?php echo esc_attr( $medicplus_footer_css['footer_c1'] ); ?>"><?php dynamic_sidebar( 'medicplus-sidebar-footer-1' ); ?></div>
					<div class="<?php echo esc_attr( $medicplus_footer_css['footer_c2'] ); ?>"><?php dynamic_sidebar( 'medicplus-sidebar-footer-2' ); ?></div>
					<div class="<?php echo esc_attr( $medicplus_footer_css['footer_c3'] ); ?>"><?php dynamic_sidebar( 'medicplus-sidebar-footer-3' ); ?></div>
					<div class="<?php echo esc_attr( $medicplus_footer_css['footer_c4'] ); ?>"><?php dynamic_sidebar( 'medicplus-sidebar-footer-4' ); ?></div>
				</div>
			</div> -->
		</div>
	</div>
</div>
<!-- #content-sidebar -->