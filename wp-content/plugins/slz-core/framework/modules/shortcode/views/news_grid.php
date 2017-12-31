<?php
$model = new Medicplus_Core_Block;
if( $atts['style'] != 1 ){
	$atts['show_author'] = 'hide';
}
$model->init( $atts);
$block_cls   = $model->attributes['extra_class'] . ' ' . $model->attributes['block-class'];
$column_cls  = '';
$wrapper_cls = 'recent-news-list';
// 1: image, 2: title, 3: desc, 4: date, 5: meta, 6: class, 7: no_thumbnails_image, 8: post_id, 9: read_more_link
$html_format = '	
	<div class="grid-item recent-news-item %6$s" data-item=".post-%8$s">
		%1$s
		<div class="recent-news-content %7$s">
			%4$s
			%2$s
			<div class="recent-news-description">%3$s</div>
			<div class="recent-news-meta">
				%5$s
			</div>
			%9$s
		</div>
	</div>
';
$html_options = array(
	'meta_seperate'    => '</li><li>',
	'bg_img_css'       => '.%1$s .%2$s .video-bg { background-image: url(%3$s);}' . "\n",
	'title_format'     => '<h2 class="recent-news-title"><a href="%2$s">%1$s</a></h2>',
	'meta_info_format' => '<ul class="list-meta list-inline list-unstyled">
								<li>%1$s</li>
							</ul>',
	'image_format'     => '<div class="recent-news-image"><a href="%1$s">%2$s</a></div>'
);
if( $atts['style'] == 1 ){
	// 1: image, 2: title, 3: desc, 4: date, 5: meta, 6: class, 7: no_thumbnails_image, 8: post_id, 9: read_more_link
	$html_format = '
		<div class="grid-item post-inner %6$s" data-item=".post-%8$s">
			%1$s
			<div class="post-content %7$s">
				<div class="post-meta">
					%4$s
					%5$s
				</div>
				%2$s
				<div class="description">%3$s</div>
				%9$s
			</div>
		</div>
	';
	$html_options['title_format'] = '<h2 class="post-title"><a href="%2$s">%1$s</a></h2>';
	$html_options['image_format'] = '<div class="post-image"><a href="%1$s">%2$s</a></div>';
	// set wrapper class
	$wrapper_cls = 'post-wrapper';
	
	// set column class
	if( !empty( $atts['col'] ) && $atts['col'] == 2 ){
		$column_cls = 'blog-2col-non-sidebar';
		$wrapper_cls = 'post-wrapper row';
	}
}
else{
	if( $atts['style'] == 2 ){
		// set column class
		if( !empty( $atts['column'] ) && $atts['column'] == 2 ){
			$column_cls = 'blog-2col-sidebar';
		}
		elseif( !empty( $atts['column'] ) && $atts['column'] == 3 ){
			$column_cls = 'blog-3col';
		}
		else{
			$html_format = '
				<div class="grid-item post-inner %6$s" data-item=".post-%8$s">
					%1$s
					<div class="post-content %7$s">
						%4$s
						%2$s
						<div class="description">%3$s</div>
						<div class="post-meta">
							%5$s
						</div>
						%9$s
					</div>
				</div>
			';
			$html_options['title_format'] = '<h2 class="post-title"><a href="%2$s">%1$s</a></h2>';
			$html_options['image_format'] = '<div class="post-image"><a href="%1$s">%2$s</a></div>';
			// set wrapper class
			$wrapper_cls = 'post-wrapper row';
		}
	}
	else{
		if( !empty( $atts['col'] ) && $atts['col'] == 2 ){
			$column_cls = 'blog-2col';
		}
		$html_options['bg_img_css'] = '.%1$s .%2$s .recent-news-image { background-image: url(%3$s);}';
		$html_options['show_no_image'] = true;
	}
}
$html_options['html_format'] = $html_format;
printf('<div class="slz-shortcode blog-wrapper %1$s %2$s style-%3$s" data-item=".%4$s">',
		esc_attr( $block_cls ),
		esc_attr( $column_cls ),
		esc_attr( $atts['style'] ),
		esc_attr( $model->attributes['block-class'] )
	);
	printf( '<div class="%s">', esc_attr( $wrapper_cls ) );
		echo '<div class="grid">';
			$model->render_grid($html_options);
		echo '</div>';
	echo '</div>';
	//paging
	if( $model->attributes['pagination'] == 'yes' ) {
		echo Medicplus_Core_Pagination::paging_nav( $model->query->max_num_pages, 2, $model->query);
	}
echo '</div>';
?>