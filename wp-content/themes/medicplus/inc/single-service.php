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
	$medicplus_post_id       = get_the_ID();
	$medicplus_post_type     = get_post_type();
	$medicplus_taxonomy_cat  = $medicplus_post_type .'_cat';
	$medicplus_meta_prefix   = $medicplus_post_type. '_';
	$medicplus_gallery_image = get_post_meta( $medicplus_post_id, $medicplus_meta_prefix .'gallery_image', true );
	if ( has_post_thumbnail() ) {
		$medicplus_post_thumb_id  = get_post_thumbnail_id($medicplus_post_id);
		$medicplus_gallery_image  = $medicplus_post_thumb_id . ',' . $medicplus_gallery_image;
	}
	$medicplus_gallery_image = str_replace(',,', ',', $medicplus_gallery_image);
	$medicplus_galleryArr = explode(',', $medicplus_gallery_image);
	$medicplus_galleryArr = array_filter($medicplus_galleryArr);
	$medicplus_countGallery = count($medicplus_galleryArr);
	$medicplus_classGallerySlider = $medicplus_countGallery > 1 ? 'post-slider owl-carousel' : '';

	// css to show/hide sidebar.
	$medicplus_all_container_css = medicplus_get_container_css();
?>

<div id="post-<?php the_ID(); ?>" <?php post_class( 'post-inner' ); ?>>
	<div class="services-detail-wrapper padding-top-100 padding-bottom-100">
		<div class="<?php echo esc_attr( $medicplus_all_container_css['container_css'] ); ?>">
			<div class="row">
				<div id="page-content" class="service-content <?php echo esc_attr( $medicplus_all_container_css['content_css'] ); ?>">
					<div class="post-detail">
						<div class="post-single">
							<?php if ( !empty($medicplus_gallery_image) ) { ?>
							<div class="post-img-wrapper">
								<div class="post-image <?php echo esc_attr( $medicplus_classGallerySlider ) ?>">
									<?php
									foreach ($medicplus_galleryArr as $medicplus_key => $medicplus_gallery) {
										$medicplus_thumb_img = wp_get_attachment_image( $medicplus_gallery, 'medicplus-thumb-750x500', false, array() );
										if( $medicplus_thumb_img ) {
											printf('<a>%s</a>', ( $medicplus_thumb_img ));
										}
									}
									?>
								</div>
								<?php if ( $medicplus_countGallery > 1 ) { ?>
								<div class="post-nav">
									<a href="javascript:void(0)" class="disabled"><i class="fa fa-angle-left"></i></a>
									<a href="javascript:void(0)"><i class="fa fa-angle-right"></i></a>
								</div>
								<?php } ?>
							</div>
							<?php } //End if gallery_image ?>
			
							<div class="post-single-content entry-content">
								<?php
									the_content( sprintf( '<a href="%s" class="read-more">%s<i class="fa fa-angle-right"></i></a>',
											get_permalink(),
											esc_html__( 'Read more', 'medicplus' )
									) );
									wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'medicplus' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );
								?>
							</div>
						</div>
					</div>
				</div>
				<?php if( $medicplus_all_container_css['has_sidebar'] != 'none' ):?>
				<div id='page-sidebar' class="sidebar <?php echo esc_attr( $medicplus_all_container_css['sidebar_css'] )?>">
					<?php medicplus_get_sidebar( $medicplus_all_container_css['sidebar_id'] );?>
				</div>
				<?php endif;?>
			</div>
		</div> <!-- container -->
	</div>
</div>
<?php
endwhile;
wp_reset_postdata();
endif;
?>
<?php get_footer(); ?>