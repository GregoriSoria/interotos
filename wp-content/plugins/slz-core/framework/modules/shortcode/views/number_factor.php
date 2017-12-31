<?php

$custom_css = "";

if( !empty( $title_color ) ){
	$custom_css .= sprintf('.slz-shortcode.counter-factor span#title-%s{color:%s;}', esc_attr( $id ), esc_attr( $title_color ));
}

if( !empty( $number_color ) ){
	$custom_css .= sprintf('.slz-shortcode.counter-factor h4#counter-%s{color:%s;}', esc_attr( $id ), esc_attr( $number_color ));
}

$custom_css .= '.slz-shortcode.counter-factor .progress-counter{text-align:center;}';

if ( !empty( $custom_css ) ) {
	do_action( SLZCORE_ADD_INLINE_CSS, $custom_css );
}
?>

<div class="slz-shortcode counter-factor <?php echo esc_attr( $extra_class ); ?>">
	<div class="progress-inner">
		<div data-value="<?php echo esc_attr( $counter ); ?>" class="progress-counter">
			<?php if( !empty($counter) ) : ?>
				<h4 id="counter-<?php echo esc_attr( $id ); ?>" class="counter-inner"><?php echo esc_html( $counter ); ?></h4>
			<?php endif; ?>
			<?php if( !empty($title) ) : ?>
				<span class="description-counter" id="title-<?php echo esc_attr( $id ); ?>">
					<?php echo esc_html( $title ); ?>
				</span>
			<?php endif; ?>
		</div>
	</div>
</div>