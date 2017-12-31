<?php
/**
 * The template for displaying a "No posts found" message
 *
 * @author Swlabs
 * @package MedicPlus
 * @since 1.0
 */
?>

<div class="page-header">
	<h2 class="title"><?php esc_html_e('We can&rsquo;t find what you&rsquo;re looking for!', 'medicplus'); ?></h2>
</div>

<div class="content-none">
	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

		<p><?php printf( '%1$s <a href="%2$s">%3$s</a>.', esc_html__( 'Ready to publish your first post?', 'medicplus' ), esc_url(admin_url( 'post-new.php' )), esc_html__( 'Get started here' , 'medicplus')); ?></p>

	<?php elseif ( is_search() ) : ?>

		<p><?php esc_html_e( 'Please try again with different keywords.', 'medicplus' ); ?></p>
		<div class="nav-search">
			<?php get_search_form(); ?>
		</div>

	<?php else : ?>

		<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'medicplus' ); ?></p>
		<div class="nav-search">
			<?php get_search_form(); ?>
		</div>

	<?php endif; ?>
	<?php do_action('medicplus_show_help_link');?>
</div>