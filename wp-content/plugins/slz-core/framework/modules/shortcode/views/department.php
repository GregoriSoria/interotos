<?php
$model = new Medicplus_Core_Department();
$model->init( $atts );

$block_cls = $model->attributes['extra_class'] . ' ' . $model->attributes['uniq_id'];

// 1$ - category, 2$ - title, 3$ - excerpt, 4$ - department_head, 5$ - department_head_info, 6$ - btn_more, 7$ - featured_image, 8$ - class_text, 9$ - class_img, 9$ - class_avt
$html_format = '
        <div class="department-inner %8$s %9$s %10$s wow fadeIn">
            <div class="department-img">
                %7$s
            </div>
            <div class="department-body">
                %1$s
                %2$s
                %3$s
                %4$s
                %5$s
                %6$s
            </div>
            <div class="clearfix"></div>
        </div>
	';
?>
<div class="slz-shortcode sc_department result-body <?php echo esc_attr( $block_cls ); ?>">
    <div class="department-wrapper loading_ajax">
        <div class="result-department">
    		<div class="department-entry">
                <div id="loader-wrapper">
                    <div id="loader"></div>
                    <?php 
                    $logo_header = Medicplus_Core::get_theme_option('slz-logo-header');
                    if ( !empty($logo_header['url']) ) { 
                        printf('<img src="%s" alt="loading" class="img-responsive">', esc_url( $logo_header['url'] )); 
                    } ?>
                </div>
    			<?php $model->render_list_post( array('html_format' => $html_format) );?>
    		</div>
    	</div>
    </div>
</div>