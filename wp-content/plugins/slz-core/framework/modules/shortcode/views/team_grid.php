<?php
$model = new Medicplus_Core_Team();
$model->init( $atts );

$block_cls = $model->attributes['extra_class'] . ' ' . $model->attributes['uniq_id'];

$custom_css = '';
if( !empty($model->attributes['title_color']) ) {
	$custom_css .= sprintf('.%s .our-team .team-inner .team-title { color: %s;}',
						$model->attributes['uniq_id'], $model->attributes['title_color']
					);
}
if( !empty($model->attributes['title_hv_color']) ) {
	$custom_css .= sprintf('.%s .our-team .team-inner:hover .team-title { color: %s;}',
						$model->attributes['uniq_id'], $model->attributes['title_hv_color']
					);
	$custom_css .= sprintf('.%1$s .our-team .team-inner .team-flipcard .back .team-title:before, .%1$s .our-team .team-inner .team-flipcard .back .team-title:after { border-color: %2$s;}',
						$model->attributes['uniq_id'], $model->attributes['title_hv_color']
					);
}
if( !empty($model->attributes['icon_hv_color']) ) {
	$custom_css .= sprintf('.%s .our-team .team-inner:hover .list-socials li .socials-link { color: %s;}',
						$model->attributes['uniq_id'], $model->attributes['icon_hv_color']
					);
}
if( !empty($model->attributes['border_color']) ) {
	$custom_css .= sprintf('.%1$s .our-team .team-inner:before { border-left-color: %2$s; border-right-color: %2$s; border-bottom-color: %2$s; }',
						$model->attributes['uniq_id'], $model->attributes['border_color']
					);
	$custom_css .= sprintf('.%1$s .our-team .team-inner .team-img:before, .%1$s .our-team .team-inner .team-img:after { background-color: %2$s; }',
						$model->attributes['uniq_id'], $model->attributes['border_color']
					);
}
if( !empty($model->attributes['border_hv_color']) ) {
	$custom_css .= sprintf('.%1$s .our-team .team-inner:after { border-left-color: %2$s; border-right-color: %2$s; border-bottom-color: %2$s; }',
						$model->attributes['uniq_id'], $model->attributes['border_hv_color']
					);
	$custom_css .= sprintf('.%1$s .our-team .team-inner .line-effect:before, .%1$s .our-team .team-inner .line-effect:after { background-color: %2$s;}',
						$model->attributes['uniq_id'], $model->attributes['border_hv_color']
					);
}
if( !empty($model->attributes['position_color']) ) {
	$custom_css .= sprintf('.%s .our-team .team-inner .team-sub-title { color: %s;}',
						$model->attributes['uniq_id'], $model->attributes['position_color']
					);
}
if( !empty($model->attributes['panel_color']) ) {
	$custom_css .= sprintf('.%s .our-team .team-inner .team-flipcard .front { background-color: %s;}',
						$model->attributes['uniq_id'], $model->attributes['panel_color']
					);
}
if( !empty($model->attributes['panel_hv_color']) ) {
	$custom_css .= sprintf('.%s .our-team .team-inner .team-flipcard .back { background-color: %s;}',
						$model->attributes['uniq_id'], $model->attributes['panel_hv_color']
					);
}
if ( !empty($custom_css) ) {
	do_action( SLZCORE_ADD_INLINE_CSS, $custom_css );
}

// 1$ - image, 2$ - title no link, 3$ - title, 4$ - position, 5$ - social, 6$ - responsive class
$html_format = '
		<div class="%6$s">
            <div class="team-inner wow slideInUp">
                <div class="line-effect"></div>
                <div class="team-img">
                	%1$s
                </div>
                <div class="team-flipcard">
                    <div class="face front">
                        <div class="team-title">%2$s</div>
                        <div class="team-sub-title">%4$s</div>
                    </div>
                    <div class="face back">
                    	%3$s
                        <ul class="list-inline list-unstyled list-socials">
                        	%5$s
                        </ul>
                    </div>
                </div>
            </div>
        </div>
	';
?>
<div class="slz-shortcode sc_team_grid <?php echo esc_attr( $block_cls ); ?>">
	<div class="doctor-wrapper">
		<div class="our-team">
	    	<div class="team-wrapper-2">
				<?php $model->render_grid( array('html_format' => $html_format) );?>
			</div>
		</div>
	</div>
</div>