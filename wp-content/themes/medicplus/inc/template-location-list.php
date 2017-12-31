<?php 
get_header();

$medicplus_currentObject = get_queried_object();

$medicplus_category_sc = '';
$medicplus_method = 'location';
$medicplus_location_list = '%5B%7B%7D%5D';
if ( is_tax() ) {
	$medicplus_method = 'cat';
	$medicplus_term_slug = is_tax() && !empty($medicplus_currentObject) ? $medicplus_currentObject->slug : '';
	if ( !empty($medicplus_term_slug) ) {
		$medicplus_category_slug[] = array('category_slug'=>$medicplus_term_slug);
		$medicplus_category_sc = urlencode(json_encode($medicplus_category_slug));
	}
}
?>
<div class="location_list padding-top-100 padding-bottom-100">
	<div class="row">
		<div class="container">
			<?php
			$medicplus_shortcode = sprintf('[slzcore_location_sc style="2" is_direction="" is_marker_map="" method="%s" location_list="%s" category_list="%s"]', esc_attr($medicplus_method), esc_attr($medicplus_location_list), esc_attr($medicplus_category_sc) );
			echo do_shortcode( $medicplus_shortcode ); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>