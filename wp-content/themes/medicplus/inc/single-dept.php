<?php
get_header();
if ( have_posts() ) :
while ( have_posts() ) :
	the_post();
	if ( post_password_required() ) {
		get_template_part( 'inc/content-password' );
		wp_reset_postdata();
		return;
	}
	$medicplus_post_id					= get_the_ID();
	$medicplus_post_type 				= get_post_type();
	$medicplus_taxonomy_cat 			= $medicplus_post_type .'_cat';
	$medicplus_meta_prefix 				= $medicplus_post_type. '_';
	$medicplus_term 					= medicplus_getTermSimpleByPost($medicplus_post_id, $medicplus_taxonomy_cat);
	$medicplus_term_name 				= !empty($medicplus_term) ? sprintf('<div class="typo-line"><h4 class="sub-header">%s</h4></div>', esc_html($medicplus_term['name'])) : '';
	$medicplus_department_info	 		= get_post_meta( $medicplus_post_id, $medicplus_meta_prefix .'department_info', true );
	$medicplus_department_head	 		= get_post_meta( $medicplus_post_id, $medicplus_meta_prefix .'department_head', true );
	$medicplus_department_head_info		= get_post_meta( $medicplus_post_id, $medicplus_meta_prefix .'department_head_info', true );
	$medicplus_show_member_box	 		= get_post_meta( $medicplus_post_id, $medicplus_meta_prefix .'show_member_box', true );
	$medicplus_box_title	 			= get_post_meta( $medicplus_post_id, $medicplus_meta_prefix .'box_title', true );
	$medicplus_information_member	 	= get_post_meta( $medicplus_post_id, $medicplus_meta_prefix .'information_member', true );
	$medicplus_show_gallery	 			= get_post_meta( $medicplus_post_id, $medicplus_meta_prefix .'show_gallery', true );
	$medicplus_gallery_image	 		= get_post_meta( $medicplus_post_id, $medicplus_meta_prefix .'gallery_image', true );

	$medicplus_class_col_howwedo_left = !empty($medicplus_gallery_image) && !empty($medicplus_show_gallery) && $medicplus_show_gallery == 'yes' ? 'col-lg-7' : 'col-lg-12';
	$medicplus_gallery_image = str_replace(',,', ',', $medicplus_gallery_image);
	$medicplus_galleryArr = explode(',', $medicplus_gallery_image);
	$medicplus_custom_css = '';

	// css to show/hide sidebar.
	$medicplus_all_container_css = medicplus_get_container_css();
?>

