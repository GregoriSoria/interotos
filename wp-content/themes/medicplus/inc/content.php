<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive.
 *
 * @author Swlabs
 * @package MedicPlus
 * @since 1.0
 */
$medicplus_no_image_class = 'no-thumbnails-image';
?>
<div class ="list-post post_class post-inner" id="post-<?php the_ID(); ?>">
	<!-- thumbnail -->
	<?php do_action( 'medicplus_entry_thumbnail');?>
	<div class="post-content <?php echo esc_attr($medicplus_no_image_class)?>">
		<div class="post-meta">
			<?php echo medicplus_post_date();?>
			<!-- //meta info -->
			<?php do_action('medicplus_entry_meta');?>
		</div>
		<!-- title -->
		<?php
			if ( is_single() ) :
				the_title( '<h1 class="post-title">', '</h1>' );
			else :
				the_title( sprintf( '<h1 class="post-title"><a href="%s">', esc_url( medicplus_get_link_url() ) ), '</a></h1>' );
			endif;
		?>
		<div class="post-single-content">

			<?php if ( has_excerpt() ) : ?>
				<div class="entry-summary">
					<?php the_excerpt(); ?>
				</div><!-- .entry-summary -->
			<?php endif;?>
			<div class="blog-descritption entry-content">
				<?php
					the_content( sprintf( '<a href="%s" class="read-more">%s<i class="fa fa-angle-right"></i></a>',
							esc_url(get_permalink()),
							esc_html__( 'Read more', 'medicplus' )
					) );
					wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'medicplus' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );
				?>
			</div><?php
			do_action('medicplus_tags_meta');
			do_action('medicplus_categories_meta');?>
		</div>
	</div>
	<?php if( is_single() ):?>
		<?php do_action( 'medicplus_post_author' );?>
	<?php endif;?>
</div>