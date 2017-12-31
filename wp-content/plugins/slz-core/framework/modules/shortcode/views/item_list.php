<?php
if( !empty( $values ) && is_array( $values ) ){

?>
<div class="slz-shortcode item_list sc-<?php echo esc_attr( $id ); ?> <?php echo esc_attr( $extra_class ); ?>">
	<ul class="list-unstyled list-howwedo">
		<?php
			foreach ( $values as $value ) {
				echo '<li><span class="description">' . esc_html( $value['content'] ) . '</span></li>';
			}
		?>
	</ul>
</div>
<?php
	$custom_css = '';
	if( !empty( $text_color ) ){
		$custom_css = sprintf('.item_list.sc-%s span.description{color:%s;}', esc_attr( $id ), esc_attr( $text_color ));
	}
	if( !empty( $icon_color ) ){
		$custom_css .= sprintf('.item_list.sc-%s span.description:before{color:%s;}', esc_attr( $id ), esc_attr( $icon_color ));
	}
	if ( $custom_css ) {
		do_action( SLZCORE_ADD_INLINE_CSS, $custom_css );
	}
}
?>
