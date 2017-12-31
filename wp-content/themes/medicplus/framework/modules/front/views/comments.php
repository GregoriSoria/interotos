<?php
$medicplus_commenter = wp_get_current_commenter();
$medicplus_req       = get_option( 'require_name_email' );
$medicplus_aria_req  = ( $medicplus_req ? " aria-required='true'" : '' );
$medicplus_html_req  = ( $medicplus_req ? " required='required'" : '' );
$medicplus_format    = 'xhtml';//The comment form format. Default 'xhtml'. Accepts 'xhtml', 'html5'.
$medicplus_html5     = 'html5' === $medicplus_format;
$medicplus_author_field = sprintf(
	'<div class="form-group form-md-line-input form-md-floating-label">
		<input id="author" name="author" type="text" class="comment-field form-input required form-control" value="%2$s" %3$s>
		<div id="author-err-required" class="input-error-msg hide">%4$s</div>
		<label for="author">%1$s</label>
	</div>',
	esc_html__( 'Name', 'medicplus' ),//placeholder
	esc_attr( $medicplus_commenter['comment_author'] ),//value
	$medicplus_aria_req . $medicplus_html_req, 
	esc_html__( 'Please enter your name.', 'medicplus' )//error message

);
$medicplus_email_field = sprintf(
	'<div class="form-group form-md-line-input form-md-floating-label">
		<input class="comment-field form-control form-input required"  id="email" name="email" %6$s value="%2$s" size="30" %3$s />
		<label for="email">%1$s</label>
		<div class="input-error-msg hide" id="email-err-required">%4$s</div>
		<div class="input-error-msg hide" id="email-err-valid">%5$s</div>
	</div>',
	esc_html__( 'Your Email', 'medicplus' ),//placeholder
	esc_attr( $medicplus_commenter['comment_author_email'] ),//value
	$medicplus_aria_req . $medicplus_html_req, 
	esc_html__( 'Please enter your email address.', 'medicplus' ),//error message
	esc_html__( 'Please enter a valid email address.', 'medicplus' ),//error message
	( $medicplus_html5 ? 'type="email"' : 'type="text"' )

);

$medicplus_comment_field = sprintf(
	'<div class="form-group form-md-line-input form-md-floating-label">
		<textarea id="comment" name="comment" required="required" class="comment-field form-control form-textarea form-input" ></textarea>
		<label for="comment">%1$s</label>
		<div class="input-error-msg hide" id="comment-err-required">%2$s</div>
	</div>',
	esc_html__( 'Your Comment', 'medicplus' ),//placeholder
	esc_html__( 'Please enter comment.', 'medicplus' )//error message
);

$medicplus_url = sprintf(
	'<div class="form-group form-md-line-input form-md-floating-label">
		<input  id="url" name="url" %3$s value="%2$s" class="comment-field url-field form-control form-input" size="30"/>
		<label for="url">%1$s</label>
	</div>',
	esc_html__( 'Your Website', 'medicplus' ),//placeholder
	esc_attr( $medicplus_commenter['comment_author_url'] ),//value
	( $medicplus_html5 ? 'type="url"' : 'type="text"' )
);

$medicplus_comments_args = array(
	'cancel_reply_link'   => esc_html__( 'Cancel', 'medicplus' ),
	'comment_notes_before'=> '',
	'format'              => $medicplus_format,
	'fields'              => array( 'author' => $medicplus_author_field, 'email' => $medicplus_email_field,'url' => $medicplus_url),
	'logged_in_as'        => '',
	'class_form'          => 'appointment-form',
	'id_form'             => 'commentform',
	'comment_field'       => $medicplus_comment_field,
	'label_submit'        => esc_html__( 'Submit comment ', 'medicplus' ),
	'title_reply'         => esc_html__( 'Leave your comment', 'medicplus' ),
	'submit_button'       => '<div class="btn-wrapper">
									<button id="submit" type="submit" class="btn btn-make-app">%4$s</button>
								</div>',
	'submit_field'        => '%1$s%2$s',
);
ob_start();
comment_form($medicplus_comments_args);