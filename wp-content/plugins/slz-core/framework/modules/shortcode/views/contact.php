<?php
$block_cls = 'shortcode-contact-'.esc_attr( $id ).' '.esc_attr( $extra_class );
$data_phone = '';
$data_zoom = '';
$custom_css = '';
if ( !empty( $phone ) ) {
$data_phone = $phone;
}
if ( !empty( $zoom ) ) {
	$data_zoom = $zoom;
}
$img = SLZCORE_ASSET_URI.'/images/logo-default.png';
$left = '';
$right = '';
if ( !empty($address) && !empty($contact_form) ) {
	$left = 'left';
	$right = 'right';
}

if( !empty($address) || !empty($contact_form) ) :
echo '<div class="contact-form-wrapper sc-contact slz-shortcode '.esc_attr( $block_cls ).'">';
	if( !empty($contact_form) ) :
	echo '<div class="contact-form-content contact-form '.esc_attr($right).'">';
		echo '
				<div class="contact-form-inner">
					<div class="contact-form-header">
		';
		if ( !empty( $header ) ) {
			echo '<div class="typo-line"><h4 class="sub-header">'.esc_html( $header ).'</h4></div>';
		}
		if ( !empty( $title ) ) {
			echo '<h2 class="header">'.esc_html( $title ).'</h2>';
		}
		if ( !empty( $description ) ) {
			echo '<div class="description">'.wp_kses_post( $description ).'</div>';
		}
		if ( !empty($contact_form) && SLZCORE_WPCF7_ACTIVE ) {
			echo do_shortcode('[contact-form-7 id="'.esc_attr( $contact_form ).'" title="'.$title.'" html_id="contact-form-'.esc_attr($id).'" html_class="contact-form"]');
		}
		echo '
					</div>
				</div>
		';
	echo '</div>';
	endif;
	if( !empty($address) ) :
	echo '<div id="slz-contact-map" class="contact-form-content contact-map '.esc_attr($left).'">';

		if ( !empty( $address ) ) {
			printf( '<div id="map" class="map-contact-style" data-img-url="%1$s" data-address="%2$s" data-phone="%3$s" data-zoom="%4$s" data-urlimg="%5$s" data-height="%6$s" data-width="%7$s"></div>', SLZCORE_MAP_MAKER, esc_attr( $address ), esc_attr( $data_phone ), esc_attr( $data_zoom ), esc_url( $img ), esc_attr( $height ), esc_attr( $width ) );
		}

	echo '</div>';
	endif;
echo '</div>';
endif;

if ( !empty($custom_css) ) {
	do_action( SLZCORE_ADD_INLINE_CSS, $custom_css );
}