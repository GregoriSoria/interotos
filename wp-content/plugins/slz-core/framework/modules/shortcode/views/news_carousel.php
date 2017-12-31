<?php
$model = new Medicplus_Core_Block;
$atts['layout'] = 'slide_news';

// 1: image, 2: title, 3: desc, 4: date, 5: meta, 6: class
if( $atts['style'] == 'news_carousel_2' ) {
	$atts['layout'] = 'carousel_news';
	$html_format = '
		<div class="media %6$s">
			<div class="media-left">
				%1$s
			</div>
			<div class="media-body">
				%2$s
				%5$s
			</div>
		</div>
		';
	$html_options = array(
		'html_format'  => $html_format,
		'title_format' => '<h4 class="media-heading"><a href="%2$s">%1$s</a></h4>',
		'thumb_class'  => 'media-object',
		'meta_info_format' => '<ul class="list-meta list-inline list-unstyled">
								<li>%1$s</li>
							</ul>',
		'thumb_href_class' => '',
	);
} else {
	//Slide
	$html_format = '
		<div class="recent-news-item item %6$s">
			<div class="recent-news-image recent-news-bg-img">
				%1$s
			</div>
			<div class="recent-news-content">
				%4$s
				%2$s
				<div class="recent-news-description">
					%3$s
				</div>
				%5$s
			</div>
		</div>
	';
	$html_options = array(
		'html_format'    => $html_format,
		'meta_seperate'  => '</li><li>',
		'bg_img_css'	 => '.%1$s .%2$s .recent-news-bg-img { background-image: url(%3$s);}' . "\n",
		'image_format'   => '<a href="%1$s" class="post-link">%2$s</a>',
	
	);
}
$model->init( $atts);
$block_cls = $model->attributes['extra_class'] . ' ' . $model->attributes['block-class'];
if( $model->query->have_posts()):
?>
	<?php if( $atts['style'] == 'news_carousel_2' ) :?>
		<div class="slz-shortcode recent-post-wrapper recent-slide <?php echo esc_attr( $block_cls ) ?> mbottom-50">
			<div class="post-list owl-carousel" data-prev="<?php esc_html_e('Prev', 'slz-core')?>" data-next="<?php esc_html_e('Next', 'slz-core')?>">
				<?php $model->render_carousel($html_options);?>
			</div>
		</div>
	<?php else :?>
		<div class="slz-shortcode recent-news <?php echo esc_attr( $block_cls ) ?>">
			<div class="recent-news-wrapper">
				<div class="recent-news-list">
				<?php $model->render_carousel($html_options);?>
				</div>
			</div>
		</div>
	<?php endif;?>
<?php endif;?>