<div id="post-<?php the_ID(); ?>" <?php post_class( 'post-inner' ); ?>>
	<div class="department-detail-wrapper">
		<div class="howwedo">
			<div class="<?php echo esc_attr( $medicplus_all_container_css['container_css'] ); ?>">
				<div id="page-content" class="department-content <?php echo esc_attr( $medicplus_all_container_css['content_css'] ); ?>">
					<div class="row">
						<div class="<?php echo esc_attr( $medicplus_class_col_howwedo_left ); ?>">
							<div class="howwedo-left-wrapper">
								<?php echo wp_kses_post($medicplus_term_name) ?>
								<h2 class="header"><?php the_title() ?></h2>
								<div class="description"><?php echo wp_kses_post($medicplus_department_info) ?></div>
								<div class="howwedo-wrapper entry-content">
									<?php
										the_content( sprintf( '<a href="%s" class="read-more">%s<i class="fa fa-angle-right"></i></a>',
												esc_url(get_permalink()),
												esc_html__( 'Read more', 'medicplus' )
										) );
										wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'medicplus' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );
									?>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div><!-- #page-content -->
				<?php if( $medicplus_all_container_css['has_sidebar'] != 'none' ):?>
				<div id='page-sidebar' class="sidebar <?php echo esc_attr( $medicplus_all_container_css['sidebar_css'] )?>">
					<?php medicplus_get_sidebar( $medicplus_all_container_css['sidebar_id'] );?>
				</div>
				<?php endif;?>

				<?php if ( !empty($medicplus_gallery_image) && !empty($medicplus_show_gallery) && $medicplus_show_gallery == 'yes' ) { ?>
				<div data-wow-delay="0.3s" class="slider-howwedo gallery-<?php echo esc_attr( $medicplus_post_id );?> wow fadeInRight">
					<div data-slider-id="howwedo" class="slider-howwedo-wrapper owl-carousel">
						<?php
						foreach ($medicplus_galleryArr as $medicplus_key => $medicplus_gallery) {
							$medicplus_thumb_img = wp_get_attachment_image_src( $medicplus_gallery, 'medicplus-thumb-650x382' );
							if( $medicplus_thumb_img ) {
								$medicplus_custom_css .= sprintf('.gallery-%1$s.slider-howwedo .slider-howwedo-wrapper .item.item-%2$s { background-image: url("%3$s");}', $medicplus_post_id, $medicplus_key, $medicplus_thumb_img[0]);
								printf('<div data-item="item-%1$s" class="item item-%1$s"></div>', $medicplus_key);
							}
						}
						?>
					</div>
					<div data-slider-id="howwedo" class="thumbs-howwedo owl-carousel">
						<?php
						foreach ($medicplus_galleryArr as $medicplus_key => $medicplus_gallery) {
							$medicplus_classActive = $medicplus_key == 0 ? 'active' : '';
							$medicplus_thumb_img = wp_get_attachment_image_src( $medicplus_gallery, 'thumbnail' );
							if( $medicplus_thumb_img ) {
								$medicplus_custom_css .= sprintf('.gallery-%1$s.slider-howwedo .thumbs-howwedo .thumb-item.item-%2$s { background-image: url("%3$s");}', $medicplus_post_id, $medicplus_key, $medicplus_thumb_img[0]);
								printf('<a href="#item-%1$s" class="thumb-item item-%1$s %2$s" data-item="%3$s">how-we-do</a>', $medicplus_key, $medicplus_classActive, $medicplus_key);
							}
						}
						?>
					</div>
					<div class="nav-howwedo">
						<a href="javascript:void(0)" class="nav-howwedo-left"><i class="fa fa-angle-left"></i></a>
						<a href="javascript:void(0)" class="nav-howwedo-right"><i class="fa fa-angle-right"></i></a>
					</div>
				</div>
				<?php } //End if gallery_image ?>
			</div> <!-- container -->
		</div>

		<div class="padding-bottom-100">
			<?php
				if( !empty( $medicplus_department_head ) ){
					$medicplus_shortcode = sprintf('[slzcore_team_simple_sc team_id="%1$s" style="1" is_container="yes"]',
								$medicplus_department_head
							);
					echo do_shortcode( $medicplus_shortcode );
				}
			?>
		</div>

		<?php
		$medicplus_team_for_department = array();
		$medicplus_param_team = array(
			'posts_per_page'=> -1,
			'meta_query'=> array(
				array(
					'key' 		=> 'medicplus_team_department',
					'value' 	=> $medicplus_post_id,
					'compare' 	=> 'LIKE'
				)
			)
		);
		$medicplus_get_team = medicplus_getPosts('medicplus_team', $medicplus_param_team);
		foreach ($medicplus_get_team as $medicplus_key => $medicplus_team) {
			$medicplus_team_for_department[] = array('team'=>"$medicplus_team->ID");
		}
		$medicplus_count_team = count($medicplus_team_for_department);
		$medicplus_column = $medicplus_count_team < 4 ? $medicplus_count_team : 4;
		$medicplus_team_list = urlencode(json_encode($medicplus_team_for_department));
		?>
		<?php if ( !empty($medicplus_show_member_box) && $medicplus_show_member_box == 'yes' && !empty($medicplus_get_team) ) { ?>
		<div class="our-team">
			<div class="container">
				<div class="typo-line"><h4 class="sub-header"><?php echo esc_html__( 'Quem somos', 'medicplus' ); ?></h4></div>
				<h2 class="header"><?php echo esc_html( $medicplus_box_title ); ?></h2>
				<div class="description"><?php echo esc_html( $medicplus_information_member ); ?></div>
				<div class="row">
					<?php
					$medicplus_shortcode = sprintf('[slzcore_team_carousel_sc method="team" team_list="%1$s" column="%2$s"]',
								esc_html( $medicplus_team_list ),
								$medicplus_column
							);
					echo do_shortcode( $medicplus_shortcode );
					?>
				</div>
			</div>
		</div>
		<?php } //End If memberbox ?>
	</div>
</div>
<?php
endwhile;
wp_reset_postdata();
endif;
if( $medicplus_custom_css ) {
	do_action( 'medicplus_add_inline_style', $medicplus_custom_css );
}
?>
<?php get_footer(); ?>