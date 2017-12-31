<?php
/**
 * Index
 * 
 * @author Swlabs
 * @package MedicPlus
 * @since 1.0
 */
// css to show/hide sidebar.
$medicplus_all_container_css = medicplus_get_container_css();
get_header();
?>
<div class="section blog padding-top-100 padding-bottom-100" >
	<div class="<?php echo esc_attr( $medicplus_all_container_css['container_css'] );?>">
		<div class="blog-wrapper row">
			<div id="page-content" class="<?php echo esc_attr( $medicplus_all_container_css['content_css'] ); ?>">
				<?php if ( have_posts() ) : ?>
				<div class="post-wrapper">
					<div class="section-content">
						<!-- The loop -->
						<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'inc/content' ); ?>
						<?php endwhile; ?>
					</div>
					<div class="clearfix"></div>
					<?php echo medicplus_paging_nav(); ?>
				</div>
				<?php else : ?>
				<div class="section-content-none">
					<?php get_template_part( 'inc/content', 'none' ); ?>
				</div>
				<?php endif; ?>
			</div>
			<?php if( $medicplus_all_container_css['has_sidebar'] != 'none' ):?>
			<div id='page-sidebar' class="sidebar <?php echo esc_attr( $medicplus_all_container_css['sidebar_css'] ); ?>">
				<?php medicplus_get_sidebar($medicplus_all_container_css['sidebar_id']);?>
			</div>
			<?php endif;?>
		</div>
	</div>
</div>
<?php get_footer();?>