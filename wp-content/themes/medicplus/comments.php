<?php
/**
 * The template for displaying comments.
 * 
 * The area of the page that contains both current comments
 * and the comment form.
 * 
 * @author Swlabs
 * @package MedicPlus
 * @since 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
	<?php if ( have_comments() ) : ?>
		<h3 class="comment-respond-title">
		<?php
			echo get_comments_number( get_the_id());
			echo '<span>'.esc_html__( ' Comments', 'medicplus' ).'</span>';
		?>
		</h3>
		<ol class="commentlist list-unstyled clearfix">
		<?php
			$medicplus_commemts_arg = array(
				'per_page'    => get_option( 'page_comments' ) ? get_option( 'comments_per_page' ) : '',
				'callback'    => 'medicplus_display_comments'
			);
			wp_list_comments( $medicplus_commemts_arg );
		?>
		</ol>
		<?php 
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<div class="paginate-com">
			<?php
				//Create pagination links for the comments on the current post, with single arrow heads for previous/next
				$medicplus_defaults = array(
					'add_fragment' => '#comments',
					'prev_text' => esc_html__( 'Previous', 'medicplus' ), 
					'next_text' => esc_html__( 'Next', 'medicplus' ),
				);
				paginate_comments_links( $medicplus_defaults );
			?>
		</div>
		<?php endif; // Check for comment navigation. ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
	<p class="no-comments"><?php esc_html_e( 'Comments are closed', 'medicplus' ); ?>.</p>
	<?php endif; ?>
	
	<?php
		//Comment Form
		do_action('medicplus_show_frm_comment');
	?>