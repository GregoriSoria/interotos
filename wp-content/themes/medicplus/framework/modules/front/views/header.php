<?php
/**
 * Header Content
 */
if (Medicplus::get_option('slz-header-hide') == '1') {
	return;
}

$header_logo_url  = Medicplus::get_option( 'slz-logo-header', 'url' );
if( empty($header_logo_url) ) {
	$header_logo_data = get_bloginfo( 'name', 'display' );
} else {
	$header_logo_data = '<img src="'. esc_url($header_logo_url).'" alt="">';
}

/************************* Topbar Left **************************/
$topbar_left =  $sticker = $topbar_right = $social = '';


	//top bar left
	$ticker_arr = Medicplus::get_option('slz-header-ticker-content');
	if ( Medicplus::get_option('slz-header-ticker') == '1' && (!empty($ticker_arr)) ) {
		foreach ($ticker_arr  as $value) {
			$sticker .= '<li><a href="#" class="ticker-inner">'.$value.'</a></li>';
		}
		$topbar_left .= '<ul>'. $sticker.'</ul>';
	}
	//top bar right
	$info = Medicplus::get_option('slz-header-other-info');
	if ( !empty($info) ) {
		foreach ($info as $value) {
			$parse_json = json_decode($value);
			if (is_array($parse_json) && isset($parse_json[1])){
				$topbar_right .= '
				<li>
					<div class="information-toppar ticker-inner"><i class="icons fa '.esc_html($parse_json[0]).'"></i>
						<p class="text">'.$parse_json[1].'</p>
					</div>
				</li>';
			}
		}
	}

	if( !empty( $topbar_right ) ) {
		$topbar_right = ''. $topbar_right;

	}
	$social_map = Medicplus_Params::get('header-social');
	$header_social_active = Medicplus::get_option('slz-header-social');
	if( $header_social_active ) {
		$header_social = '';
		foreach ($header_social_active['enabled'] as $key => $value) {
			$social_key = Medicplus::get_option('slz-social-' . $key);
			if( !empty( $social_key ) && isset( $social_map[$key] ) ) {
				$header_social .= '<li><a href="'. esc_url($social_key) .'" class="link  '.$key.'" target="_blank"><i class="fa ' . $social_map[$key] . '"></i></a></li>';
			}
		}
		$social = $header_social ;
	}


/************************* Layout **************************/
$template = Medicplus::get_option( 'slz-header-layout' );

$layouts = array('one','two','three','four','five','six','seven','eight','nine','ten','eleven','twelve','thirt-teen','four-teen','fif-teen');
if( ! in_array( $template , $layouts)) {
	$template = 'one';
}

include locate_template('inc/header/header-' . $template . '.php');