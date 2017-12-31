<?php
$model = new Medicplus_Core_Gallery();
$model->init($atts);
$style = $model->attributes['style'];

if ( $style == 1 ) {
    // 1$ - term taxonomy, 2$ - permalink, 3$ - title, 4$ - featured_image, 5$ - feature_image_url, $6 - post_id, $7 - responsive_class, $8 - post_class
    $html_format = '
            <div style="background: url(%5$s) no-repeat center; background-size: cover" class="%6$s %1$s %7$s alldepartment">
                %4$s
                <div class="hover-effect">
                    <div class="bg-overlay">
                        <h4 class="title-hover fadeIn animated"><a href="%5$s" data-fancybox-group="gallery" class="link-gallery zoomIn animated fancybox"></a>%3$s</h4>
                    </div>
                </div>
            </div>
        ';
    $html_options = array(
        'html_format' => $html_format,
    );
} elseif (  $style == 2 ) {
    // 1$ - term taxonomy, 2$ - permalink, 3$ - title, 4$ - featured_image, 5$ - feature_image_url, $6 - post_id, $8 - post_class, $9 - classMasonryArr
    $html_format = '
            <div style="background: url(%5$s) no-repeat center; background-size: cover" class="%6$s %1$s %9$s alldepartment %10$s">
                %4$s
                <div class="hover-effect">
                    <div class="bg-overlay">
                        <h4 class="title-hover fadeIn animated"><a href="%5$s" data-fancybox-group="gallery" class="link-gallery zoomIn animated fancybox"></a>%3$s</h4>
                    </div>
                </div>
            </div>
        ';
    $html_options = array(
        'html_format' => $html_format,
    ); 
}
echo ( $model->render_sc( $html_options ) );
$model->attributes['paged'] = absint($model->attributes['paged']) + 1;
$close_more ='';
if( $model->query->max_num_pages > 1 && $model->attributes['paged'] <= $model->query->max_num_pages ) {
    $close_more = '1,' .$model->query->max_num_pages;
}
$model->reset();
?>
<div class="hide gallery_atts_more hide" data-pages="<?php echo esc_attr($close_more)?>" data-json="<?php echo esc_attr(json_encode($model->attributes));?>"></div>
