<?php
/**
 * The default template for displaying content
 *
 * Used for search.
 *
 * @author Swlabs
 * @package MedicPlus
 * @since 1.0
 */
?>
<div id="post-<?php the_ID(); ?>" <?php post_class( array('list-post', 'grid-item', 'post-inner') ); ?>>
	<div class="post-content no-thumbnails-image">
		<?php if ( 'page' !== get_post_type() ) : ?>
			<div class="post-meta">
				<?php echo medicplus_post_date();?>
				<?php do_action( 'medicplus_entry_meta');?>
			</div>
		<?php else:?>
			<?php edit_post_link( esc_html__( 'Edit', 'medicplus' ), '<div class="item edit-link"><i class="fa fa-pencil"></i>', '</div>' ); ?>
		<?php endif;?>
		<h2 class="post-title"> <?php the_title( sprintf( '<a  href="%s">', esc_url( get_permalink() ) ) , '</a>' ) ;?></h2>
		<div class="description entry-summary">
			<?php the_excerpt(); ?>
		</div>
		<?php if ( 'page' !== get_post_type() ) : ?>
			<div class="blog-meta">
				<?php do_action('medicplus_tags_meta');?>
				<?php do_action('medicplus_categories_meta');?>
			</div>
		<?php endif;?>
	</div>
</div>