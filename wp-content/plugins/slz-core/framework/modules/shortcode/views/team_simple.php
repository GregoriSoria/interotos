<?php
$model = new Medicplus_Core_Team();
$model->init( $atts );
$block_cls = $model->attributes['extra_class'] . ' ' . $model->attributes['uniq_id'];
$style = $model->attributes['style'];

$custom_css = '';
if( !empty($model->attributes['title_color']) ) {
	$custom_css .= sprintf('.%s .doctor-wrapper .doctor-title { color: %s;}',
						$model->attributes['uniq_id'], $model->attributes['title_color']
					);
}
if( !empty($model->attributes['position_color']) ) {
	$custom_css .= sprintf('.%s .doctor-wrapper .doctor-sub-title { color: %s;}',
						$model->attributes['uniq_id'], $model->attributes['position_color']
					);
}
if( !empty($model->attributes['icon_color']) ) {
	$custom_css .= sprintf('.%s .doctor-wrapper .doctor-info .info-inner i { color: %s;}',
						$model->attributes['uniq_id'], $model->attributes['icon_color']
					);
}
if( !empty($model->attributes['text_color']) ) {
	$custom_css .= sprintf('.%s .doctor-wrapper .doctor-info .info-inner { color: %s;}',
						$model->attributes['uniq_id'], $model->attributes['text_color']
					);
	$custom_css .= sprintf('.%s .doctor-wrapper .doctor-body > .description { color: %s;}',
						$model->attributes['uniq_id'], $model->attributes['text_color']
					);
}
if( !empty($model->attributes['hover_color']) ) {
	$custom_css .= sprintf('.%s .doctor-wrapper .doctor-title:hover { color: %s;}',
						$model->attributes['uniq_id'], $model->attributes['hover_color']
					);
	$custom_css .= sprintf('.%s .doctor-wrapper .doctor-title:after { border-left-color: %s;}',
						$model->attributes['uniq_id'], $model->attributes['hover_color']
					);
	$custom_css .= sprintf('.%s .doctor-wrapper .doctor-info .info-inner:hover { color: %s;}',
						$model->attributes['uniq_id'], $model->attributes['hover_color']
					);
	$custom_css .= sprintf('.%1$s .doctor-wrapper .doctor-body:before, .%1$s .doctor-wrapper .doctor-body:after { border-top-color: %2$s; border-bottom-color: %2$s; }',
						$model->attributes['uniq_id'], $model->attributes['hover_color']
					);
	$custom_css .= sprintf('.%1$s .doctor-wrapper .doctor-body:after { border-right-color: %2$s; }',
						$model->attributes['uniq_id'], $model->attributes['hover_color']
					);
}
if( !empty($model->attributes['background_color']) ) {
	$custom_css .= sprintf('.%s .department-detail-wrapper .doctor-wrapper { background-color: %s;}',
						$model->attributes['uniq_id'], $model->attributes['background_color']
					);
}
if ( !empty($custom_css) ) {
	do_action( SLZCORE_ADD_INLINE_CSS, $custom_css );
}

// 1$ - thumb img, 2$ - title, 3$ - position, 4$ - phone, 5$ - email, 6$ - social, 7$ - description, 8$ - signature, 9$ - open row, 10$ - close row
$html_format = '
	%9$s
        <div class="doctor-head-wrapper">
            <div class="doctor-head-inner">
                <div class="doctor-img">
                    %1$s
                </div>
                <div class="doctor-body">
                	%2$s
                    <div class="doctor-sub-title">%3$s</div>
                    <div class="doctor-info">
                    	%4$s
                    	%5$s
                        <ul class="info-inner list-inline list-unstyled list-socials">
                            %6$s
                        </ul>
                    </div>
                    %7$s
                </div>
                <div class="doctor-sign">
                	%8$s
                </div>
            </div>
        </div>
    %10$s
	';
?>
<div class="slz-shortcode sc_team_simple <?php echo esc_attr( $block_cls ); ?>">    
	<?php $model->render_simple( array('html_format' => $html_format) );?>
</div>