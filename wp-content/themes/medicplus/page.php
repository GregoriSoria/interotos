<?php
/**
 * The template for displaying all pages.
 *
 * @author Swlabs
 * @package MedicPlus
 * @since 1.0
 */
// css to show/hide sidebar.
$medicplus_all_container_css = medicplus_get_container_css();
get_header();
?>

<!-- Content section -->
<div class="section section-padding page-detail padding-top-100 padding-bottom-100">
	<div class="<?php echo esc_attr($medicplus_all_container_css['container_css']);?>">
		<div class="row">
			<div id="page-content" class="<?php echo esc_attr( $medicplus_all_container_css['content_css'] ); ?>">
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
					<?php while ( have_posts() ) : the_post(); ?>
						<?php do_action( 'medicplus_entry_thumbnail', array('page') );?>
						<div class="section-page-content clearfix ">
							<div class="entry-content">
								<?php the_content(); ?>
								<?php
									wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'medicplus' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );
								?>
							</div>
							<?php edit_post_link( esc_html__( 'Edit', 'medicplus' ), '<div class="edit-link"><i class="fa fa-pencil"></i>', '</div>' ); ?>
							<?php if ( comments_open() ) :
									echo '<div class="entry-comment entry-page-comment blog-detail">';
										comments_template();
									echo '</div>';
								endif;
							?>
						</div>

					<?php endwhile; // End of the loop. ?>

				</div>
			</div>
			<?php if( $medicplus_all_container_css['has_sidebar'] != 'none' ):?>
			<div id='page-sidebar' class="sidebar <?php echo esc_attr( $medicplus_all_container_css['sidebar_css'] ); ?>">
				<?php medicplus_get_sidebar($medicplus_all_container_css['sidebar_id']);?>
			</div>
			<?php endif;?>
		</div>
	</div>
</div>
<!-- #section -->
<?php get_footer(); ?>