<?php
$model = new Medicplus_Core_Gallery();
$model->init( $atts );
$uniq_id = $model->attributes['uniq_id'];
$block_cls = $model->attributes['extra_class'] . ' ' . $uniq_id;
$style = $model->attributes['style'];

$classMasonry = '';

$is_show_filter = false;
if( $model->attributes['show_filter'] == 'yes') {
	$model->attributes['paged'] = 1;
	$filter_html_tab = $model->render_filter_type($model->attributes);
	$is_show_filter = true;
}

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
	$classMasonry = 'gallery-3col-masonry';
}
$output_grid = $model->render_sc( $html_options );

// json tab "All"
$json_data_all = json_encode($model->attributes);

// load more json
$model->attributes['paged'] = 2;
$json_data = json_encode($model->attributes);

//check show/hide load more button
$close_more ='hide';
if( $model->query->max_num_pages > 1 && $model->attributes['paged'] <= $model->query->max_num_pages ) {
	$close_more = '';
}

// render tab "All"
if ( !empty($model->attributes['title_all']) ) {
	$title_all = esc_html( $model->attributes['title_all'] );
} else {
	$title_all = esc_html__( 'All Department', 'slz-core' );
}
$tab_all = sprintf('<button class="btn active gallery_filter_tab" data-filter="*" data-json="%1$s" data-category="%2$s">%2$s</button>',
		esc_attr($json_data_all),
		esc_html( $title_all )
	);

$model->reset();

if ( !empty($model->attributes['title_button']) ) {
	$title_button = esc_html( $model->attributes['title_button'] );
} else {
	$title_button = esc_html__( 'Load more photos', 'slz-core' );
}
?>
<div class="slz-shortcode sc_gallery <?php echo esc_attr( $block_cls ); ?>">
	<div class="gallery-wrapper <?php echo esc_attr( $classMasonry ); ?> gallery-content" data-item="<?php echo esc_attr($uniq_id)?>">
		<div class="gallery-inner">
			<?php if( $is_show_filter ) :?>
			<a role="button" data-toggle="collapse" href="#collapse-<?php echo esc_attr( $uniq_id ); ?>" aria-expanded="false" aria-controls="collapse-<?php echo esc_attr( $uniq_id ); ?>" class="btn btn-primary hidden-lg hidden-md hidden-sm">
				<span><?php esc_html_e( 'All', 'slz-core' )?></span><i class="fa fa-angle-down"></i>
			</a>
			<?php printf('<div id="collapse-%s" class="button-group filter-button-group">%s%s</div>', esc_attr( $uniq_id ), $tab_all, $filter_html_tab);?>
			<?php endif;?>
			<div class="galleryContainer galleryIsotope loading_ajax">
				<div class="loader-wrapper">
					<div class="loader"></div>
					<?php 
					$logo_header = Medicplus_Core::get_theme_option('slz-logo-header');
					if ( !empty($logo_header['url']) ) { 
						printf('<img src="%s" alt="loading" class="img-responsive">', esc_url( $logo_header['url'] )); 
					} ?>
				</div>
				<div class="grid-content">
					<?php printf('<div class="grid">%s</div>', $output_grid );?>
				</div>
			</div>
			<?php printf('<div class="grid-clone hide">%s</div>', $output_grid );?>
			<div class="clearfix"></div>
			<div class="btn-wrapper load-more <?php echo esc_attr($close_more)?>">
				<button class="btn gallery_more" data-json="<?php echo esc_attr($json_data);?>"><?php echo wp_kses_post( $title_button ) ?></button>
			</div>
		</div>
	</div>
</div>
