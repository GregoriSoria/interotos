<?php
/**
 * The default template for displaying content
 *
 * Used for single.
 *
 * @author Swlabs
 * @package MedicPlus
 * @since 1.0
 */
$medicplus_no_images = '';
if( ! has_post_thumbnail() ) {
	$medicplus_no_images = 'item-no-image';
}
?>
<div <?php post_class(); ?> >
	<div class="post-detail">
		<div class="post-single">
			<div class="medicplus-item item-blog-detail <?php echo esc_attr($medicplus_no_images);?>">
				<!-- thumbnail -->
				<?php do_action( 'medicplus_entry_video'); ?>
				<div class="post-meta">
					<!-- meta info -->
					<?php echo medicplus_post_date();
					do_action( 'medicplus_entry_meta');
					do_action('medicplus_share_link');?>

				</div>
			</div>
			<!-- title -->
			<?php the_title( '<h2 class="post-title">', '</h2>' );?>
			<!-- content -->
			<div class="post-single-content">
				<div class="entry-content">
					<?php
						the_content( sprintf( '<a href="%s" class="read-more">%s<i class="fa fa-angle-right"></i></a>',
								esc_url(get_permalink()),
								esc_html__( 'Read more', 'medicplus' )
						) );
						wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'medicplus' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );
					?>
				</div>
					<!-- tags info -->
				<?php do_action('medicplus_tags_meta');
				do_action('medicplus_categories_meta');
				do_action( 'medicplus_post_author' );?>
				
			</div>
			<!-- Related post -->
			<?php if( Medicplus::get_option('slz-blog-related-post') == 1 && MEDICPLUS_CORE_IS_ACTIVE && shortcode_exists('slzcore_news_carousel_sc')):
				echo do_shortcode('[slzcore_news_carousel_sc style="news_carousel_2" post_filter_by="post_same_category"]');
			endif;?>
		</div>
	</div>
</div>