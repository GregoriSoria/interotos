<?php
$model = new Medicplus_Core_Faq();
$model->init( $atts );
$block_cls = $model->attributes['extra_class'] . ' ' . $model->attributes['uniq_id'];

$custom_css = '';
if( !empty( $atts[ 'active_color' ] ) ){
	$custom_css .= sprintf('.faq-wrapper.id-%s .faq-panel .panel-heading.active:before{background-color:%s;}', esc_attr( $atts[ 'id' ] ), esc_attr( $atts[ 'active_color' ] ));
}

do_action( SLZCORE_ADD_INLINE_CSS, $custom_css );

$html_format = '
	<div class="panel panel-default faq-panel">
		<div id="heading-%2$s-%1$s" role="tab" class="panel-heading%3$s">
			<h4 class="panel-title">
				<a role="button" data-toggle="collapse" data-parent="#toggle-box-' . esc_attr( $atts['id'] ) . '" href="#collapse-%2$s-%1$s" aria-expanded="%4$s" aria-controls="collapse-%2$s-%1$s" %5$s>%7$s
				</a>
			</h4>
		</div>
		<div id="collapse-%2$s-%1$s" role="tabpanel" aria-labelledby="heading-%2$s-%1$s" class="panel-collapse collapse%6$s">
			<div class="panel-body">
				<div class="description">%8$s</div>
			</div>
		</div>
	</div>';
$html_options = array(
	'html_format' => $html_format,
);

?>
<div class="slz-shortcode toggle-box <?php echo esc_attr( $block_cls ); ?>">
	<div class="faq-wrapper id-<?php echo esc_attr( $atts['id'] ); ?>">
		<div id="toggle-box-<?php echo esc_attr( $atts['id'] ); ?>" role="tablist" aria-multiselectable="true" class="panel-group faq-group">
			<?php
				$model->render_sc( $html_options );
			?>
		</div>
	</div>
</div>
