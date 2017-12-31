<?php
$custom_css = "";
if( $atts['style'] == '1' ):
$image = wp_get_attachment_image_src( $atts['image'], "large" );
$background = wp_get_attachment_image_src( $atts['background'], "large" );

if( !empty( $background ) ){
	$custom_css .= sprintf('.slz-shortcode.banner.id-%s .why-choose-us-wrapper{background-image:url(%s);}', esc_attr( $atts[ 'id' ] ), esc_attr( $background[0] ));
}
if( !empty( $atts['bg_transparent'] ) ) {
	$custom_css .= sprintf('.slz-shortcode.banner.id-%s .why-choose-us-wrapper{background-color:transparent;}', esc_attr( $atts[ 'id' ] ));
}
elseif( !empty( $atts['background_color'] ) ){
	$custom_css .= sprintf('.slz-shortcode.banner.id-%s .why-choose-us-wrapper{background-color:%s;}', esc_attr( $atts[ 'id' ] ), esc_attr( $atts['background_color'] ));
}

if( !empty( $atts['title_color'] ) ){
	$custom_css .= sprintf('.slz-shortcode.banner.id-%s .why-choose-us-wrapper .why-choose-us-title{color:%s;}', esc_attr( $atts[ 'id' ] ), esc_attr( $atts['title_color'] ));
}

if( !empty( $atts['description_color'] ) ){
	$custom_css .= sprintf('.slz-shortcode.banner.id-%s .why-choose-us-wrapper .description{color:%s;}', esc_attr( $atts[ 'id' ] ), esc_attr( $atts['description_color'] ));
}
if( !empty( $atts['image_height'] ) ){
	$custom_css .= sprintf( '.slz-shortcode.banner.id-%s .why-choose-us-wrapper img{height:%s;}', esc_attr( $atts[ 'id' ] ), esc_attr( $atts['image_height'] ) );
}
if( !empty( $atts['array_button'] ) && is_array( $atts['array_button'] ) ){
	foreach ( $atts['array_button'] as $key => $value ) {
		if ( !empty($value['btn_transparent']) ) {
			$custom_css .= sprintf('.slz-shortcode.banner.id-%s #button-' . $atts['id'] . '-' . $key . '{background-color:transparent;}', esc_attr( $atts[ 'id' ] ));
		}
		elseif ( !empty($value['color']) ) {
			$custom_css .= sprintf('.slz-shortcode.banner.id-%s #button-' . $atts['id'] . '-' . $key . '{background-color:%s;}', esc_attr( $atts[ 'id' ] ), esc_attr( $value['color'] ));
		}
		if ( !empty($value['color_hover']) ) {
			$custom_css .= sprintf('.slz-shortcode.banner.id-%s #button-' . $atts['id'] . '-' . $key . ':hover {background-color:%s;}', esc_attr( $atts[ 'id' ] ), esc_attr( $value['color_hover'] ));
		}
		if ( !empty($value['text_color']) ) {
			$custom_css .= sprintf('.slz-shortcode.banner.id-%s #button-' . $atts['id'] . '-' . $key . '{color:%s;}', esc_attr( $atts[ 'id' ] ), esc_attr( $value['text_color'] ));
		}
		if ( !empty($value['text_color_hover']) ) {
			$custom_css .= sprintf('.slz-shortcode.banner.id-%s #button-' . $atts['id'] . '-' . $key . ':hover {color:%s;}', esc_attr( $atts[ 'id' ] ), esc_attr( $value['text_color_hover'] ));
		}
		if ( !empty($value['border_color']) ) {
			$custom_css .= sprintf('.slz-shortcode.banner.id-%s #button-' . $atts['id'] . '-' . $key . '{border-color:%s;}', esc_attr( $atts[ 'id' ] ), esc_attr( $value['border_color'] ));
		}
		if ( !empty($value['border_color_hover']) ) {
			$custom_css .= sprintf('.slz-shortcode.banner.id-%s #button-' . $atts['id'] . '-' . $key . ':hover {border-color:%s;}', esc_attr( $atts[ 'id' ] ), esc_attr( $value['border_color_hover'] ));
		}
	}
}
?>
<div class="slz-shortcode banner id-<?php echo esc_attr( $atts['id'] ).' '.esc_attr( $atts['extra_class'] ); ?>">
	<div class="why-choose-us-wrapper" id="choose-background">
		<div <?php if( !empty( $atts['full_width'] ) ) echo 'class="container"'; ?>>
			<h3 class="why-choose-us-title"><?php echo esc_html( $atts['title'] ); ?></h3>
			<div class="description"><?php echo wp_kses_post( $atts['content'] ); ?></div>
				<?php
					if( !empty( $atts['array_button'] ) && is_array( $atts['array_button'] ) ){
						echo '<div class="btn-wrapper">';
						foreach ( $atts['array_button'] as $index => $value ) {
							$btn_title = Medicplus_Core::get_value($value, 'title');
							$btn_link = Medicplus_Core::get_value($value, 'url');
							if( $btn_title ) {
								$link_val = Medicplus_Core_Util::get_link($btn_link);
								if ( !empty($link_val) ) {
									$link_val['link'] = esc_url( $link_val['link'] );
								} else {
								 	$link_val['link'] = 'javascipt:void(0)';
								 	$link_val['target'] = $link_val['url_title'] = '';
								}
								echo '<a id="button-' . $atts['id'] . '-' . $index . '" href="' . esc_attr( $link_val['link'] ) . '" class="btn" '. esc_attr( $link_val['url_title'] ). ' '. esc_attr( $link_val['target'] ) .'>' . esc_html( $btn_title ) . '</a>';
							}
						}
						echo '</div>';
					}
					if( $image ) {
						echo '<img src="'. esc_url( $image[0] ) .'" alt="" class="img-wcu img-responsive">';
					}
				?>
		</div>
	</div>
