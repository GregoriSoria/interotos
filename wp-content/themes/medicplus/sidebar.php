<?php
/**
 * The sidebar containing the main widget area.
 * 
 * @author Swlabs
 * @package MedicPlus
 * @since 1.0
 */
if ( ! is_active_sidebar( 'medicplus-sidebar-default' ) ) {
	return;
}

?>
<div class="sidebar-wrapper">
	<?php dynamic_sidebar( 'medicplus-sidebar-default' ); ?>
</div>