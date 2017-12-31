<?php get_header(); ?>
<?php
if ( ! MEDICPLUS_CORE_IS_ACTIVE ){
	exit;
}
$medicplus_currentObject = get_queried_object();
$medicplus_term_slug = is_tax() && !empty($medicplus_currentObject) ? $medicplus_currentObject->slug : '';

$medicplus_atts = array();
$medicplus_atts['pagination']    = 'yes';
$medicplus_atts['limit_post']    = get_option('posts_per_page');
$medicplus_atts['button_text']   = esc_html__( 'View Detail', 'medicplus' );
$medicplus_atts['category_slug'] = $medicplus_term_slug;
$medicplus_model = new Medicplus_Core_Department();
$medicplus_model->init( $medicplus_atts );
$medicplus_block_cls = $medicplus_model->attributes['extra_class'] . ' ' . $medicplus_model->attributes['uniq_id'];

// 1 - category, 2 - title, 3 - excerpt, 4 - department_head, 5 - department_head_info, 6 - btn_more, 7 - featured_image, 8 - class_text, 9 - class_img, 9 - class_avt
$medicplus_html_format = '
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
<div class="slz-shortcode sc_department department_list result-body <?php echo esc_attr( $medicplus_block_cls ); ?>">
	<div class="department-wrapper loading_ajax padding-top-100 padding-bottom-100">
		<div class="container">
			<div class="result-department">
				<div class="department-entry">
					<div id="loader-wrapper">
						<div id="loader"></div>
						<?php 
						$medicplus_logo_header = Medicplus::get_option('slz-logo-header');
						if ( !empty($medicplus_logo_header['url']) ) { 
							printf('<img src="%s" alt="loading" class="img-responsive">', esc_url( $medicplus_logo_header['url'] )); 
						} ?>
					</div>
					<?php $medicplus_model->render_list_post( array('html_format' => $medicplus_html_format) );?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>