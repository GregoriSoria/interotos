<?php
/**
 * Template Name: SLZ Coming Soon Template
 * 
 * @author Swlabs
 * @package Medicplus
 * @since 1.0
 */
get_header();
?>
<!-- Content section -->
<div class="session comming-soon-wrapper comming-soon-1">
	<?php while ( have_posts() ) : the_post(); ?>
		<div class="section-page-content clearfix ">
			<div class="entry-content">
				<?php the_content(); ?>
				<?php
					wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'medicplus' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );
				?>
			</div>
			<?php edit_post_link( esc_html__( 'Edit', 'medicplus' ), '<div class="edit-link"><i class="fa fa-pencil"></i>', '</div>' );
			?>
		</div>
	<?php endwhile; // End of the loop. ?>
</div>
<!-- #section -->
<?php get_footer('none'); ?>