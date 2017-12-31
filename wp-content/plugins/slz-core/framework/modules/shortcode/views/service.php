<?php
$model = new Medicplus_Core_Service();
$model->init( $atts );
$block_cls = $model->attributes['extra_class'] . ' ' . $model->attributes['uniq_id'];
$btn_readmore = '';
$style = 1;
$style = $model->attributes['style'];


// 1$ - icon, 2$ - title, 3$ - excerpt, 4$ - responsive class, 5$ - permalink, 6$ - line
$html_format_1 = '
	<div class="%4$s services-item item wow fadeInUp">
		<a href="%5$s">
			<div class="services-content">
				<div class="btn-for-icon bottom">
					<i class="icon1 %1$s"></i>
					<i class="icon2 %1$s"></i>
				</div>
				%6$s
				<h3 class="services-title">%2$s</h3>
				<div class="description">%3$s</div>
			</div>
		</a>
	</div>
';

$align = $model->attributes['align'];
if ( $align == 'center' ) {
	$classAlignText = 'text-center';
} elseif ( $align == 'right' ) {
	$classAlignText = 'text-right';
} else {
	$classAlignText = 'text-left';
}
// 1$ - icon, 2$ - title, 3$ - excerpt, 4$ - responsive class, 5$ - permalink, 7$ - classColorIcon
$html_format_2 = '
	<div class="%4$s services-item item wow fadeInUp">
		<div class="services-content style-3 '. $classAlignText .'">
			<a href="%5$s">
				<div class="btn-for-icon"><i class="icon1 %1$s %7$s"></i></div>
				<h3 class="services-title">%2$s</h3>
				<div class="description">%3$s</div>
			</a>
		</div>
	</div>
';

if ( !empty( $model->attributes['btn_readmore'] ) ){
	$btn_readmore = '<a href="%5$s" class="nutrition-btn">'.esc_attr( $atts['btn_readmore'] ).'</a>';
}
$align_2 = $model->attributes['align_2'];
if ( $align_2 == 'right' ) {
	$classAlignText = 'text-right';
} else {
	$classAlignText = 'text-left';
}
// 1$ - icon, 2$ - title, 3$ - excerpt, 4$ - responsive class, 5$ - permalink, 8$ - image
$html_format_3 = '	
	<div class="%4$s item nutrition-services-item">		
		<div class="nutrition-services-content '. $classAlignText .'">
			%8$s
			<a href="%5$s"><h3 class="services-title">%2$s</h3></a>
			<div class="description">%3$s</div>
			'. $btn_readmore .'
		</div>		
	</div>
';
?>
<div class="slz-shortcode sc_service <?php echo esc_attr( $block_cls ); ?>">
	<?php if ( $style == 1 ) { ?>
	<div class="whatwedo">
		<div class="services-wrapper">
			<div class="row">
				<?php $model->render_grid( array('html_format' => $html_format_1) );?>
			</div>
		</div>
	</div>
	<?php } elseif ( $style == 2 ) { ?>
	<div class="whatwehelp pediatric">
		<div class="services-wrapper">
			<div class="row">
				<?php $model->render_grid( array('html_format' => $html_format_2) );?>
			</div>
		</div>
	</div>
	<?php } elseif ( $style == 3 ) { ?>
	<div class="whatwedo-nutrition home-nutrition">
		<div class="services-wrapper">
			<div class="row">
				<?php $model->render_grid( array('html_format' => $html_format_3) );?>
			</div>
		</div>
	</div>
	<?php } ?>
</div>