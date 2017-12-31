<?php
$icon = '';
$custom_css = '';

if ( !empty($icon_type) && $icon_type == '02' && !empty( $icon_fw ) ) {
	$icon = $icon_fw;

}
elseif ( empty($icon_type) && !empty( $icon_ex ) ) {
	$icon = $icon_ex;
}
echo '<div class="slz-shortcode icons-box-'.esc_attr($id).' '.esc_attr($extra_class).'">';

if( $style_icon == '2' ) {

	if( !empty($color) ){
		$custom_css .= sprintf('.icons-box-%s .services-content .btn-for-icon i{color:%s;}', esc_attr($id), esc_attr( $color ));
		$custom_css .= sprintf('.icons-box-%s .services-content .btn-for-icon .icon2{background-color:%s;}', esc_attr($id), esc_attr( $color ));
		$custom_css .= sprintf('.icons-box-%s .line{background-color:%s;}', esc_attr($id), esc_attr( $color ));
	}
	if( !empty($color_icon) ){
		$custom_css .= sprintf('.icons-box-%s .services-content .btn-for-icon i{background-color:%s;}', esc_attr($id), esc_attr( $color_icon ));
		$custom_css .= sprintf('.icons-box-%s .services-content .btn-for-icon .icon2{color:%s;}', esc_attr($id), esc_attr( $color_icon ));
	}
	if( !empty($color_hover) ){
		$custom_css .= sprintf('.icons-box-%s .services-content:after{background-color:%s;}', esc_attr($id), esc_attr( $color_hover ));
	}
	if( !empty($title_color) ){
		$custom_css .= sprintf('.icons-box-%s .services-content .services-title{color:%s;}', esc_attr($id), esc_attr( $title_color ));
	}
	if( !empty($description_color) ){
		$custom_css .= sprintf('.icons-box-%s .services-content .description{color:%s;}', esc_attr($id), esc_attr( $description_color ));
	}
	if ( !empty($icon) || !empty($title) || !empty($description) ) {
		echo '<div class="services-content">';
			echo '<div class="btn-for-icon bottom">
					<i class="icon1 '.esc_attr($icon).'"></i>
					<i class="icon2 '.esc_attr($icon).'"></i>';
			echo '</div>';
			echo '<div class="line"></div>';
		if ( !empty($title) ) {
			echo '<h3 class="services-title">'.esc_html($title).'</h3>';
		}
		if ( !empty($description) ) {
			echo '<div class="description">'.wp_kses_post($description).'</div>';
		}
		echo '</div>';
	}
}
elseif ( $style_icon == '3' ) {
	if( !empty($color) ){
		$custom_css .= sprintf('.icons-box-%s .info-footer .btn-for-icon i{color:%s;}', esc_attr($id), esc_attr( $color ));
	}
	if( !empty($title_color) ){
		$custom_css .= sprintf('.icons-box-%s .info-footer .title-footer{color:%s;}', esc_attr($id), esc_attr( $title_color ));
	}
	if( !empty($description_color) ){
		$custom_css .= sprintf('.icons-box-%s .info-footer .footer-description{color:%s;}', esc_attr($id), esc_attr( $description_color ));
	}

	if ( !empty($icon) || !empty($title) || !empty($description) ) {
		echo '<div class="icons-box-style-3 info-footer">';
			echo '<div class="info-footer-img btn-for-icon">';
				echo '<i class="icon1 '.esc_attr( $icon ).'"></i>';
			echo '</div>';
		if ( !empty($title) ) {
			echo '<h2 class="title-footer">'.esc_html($title).'</h2>';
		}
		if ( !empty($description) ) {
			echo '<div class="footer-description">'.wp_kses_post($description).'</div>';
		}
		echo '</div>';
	}
}
elseif ( $style_icon == '4' ) {
	if( !empty($color) ){
		$custom_css .= sprintf('.icons-box-%s .feature-1 i{color:%s;}', esc_attr($id), esc_attr( $color ));
	}
	if( !empty($title_color) ){
		$custom_css .= sprintf('.icons-box-%s .feature-1 .header-feature{color:%s;}', esc_attr($id), esc_attr( $title_color ));
	}
	if( !empty($description_color) ){
		$custom_css .= sprintf('.icons-box-%s .feature-1 .description{color:%s;}', esc_attr($id), esc_attr( $description_color ));
	}

	if ( !empty($icon) || !empty($title) || !empty($description)) {
		echo '<div class="feature-1 style-2 item wow flipInY">';
			echo '<i class="'.esc_attr( $icon ).'"></i>';
		if ( !empty($title) ) {
			echo '<h5 class="header-feature">'.esc_html($title).'</h5>';
		}
		if ( !empty($description) ) {
			echo '<div class="description">'.wp_kses_post($description).'</div>';
		}
		echo '</div>';
	}
}
elseif ( $style_icon == '5' ) {
	if( !empty($color) ){
		$custom_css .= sprintf('.icons-box-%s .btn-for-icon i{color:%s;}', esc_attr($id), esc_attr( $color ));
	}
	if( !empty($title_color) ){
		$custom_css .= sprintf('.icons-box-%s .services-content .services-title{color:%s;}', esc_attr($id), esc_attr( $title_color ));
	}
	if( !empty($description_color) ){
		$custom_css .= sprintf('.icons-box-%s .services-content .description{color:%s;}', esc_attr($id), esc_attr( $description_color ));
	}
	if( !empty( $alignment ) ){
		$custom_css .= sprintf('.icons-box-%s .services-content{text-align:%s;}', esc_attr($id), esc_attr($alignment));
	}

	if ( !empty($icon) || !empty($title) || !empty($description)) {
		echo '<div class="services-content style-3">';
			echo '<div class="btn-for-icon">';
				echo '<i class="icon1 '.esc_attr( $icon ).'"></i>';
			echo '</div>';
			if ( !empty($title) ) {
				echo '<h3 class="services-title">'.esc_html($title).'</h3>';
			}
			if ( !empty($description) ) {
				echo '<div class="description">'.wp_kses_post($description).'</div>';
			}
		echo '</div>';
	}
}
else{

	if( !empty($color) ){
		$custom_css .= sprintf('.icons-box-%s .btn-for-icon i.icon1{color:%s;}', esc_attr($id), esc_attr( $color ));
		$custom_css .= sprintf('.icons-box-%s .btn-for-icon i.icon2 {background-color:%s;}', esc_attr($id), esc_attr( $color ));
		$custom_css .= sprintf('.icons-box-%s .howwedoit-inner:hover:before{border-color:%s;}', esc_attr($id), esc_attr( $color ));
	}
	if( !empty($color_icon) ){
		$custom_css .= sprintf('.icons-box-%s .btn-for-icon i.icon1 {background-color:%s;}', esc_attr($id), esc_attr( $color_icon ));
		$custom_css .= sprintf('.icons-box-%s .btn-for-icon i.icon2 {color:%s;}', esc_attr($id), esc_attr( $color_icon ));
	}
	if( !empty($title_color) ){
		$custom_css .= sprintf('.icons-box-%s .howwedoit-inner .howwedoit-title{color:%s;}', esc_attr($id), esc_attr( $title_color ));
	}
	if ( !empty($icon) || !empty($title) ) {
			echo '<div class="howwedoit-inner">';
				echo '<div class="btn-for-icon left">';
					echo '<i class="icon1 '.esc_attr( $icon ).'"></i>';
					echo '<i class="icon2 '.esc_attr( $icon ).'"></i>';
				echo '</div>';
			if ( !empty($title) ) {
				echo '<h2 class="howwedoit-title">'.esc_html($title).'</h2>';
			}
			echo '</div>';
	}
}
echo '</div>';

if ( !empty($custom_css) ) {
	do_action( SLZCORE_ADD_INLINE_CSS, $custom_css );
}