<?php
$block_cls = 'video-'.esc_attr($id).' '.esc_attr($extra_class);
$link = '';
$custom_css = '';
if( !empty($image_video) ) :
	$img2 = wp_get_attachment_url($image_video);
endif;

if ( $video_type == '' && !empty($id_youtube) ) {
	$link = 'https://www.youtube.com/embed/'.esc_attr($id_youtube).'?rel=0';
}elseif ( $video_type == '2' && !empty($id_vimeo) ) {
	$link = 'https://player.vimeo.com/video/'.esc_attr($id_vimeo).'?rel=0';
}
if ( !empty($image_video) ) {
	$custom_css .= sprintf( '.video-%s .video-bg{background-image: url("%s"); }', esc_attr($id), esc_url($img2) );
}
if ( !empty($height) ) {
	$custom_css .= sprintf( '.video-%s .video-thumbnails{padding-bottom:%s ; }',esc_attr($id),esc_attr($height) );
}

echo '<div class="slz-shortcode slz-video-sc pediatric '.esc_attr($block_cls).'">';
	if ( !empty($img2) && !empty($link) ) {
		echo '<div class="post-image video-thumbnails">';
			echo '
				<iframe src="'.esc_url($link).'" allowfullscreen="" class="video-embed animated hide-video"></iframe>
				<div class="video-bg animated"><img src="'.esc_url($img2).'" alt="" class="img-responsive"></div>
				<div class="video-button-play animated"><i class="fa fa-youtube-play"></i></div>
				<div class="video-button-close animated hide-video"><i class="fa fa-times"></i></div>';
		echo '</div>';
	}
echo '</div>';
if ( !empty($custom_css) ) {
	do_action( SLZCORE_ADD_INLINE_CSS, $custom_css );
}

