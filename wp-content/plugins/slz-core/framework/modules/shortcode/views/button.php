<?php if ( !empty($title) ) : 
$classButton = 'button-' . $id;
$custom_css = "";
if( !empty( $alignment ) ) {
	$custom_css .= sprintf('.%s .btn-wrapper {text-align: %s;}', esc_attr( $classButton ), esc_attr( $alignment ));
}
if( !empty( $bg_transparent ) && $bg_transparent == 'yes' ) {
	$custom_css .= sprintf('.%s .btn {background: transparent;}', esc_attr( $classButton ) );
} else {
	if( !empty( $button_color ) ) {
		$custom_css .= sprintf('.%s .btn{background-color:%s;}', esc_attr( $classButton ), esc_attr( $button_color ) );
	}
}
if( !empty( $button_color_hover ) ) {
	$custom_css .= sprintf('.%s .btn:hover{background-color:%s;}', esc_attr( $classButton ), esc_attr( $button_color_hover ) );
}
if( !empty( $text_color ) ){
	$custom_css .= sprintf('.%s .btn {color:%s;}', esc_attr( $classButton ), esc_attr( $text_color ) );
}
if( !empty( $text_color_hover ) ) {
	$custom_css .= sprintf('.%s .btn:hover{color:%s;}', esc_attr( $classButton ), esc_attr( $text_color_hover ) );
}
if( !empty( $border_color) ){
	$custom_css .= sprintf('.%s .btn {border-color:%s}', esc_attr( $classButton ), esc_attr( $border_color ) );
}
if( !empty( $border_color_hover) ) {
	$custom_css .= sprintf('.%s .btn:hover{border-color:%s}', esc_attr( $classButton ), esc_attr( $border_color_hover ) );
}
if ( !empty($custom_css) ) {
	do_action( SLZCORE_ADD_INLINE_CSS, $custom_css );
}
?>
<div class="slz-shortcode button <?php echo esc_attr( $extra_class ); ?> <?php echo esc_attr( $classButton ); ?>">
	<div class="btn-wrapper">
		<?php
		$target = Medicplus_Core::get_value($url, 'target');
		$url_title = Medicplus_Core::get_value($url, 'url_title');
		$link = Medicplus_Core::get_value($url, 'link');
		if( empty( $link ) ) { 
			$link = 'javascript:void(0)';
		}
		$btn_class = '';
		$cf7_id = '';
		$btn_atts = sprintf( '%1$s %2$s', esc_attr( $url_title ), esc_attr( $target ) );
		if( SLZCORE_WPCF7_ACTIVE && isset(  $open_form ) && !empty( $open_form ) && !empty( $contact_form ) ){
			$link = 'javascript:void(0)';
			$btn_class = 'open_cf7_modal';
			$btn_atts = sprintf( '%1$s %2$s data-cf7-id=%3$s data-toggle=modal data-target=.slz_cf7_modal',
								esc_attr( $url_title ), esc_attr( $target ), esc_attr( $contact_form )
							);
			
			$uri = plugins_url().'/contact-form-7/includes/js/scripts.js';
			$cf7_content = do_shortcode('[contact-form-7 id="'. esc_attr( $contact_form ) .'"]');
			printf('<div class="cf7-content hide">
						<button type="button" data-dismiss="modal" class="close">
							<span aria-hidden="true">&times;</span>
						</button>
						%1$s
					</div>
					<div class="cf7_js_uri hide">%2$s</div>',
					$cf7_content,
					esc_url( $uri )
				);
		}
		printf( '<a href="%1$s" class="btn %2$s" %3$s>%4$s</a>',
				esc_attr( $link ),
				esc_attr( $btn_class ),
				esc_attr( $btn_atts ),
				esc_html( $title )
			);
		?>
	</div>
</div>
<?php endif; ?>