<?php if($posttags):?>
<div class="tag-post-wrapper tag-meta">
	<div class="category-text"><?php esc_html_e('Tags:', 'medicplus')?></div><?php
	$links = array();
	foreach($posttags as $tag) {
		$tag_link = get_tag_link($tag->term_id);
		$links[] = sprintf( '<a href="%1$s" class="post-tag-link" rel="tag">%2$s</a>', esc_url( $tag_link ), esc_html( $tag->name ) );
	}// endforeach
	if( $links ) {
		echo '<ul class="tag-post-list list-inline list-unstyled">';
		echo '<li>'.implode('</li><li>', $links) .'</li>';
		echo '</ul>';
	}?>
</div><?php
endif;?>