<?php
if(empty($author_id)) {
	$author_id = get_query_var('author');
}
$author_url = get_author_posts_url( $author_id );
$author_desc = get_the_author_meta( 'description', $author_id );
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><?php esc_html_e('Posted by  ','medicplus');?><span><a  href="<?php echo esc_url( $author_url )?>"><?php echo get_the_author_meta('display_name', $author_id); ?></a></span></h3></div>
	<div class="panel-body">
		<div class="author-image">
			<a  href="<?php echo esc_url( $author_url )?>">
				<?php echo get_avatar($author_id, 64); ?>
			</a>
		</div>
		<?php echo nl2br( esc_textarea( $author_desc ) ) ?>
	</div>
</div>

 