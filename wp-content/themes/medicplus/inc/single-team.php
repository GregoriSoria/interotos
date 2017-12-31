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

	$medicplus_department    = get_post_meta( $medicplus_post_id, $medicplus_meta_prefix .'department', true );
	$medicplus_custom_css    = '';
	$medicplus_show_contact  = Medicplus::get_option('slz-team-contact-form');
	$medicplus_appointment   = Medicplus::get_option('slz-team-contact-sc');
	
	// css to show/hide sidebar.
	$medicplus_all_container_css = medicplus_get_container_css();
?>

<div id="post-<?php the_ID(); ?>" <?php post_class( 'post-inner' ); ?>>
	<div class="team-single padding-top-100 padding-bottom-100" >
		<div class="<?php echo esc_attr( $medicplus_all_container_css['container_css'] ); ?>">
			<div id="page-content" class="team-content <?php echo esc_attr( $medicplus_all_container_css['content_css'] ); ?>">
				<div >
					<?php
						if( !empty( $medicplus_post_id ) ){
							$medicplus_shortcode = sprintf('[slzcore_team_simple_sc team_id="%s" style="1" ]',
										$medicplus_post_id
									);
							echo do_shortcode( $medicplus_shortcode );
						}
					?>
				</div>
				<div class="post-single-content doctor-body-wrapper  entry-content">
					<?php
						the_content( sprintf( '<a href="%s" class="read-more">%s<i class="fa fa-angle-right"></i></a>',
								esc_url(get_permalink()),
								esc_html__( 'Read more', 'medicplus' )
						) );
						wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'medicplus' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );
					?>
				</div>
				<div class="appointment-wrapper">
					<div class="make-apppointment">
						<div class="">
							<?php if ($medicplus_show_contact == '1'){
								echo do_shortcode($medicplus_appointment);
						   	}?>
						</div>
					</div>
				</div>
			</div><!-- #page-content -->
			<?php if( $medicplus_all_container_css['has_sidebar'] != 'none' ):?>
			<div id='page-sidebar' class="sidebar <?php echo esc_attr( $medicplus_all_container_css['sidebar_css'] )?>">
				<?php medicplus_get_sidebar( $medicplus_all_container_css['sidebar_id'] );?>
			</div>
			<?php endif;?>
		</div> <!-- container -->
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