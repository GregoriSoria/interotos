<?php
$html_options = array(
	'icon_fmt'       => '<i class="%1$s"></i>',
	'title_fmt'      => '<h5 class="header-feature item-title">%1$s</h5>',
	'desc_fmt'       => '<div class="description">%1$s</div>',
	'data_delay_fmt' => '',
);

$map_number_item = array(
	'1' => '100%',
	'2' => '50%',
	'3' => '33.33%',
	'4' => '25%'
);
$contain_cls = 'appointment-wrapper';
$custom_css = '';
if( $number_item && isset($map_number_item[$number_item])) {
	$custom_css = sprintf('.slz-shortcode.feature-item-%1$s .list-features .item { width : %2$s; }',
			esc_attr($id), esc_attr( $map_number_item[$number_item] )
	);
}
// 1 - icon, 2 - title, 3 - desc, 4 - index, 5 - data-wow-delay="0.2s", 6 - big
switch ( $style ) {
	case '2':
		$contain_cls = 'why-choose-us-wrapper-new dental-care';
		$open_group = '<div class="list-features list-unstyled dental-care">';
		$close_group = '</div>';
		$html_format = '
			<div class="feature-1 item wow flipInY feature-item-id-%4$s" %5$s>
				%1$s
				%2$s
				%3$s
			</div>';
		break;
	case '3':
		if( $line_color ) {
			$custom_css .= sprintf('.slz-shortcode.feature-item-%1$s .list-features .services-content.style-4 .line{background-color:%2$s;}'."\n",
					esc_attr($id), esc_attr( $line_color ) );
		}
		if( $line_hover_color ) {
			$custom_css .= sprintf('.slz-shortcode.feature-item-%1$s .list-features .services-content.style-4:hover .line{background-color:%2$s;}'."\n",
					esc_attr($id), esc_attr( $line_hover_color ) );
		}
		$contain_cls = 'whatwedo dental-care';
		$open_group = '<div class="services-wrapper list-features">';
		$close_group = '</div>';
		$html_format ='
			<div class="services-item item feature-item-id-%4$s style-%7$s">
				<div class="services-content style-4">
					%1$s
					<div class="line"></div>
					%2$s
					%3$s
				</div>
			</div>';
		$html_options = array(
			'icon_fmt'       => '<div class="btn-for-icon bottom">
									<i class="icon1 %1$s"></i>
									<i class="icon2 %1$s"></i>
								</div>',
			'title_fmt'      => '<h3 class="services-title item-title">%1$s</h3>',
			'desc_fmt'       => '<div class="description">%1$s</div>',
		);
		break;
	case '4':
		$contain_cls = 'home-prenancy';
		$open_group = '<div class="feature-wrapper "> <div class="list-features list-unstyled list-inline">';
		$close_group = '</div></div>';
		$html_format ='
			<div class="feature-1 style-3 item wow flipInY feature-item-id-%4$s %6$s" %5$s>
				%1$s
				%2$s
				%3$s
			</div>';
		break;
	case '5':
		$custom_css = '';
		$contain_cls = 'home-ophthalmology feature-wrapper';
		$open_group = '<div class="list-features owl-carousel">';
		$close_group = '</div>';
		$html_format = '
			<div class="feature-1 style-2 item wow flipInY feature-item-id-%4$s" %5$s>
				%1$s
				%2$s
				%3$s
			</div>';
		break;
	default:
		//1
		$open_group = '<div class="list-features list-unstyled list-inline">';
		$close_group = '</div>';
		$html_format = '
			<div class="feature-1 item wow flipInY feature-item-id-%4$s" %5$s >
				%1$s
				%2$s
				%3$s
			</div>';
}
$default = array(
	'icon_type' => '',
	'icon_fw'   => '',
	'icon_ex'   => '',
	'title'     => '',
	'description' => '',
	'icon_color'  => '',
	'title_color' => '',
	'description_color' => '',
	'backg_color'       => '',
	'hover_color'       => '',
	'text_hover_color'  => '',
	'icon_background_color' => '',
	'icon'       => '',
);
$item_index = 1;
$delay = 2;
$default_data = array (
	'icon'        => '',
	'title'       => '',
	'description' => '',
	'delay'       => '',
);
$render_html = '';
$big_index = 0;
$loop = 1;
$item_per_row = 1;
if( $feature_list ) {
	foreach ( $feature_list as $index => $items ) {
		if( $items ) {
			$items = array_merge( $default, $items );
			$data_delay = '';
			$data = $default_data;
			$style_4_class= '';
			//icon
			if( $items['icon_type'] == '02' ) {
				$icon = $items['icon_fw'];
			} else {
				$icon = $items['icon_ex'];
			}
			if( $icon ) {
				$data['icon'] = sprintf( $html_options['icon_fmt'], $icon);
			}
			//title
			if( $items['title'] ) {
				$data['title'] = sprintf( $html_options['title_fmt'], $items['title']);
			}
			//desc
			if( $items['description'] ) {
				$data['description'] = sprintf( $html_options['desc_fmt'], $items['description']);
			}
			//delay
			if( $item_index > 1 ) {
				$data_delay = ($item_index -1 ) * $delay;
				$style_4_class = 'big';
				if( $big_index == 2 ) {
					$style_4_class = '';
				} else {
					$big_index ++;
				}
				if( $item_index > $number_item ) {
					$style_4_class = '';
					$big_index = 0;
				}
			}
			if( $data_delay && isset($html_options['data_delay_fmt']) ) {
				$data['delay'] = 'data-wow-delay="0.'.$data_delay.'s"';
			}
			$render_html .= sprintf($html_format, $data['icon'], $data['title'], $data['description'], $item_index, $data['delay'], $style_4_class, $loop );
			if( $loop == absint($number_item) ) {
				$loop = 0;
			}
			
			//css
			if( $items['icon_color']) {
				if( $style == '3' ) {
					$custom_css .= sprintf( '.slz-shortcode.feature-item-%1$s .list-features .feature-item-id-%2$s .btn-for-icon i{ color:%3$s; }', esc_attr($id), $item_index, $items['icon_color'] ) ."\n";
					$custom_css .= sprintf( '.slz-shortcode.feature-item-%1$s .list-features .feature-item-id-%2$s .services-content.style-4 .btn-for-icon .icon2{ background-color:%3$s; }', esc_attr($id), $item_index, $items['icon_color'] ) ."\n";
				} else {
					$custom_css .= sprintf( '.slz-shortcode.feature-item-%1$s .list-features .feature-item-id-%2$s i{ color:%3$s; }', esc_attr($id), $item_index, $items['icon_color'] ) ."\n";
				}
			}
			if( $items['title_color']) {
				if( $style == '3') {
					$custom_css .= sprintf( '.slz-shortcode.feature-item-%1$s .list-features .feature-item-id-%2$s .services-content.style-4 .item-title{ color:%3$s; }', esc_attr($id), $item_index, $items['title_color'] ) ."\n";
				} else {
					$custom_css .= sprintf( '.slz-shortcode.feature-item-%1$s .list-features .feature-item-id-%2$s .item-title{ color:%3$s; }', esc_attr($id), $item_index, $items['title_color'] ) ."\n";
				}
			}
			if( $items['description_color']) {
				$custom_css .= sprintf( '.slz-shortcode.feature-item-%1$s .list-features .feature-item-id-%2$s .description{ color:%3$s; }', esc_attr($id), $item_index, $items['description_color'] ) ."\n";
			}
			if( $items['backg_color']) {
				if( $style == '3') {
					$custom_css .= sprintf( '.slz-shortcode.feature-item-%1$s .list-features .feature-item-id-%2$s .services-content.style-4:before{ background-color:%3$s; }', esc_attr($id), $item_index, $items['backg_color'] ) ."\n";
				} elseif( $style == '4') {
					$custom_css .= sprintf( '.slz-shortcode.feature-item-%1$s .list-features .feature-item-id-%2$s:before{ background-color:%3$s; }', esc_attr($id), $item_index, $items['backg_color'] ) ."\n";
				} else {
					$custom_css .= sprintf( '.slz-shortcode.feature-item-%1$s .list-features .feature-item-id-%2$s { background-color:%3$s; }', esc_attr($id), $item_index, $items['backg_color'] ) ."\n";
				}
			}
			if( $items['hover_color']) {
				if( $style == '3') {
					$custom_css .= sprintf( '.slz-shortcode.feature-item-%1$s .list-features .feature-item-id-%2$s .btn-for-icon i{ border-color:%3$s; background-color:%3$s; }', esc_attr($id), $item_index, $items['hover_color'] ) ."\n";
					$custom_css .= sprintf( '.slz-shortcode.feature-item-%1$s .list-features .feature-item-id-%2$s .services-content.style-4:after{ background-color:%3$s; }', esc_attr($id), $item_index, $items['hover_color'] ) ."\n";
					$custom_css .= sprintf( '.slz-shortcode.feature-item-%1$s .list-features .feature-item-id-%2$s .services-content.style-4 .btn-for-icon .icon2{ color:%3$s; }', esc_attr($id), $item_index, $items['hover_color'] ) ."\n";
				} elseif( $style == '4') {
					$custom_css .= sprintf( '.slz-shortcode.feature-item-%1$s .list-features .feature-item-id-%2$s:hover:before{ background-color:%3$s; }', esc_attr($id), $item_index, $items['hover_color'] ) ."\n";
				} else {
					$custom_css .= sprintf( '.slz-shortcode.feature-item-%1$s .list-features .feature-item-id-%2$s:hover{ background-color:%3$s; }', esc_attr($id), $item_index, $items['hover_color'] ) ."\n";
				}
				
			}
			if( $items['text_hover_color']) {
				if( $style == '3') {
					$custom_css .= sprintf( '.slz-shortcode.feature-item-%1$s .list-features .feature-item-id-%2$s .services-content.style-4:hover .item-title{ color:%3$s; }', esc_attr($id), $item_index, $items['text_hover_color'] ) ."\n";
					$custom_css .= sprintf( '.slz-shortcode.feature-item-%1$s .list-features .feature-item-id-%2$s .services-content.style-4:hover .description{ color:%3$s; }', esc_attr($id), $item_index, $items['text_hover_color'] ) ."\n";
				} else {
					$custom_css .= sprintf( '.slz-shortcode.feature-item-%1$s .list-features .feature-item-id-%2$s:hover .item-title{ color:%3$s; }', esc_attr($id), $item_index, $items['text_hover_color'] ) ."\n";
					$custom_css .= sprintf( '.slz-shortcode.feature-item-%1$s .list-features .feature-item-id-%2$s:hover .description{ color:%3$s; }', esc_attr($id), $item_index, $items['text_hover_color'] ) ."\n";
				}
			}
			$item_index ++;
			$loop ++;
			$item_per_row ++;
		}
	}
}

$contain_cls = $contain_cls . ' slz-feature-item-style-' . $style;
if( $render_html ) {
	echo '<div class="slz-shortcode feature-item-'.esc_attr($id).' ' .esc_attr($extra_class).'">';
		echo '<div class="'. esc_attr($contain_cls) . '" >'.
				$open_group . $render_html . $close_group .
			'</div>';
	echo '</div>';
}
if ( !empty($custom_css) ) {
	do_action( SLZCORE_ADD_INLINE_CSS, $custom_css );
}