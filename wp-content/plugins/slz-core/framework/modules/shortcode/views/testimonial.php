<?php
$model = new Medicplus_Core_Testimonial();
$model->init( $atts );
$block_cls = $model->attributes['extra_class'] . ' ' . $model->attributes['uniq_id'];
$attr_autospeed = $attr_speed = $attr_column = $attr_num = $image_circle_class = '';
$style = 1;
$style = $model->attributes['style'];
$image_circle = $model->attributes['image_circle'];
if ( !empty($image_circle) && $image_circle == 'yes') {
	$image_circle_class = 'image_circle';
}

$autospeed = intval($atts['auto_speed']);
$speed = intval($atts['speed']);
$column = intval($atts['column']);
if ( !empty( $autospeed ) ) {
	$attr_autospeed = 'data-autospeed='.$autospeed;
}
if ( !empty( $speed ) ) {
	$attr_speed = 'data-speed='.$speed;
}
if ( !empty( $column ) ) {
	$attr_column = 'data-column='.$column;
}
$count_post = $model->query->found_posts;
if ( !empty($count_post) ) {
	$attr_num = 'data-number='.$count_post;
}

// 	1 - title , 2 - excerpt, 3 - post class
$html_format_style_1 = '
    <div class="item %3$s">
        <div class="testimonial-graph">%2$s</div>
        <div class="typo-line"><span class="sub-header">'. esc_html__( 'From', 'slz-core' ) .' %1$s</span></div>
    </div>';

// 	1 - title , 2 - excerpt, 3 - post class
$html_format_style_2 = '
    <div class="item %3$s">
		<div class="slider-testimonials-inner">
			<div class="close-bracket-wrapper">
				<i class="icon-close-bracket"></i>
				<div class="line-top line-top-left"></div>
				<div class="line-top line-top-right"> </div>
			</div>
			<span class="sub-header">'. esc_html__( 'From', 'slz-core' ) .' %1$s</span>
			<div class="description">%2$s</div>
		</div>
    </div>';
?>
<div class="slz-shortcode sc_testimonials <?php echo esc_attr( $block_cls ); ?>">
	<?php if ( $style == 1 ) { ?>
	<div class="testimonials">
		<div class="close-bracket-wrapper"><i class="close-bracket icon-close-bracket"></i></div>
	    <div id="<?php echo esc_attr( $model->attributes['uniq_id'] ); ?>" class="slider-testimonials owl-carousel <?php echo esc_attr($image_circle_class) ?>" <?php echo esc_attr($attr_autospeed).' '.esc_attr($attr_speed).' '.esc_attr($attr_num); ?>>
			<?php $model->render_sc( array('html_format' => $html_format_style_1) );?>
		</div>
	</div>
	<?php } elseif ( $style == 2 ) { ?>
	<div id="<?php echo esc_attr( $model->attributes['uniq_id'] ); ?>" class="testimonials testimonials-style-2">
		<div class="nav-testimonial">
			<a href="javascript:void(0)" class="nav-testimonial-inner-left"><i class="fa fa-angle-left"></i></a>
			<a href="javascript:void(0)" class="nav-testimonial-inner-right"><i class="fa fa-angle-right"></i></a>
		</div>
		<div class="slider-testimonials-style-2 owl-carousel" <?php echo esc_attr($attr_autospeed).' '.esc_attr($attr_speed).' '.esc_attr($attr_num).' '.esc_attr($attr_column); ?>>
			<?php $model->render_sc( array('html_format' => $html_format_style_2) );?>
		</div>
	</div>
	<?php } ?>
</div>