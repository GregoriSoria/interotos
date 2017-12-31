<?php if($postcats):?>
<div class="tag-post-wrapper category-meta">
	<div class="category-text"><?php echo esc_html_e('Categories:', 'medicplus')?></div>
	<?php
	$links = array();
	foreach($postcats as $cat) {
		$cat_link = get_category_link($cat->term_id);
		$links[] = sprintf( '<a href="%1$s" class="post-tag-link">%2$s</a>', esc_url( $cat_link ), esc_html( $cat->name ) );
	}// endforeach
	if( $links ) {
		echo '<ul class="tag-post-list list-inline list-unstyled">';
		echo '<li>'.implode('</li><li>', $links) .'</li>';
		echo '</ul>';
	}?>
</div><?php
endif;?>