<?php
$uniq_id = 'slz_toggle_box-'.esc_attr( $id );
$custom_css = '';
if( !empty( $active_color ) ){
	$custom_css .= sprintf('.%1$s.toggle-box .faq-wrapper .faq-panel .panel-heading.active:before{background-color:%2$s;}', $uniq_id, esc_attr( $active_color )) ."\n";
}
if( !empty( $inactive_color ) ){
	$custom_css .= sprintf('.%1$s.toggle-box .faq-wrapper .faq-panel .panel-heading:before{background-color:%2$s;}', $uniq_id, esc_attr( $inactive_color )) ."\n";
	$custom_css .= sprintf('.%1$s.toggle-box .faq-wrapper .faq-panel .panel-heading{border-color:%2$s;}', $uniq_id, esc_attr( $inactive_color )) ."\n";
}
if( !empty( $title_color ) ){
	$custom_css .= sprintf('.%1$s.toggle-box .faq-wrapper .faq-panel .panel-heading{color:%2$s;}', $uniq_id, esc_attr( $title_color )) ."\n";
}
if( !empty( $content_color ) ){
	$custom_css .= sprintf('.%1$s.toggle-box .faq-wrapper .description{color:%2$s;}',  $uniq_id, esc_attr( $content_color )) ."\n";
}
if( !empty( $title_color_hover ) ){
	$custom_css .= sprintf('.%1$s.toggle-box .faq-wrapper .faq-panel .panel-title a:hover,
							.%1$s.toggle-box .faq-wrapper .faq-panel .panel-title a:focus,
							.%1$s.toggle-box .faq-wrapper .faq-panel .panel-title a:active{color:%2$s;}', $uniq_id, esc_attr( $title_color_hover));
}
if ( !empty( $custom_css ) ) {
	do_action( SLZCORE_ADD_INLINE_CSS, $custom_css );
}

if( !empty( $values ) && is_array( $values ) ){
?>
	<div class="slz-shortcode toggle-box toggle-box-sc <?php echo esc_attr($uniq_id).' '.esc_attr( $extra_class )?>">
		<div class="faq-wrapper">
			<div id="toggle-box-<?php echo esc_attr( $id ); ?>" role="tablist" aria-multiselectable="true" class="panel-group faq-group">
				<?php
					$i = 0;
				if ( !empty( $values ) ) :
					foreach ( $values as $value ) {
				?>
					<?php if( !empty( $value['title'] ) || !empty( $value['content'] ) ) : ?>
					<?php if( (!empty( $value['title'] ) && !empty(  $value['content'])) || !empty( $value['title'] ) ) : ?>
					<div class="panel panel-default faq-panel">
					<?php endif; ?>
						<?php if( !empty( $value['title'] ) ) : ?>
						<div id="heading-<?php echo esc_attr( $id ); ?>-<?php echo esc_attr( $i ); ?>" role="tab" class="panel-heading<?php echo ( $i == 0 ) ? ' active' : ''; ?>">
							<h4 class="panel-title">
								<a role="button" data-toggle="collapse" data-parent="#toggle-box-<?php echo esc_attr( $id ); ?>" href="#collapse-<?php echo esc_attr( $id ); ?>-<?php echo esc_attr( $i ); ?>" aria-expanded="<?php echo ( $i == 0 ) ? 'true' : 'false'; ?>" aria-controls="collapse-<?php echo esc_attr( $id ); ?>-<?php echo esc_attr( $i ); ?>"<?php echo ( $i != 0 ) ? ' class="collapsed"' : ''; ?>><?php echo esc_html( $value['title'] ); ?></a>
							</h4>
						</div>
						<?php endif; ?>
						<?php if( !empty($value['content']) && !empty($value['title']) ) : ?>
						<div id="collapse-<?php echo esc_attr( $id ); ?>-<?php echo esc_attr( $i ); ?>" role="tabpanel" aria-labelledby="heading-<?php echo esc_attr( $id ); ?>-<?php echo esc_attr( $i ); ?>" class="panel-collapse collapse <?php echo ( $i == 0 ) ? 'in' : ''; ?>">
							<div class="panel-body">
								<div class="description"><?php echo wp_kses_post( $value['content'] ); ?></div>
							</div>
						</div>
						<?php endif; ?>
					<?php if( (!empty( $value['title'] ) && !empty(  $value['content'])) || !empty( $value['title'] ) ) : ?>
					</div>
					<?php endif; ?>
					<?php endif; ?>
				<?php
					$i++;
					}
				endif;
				?>
			</div><!-- //toggle-box -->
		</div><!-- //faq-wrapper -->
	</div>
<?php
}