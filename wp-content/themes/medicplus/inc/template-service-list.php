<?php get_header(); ?>
<?php
if ( ! MEDICPLUS_CORE_IS_ACTIVE ){
	exit;
}
$medicplus_currentObject = get_queried_object();
$medicplus_term_slug = is_tax() && !empty($medicplus_currentObject) ? $medicplus_currentObject->slug : '';

$medicplus_category_sc = '';
if ( !empty($medicplus_term_slug) ) {
	$medicplus_category_slug[] = array( 'category_slug' => $medicplus_term_slug );
	$medicplus_category_sc = urlencode(json_encode($medicplus_category_slug));
}
?>

<div class="service_list padding-top-100 padding-bottom-100">
	<div class="row">
		<div class="container">
			<?php
			$medicplus_shortcode = sprintf('[slzcore_service_sc method="cat" category="%1$s"]',
						esc_html( $medicplus_category_sc )
					);
			echo do_shortcode( $medicplus_shortcode );
			?>
		</div>
	</div>
</div>
<?php get_footer(); ?>