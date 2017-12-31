<?php
if( is_search() ) return;
$post_id = get_the_ID();
if( $post_id ) {
	$slider_page_settings = get_post_meta( $post_id, 'medicplus_page_options', true );
	if ( $slider_page_settings ){
		$slider = medicplus::get_value( $slider_page_settings, 'revolution_slider');
		if ( !empty( $slider ) ){
			echo do_shortcode( '[rev_slider_vc alias="'.$slider_page_settings['revolution_slider'].'"]' );
		}
	}
	//show appointment shortcode
	$header_layout = Medicplus::get_option('slz-header-layout');
	$appointment = Medicplus::get_option('slz-sc-appointment');
	if(!empty($appointment)){
		if ($header_layout == 'one'){
			$class = 'appointment-one';
		}else if ($header_layout == 'two'){
			$class = 'appointment-two';
		}else {
			$class = 'appointment-three';
		}
		if ($header_layout == 'thirt-teen'){
			echo '<div class="home-prenancy prenancy-template"><div class="shortcode-header"><div class="bg-curve-back"></div>';
				echo '<div class="container">';
					echo '<div class="slz-header-shortcode">';
						echo do_shortcode($appointment);
					echo '</div>';
				echo '</div>';
			echo '</div></div>';
		}else{
			echo '<div class="'.esc_attr($class).'">';
				echo '<div class="container">';
					echo '<div class="slz-header-shortcode">';
						echo do_shortcode($appointment);
					echo '</div>';
				echo '</div>';
			echo '</div>';
		}
		
	}
}