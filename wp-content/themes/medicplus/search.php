<?php
/**
 * The template for displaying Search Results pages
 * 
 * @author Swlabs
 * @package MedicPlus
 * @since 1.0
 */
// css to show/hide sidebar.
$medicplus_all_container_css = medicplus_get_container_css();

if(get_post_type() == "page") {
	$medicplus_css = '
	#wrapper #content-wrapper {
		padding-top: 80px;
		padding-bottom: 80px;
	}';
	do_action( 'medicplus_add_inline_style', $medicplus_css);
}
get_header();
?>
<div class="section blog padding-top-100 padding-bottom-100">
	<div class="<?php echo esc_attr( $medicplus_all_container_css['container_css'] );?>">
		<div class="blog-wrapper row">
			<div id="page-content" class="blog-content <?php echo esc_attr( $medicplus_all_container_css['content_css'] ); ?>">
				<div class="search-page">
					<?php if ( have_posts() && strlen( trim(get_search_query()) ) != 0 ) : ?>
					<div class="nav-search">
						<?php get_search_form(); ?>
					</div>
					<div class="news-detail-wrapper">
						<!-- The loop -->
						<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'inc/content-search' ); ?>
						<?php endwhile; ?>
						<?php echo medicplus_paging_nav(); ?>
					</div>
					<?php else : ?>
						<?php get_template_part( 'inc/content', 'none' ); ?>
					<?php endif; ?>
				</div>
			</div>
			<?php if( $medicplus_all_container_css['has_sidebar'] != 'none' ):?>
				<div id='page-sidebar' class="sidebar <?php echo esc_attr( $medicplus_all_container_css['sidebar_css'] ); ?>">
					<?php medicplus_get_sidebar($medicplus_all_container_css['sidebar_id']);?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php get_footer();?>