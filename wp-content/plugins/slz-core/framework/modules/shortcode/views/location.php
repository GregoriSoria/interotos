<?php
$model = new Medicplus_Core_Location();
$model->init( $atts );
$block_cls = $model->attributes['extra_class'] . ' ' . $model->attributes['uniq_id'];
$style = $model->attributes['style'];

if ( $style == 1 ) {
	// 1$ - title, 2$ - address, 3$ - go to map, 4$ - direction, 5$ - phone, 6$ - features, 7$ - expert, 9$ - post_id attr, 10$ - address attr, 11$ - positionLat attr, 12$ - positionLng attr
	$html_format = '
		<div class="col-sm-6">
			<div class="location-address-content get_map_content" %9$s %10$s %11$s %12$s>
				<div class="location-address-with-border">
					<div class="location-text get_map_title">%1$s</div>
					%2$s
					%3$s
					%4$s
				</div>
				<div class="location-address-with-highlight">
					<div class="location-tele-info get_map_phone" data-phone="%5$s">%5$s</div>
					<ul class="list-unstyled list-location-info">
						%6$s
					</ul>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="location-address-content">
				<div class="description">%7$s</div>
			</div>
		</div>
		<div class="clearfix"></div>
	';
} elseif ( $style == 2 ) {
	$classRowOpen = '<div class="row">';
	$classRowClose = '</div>';
	// 1$ - title, 2$ - address, 3$ - go to map, 4$ - direction, 5$ - phone, 6$ - features, 8$ - responsive class, 9$ - post_id attr, 10$ - address attr, 11$ - positionLat attr, 12$ - positionLng attr
	$html_format = '
		<div class="%8$s inline_block">
			<div class="location-address-content get_map_content" %9$s %10$s %11$s %12$s>
				<div class="location-address-with-border">
					<div class="location-text get_map_title">%1$s</div>
					%2$s
					%3$s
					%4$s
				</div>
				<div class="location-address-with-highlight">
					<div class="location-tele-info get_map_phone" data-phone="%5$s">%5$s</div>
					<ul class="list-unstyled list-location-info">
						%6$s
					</ul>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	';

}
?>

<div class="slz-shortcode sc_location <?php echo esc_attr( $block_cls ); ?>">
	<div class="location-main">
		<div class="location-entry">
			<?php $model->render_location_cat_sc( $html_format );?>
		</div>
	</div>
</div>