</div>
<?php
else:
// style 2
?>
<div class="slz-shortcode text-below-slider sc-<?php echo esc_attr($atts['id']).' '.esc_attr($atts['extra_class']); ?>">
	<div class="text-inner">
	<?php
		if( !empty( $atts['title'] ) ){
			printf('<div class="text-left">%s</div>', esc_html( $atts['title'] ) );
		}
		if( !empty( $atts['btn_text'] ) && !empty( $atts['btn_url'] ) ){
			$btn_url = Medicplus_Core_Util::get_link( $atts['btn_url'] );
			printf('<div class="text-right btn-wrapper">
						<a href="%1$s" class="btn" %2$s %3$s>%4$s</a>
					</div>',
					esc_url( $btn_url['link'] ),
					esc_attr( $btn_url['url_title'] ),
					esc_attr( $btn_url['target'] ),
					esc_html( $atts['btn_text'] )
				);
		}
	?>
	</div>
</div>
<?php
	if( !empty( $atts['text_color'] ) ){
		$custom_css.= sprintf('.text-below-slider.sc-%s .text-right .btn{ color: %s; }',
								esc_attr( $atts[ 'id' ] ), esc_attr( $atts['text_color'] ) );
	}
	if( !empty( $atts['border_color'] ) ){
		$custom_css.= sprintf('.text-below-slider.sc-%s .text-right .btn{ border-color: %s; }',
								esc_attr( $atts[ 'id' ] ), esc_attr( $atts['border_color'] ) );
	}
	if( !empty( $atts['bg_transparent'] ) ) {
		$custom_css .= sprintf('.text-below-slider.sc-%s .btn-wrapper .btn{ background-color: transparent; }',
								esc_attr( $atts[ 'id' ] ) );
	}
	elseif( !empty( $atts['bg_color'] ) ){
		$custom_css.= sprintf('.text-below-slider.sc-%s .btn-wrapper .btn{ background-color: %s; }',
								esc_attr( $atts[ 'id' ] ), esc_attr( $atts['bg_color'] ) );
	}
	if( !empty( $atts['text_hov_color'] ) ){
		$custom_css.= sprintf('.text-below-slider.sc-%s .text-right .btn:hover{ color: %s; }',
								esc_attr( $atts[ 'id' ] ), esc_attr( $atts['text_hov_color'] ) );
	}
	if( !empty( $atts['border_hov_color'] ) ){
		$custom_css.= sprintf('.text-below-slider.sc-%s .text-right .btn:hover{ border-color: %s; }',
								esc_attr( $atts[ 'id' ] ), esc_attr( $atts['border_hov_color'] ) );
	}
	if( !empty( $atts['bg_hov_color'] ) ){
		$custom_css.= sprintf('.text-below-slider.sc-%s .text-right .btn:hover{ background-color: %s; }',
								esc_attr( $atts[ 'id' ] ), esc_attr( $atts['bg_hov_color'] ) );
	}
	if( !empty( $atts['title_color'] ) ){
		$custom_css .= sprintf('.text-below-slider.sc-%s .text-left{color:%s;}', esc_attr( $atts[ 'id' ] ), esc_attr( $atts['title_color'] ));
	}
endif;
if( $custom_css ) {
	do_action( SLZCORE_ADD_INLINE_CSS, $custom_css );
}
?>