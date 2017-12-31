<?php
$block_cls = 'image-list-'.esc_attr($id).' '.esc_attr($extra_class);
$custom_css = '';
$images = wp_get_attachment_image_url( $image, 'medicplus-thumb-175x181' );
if( !empty($color_buttom) ){
	$custom_css .= sprintf('.image-list-%s .nutrition-services-content .nutrition-btn {color:%s;}', esc_attr($id), esc_attr( $color_buttom));
	$custom_css .= sprintf('.image-list-%s .nutrition-services-content .nutrition-btn:before {background-color:%s;}', esc_attr($id), esc_attr( $color_buttom));
	$custom_css .= sprintf('.image-list-%s .nutrition-services-content {border-left:2px solid %s;}', esc_attr($id), esc_attr( $color_buttom));
	$custom_css .= sprintf('.image-list-%s .nutrition-services-content {border-right:2px solid %s;}', esc_attr($id), esc_attr( $color_buttom));
	$custom_css .= sprintf('.image-list-%s .nutrition-services-content:before {border-top:2px solid %s;}', esc_attr($id), esc_attr( $color_buttom));
	$custom_css .= sprintf('.image-list-%s .nutrition-services-content:before {border-bottom:2px solid %s;}', esc_attr($id), esc_attr( $color_buttom));
}
if( !empty($color_buttom_hover) ){
	$custom_css .= sprintf('.image-list-%s .nutrition-services-content .nutrition-btn:hover {color:%s;}', esc_attr($id), esc_attr( $color_buttom_hover));
	$custom_css .= sprintf('.image-list-%s .nutrition-services-content .nutrition-btn:hover:before, .nutrition-services-content .nutrition-btn:focus:before {background-color:%s;}', esc_attr($id), esc_attr( $color_buttom_hover));
}
if( !empty($title_color) ){
	$custom_css .= sprintf('.image-list-%s .nutrition-services-content .services-title{color:%s;}', esc_attr($id), esc_attr( $title_color ));
}
if( !empty($description_color) ){
	$custom_css .= sprintf('.image-list-%s .nutrition-services-content .description{color:%s;}', esc_attr($id), esc_attr( $description_color ));
}
if ( !empty($button_txt) ) {
	if ( !empty($url_btn['link']) ) {
		$btn = '<a href="'.esc_url($url_btn['link']).'" '.esc_attr($url_btn['url_title']).' '.esc_attr($url_btn['target']).' class="nutrition-btn">'.esc_attr($button_txt).'</a>';
	}else{
		$btn = '<a href="" class="nutrition-btn">'.esc_attr($button_txt).'</a>';
	}
}

if(!empty($images) && !empty($title)):
echo '<div class="slz-shortcode '.esc_attr($block_cls).'">';
	echo '<div class="nutrition-services-content">';
		echo '<img src="'.esc_url($images).'" alt="" class="img-responsive">
			<h3 class="services-title">'.esc_html($title).'</h3>
			<div class="description">'.wp_kses_post($description).'</div>';
			if( !empty($btn) ) :
				echo wp_kses_post($btn);
			endif;
	echo '</div>';
echo '</div>';
endif;
if ( !empty($custom_css) ) {
	do_action( SLZCORE_ADD_INLINE_CSS, $custom_css );
}