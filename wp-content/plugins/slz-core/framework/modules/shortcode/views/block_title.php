<?php

$custom_css = "";

if( !empty( $title_color ) ){
	$custom_css .= sprintf('.slz-shortcode.block-title.id-%s h4.sub-header{color:%s;}', esc_attr( $id ), esc_attr( $title_color ));
}

if( !empty( $content_color ) ){
	$custom_css .= sprintf('.slz-shortcode.block-title.id-%s h2.header{color:%s;}', esc_attr( $id ), esc_attr( $content_color ));
}

if( !empty( $description_color ) ){
	$custom_css .= sprintf('.slz-shortcode.block-title.id-%s .description{color:%s;}', esc_attr( $id ), esc_attr( $description_color ));
}

if( !empty( $alignment ) ){
	$custom_css .= sprintf('.slz-shortcode.block-title.id-%s{text-align:%s;}', esc_attr( $id ), esc_attr( $alignment ));
}

if( !empty( $separator_color ) ) {
	$custom_css .= sprintf('.slz-shortcode.block-title.id-%s .typo-line:after{background-color:%s;}', esc_attr( $id ), esc_attr( $separator_color ));
}

do_action( SLZCORE_ADD_INLINE_CSS, $custom_css );
?>

<div class="slz-shortcode block-title id-<?php echo esc_attr( $id ); ?> <?php echo esc_attr( $extra_class ); ?>">
	<?php
		if( !empty( $separator_line ) ) {
			echo '<div class="typo-line">';
		}
	?>
	    <h4 class="sub-header"><?php echo esc_html( $title ); ?></h4>
	<?php
		if( !empty( $separator_line ) ) {
			echo '</div>';
		}
	?>
	
	<h2 class="header"><?php echo esc_html( $txt_content ); ?></h2>
	<?php 
	if( !empty( $description ) ) echo '<div class="description">' . esc_html( $description ) . '</div>';
	?>
</div>