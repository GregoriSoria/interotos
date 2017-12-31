<?php
$model = new Medicplus_Core_Location();
$model->init( $atts );
$block_cls = $model->attributes['extra_class'] . ' ' . $model->attributes['uniq_id'];
$function = $model->attributes['function'];

$custom_css = '';
$logoAttr = $zoomAttr = '';
$iconAttr = sprintf('data-icon=%s', esc_url( SLZCORE_ASSET_URI. '/images/common/map-maker/map-maker-small.png' ));
$iconBigAttr = sprintf('data-icon-big=%s', esc_url( SLZCORE_ASSET_URI. '/images/common/map-maker/map-maker.png' ));

$logo_header = Medicplus_Core::get_theme_option('slz-logo-header');
if ( !empty($logo_header['url']) ) { 
	$logoAttr = sprintf('data-logo=%s', esc_url( $logo_header['url'] ));
}
$zoom_map = $model->attributes['zoom_map'];
if ( !empty($zoom_map) ) {
	$zoom_map = (int)$zoom_map;
	$range = range(3, 21);
	$isArr = in_array($zoom_map, $range);
	if ($isArr == true) {
		$zoomAttr = sprintf('data-zoom=%s', esc_attr( $zoom_map ));
	}
}
$image_icon_marker = $model->attributes['image_icon_marker'];
if ( !empty($image_icon_marker) ) {	
	$get_attached_file = '';
	$get_attached_file = get_attached_file($image_icon_marker);
	if ( file_exists($get_attached_file) ) {
		$iconSrc = wp_get_attachment_image_src($image_icon_marker, 'thumnail');
		if ( !empty($iconSrc) ) {
			$iconAttr = sprintf('data-icon=%s', esc_url( $iconSrc[0] ));
		}
	}
}
$image_icon_marker_big = $model->attributes['image_icon_marker_big'];
if ( !empty($image_icon_marker_big) ) {
	$get_attached_file = '';
	$get_attached_file = get_attached_file($image_icon_marker_big);
	if ( file_exists($get_attached_file) ) {
		$iconBigSrc = wp_get_attachment_image_src($image_icon_marker_big, 'thumnail');
		if ( !empty($iconBigSrc) ) {
			$iconBigAttr = sprintf('data-icon-big=%s', esc_url( $iconBigSrc[0] ));
		}
	}
}
if ( !empty($model->attributes['height_map']) ) {
	$height_map = (int)$model->attributes['height_map'];
	$custom_css .= sprintf('.%s #map_location { height: %spx !important; }', $model->attributes['uniq_id'], $model->attributes['height_map'] );
}

$jsonAttr = '';
if ( $function == 2 ) {
	$jsonAttr = $model->list_location_map_sc();
}

if( $custom_css ) {
	do_action( SLZCORE_ADD_INLINE_CSS, $custom_css );
}
?>
<div class="slz-shortcode sc_location_map <?php echo esc_attr( $block_cls ); ?>">
	<div class="location-main">
		<div id="map_location" class="map-contact-style" data-function="<?php echo esc_attr( $model->attributes['function'] ); ?>" <?php echo esc_attr( $logoAttr ); ?> <?php echo esc_attr( $zoomAttr ); ?> <?php echo esc_attr( $iconAttr ); ?> <?php echo esc_attr( $iconBigAttr ); ?> <?php if ( !empty($jsonAttr) ) : printf("data-json='%s'", esc_attr($jsonAttr) ); endif; ?> ></div>
	</div>
</div>