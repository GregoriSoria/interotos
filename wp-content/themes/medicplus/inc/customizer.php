<?php
/**
 * Theme Customizer
 *
 * @author Swlabs
 * @package MedicPlus
 * @since 1.0
 */

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function medicplus_customize_preview_js() {
	wp_enqueue_script( 'medicplus_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20160508', true );
}
add_action( 'customize_preview_init', 'medicplus_customize_preview_js' );