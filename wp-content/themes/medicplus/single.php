<?php
/**
 * The template for displaying all single posts.
 * 
 * @author Swlabs
 * @package MedicPlus
 * @since 1.0
 */
$medicplus_post_type = get_post_type();
$medicplus_custom_post_type = array('medicplus_dept', 'medicplus_service', 'medicplus_team' );
if(in_array( $medicplus_post_type, $medicplus_custom_post_type ) && MEDICPLUS_CORE_IS_ACTIVE ){
	$medicplus_post_type = str_replace('medicplus_', '', $medicplus_post_type);
	get_template_part( 'inc/single', $medicplus_post_type );
	return;
}
// css to show/hide sidebar.
$medicplus_all_container_css = medicplus_get_container_css();
get_header();
?>
<div class="section blog-detail padding-top-100 padding-bottom-100">
	<div class="<?php echo esc_attr( $medicplus_all_container_css['container_css'] ); ?>">
		<div class="blog-detail-wrapper">
			<div class="row">
				<div id="page-content" class="blog-content <?php echo esc_attr( $medicplus_all_container_css['content_css'] ); ?>">
					<div class="row">
						<div class="col-md-12  blog-detail-wrapper">
							<?php if ( have_posts() ) : ?>
								<?php /* Custom post type */ ?>
								<?php if ( $medicplus_post_type != 'post' ) : ?>
									<div class="section-content">
										<?php while ( have_posts() ) : the_post(); ?>
											<?php get_template_part( 'inc/single', $template ); ?>
											<?php
												// If comments are open or we have at least one comment, load up the comment template.
												if ( comments_open() || get_comments_number() ) :
													comments_template();
												endif;
											?>
										<?php endwhile; ?>
									</div>
								<?php else: //single post?>
									<div class="section-content">
										<?php /* The loop */ ?>
										<?php while ( have_posts() ) : the_post(); ?>
											<?php get_template_part( 'inc/content-single' ); ?>
										<?php endwhile; ?>
										<?php
										if ( is_single() && ( comments_open() || get_comments_number() ) ) :
											echo '<div class="entry-comment comments clearfix">';
											comments_template();
											echo '</div>';
										endif;
										?>
									</div>
									<div class="clear-fix" ></div>
								<?php endif;?>
							<?php else : ?>
								<?php get_template_part( 'inc/content', 'none' ); ?>
							<?php endif; // have_posts?>
						</div>
					</div>
				</div><!-- #page-content -->
				<?php if( $medicplus_all_container_css['has_sidebar'] != 'none' ):?>
				<div id='page-sidebar' class="sidebar <?php echo esc_attr( $medicplus_all_container_css['sidebar_css'] )?>">
					<?php medicplus_get_sidebar($medicplus_all_container_css['sidebar_id']);?>
				</div>
				<?php endif;?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>