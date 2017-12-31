<?php
$uniq_id = 'slz_count_down-'.esc_attr($id);
$custom_css = '';
if( !empty($align) ){
	$custom_css .= sprintf('.%1$s .comming-soon-wrapper {text-align:%2$s;}', $uniq_id, esc_attr( $align ));
}
if( !empty($text_color) ){
	$custom_css .= sprintf('.%1$s .comming-soon-wrapper .countdown-period{color:%2$s;}', $uniq_id, esc_attr( $text_color ));
	$custom_css .= sprintf('.%1$s .comming-soon-wrapper .countdown-amount{color:%2$s;}', $uniq_id, esc_attr( $text_color ));
	$custom_css .= sprintf('.%1$s .comming-soon-2 .countdown-section .countdown-amount:after{color:%2$s;}', $uniq_id, esc_attr( $text_color ));
}
if( !empty($line_color) ){
	$custom_css .= sprintf('.%1$s .comming-soon-wrapper .countdown-amount:before{background-color:%2$s;}', $uniq_id, esc_attr( $line_color ));
}
if ( !empty($custom_css) ) {
	do_action( SLZCORE_ADD_INLINE_CSS, $custom_css );
}
echo '<div class="slz-shortcode count-down '.$uniq_id.' '.esc_attr($extra_class).'">';
	if(!empty($date)):
		if( $show_colon == 'yes' ){
			$cls_comming = 'comming-soon-2';
		}
		else{
			$cls_comming = 'comming-soon-1';
		}
		echo '<div class="comming-soon-wrapper '.esc_attr($cls_comming).'">';
			echo'<div id="comming-soon" data-date="'.esc_attr($date).'"></div>';
		echo '</div>';
	endif;
echo '</div>';